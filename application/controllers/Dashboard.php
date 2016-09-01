<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Dashboard Class
 *
 * @author Colan
 */
class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        cipl_user_auth();

    }

    public function index() {
        $parent_details = $this->session->userdata("user_details");
        $data["parent_details"] = $parent_details;
        
        $this->load->view('front/common/header');
        if ($parent_details['child_mode'] == false) {
            $this->load->view('front/dashboard/parent_index', $data);
        } else {
            $this->load->view('front/dashboard/child_index', $data);
        }
        
        $this->load->view('front/common/footer');
    }

}
