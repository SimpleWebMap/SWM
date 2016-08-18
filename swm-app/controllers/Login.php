<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Constructor
	 *
	 */
	public function __construct(){
		parent::__construct();
		initialize_dashboard();
	}


	public function index()
	{
        //if you are logged redirects to the dashboard
        if (be_logged(FALSE)) redirect('dashboard');
        $this->load->model('users_model', 'users');
        //data validation
		$this->form_validation->set_message('required', 'O campo %s é requerido');
        $this->form_validation->set_message('valid_email', 'E-mail inválido');
        $this->form_validation->set_message('min_length', 'O campo %s curto demais');
        $this->form_validation->set_rules('email', strtoupper('E-mail'), 'trim|required|strtolower|valid_email');
        $this->form_validation->set_rules('password', strtoupper('Senha'), 'trim|required|min_length[6]');
        //performs login
        if ($this->form_validation->run()==TRUE):
            $login = $this->input->post('email', TRUE);
            $password = md5($this->input->post('password', TRUE));
            $redirect = $this->input->post('redirect', TRUE);
            //creates a login session
            if ($query = $this->users->do_login($login, $password)):
                $data = array(
                    'user_id' => (string)$query['id'],
                    'user_email' => (string)$query->email,
                    'user_name' => (string)$query->name,
                    'user_level' => (string)$query->user_level,
                    'user_logged' => TRUE
                );
                $this->session->set_userdata($data);
                set_msg('msg', 'Login efetuado com sucesso!', 'success');
                if ($redirect != ''):
                    redirect($redirect);
                else:
                    redirect('dashboard'); 
                endif;
            else:
                set_msg('msg', 'E-mail ou senha incorreta!', 'error');
                redirect('login');
            endif;
        endif;

		set_theme('template', 'login_template_view');
		set_theme('the_title', 'Login');
		set_theme('content', load_module('login_view', 'login'));
		load_template();
	}

    public function newpass()
    {
        //if you are logged redirects to the dashboard
        if (be_logged(FALSE)) redirect('dashboard');
        //data validation
        $this->form_validation->set_message('required', 'O campo %s é requerido');
        $this->form_validation->set_message('valid_email', 'E-mail inválido');
        $this->form_validation->set_message('min_length', 'O campo %s curto demais');
        $this->form_validation->set_rules('email', strtoupper('E-mail'), 'trim|required|strtolower|valid_email');
        //send a new password
        if ($this->form_validation->run() == TRUE):
            $this->load->model('users_model', 'users');
            $email = $this->input->post('email');
            $query = $this->users->get_id_by_email($email);
            if($query):
                $id = $query;
                $new_password = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm123456789'), 0, 6);
                $mensage = "<p>Uma nova senha foi gerada para o seu perfil.Acesse ".base_url('index.php/login').", use seu e-mail e a senha <strong>$new_password</strong> para acessar o sistema.</p></p>";
                if ($this->system->send_email($email, 'Nova senha de acesso a '.base_url(), $mensage)):
                    $data['pass'] = md5($new_password);
                    $this->users->update_user_by_id($data, $id);
                    set_msg('msg', 'Uma nova senha foi enviada para o seu e-mail.'.$new_password, 'sucess');
                    redirect('login');
                else:
                    set_msg('msg', 'Erro ao enviar nova senha, entre em contato com o administrador.', 'error');
                    redirect('login/newpass');
                endif;
            else:
                set_msg('msg', 'Nenhum usuário registrado com este e-mail foi encontrado.', 'error');
                redirect('login/newpass');
            endif;
        endif;
        set_theme('template', 'login_template_view');
        set_theme('the_title', 'Recuperar senha');
        set_theme('content', load_module('login_view', 'newpass'));
        load_template();
    }

	// --------------------------------------------------------------------

    /**
     * The logoff page
     *
     * Page to block access the system
     * Performs off the system.
     *
     * @access     public
     * @since      0.0.0
     * @modify     0.0.0
     */
	public function logoff(){
        //clears the session
        $data = array(
            'user_id' => '',
            'user_email' => '',
            'user_name' => '',
            'user_level' => '',
            'user_logged' => FALSE
        );
        $this->session->unset_userdata($data);
        $this->session->set_userdata($data);
        set_msg('msg', 'Logoff efetuado com sucesso!', 'success');
        redirect('login');
    }

}
