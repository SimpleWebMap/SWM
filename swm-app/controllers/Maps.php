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
		
		print_r($this->input->post('multiselect'));
		$this->load->model('maps_model', 'maps');
		init_htmleditor();
		init_multiselect();
		set_theme('the_title', 'Mapas');
		if(get_setting('method') == '0'):
			set_theme('content', load_module('maps_view', 'map_unique'));
		endif;
		load_template();
	}
}
