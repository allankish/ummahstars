<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Content Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Content_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $content_tbl;
  

    function __construct() {
        parent::__construct();
        $this->content_tbl = "contents";
        
    }

    

    public function addContent($data) {
        return $this->db->insert($this->content_tbl, $data);
    }
    
    public function updateContent($data,$content_id) {
        
        $this->db->where('content_id', $content_id);
        return $this->db->update('contents', $data); 
        
    }
    
     public function getContentList() {
        $this->db->select('t1.content_type,t1.content_id,t1.created_date,t1.sort_order,t2.section_name,t3.category_name,t4.age_group_name,')->from('contents as t1');
        $this->db->join('sections as t2','t2.section_id = t1.section_id');
        $this->db->join('categories as t3','t3.category_id = t1.category_id');
        $this->db->join('age_group as t4','t4.age_group_id = t1.age_group_id');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    
    public function getContentById($content_id)
    {
        
        $this->db->select('*,t2.category_name')->from('contents as t1')->where('t1.content_id',$content_id);
        $this->db->join('categories as t2','t2.category_id = t1.category_id');
        $query = $this->db->get();
        return $result = $query->result_array();
        
        
    }
    
    public function deleteContent($content_id) {
        
        $result = $this->db->delete($this->content_tbl, array('content_id' => $content_id));
        return $result;
    }

   

}
