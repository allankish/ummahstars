<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Language Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Users_Model extends CI_Model
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
    
   
    
    public function get_users_list()
    {
        $this->db->select('*')->from('users')->order_by('user_id','asc');
        //run the query
        $query = $this->db->get();
       
        return $result = $query->result_array();
    }
    
}