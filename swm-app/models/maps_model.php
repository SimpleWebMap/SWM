<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_model extends CI_Model {

    /**
     * Constructor
     *
     */
    public function __construct(){
        parent::__construct();
    }

    public function get_map_by_id($id){
        $params = array('path' => 'swm-app/database/maps.xml');
        $this->load->library('easyxml', $params);
        $result = $this->easyxml->attribute_value_exists('maps', 'map', 'id', '0');
        print_r($result);
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function update_user_by_id($data, $id){
        $params = array('path' => 'swm-app/database/users.xml');
        $this->load->library('easyxml', $params);
        return $this->easyxml->update($data, 'users', 'user', 'id', $id);
    }

}