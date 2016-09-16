<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Dashboard Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Child_Model extends CI_Model {
    protected $users_tbl;
    protected $age_groups_tbl;
    /**
     * Constructor
     * 
     * @access public
     */
    function __construct() {
        $this->sections_tbl = 'sections';
        $this->cat_tbl = 'categories';
        parent::__construct();
    }

    public function get_sections($slug) {
        $query = $this->db->select('*')->where(array('slug' => $slug))->from($this->sections_tbl)->get();
        $section = $query->row_array();
        return $section;
    }
    
    public function get_parent_categories($section_id) {
        $query = $this->db->select('*')->order_by('sort_order', 'ASC')->where(array('section_id' => $section_id, 'parent_id'=>0))->from($this->cat_tbl)->get();
        $categories = $query->result_array();
        return $categories;
    }
    
  
}
