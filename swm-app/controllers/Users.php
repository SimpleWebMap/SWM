<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Constructor
	 *
	 */
	public function __construct(){
		parent::__construct();
        be_logged();
		initialize_dashboard();
	}


	public function index()
	{
        //if you are logged redirects to the dashboard
        $this->load->model('users_model', 'users');

		set_theme('the_title', 'Usuários');
		set_theme('content', load_module('users_view', 'users'));
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
	public function edit(){
		if ($this->uri->segment(3) == NULL):
			redirect('users');
		endif;
        $this->load->model('users_model', 'users');
        $this->form_validation->set_message('required', 'O campo %s é requerido');
        $this->form_validation->set_message('valid_email', 'E-mail inválido');
        $this->form_validation->set_message('min_length', 'O campo %s curto demais');
        $this->form_validation->set_rules('email', strtoupper('E-mail'), 'trim|required|strtolower|valid_email');
        $this->form_validation->set_rules('pass', strtoupper('Senha'), 'trim|min_length[6]');
        if ($this->form_validation->run()==TRUE):
        	$id = $this->input->post('id', TRUE);
        	$data['name'] = $this->input->post('name', TRUE);
            $data['email'] = $this->input->post('email', TRUE);
            $data['tel'] = $this->input->post('tel', TRUE);
            $data['address'] = $this->input->post('address', TRUE);
            $data['user_updated'] = date('Y-m-d H:i:s');
            if($this->input->post('pass', TRUE) != NULL):
            	$data['pass'] = md5($this->input->post('pass', TRUE));
            endif;
            $result = $this->users->update_user_by_id($data, $id);
            if($result):
            	set_msg('msg', 'Dados alterados com sucesso!', 'success');
            	redirect('users');
            else:
            	set_msg('msg', 'Erro ao alterar dados.', 'error');
           	endif;
        endif;
		set_theme('the_title', 'Editar usuários');
		set_theme('content', load_module('users_view', 'edit'));
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
	public function insert(){
        $this->load->model('users_model', 'users');
        $this->form_validation->set_message('required', 'O campo %s é requerido');
        $this->form_validation->set_message('valid_email', 'E-mail inválido');
        $this->form_validation->set_message('min_length', 'O campo %s curto demais');
        $this->form_validation->set_rules('email', strtoupper('E-mail'), 'trim|required|strtolower|valid_email');
        $this->form_validation->set_rules('pass', strtoupper('Senha'), 'trim|required|min_length[6]');
        if ($this->form_validation->run()==TRUE):
        	$data['name'] = $this->input->post('name', TRUE);
            $data['email'] = $this->input->post('email', TRUE);
            $data['tel'] = $this->input->post('tel', TRUE);
            $data['address'] = $this->input->post('address', TRUE);
            $data['pass'] = md5($this->input->post('pass', TRUE));
            $data['user_registered'] = date('Y-m-d H:i:s');
            $result = $this->users->insert_user($data);
            if($result):
            	set_msg('msg', 'Usuário inserido com sucesso!', 'success');
            	redirect('users');
            else:
            	set_msg('msg', 'Erro ao inserir usuário.', 'error');
           	endif;
        endif;
		set_theme('the_title', 'Inserir novo usuário');
		set_theme('content', load_module('users_view', 'insert'));
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
	public function delete(){
		if ($this->uri->segment(3) == NULL):
			redirect('users');
		endif;
        $this->load->model('users_model', 'users');
        $id = $this->uri->segment(3);
        if($id == NULL):
        	set_msg('msg', 'Erro ao tentar excluir usuário.', 'error');
        	redirect('users');
        elseif($id == 0):
        	set_msg('msg', 'Este usuário não pode ser excluído.', 'error');
        else:
        	$this->users->delete_user_by_id($id);
        	set_msg('msg', 'Usuário excluido com sucesso!', 'success');
        endif;
    	redirect('users');
    }

}
