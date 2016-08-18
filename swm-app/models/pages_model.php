<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

    /**
     * Constructor
     *
     */
    public function __construct(){
        parent::__construct();
    }

    public function get_pages(){
        $params = array('path' => 'swm-app/database/pages.xml');
        $this->load->library('easyxmlclone', $params);
        return $this->easyxmlclone->child_exists('pages', 'page');
    }

    public function get_id_by_slug($slug){
        $params = array('path' => 'swm-app/database/pages.xml');
        $this->load->library('easyxmlclone', $params);
        $result = $this->easyxmlclone->get_by_child('pages', 'page', 'slug', $slug);
        if($result->slug == $slug):
            return $result['id'];
        else:
            return FALSE;
        endif;
    }

    public function get_page_by_id($id){
        $params = array('path' => 'swm-app/database/pages.xml');
        $this->load->library('easyxmlclone', $params);
        $result = $this->easyxmlclone->attribute_value_exists('pages', 'page', 'id', $id);
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function insert_page($data){
        $params = array('path' => 'swm-app/database/pages.xml');
        $this->load->library('easyxmlclone', $params);
        return $this->easyxmlclone->insert($data, 'pages', 'page');
    }

    public function update_page_by_id($data, $id){
        $params = array('path' => 'swm-app/database/pages.xml');
        $this->load->library('easyxmlclone', $params);
        return $this->easyxmlclone->update($data, 'pages', 'page', 'id', $id);
    }

}