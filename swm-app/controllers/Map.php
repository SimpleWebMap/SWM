<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

	/**
	 * Constructor
	 *
	 */
	public function __construct(){
		parent::__construct();

		initialize_map();
	}


	public function index()
	{
		init_chart();
		set_theme('the_title', 'Título do mapa');
		set_theme('content', load_module('map_view', 'map'));
		load_template();
	}
}
