<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Section Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Section_Model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $sections_tbl;
    function __construct() {
        parent::__construct();
        $this->sections_tbl = 'sections';
    }

    public function addSection($data) {
        $this->db->insert($this->sections_tbl, $data);
        return true;
    }

    public function listSection() {

        $this->db->select('*')->from($this->sections_tbl)->order_by('sort_order', 'asc');
        $section_ids = array('1', '2');
        $this->db->where_not_in('section_id', $section_ids);
        $query = $this->db->get();

        return $result = $query->result_array();
    }

    public function getSection($section_id) {

        $this->db->select('*')->from($this->sections_tbl);
        $this->db->where('section_id', $section_id);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    public function editSection($data, $section_id) {

        $this->db->where('section_id', $section_id);
        $this->db->update($this->sections_tbl, $data);
        return true;
    }

    public function deleteSection($data) {
        $section_id         = $data["section_id"];
        $result             = $this->db->delete($this->sections_tbl, array('section_id' => $section_id));
        return $result;
    }

}