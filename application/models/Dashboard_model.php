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
}
