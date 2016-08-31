<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('user_auth'))
            redirect('login', 'refresh');
    }

    public function index() {
        if ($this->session->userdata('user_auth')) {
            $unset_items = array('user_details' => '', 'user_auth' => '');

            $this->session->unset_userdata($unset_items);

            $this->session->sess_destroy();
        }
        redirect('login', 'refresh');
    }

}
