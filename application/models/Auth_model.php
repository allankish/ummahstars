<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Auth Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Auth_Model extends CI_Model {
    protected $users_tbl;
    /**
     * Constructor
     * 
     * @access public
     */
    function __construct() {
        $this->users_tbl = 'users';
        parent::__construct();
    }

    public function user_authentication($where) {
        $this->db->select('*')->from($this->users_tbl)->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    public function update_last_login($user_id) {
        $data = array("last_login" => date('Y-m-d H:i:s'));
        $this->db->where("user_id", $user_id);
        $this->db->update($this->users_tbl, $data);
        return true;
    }
    
    public function add_parent($data) {
        $this->db->set($data);
        return $this->db->insert($this->users_tbl);
    }

    public function check_parent_exists($email) {
        $this->db->select('*')->from($this->users_tbl)->where("email_id", $email);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    
    public function update_user($data, $user_id) {
        $this->db->where("user_id", $user_id);
        $this->db->update($this->users_tbl, $data);
        return true;
    }
}
