<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    /**
     * Constructor
     *
     */
    public function __construct(){
        parent::__construct();
    }

    public function get_settings(){
        $params = array('path' => 'swm-app/database/settings.xml');
        $this->load->library('easyxml', $params);
        $result = $this->easyxml->attribute_value_exists('settings', 'setting', 'id', '0');
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function update_setting($data){
        $params = array('path' => 'swm-app/database/settings.xml');
        $this->load->library('easyxml', $params);
        return $this->easyxml->update($data, 'settings', 'setting', 'id', '0');
    }
}