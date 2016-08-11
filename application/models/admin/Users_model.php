<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Users Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Users_Model extends CI_Model {

    public $users_tbl;
    public $age_group_tbl;

    /**
     * Constructor
     * 
     * @access public
     */
    function __construct() {
        parent::__construct();
        $this->users_tbl = 'users';
        $this->age_group_tbl = 'age_group';
    }

    public function get_users_list() {
        $this->db->select('*')->from($this->users_tbl)->order_by('user_id', 'asc');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_user_details($user_id) {
        $this->db->select('*')->from($this->users_tbl)->where('user_id', $user_id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_child_count($user_id) {
        $this->db->from($this->users_tbl)->where(array('parent_id' => $user_id, 'user_role' => '3'));
        $total = $this->db->count_all_results();
        return $total;
    }

    public function get_child_list($user_id) {
        $this->db->select('*')->from($this->users_tbl)->where(array("user_role" => "3", "parent_id" => $user_id))->order_by('user_id', 'asc');
        $this->db->join($this->age_group_tbl, $this->age_group_tbl . '.age_group_id = ' . $this->users_tbl.'.age_group');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    
    public function get_child_details($user_id) {
        $this->db->select('*')->from($this->users_tbl)->where('user_id', $user_id);
        $this->db->join($this->age_group_tbl, $this->age_group_tbl . '.age_group_id = ' . $this->users_tbl.'.age_group');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function update_user($data, $user_id) {
        $this->db->set($data);
        $this->db->where("user_id", $user_id);
        return $this->db->update($this->users_tbl);
    }
    
    public function add_user($data) {
        $this->db->set($data);
        return $this->db->insert($this->users_tbl);
    }
    
    public function delete_user($data) {
        $user_id            = $data["user_id"];
        $result             = $this->db->delete($this->users_tbl, array('user_id' => $user_id));
        return $result;
    }
    
    public function delete_child($data) {
        $child_id            = $data["child_id"];
        $result             = $this->db->delete($this->users_tbl, array('user_id' => $child_id));
        return $result;
    }
    
    public function validate_email($email, $user_id = '') {
        if ($user_id != '') {
            $this->db->select('*')->where(array('email_id = ' => $email, "user_id" => $user_id));
        } else {
            $this->db->select('*')->where(array('email_id = ' => $email));
        }
        $rows = $this->db->count_all_results($this->users_tbl);
        if ($rows > 0) {
            return false;
        } else {
            return true;
        }
    }

}