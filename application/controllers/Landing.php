<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landing extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        
    }

    public function index() {

        $req = $_REQUEST;
        if(isset($req['code'])) {
            redirect(base_url()."gpluslogin?code=".$req['code'], 'refresh');
            //redirect(base_url()."user_authentication", 'refresh');
        }
        $this->load->view('front/landing/home');
    }

}
