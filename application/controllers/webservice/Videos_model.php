<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Videos_Model extends CI_Model
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        
    }
    
    public function fetchLandingPageVideo()
    {
        
        $this->db->select('content');
        $this->db->where("section_id",1);
        $query = $this->db->get('contents');
        
        $result = $query->result_array();
        
        return array("result" => "success", 
					"message" => "Landing page video url returned",
					"response" => array('video_url' => base_url().$result[0]['content'])
					);
        
    }
    
    
    public function fetchTryMeVideos()
    {
        
        $this->db->select('ag.age_group_name,ct.content,ct.video_thumb');
        $this->db->from('contents as ct');
        $this->db->join('age_group as ag','ag.age_group_id=ct.age_group_id');
        $this->db->where("ct.section_id",2);
        $query = $this->db->get();
        
        $videos = $query->result_array();
		
        $response = array();  
        $ind = 0;
        foreach($videos as $video)
        {
           
            $response[$video['age_group_name']][$ind.'_v']['video_url'] = base_url().$video['content'];
            $response[$video['age_group_name']][$ind.'_v']['video_thumb_url'] = base_url().$video['video_thumb'];
            $ind++;
        }
		$result = array("result" => "success",
						"message" => "Try me videos returned",
						"response" => $response);
              //  print_r($response);
        return $result;
        
    }
    
    
}
