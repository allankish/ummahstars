<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Auth Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class TryMe_model extends CI_Model {
    protected $users_tbl;
    /**
     * Constructor
     * 
     * @access public
     */
    function __construct() {
       
        parent::__construct();
    }

    public function fetchTryMeVideos($age_group_id) {
        $this->db->select('*')->from('contents')->order_by('sort_order','ASC');
        if($age_group_id!='All')
        $this->db->where("age_group_id",$age_group_id);
        $this->db->where("section_id",'2');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    
}
