<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Dashboard Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Dashboard_Model extends CI_Model {
    protected $users_tbl;
    protected $age_groups_tbl;
    /**
     * Constructor
     * 
     * @access public
     */
    function __construct() {
        $this->users_tbl = 'users';
        $this->age_groups_tbl = 'age_group';
        parent::__construct();
    }

    public function get_childs_by_parent($parent_id) {
        $query = $this->db->select('*')->where(array('parent_id' => $parent_id, 'user_role' => '3'))->from($this->users_tbl)->get();
        $childs = $query->result_array();
        return $childs;
    }
    
    public function get_all_age_groups() {
        $query = $this->db->select('*')->order_by('sort_order', 'ASC')->from($this->age_groups_tbl)->get();
        $age_groups = $query->result_array();
        return $age_groups;
    }
    
    public function get_age_group($age_group_id) {
        $query = $this->db->select('*')->where('age_group_id', $age_group_id)->from($this->age_groups_tbl)->get();
        return $query->result_array();
    }
    
    public function update_child_mode($user_id, $child_mode) {
        
        $data = array('child_mode' => $child_mode);
        $this->db->where('user_id', $user_id);
        $this->db->update($this->users_tbl, $data);
        
        return true;
    }

    public function get_parent_info($parent_id) {
        $query = $this->db->select('*')->where(array('user_id' => $parent_id, 'user_role' => '2'))->from($this->users_tbl)->get();
        $parent = $query->row_array();
        return $parent;
    }
}
