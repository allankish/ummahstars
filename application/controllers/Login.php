<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Login Class
 *
 * @author Colan
 */
class Login extends CI_Controller {

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
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
                $data = array(
                            "email_id"      => $this->input->post('email_id'), 
                            "password"      => md5($this->input->post('password')),
                            "user_role"     => "2"
                        );
                $result = $this->auth_model->user_authentication($data);

                if(isset($result) && sizeof($result) > 0) {
                    $user_details = $result[0];
                    $user_array = array(
                        "user_details"      => array(
                            "user_id"           => $user_details['user_id'],
                            "email_id"          => $user_details['email_id'],
                            "uname"             => $user_details['uname'],
                            "gender"            => $user_details['gender'],
                            "profile_image"     => $user_details['profile_image'],
                            "child_mode"        => $user_details['child_mode']
                        ),
                        "user_auth"         => true
                    );
                    
                    // Update last login date in database
                    $this->auth_model->update_last_login($user_details['user_id']);
                    
                    $this->session->set_userdata($user_array);
                    
                    redirect('dashboard', 'refresh');
                }
            }
        }
        $this->load->view('front/common/header');
        $this->load->view('front/login/index');
        $this->load->view('front/common/footer');
    }

}
