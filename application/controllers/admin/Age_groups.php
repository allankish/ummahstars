<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Age Groups Class
 *
 * @author Colan
 */
class Age_groups extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        
        $this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->model('admin/age_groups_model');

		cipl_admin_auth($this);
    }
	
	public function index() {
		
	}
	
	// List Age Groups
    public function list_age_groups() {
		$data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        $this->load->view('admin/common/header');
		$this->load->view('admin/age_groups/list', $data);
        $this->load->view('admin/common/footer');
    }
	
	// Add age group
	public function add_age_group() {
		$this->load->view('admin/common/header');
		$this->load->view('admin/age_groups/add');
        $this->load->view('admin/common/footer');
	}
	
	// Edit age group
	public function edit_age_group() {
		$this->load->view('admin/common/header');
		$this->load->view('admin/age_groups/edit');
        $this->load->view('admin/common/footer');
	}
}