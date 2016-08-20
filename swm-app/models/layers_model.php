<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layers_model extends CI_Model {

    /**
     * Constructor
     *
     */
    public function __construct(){
        parent::__construct();
    }

    public function get_layers(){
        $path = 'swm-app/database/layers.xml';
        $this->load->library('easyxml');
        return $this->easyxml->child_exists($path, 'layers', 'layer');
    }

    public function get_id_by_slug($slug){
        $path = 'swm-app/database/pages.xml';
        $this->load->library('easyxml');
        $result = $this->easyxml->get_by_child($path, 'pages', 'page', 'slug', $slug);
        if($result->slug == $slug):
            return $result['id'];
        else:
            return FALSE;
        endif;
    }

    public function get_page_by_id($id){
        $path = 'swm-app/database/pages.xml';
        $this->load->library('easyxml');
        $result = $this->easyxml->attribute_value_exists($path, 'pages', 'page', 'id', $id);
        if(count(obj_to_array($result))):
            return obj_to_array($result)[0];
        endif;;
    }

    public function insert_page($data){
        $path = 'swm-app/database/pages.xml';
        $this->load->library('easyxml');
        return $this->easyxml->insert($path, $data, 'pages', 'page');
    }

    public function update_page_by_id($data, $id){
        $path = 'swm-app/database/pages.xml';
        $this->load->library('easyxml');
        return $this->easyxml->update($path, $data, 'pages', 'page', 'id', $id);
    }

}