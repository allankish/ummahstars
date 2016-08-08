<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users Class
 *
 * @author Colan
 */
class Users extends CI_Controller 
{

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/users_model');
        
        cipl_admin_auth($this);

    }

    // List all users
    public function list_users() {
        $data['users'] = $this->users_model->get_users_list();
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add new user
    public function add_user() {
        $data = '';
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/add', $data);
        $this->load->view('admin/common/footer');
    }

    // Edit user details
    public function edit_user() {
        $data = '';
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete user from database
    public function delete_user() {
        
    }

    // View a user details from database
    public function view_user() {
        $data = '';
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/view', $data);
        $this->load->view('admin/common/footer');
    }

}