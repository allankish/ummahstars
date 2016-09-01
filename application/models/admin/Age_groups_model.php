<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Age Groups Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Age_groups_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $age_group_tbl;
    function __construct() {
        parent::__construct();
        $this->age_group_tbl = "age_group";
    }

    public function get_all_age_groups() {
        $this->db->select('*')->from($this->age_group_tbl)->order_by('sort_order', 'ASC');

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
        $password_required  = $data["password_required"];
        $data = array("age_group_name" => $age_group_name, "sort_order" => $sort_order, "password_required" => $password_required);
        return $this->db->insert($this->age_group_tbl, $data);
    }
    
    public function update_age_group($data) {
        $age_group_name     = $data["age_group_name"];
        $sort_order         = $data["sort_order"];
        $password_required  = $data["password_required"];
        $data_array         = array("age_group_name" => $age_group_name, "sort_order" => $sort_order, "password_required" => $password_required);
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