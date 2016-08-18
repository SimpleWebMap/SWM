<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        $this->load->model('settings_model', 'settings');
        
        if ($this->input->post('save')):
            $data = $this->input->post();
            unset($data['save']);
            $result = $this->settings->update_setting($data);
            if($result):
                set_msg('msg', 'Dados alterados com sucesso!', 'success');
                redirect('settings');
            else:
                set_msg('msg', 'Erro ao alterar dados.', 'error');
            endif;
        endif;

		set_theme('the_title', 'Configurações');
		set_theme('content', load_module('settings_view', 'settings'));
		load_template();
	}

}
