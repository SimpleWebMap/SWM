<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

 /**
 * Be Logged
 *
 * Checks if the User is logged into the system.
 * 
 * @access  private
 * @param   bool
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function be_logged($redir=TRUE){
    $CI =& get_instance();
    $CI->load->helper('url');
    $user_status = get_session('user_logged');
    if (!isset($user_status) || $user_status != TRUE):
        if ($redir):
            $CI->session->set_userdata(array('redir_for'=>current_url()));
            set_msg('msg', 'Acesso restrito', 'error');
            redirect('login');
        else:
            return FALSE;
        endif;
    else:
        return TRUE;
    endif;
}


// ------------------------------------------------------------------------

 /**
 * Get Session
 *
 * Returns a session with the default prefix.
 * 
 * @access  private
 * @param   string
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function get_session($session=NULL){
    $CI =& get_instance();
    $CI->load->library('session');
    $return_session = $CI->session->userdata($session);
    return $return_session;
}




function get_setting($setting=NULL){
    $CI =& get_instance();
    $CI->load->model('settings_model', 'settings');
    $all_settings =$CI->settings->get_settings();
    if($setting != NULL && array_key_exists($setting, $all_settings)):
        return $all_settings[$setting];
    else:
        return NULL;
    endif;
}

// ------------------------------------------------------------------------

 /**
 * Set MSG
 *
 * Sets a message to be displayed on the next screen loaded.
 * 
 * @access  private
 * @param   string string string
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function set_msg($id='msgerror', $msg=NULL, $type='error'){
    $CI =& get_instance();
    switch ($type):
        case 'error':
            $CI->session->set_flashdata($id, '<div class="alert callout" data-closable>'.$msg.'<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>');
            break;
        case 'success':
            $CI->session->set_flashdata($id, '<div class="success callout" data-closable>'.$msg.'<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>');
            break;
        default:
            $CI->session->set_flashdata($id, '<div class="warning callout" data-closable>'.$msg.'<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>');
            break;
    endswitch;
}

// ------------------------------------------------------------------------

 /**
 * Get MSG
 *
 * Checks for a message to be displayed on screen and displays tual.
 * 
 * @access  private
 * @param   string string
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function get_msg($id, $printar=TRUE){
    $CI =& get_instance();
    if ($CI->session->flashdata($id)):
        if($printar):
            echo $CI->session->flashdata($id);
            return TRUE;
        else:
            return $CI->session->flashdata($id);
        endif;
    endif;
    return FALSE;
}


// ------------------------------------------------------------------------

 /**
 * Errors Validating
 *
 * Displays validation errors in forms.
 * 
 * @access  private
 * @param   no
 * @return  string
 * @since   0.0.0
 * @modify  0.0.0
 */
function errors_validating(){
    if (validation_errors()):
        echo '<div class="alert callout" data-closable>'.validation_errors('<div>', '</div>').'<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';
    endif;
}



function obj_to_array($obj){
    if($obj):
        $array = array();
        $i = 0;
        foreach ($obj as $key => $value):
            foreach($value as $k => $v):
                $array[$i][(string)$k] = (string)$v;
            endforeach;
            $i++;
        endforeach;
        return $array;
    else:
        return false;
    endif;
}


function get_user_name_by_id($id){
    $CI =& get_instance();
    $CI->load->model('users_model', 'users');
    return $CI->users->get_user_by_id($id);
}