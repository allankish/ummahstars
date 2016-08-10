<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Age Groups Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Subscription_Model extends CI_Model 
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
    
   
    
    public function addSubscriptionPlan()
    {
        
        $data = array("plan_name" => trim($this->input->post('plan_name')),
                      "duration" => $this->input->post('duration'),
                      "price" => $this->input->post('price'),
                      "sort_order" => $this->input->post('sort_order'),
                      );
        
        $this->db->insert('subscription_plans', $data);
       
        return true;
    }
    
    public function listSubscriptionPlans()
    {
        
        $this->db->select('*')->from('subscription_plans')->order_by('sort_order','asc');
        $query = $this->db->get();
       
        return $result = $query->result_array();
       
    }
    
    
    public function getSubscriptionPlans($plan_id)
    {
        
        
        
        $this->db->select('*')->from('subscription_plans');
        $this->db->where('plan_id',$plan_id);
        $query = $this->db->get();
       
        $result = $query->result_array();
        return $result;
       
    }
    
    public function editSubscriptionPlan($plan_id)
    {
        
        $data = array("plan_name" => trim($this->input->post('plan_name')),
                      "duration" => $this->input->post('duration'),
                      "price" => $this->input->post('price'),
                      "sort_order" => $this->input->post('sort_order')
                      );
        
        $this->db->where('plan_id', $plan_id);
        $this->db->update('subscription_plans', $data);
       
        return true;
    }
    
    public function deleteSubscriptionPlan($plan_id)
    {
        
        
        $this->db->where('plan_id', $plan_id);
        $this->db->delete('subscription_plans');
       
        return true;
    }
    
}