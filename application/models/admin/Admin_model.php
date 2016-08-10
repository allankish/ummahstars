<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Admin Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Admin_Model extends CI_Model {

    public $admin_tbl;

    /**
     * Constructor
     * 
     * @access public
     */
    function __construct() {
        parent::__construct();
        $this->admin_tbl = 'admin';
    }

    public function get_admin_details($admin_id) {
        $this->db->select('*')->from($this->admin_tbl)->where('admin_id', $admin_id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function update_admin($data, $admin_id) {
        $this->db->set($data);
        $this->db->where("admin_id", $admin_id);
        return $this->db->update($this->admin_tbl);
    }

}