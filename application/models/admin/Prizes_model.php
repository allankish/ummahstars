<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Prizes Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Prizes_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $prizes_tbl;
    protected $users_tbl;

    function __construct() {
        parent::__construct();
        $this->prizes_tbl = "prizes";
        $this->users_tbl = "users";
    }

    public function getAllPrizes() {
        $this->db->select($this->prizes_tbl . '.*,' . $this->users_tbl . '.uname')->from($this->prizes_tbl)->order_by($this->prizes_tbl . '.prize_name', 'ASC');
        $this->db->join($this->users_tbl, $this->users_tbl . '.user_id=' . $this->prizes_tbl . '.created_by', 'left');
        $query = $this->db->get();
        $prizes = $query->result_array();

        return $prizes;
    }

    public function getPrize($prize_id) {
        $this->db->select('*')->from($this->prizes_tbl)->where('prize_id', $prize_id);
        $query = $this->db->get();
        return $prize_details = $query->result_array();
    }

    public function addPrize($data) {
        return $this->db->insert($this->prizes_tbl, $data);
    }

    public function updatePrize($data, $prize_id) {
        $this->db->where('prize_id', $prize_id);
        return $this->db->update($this->prizes_tbl, $data);
    }

    public function deletePrize($data) {
        $prize_id = $data["prize_id"];
        $result = $this->db->delete($this->prizes_tbl, array('prize_id' => $prize_id));
        return $result;
    }

}
