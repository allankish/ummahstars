<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Log in Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Login_Model extends CI_Model
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
    
   
    
    public function admin_authentication($post)
    {
		$email_id = $post['email_id'];
		$password = $post['password'];
        $this->db->select('*')->from('admin')->where(array('admin_email' => $email_id, "password" => md5($password)));
        //run the query
        $query = $this->db->get();
       
        return $result = $query->result_array();
    }
	
	
    
}