<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Categories Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Categories_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $categories_tbl;
    protected $sections_tbl;

    function __construct() {
        parent::__construct();
        $this->categories_tbl = "categories";
        $this->sections_tbl = 'sections';
    }

    public function getAllCategories() {
        $this->db->select($this->categories_tbl.'.*,' . $this->sections_tbl . '.section_name')->from($this->categories_tbl)->where('parent_id', '0')->order_by($this->categories_tbl . '.sort_order', 'ASC');
        $this->db->join($this->sections_tbl, $this->sections_tbl . '.section_id = ' . $this->categories_tbl . '.section_id');
        $query = $this->db->get();
        $root_categories = $query->result_array();
        
        $all_categories = array();
        foreach ($root_categories as $root_category) {
            $this->db->select($this->categories_tbl.'.*,' . $this->sections_tbl . '.section_name')->from($this->categories_tbl)->where('parent_id', $root_category['category_id'])->order_by($this->categories_tbl . '.sort_order', 'ASC');
            $this->db->join($this->sections_tbl, $this->sections_tbl . '.section_id = ' . $this->categories_tbl . '.section_id');
            $query = $this->db->get();
            $child_categories = $query->result_array();
            $all_categories[] = array(
                "category_id" => $root_category["category_id"],
                "category_name" => $root_category["category_name"],
                "category_type" => $root_category["category_type"],
                "parent_id" => $root_category["parent_id"],
                "section_id" => $root_category["section_id"],
                "section_name" => $root_category["section_name"],
                "background_image" => $root_category["background_image"],
                "need_payment" => $root_category["need_payment"],
                "sort_order" => $root_category["sort_order"],
                "created_on" => $root_category["created_on"],
                "updated_on" => $root_category["updated_on"],
                "child_categories" => $child_categories
            );
        }
        //echo '<pre>';print_r($all_categories);
        return $all_categories;
    }
    
    public function getCategory($category_id) {
        $this->db->select('*')->from($this->categories_tbl)->where('category_id', $category_id);
        $query = $this->db->get();
        return $category_details = $query->result_array();
    }
    
    public function getRootCategories() {
        $this->db->select('*')->from($this->categories_tbl)->where('parent_id', '0')->order_by($this->categories_tbl . '.sort_order', 'ASC');
        $query = $this->db->get();
        return $root_categories = $query->result_array();
    }

    public function getAllSections() {
        $section_ids = array('1', '2');
        $this->db->select('*')->from($this->sections_tbl)->order_by('sort_order', 'asc');

        $this->db->where_not_in('section_id', $section_ids);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function addCategory($data) {
        return $this->db->insert($this->categories_tbl, $data);
    }

    public function updateCategory($data, $category_id) {
        $this->db->where('category_id', $category_id);
        return $this->db->update($this->categories_tbl, $data);
    }

    public function deleteCategory($data) {
        $category_id = $data["category_id"];
        $result = $this->db->delete($this->categories_tbl, array('category_id' => $category_id));
        return $result;
    }

}
