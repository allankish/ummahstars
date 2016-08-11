<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Categories Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Categories_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    public $categories_tbl;
    function __construct() {
        parent::__construct();
        $this->categories_tbl = "categories";
    }

    public function get_all_categories() {
        $this->db->select('*')->from($this->categories_tbl)->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    
    public function get_age_group($age_group_id) {
        $this->db->select('*')->from($this->age_group_tbl)->where('age_group_id', $age_group_id);

        $query = $this->db->get();
        
        return $result = $query->result_array();
    }
    
    public function add_age_group($data) {
        $age_group_name     = $data["age_group_name"];
        $sort_order         = $data["sort_order"];
        $data = array("age_group_name" => $age_group_name, "sort_order" => $sort_order);
        return $this->db->insert($this->age_group_tbl, $data);
    }
    
    public function update_age_group($data) {
        $age_group_name     = $data["age_group_name"];
        $sort_order         = $data["sort_order"];
        $data_array         = array("age_group_name" => $age_group_name, "sort_order" => $sort_order);
        $this->db->set($data_array);
        $this->db->where('age_group_id', $data["age_group_id"]);
        return $this->db->update($this->age_group_tbl);
    }
    
    public function delete_age_group($data) {
        $age_group_id       = $data["age_group_id"];
        $result             = $this->db->delete($this->age_group_tbl, array('age_group_id' => $age_group_id));
        return $result;
    }

}