<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Age Groups Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Age_groups_model extends CI_Model 
{
    /**
     * Constructor
     * 
     * @access public
     */
    function __construct()
    {
        parent::__construct();
    }
    
   
    
    public function get_all_age_groups()
    {
        $this->db->select('*')->from('age_groups')->order_by('sort_order','asc');
        //run the query
        $query = $this->db->get();
       
        return $result = $query->result_array();
    }
    
}