<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Register Class
 *
 * @author Colan
 */
class Register extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('auth_model');
    }

    public function index() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'email_id',
                    'label' => 'Email Id',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'retype_password',
                    'label' => 'Retype Password',
                    'rules' => 'trim|required|matches[password]'
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
                $data = array(
                            "email_id"      => $this->input->post('email_id'), 
                            "password"      => md5($this->input->post('password')),
                            "gender"        => $this->input->post('gender'),
                            "uname"         => $this->input->post('uname'),
                            "profile_image" => '',
                            "user_role"     => '2',
                            "age"           => '0',
                            "age_group"     => '0',
                            "parent_id"     => '0',
                            "logged_in"     => '0',
                            "status"        => '0',
                            "created_on"    => date('Y-m-d H:i:s'),
                            "child_mode"    => 'false',
                            "parent_type"   => 'active',
                            "child_allowed" => '4'
                        );
                $result = $this->auth_model->add_parent($data);                
            }
        }
        $this->load->view('front/common/header');
        $this->load->view('front/register/index');
        $this->load->view('front/common/footer');
    }

}
