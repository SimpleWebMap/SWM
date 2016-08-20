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
            $path = 'swm-app/database/users.xml';
            $this->load->library('easyxml');
            if ( $result = $this->easyxml->get_by_child($path, 'users', 'user', 'email', $login) ):
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
        $path = 'swm-app/database/users.xml';
        $this->load->library('easyxml');
        return $this->easyxml->child_exists($path, 'users', 'user');
    }

    public function get_id_by_email($email){
        $path = 'swm-app/database/users.xml';
        $this->load->library('easyxml');
        $result = $this->easyxml->get_by_child($path, 'users', 'user', 'email', $email);
        if($result->email == $email):
            return $result['id'];
        else:
            return FALSE;
        endif;
    }

    public function get_user_by_id($id){
        $path = 'swm-app/database/users.xml';
        $this->load->library('easyxml');
        $result = $this->easyxml->attribute_value_exists($path, 'users', 'user', 'id', $id);
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function update_user_by_id($data, $id){
        $path = 'swm-app/database/users.xml';
        $this->load->library('easyxml');
        return $this->easyxml->update($path, $data, 'users', 'user', 'id', $id);
    }

    public function delete_user_by_id($id){
        $path = 'swm-app/database/users.xml';
        $this->load->library('easyxml');
        return $this->easyxml->removeNodeByAttrib($path, 'users', 'user', 'id', $id);
    }

    public function insert_user($data){
        $path = 'swm-app/database/users.xml';
        $this->load->library('easyxml');
        return $this->easyxml->insert($path, $data, 'users', 'user');
    }
}