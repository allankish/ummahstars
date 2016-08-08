<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('admin_auth'))
            redirect('usadmin/login', 'refresh');
    }

    public function index() {
        if ($this->session->userdata('admin_auth')) {
            $unset_items = array('admin_id' => '', 'admin_email' => '', 'admin_auth' => '');

            $this->session->unset_userdata($unset_items);

            $this->session->sess_destroy();
        }
        redirect('usadmin/login', 'refresh');
    }

}
