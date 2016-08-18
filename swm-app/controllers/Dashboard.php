<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		init_chart();
		set_theme('the_title', 'Dashboard');
		set_theme('content', load_module('dashboard_view', 'dashboard'));
		load_template();
	}
}
