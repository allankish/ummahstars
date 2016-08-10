<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

/**
 * Dashboard Class
 */
class Dashboard extends CI_Controller {
      
    function __construct() {
        parent::__construct();

        $this->load->library('javascript');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');

        cipl_admin_auth();
    }

    public function index() {
        $data = '';
        $this->load->view('admin/common/header');
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/common/footer');
    }

}
