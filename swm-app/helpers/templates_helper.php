<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Templates functions
 *
 * Helper functions used in construction operations for the system layout(template)
 *
 * @package     Compass
 * @subpackage  Core
 * @copyright   Copyright (c) 2014, Compass, Inc.
 * @author      Francisco Rodrigo Cunha de Sousa
 * @link        http://rodrigosousa.info
 * @since       0.0.0
 */


// ------------------------------------------------------------------------

 /**
 * Initialize Dashboard
 *
 * initialize the admin panel charging system and that the necessary resources are recurrent use.
 * 
 * @access  private
 * @param   no
 * @return  NULL
 * @since   0.0.0
 * @modify  0.0.0
 */
function initialize_dashboard(){
    $CI =& get_instance();
    //loads librarys, helpers and models recurrently used in the system
    $CI->load->library(array('parser', 'system', 'session', 'form_validation'));
    $CI->load->helper(array('form', 'url', 'array', 'text'));
    //property standards as the title of the panel and roapé (are automatically entered in the system settings)
    set_theme('theme', 'default');
    set_theme('title_default', 'Título do meu site');
    set_theme('footer', '');
    set_theme('template', 'template_view');
    set_theme('menu', main_menu());
    //loading css in header
    set_theme('headerinc', load_css(array('foundation.min', 'style', 'font-awesome.min', 'table-sorter')), FALSE);
    //loading js in footer
    
    set_theme('footerinc', load_js(array('vendor/jquery', 'vendor/what-input', 'vendor/foundation.min', 'jquery.tablesorter.min', 'jquery.tablesorter.pager', 'app')), FALSE);
    //startup package
}

// ------------------------------------------------------------------------

 /**
 * Load Module
 *
 * Loads a module of the system returning the requested screen in view format.
 * 
 * @access  private
 * @param   string string string array
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function load_module($module=NULL, $screen=NULL, $array=array()){
    $CI =& get_instance();
    //performs the function only if the module is not null
    if ($module != NULL):
        $vars['screen'] = $screen;
        if ($array != NULL):
            foreach ($array as $k => $v):
                $vars[$k] = $v;
            endforeach;
        endif;
        //loads the view
        return $CI->load->view("$module", $vars, TRUE);
    else:
        return FALSE;
    endif;
}

// ------------------------------------------------------------------------

 /**
 * Set Theme
 *
 * Sets values ​​to the overall theme of the array class system, to be used throughout the system.
 * 
 * @access  private
 * @param   string string bool bool
 * @return  NULL
 * @since   0.0.0
 * @modify  0.0.0
 */
function set_theme($prop, $value, $replace=TRUE, $load_template=TRUE){
    $CI =& get_instance();
    $CI->load->library('system');
    if ($replace):
        $CI->system->theme[$prop] = $value;
    else:
        if (!isset($CI->system->theme[$prop])) $CI->system->theme[$prop] = '';
        $CI->system->theme[$prop] .= $value;
    endif;
}

// ------------------------------------------------------------------------

 /**
 * Load Template
 *
 * Loads a template theme through the array as parameter.
 * 
 * @access  private
 * @param   no
 * @return  NULL
 * @since   0.0.0
 * @modify  0.0.0
 */
function load_template(){
    $CI =& get_instance();
    $CI->load->library('system');
    $CI->parser->parse($CI->system->theme['template'], $CI->system->theme);
}

// ------------------------------------------------------------------------

 /**
 * Load CSS
 *
 * Load one or more files. css in a folder.
 * 
 * @access  private
 * @param   string string string
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function load_css($file=NULL, $folder='css', $media='all',$tab=2){
    if ($file != NULL):
        $CI =& get_instance();
        $CI->load->helper('url');
        $return = '';
        if (is_array($file)):
            foreach ($file as $css):
                $return .= '<link rel="stylesheet" type="text/css" href="'.base_url("swm-content/includes/$folder/$css.css").'" media="'.$media.'" />';
            	if($tab > 0):
            		$return .= "\n";
            		for ($i=0; $i < $tab; $i++):
            			$return .= "\t";
            		endfor;
            	endif;
            endforeach;
        else:
            $return .= '<link rel="stylesheet" type="text/css" href="'.base_url("swm-content/includes/$folder/$file.css").'" media="'.$media.'" />'."\n";
        	if($tab > 0):
        		$return .= "\n";
        		for ($i=0; $i < $tab; $i++):
        			$return .= "\t";
        		endfor;
        	endif;
        endif;
    endif;
    return $return;
}

// ------------------------------------------------------------------------

 /**
 * Load JS
 *
 * Load one or more files. js folder or a remote server.
 * 
 * @access  private
 * @param   string string bool
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function load_js($file=NULL, $folder='js', $remote=FALSE, $tab=2){
    if ($file != NULL):
        $CI =& get_instance();
        $CI->load->helper('url');
        $return = '';
        if (is_array($file)):
            foreach ($file as $js):
                if ($remote):
                    $return .= '<script type="text/javascript" src="'.$js.'"></script>';
                else:
                    $return .= '<script type="text/javascript" src="'.base_url("swm-content/includes/$folder/$js.js").'"></script>';
                endif;
                if($tab > 0):
            		$return .= "\n";
            		for ($i=0; $i < $tab; $i++):
            			$return .= "\t";
            		endfor;
            	endif;
            endforeach;
        else:
            return NULL;
        endif;
    endif;
    return $return;
}

// ------------------------------------------------------------------------

 /**
 * Initialize Tinymce
 *
 * Initialize the tinymce to create textarea with html editor.
 * 
 * @access  private
 * @param   no
 * @return  NULL
 * @since   0.0.0
 * @modify  0.0.0
 */
function init_chart(){
    $CI =& get_instance();
    set_theme('footerinc', load_js(array('chart.min')), FALSE);
}


function init_htmleditor(){
    $CI =& get_instance();
    set_theme('footerinc', load_js(array('tinymce/tinymce.min')), FALSE);
}

function init_multiselect(){
    $CI =& get_instance();
    set_theme('headerinc', load_css(array('multi-select')), FALSE);
    set_theme('footerinc', load_js(array('jquery.multi-select', 'jquery.quicksearch')), FALSE);
}


function main_menu(){
	return 
	menu('separator', 'Dashboard').
	menu('menu', 'Início', 'dashboard', 'index').
	menu('menu', 'Mapas', 'maps', 'index').
	menu('menu', 'Camadas', 'layers', 'index').
	menu('menu', 'Atributos', 'attr', 'index').
	menu('menu', 'Páginas', 'pages', 'index').
	menu('separator', 'Ferramentas').
	menu('menu', 'Relatórios', 'reports', 'index').
	menu('menu', 'Configurações', 'settings', 'index').
	menu('menu', 'Usuários', 'users', 'index').
	menu('menu', 'Sair', 'login', 'logoff');
}

function menu($type=NULL, $title=NULL, $value_class='dashboard', $value_method='index'){
	$CI =& get_instance();
    $CI->load->helper('url');
    $class = $CI->router->class;
    $method = $CI->router->method;

	if($type == 'menu'):
		if($value_class == $class):
			return "<li class='active'><a href='".base_url("index.php/$value_class/$value_method")."'>$title</a></li>";
		else:
			return "<li><a href='".base_url("index.php/$value_class/$value_method")."'>$title</a></li>";
		endif;
	elseif($type == 'separator'):
		return '<li class="separator"><span>'.$title.'</span></li>';
	else:
		return NULL;
	endif;
}

