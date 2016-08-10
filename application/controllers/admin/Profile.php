<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users Class
 *
 * @author Colan
 */
class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');

        cipl_admin_auth($this);
    }
    
    public function index() {
        $admin_id = $this->session->userdata('admin_id');
        $admin_details = $this->admin_model->get_admin_details($admin_id);
        $data['admin_details'] = $admin_details[0];
        
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/profile/edit', $data);
        $this->load->view('admin/common/footer');
    }
}