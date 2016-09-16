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
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->helper('string');
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
                $auth_key = random_string('alnum', 24);
                $data = array(
                    "email_id" => $this->input->post('email_id'),
                    "password" => md5($this->input->post('password')),
                    "gender" => $this->input->post('gender'),
                    "uname" => $this->input->post('uname'),
                    "profile_image" => '',
                    "user_role" => '2',
                    "age" => '0',
                    "age_group" => '0',
                    "parent_id" => '0',
                    "logged_in" => '0',
                    "status" => '0',
                    "created_on" => date('Y-m-d H:i:s'),
                    "child_mode" => 'false',
                    "parent_type" => 'active',
                    "child_allowed" => '4',
                    "password_reset_key" => '',
                    "register_confirm_key" => $auth_key
                );
                $result = $this->auth_model->add_parent($data);
                // SEND EMAIL
                $this->email->from('admin@colanapps.in', 'Ummahstars.Com');
                $this->email->to($this->input->post('email_id'));
                $this->email->subject('Ummahstars.com - Welcome');

                $mail_data["uname"] = $this->input->post('uname');
                $mail_data['auth_link'] = base_url() . 'register/confirm?key=' . $auth_key;
                $mail_data['email_id'] = $this->input->post('email_id');
                $mail_data['password'] = $this->input->post('password');
                
                $message = $this->load->view('front/email_templates/register_success', $mail_data, TRUE);
                $this->email->message($message);
                $this->email->send();
                $this->session->set_flashdata('Success', 'You are successfully registered. Please check your email to confirm the registration.');

                $checkParent = $this->auth_model->check_parent_exists($this->input->post('email_id'));
                $user_details = $checkParent;
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

                //print_r($user_array); exit;
                // Update last login date in database
                $this->auth_model->update_last_login($user_details['user_id']);

                $this->session->set_userdata($user_array);
                redirect('add_child', 'refresh'); exit;
            }
        }
        $this->load->view('front/common/header');
        $this->load->view('front/register/index');
        $this->load->view('front/common/footer');
    }

}
