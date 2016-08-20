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
        $path = 'swm-app/database/maps.xml';
        $this->load->library('easyxml');
        $result = $this->easyxml->attribute_value_exists($path, 'maps', 'map', 'id', '0');
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function update_map_by_id($data, $id){
        $path = 'swm-app/database/maps.xml';
        $this->load->library('easyxml');
        return $this->easyxml->update($path, $data, 'maps', 'map', 'id', $id);
    }

}