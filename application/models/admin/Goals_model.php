<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Goals Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Goals_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $goals_tbl;
    protected $prizes_tbl;
    protected $users_tbl;
    protected $age_groups_tbl;
                function __construct() {
        parent::__construct();
        $this->goals_tbl = "goals";
        $this->prizes_tbl = "prizes";
        $this->users_tbl = "users";
        $this->age_groups_tbl = "age_group";
    }

    public function getAllGoals() {
        $this->db->select('g.*, u.uname, u1.uname as "assigned_uname", a.age_group_name, p.prize_name')->from($this->goals_tbl . " g")->order_by('g.created_on', 'DESC');
        $this->db->join($this->users_tbl . " u", 'u.user_id = g.created_by', 'left');
        $this->db->join($this->users_tbl . " u1", 'u1.user_id = g.assigned_to', 'left');
        $this->db->join($this->age_groups_tbl . " a", 'a.age_group_id = g.age_group', 'left');
        $this->db->join($this->prizes_tbl . " p", 'p.prize_id = g.prize_id', 'left');
        $query = $this->db->get();
        $goals = $query->result_array();

        return $goals;
    }

    public function getGoal($goal_id) {
        $this->db->select('*')->from($this->goals_tbl)->where('goal_id', $goal_id);
        $query = $this->db->get();
        return $goal_details = $query->result_array();
    }

    public function addGoal($data) {
        return $this->db->insert($this->goals_tbl, $data);
    }

    public function updateGoal($data, $goal_id) {
        $this->db->where('goal_id', $goal_id);
        return $this->db->update($this->goals_tbl, $data);
    }

    public function deleteGoal($data) {
        $goal_id = $data["goal_id"];
        $result = $this->db->delete($this->goals_tbl, array('goal_id' => $goal_id));
        return $result;
    }

}
