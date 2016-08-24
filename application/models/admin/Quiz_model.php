<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Quiz Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Quiz_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $quiz_tbl;
  

    function __construct() {
        parent::__construct();
        $this->quiz_tbl = "quiz";
        
    }

    public function addQuiz($data) {
        return $this->db->insert($this->quiz_tbl, $data);
    }
    
    public function getAllQuiz()
    {
        
        $this->db->select('t1.quiz_id,t1.quiz_title,t1.created_date,t2.section_name,t3.category_name,t4.age_group_name,')->from('quiz as t1');
        $this->db->join('sections as t2','t2.section_id = t1.section_id');
        $this->db->join('categories as t3','t3.category_id = t1.category_id');
        $this->db->join('age_group as t4','t4.age_group_id = t1.age_group_id');
        $query = $this->db->get();
        return $result = $query->result_array();
        
        
    }
    
    public function getQuiz($quiz_id) {
        
       $this->db->select('*')->from($this->quiz_tbl)->where('quiz_id', $quiz_id);
        $query = $this->db->get();
        return $quiz_details = $query->result_array();
        
    }
    
    public function quizCatCheck($data,$quiz_id="") {
        
        $this->db->select('*')->from($this->quiz_tbl);
        $this->db->where('age_group_id', $data['age_group_id']);
        $this->db->where('category_id', $data['category_id']);
        
        if($quiz_id!="")
        {
        $this->db->where_not_in('quiz_id', $quiz_id);
        }
        $query = $this->db->get();
        if($query->num_rows() == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        
        
        
    }
    
    public function updateQuiz($data,$quiz_id) {
        
        $this->db->where('quiz_id', $quiz_id);
        return $this->db->update($this->quiz_tbl, $data); 
        
    }
    
    public function deleteQuiz($quiz_id) {
        
        $result = $this->db->delete($this->quiz_tbl, array('quiz_id' => $quiz_id));
        return $result;
    }
    
    
    
    

}


