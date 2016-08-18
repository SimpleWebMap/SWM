<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    /**
     * Constructor
     *
     */
    public function __construct(){
        parent::__construct();
    }



    // --------------------------------------------------------------------

    /**
     * Sign in
     *
     * Used of checks if the username and password exist in bd.
     *
     * @access     private
     * @since      0.0.0
     * @modify     0.0.0
     */
    public function do_login($login=NULL, $password=NULL){
        if ($login && $password):
            $params = array('path' => 'swm-app/database/users.xml');
            $this->load->library('easyxml', $params);
            if ( $result = $this->easyxml->get_by_child('users', 'user', 'email', $login) ):
                if ($result->pass == $password):
                    return($result);
                else:
                    return FALSE;
                endif;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

    public function get_users(){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        return $this->easyxml->child_exists('users', 'user');
    }

    public function get_id_by_email($email){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        $result = $this->easyxml->get_by_child('users', 'user', 'email', $email);
        if($result->email == $email):
            return $result['id'];
        else:
            return FALSE;
        endif;
    }

    public function get_user_by_id($id){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        $result = $this->easyxml->attribute_value_exists('users', 'user', 'id', $id);
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function update_user_by_id($data, $id){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        return $this->easyxml->update($data, 'users', 'user', 'id', $id);
    }

    public function delete_user_by_id($id){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        return $this->easyxml->removeNodeByAttrib('users', 'user', 'id', $id);
    }

    public function insert_user($data){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        return $this->easyxml->insert($data, 'users', 'user');
    }
}