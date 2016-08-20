<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {

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
		$this->load->model('maps_model', 'maps');
		init_htmleditor();
		init_multiselect();
		set_theme('the_title', 'Mapas');
		if(get_setting('method') == '0'):
	        $this->form_validation->set_message('required', 'O campo %s é requerido');
	        $this->form_validation->set_rules('title', strtoupper('Título'), 'trim|required');
	        if ($this->form_validation->run()==TRUE):
	        	$id = 0;
	        	$data = $this->input->post();
	        	$layers = NULL;
	        	if(isset($data['layers'])):
		        	foreach($data['layers'] as $layer):
		        		$layers .= $layer.',';
		        	endforeach;
		        endif;
	        	$data['layers'] = $layers;
            	unset($data['save']);
	            $result = $this->maps->update_map_by_id($data, $id);
	            if($result):
	            	set_msg('msg', 'Dados alterados com sucesso!', 'success');
	            	//redirect('maps');
	            else:
	            	set_msg('msg', 'Erro ao alterar dados.', 'error');
	           	endif;
	        endif;
			set_theme('content', load_module('maps_view', 'map_unique'));
		endif;
		load_template();
	}
}
