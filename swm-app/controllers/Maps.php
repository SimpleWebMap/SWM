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
		if (isset($this->input->post()['teste'])) {
		print_r($this->input->post()['teste']);	# code...
		}
		
		$this->load->model('maps_model', 'maps');
		$this->load->model('pages_model', 'pages');
		init_htmleditor();
		init_multiselect();
		set_theme('the_title', 'Mapas');
		if(get_setting('method') == '0'):
	        $this->form_validation->set_message('required', 'O campo %s é requerido');
	        $this->form_validation->set_rules('title', strtoupper('Título'), 'trim|required');
	        if ($this->form_validation->run()==TRUE):
	        	$id = 0;
	        	$data = $this->input->post();
	        	$pages = NULL;
	        	if(isset($data['pages'])):
		        	foreach($data['pages'] as $page):
		        		$pages .= $page.',';
		        	endforeach;
		        endif;
	        	$data['pages'] = $pages;
	        	$layers = NULL;
	        	if(isset($data['layers'])):
		        	foreach($data['layers'] as $layer):
		        		$layers .= $layer.',';
		        	endforeach;
		        endif;
	        	$data['layers'] = $layers;
	        	$checkboxes = array('btn_buttons_zoom', 'btn_slider_zoom', 'btn_button_extend', 'btn_button_geolocation', 'btn_button_north', 'btn_button_info', 'btn_button_fullscreen', 'elm_bar_scale', 'elm_north', 'elm_buttons_navigation', 'elm_overview', 'elm_bar_status', 'eli_title', 'eli_banner', 'eli_footer', 'eli_siderbar', 'eli_statusbar', 'eli_menu', 'eln_basemap', 'eln_search', 'eln_pages', 'els_legend', 'els_layers', 'els_info', 'els_filters');
	        	foreach ($checkboxes as $checkbox):
	        		if(isset($this->input->post()[$checkbox])):
						$data[$checkbox] = 1;
					else:
						$data[$checkbox] = 0;
					endif;
	        	endforeach;
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
