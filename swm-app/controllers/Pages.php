<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
        $this->load->model('pages_model', 'pages');

		set_theme('the_title', 'Páginas');
		set_theme('content', load_module('pages_view', 'pages'));
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
        $this->load->model('pages_model', 'pages');
        init_htmleditor();
        $this->form_validation->set_message('required', 'O campo %s é requerido');
        $this->form_validation->set_message('min_length', 'O campo %s curto demais');
        $this->form_validation->set_rules('title', strtoupper('Título'), 'trim|required|min_length[5]');
        if ($this->form_validation->run()==TRUE):
            $id = $this->uri->segment(3);
            $data['title'] = $this->input->post('title', TRUE);
            $data['author'] = get_session('user_id');
            $content = html_entity_decode($this->input->post('content', TRUE));
            $data['content'] = $content;
            $data['slug'] = url_title($this->input->post('title', TRUE), 'underscore', TRUE);
            $data['date'] = date('Y-m-d H:i:s');
            $data['date_update'] = date('Y-m-d H:i:s');
            $result = $this->pages->update_page_by_id($data, $id);
            if($result):
                set_msg('msg', 'Página publicada com sucesso!', 'success');
                redirect('pages/index/');
            else:
                set_msg('msg', 'Erro ao editar página.', 'error');
            endif;
        endif;

		set_theme('the_title', 'Editar página');
		set_theme('content', load_module('pages_view', 'edit'));
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
        $this->load->model('pages_model', 'pages');
        $this->load->model('users_model', 'users');
        init_htmleditor();
        $this->form_validation->set_message('required', 'O campo %s é requerido');
        $this->form_validation->set_message('min_length', 'O campo %s curto demais');
        $this->form_validation->set_rules('title', strtoupper('Título'), 'trim|required|min_length[5]');
        if ($this->form_validation->run()==TRUE):
        	$data['title'] = html_entity_decode($this->input->post('title', TRUE));
            $data['author'] = get_session('user_id');
            $content = html_entity_decode($this->input->post('content', TRUE));
            $data['content'] = $content;
            $data['slug'] = url_title($this->input->post('title', TRUE), 'underscore', TRUE);
            $data['date'] = date('Y-m-d H:i:s');
            $data['date_update'] = date('Y-m-d H:i:s');
            $result = $this->pages->insert_page($data);
            if($result):
            	set_msg('msg', 'Página publicada com sucesso!', 'success');
            	redirect('pages');
            else:
            	set_msg('msg', 'Erro ao adicionar nova página.', 'error');
           	endif;
        endif;
		set_theme('the_title', 'Adicionar nova página');
		set_theme('content', load_module('pages_view', 'insert'));
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
