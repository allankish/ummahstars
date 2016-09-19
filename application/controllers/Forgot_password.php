<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Forgot Password Class
 *
 * @author Colan
 */
class Forgot_password extends CI_Controller {

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
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {
                $data = array(
                    "email_id" => $this->input->post('email_id'),
                    "user_role" => "2"
                );
                $result = $this->auth_model->user_authentication($data);

                if (isset($result) && sizeof($result) > 0) {
                    $reset_key = random_string('alnum', 24);
                    $reset_data = array("password_reset_key" => $reset_key);
                    $reset_user_id = $result[0]['user_id'];
                    $this->auth_model->update_user($reset_data, $reset_user_id);
                    $reset_link = base_url() . 'forgot_password/reset?key=' . $reset_key;
                    
                    // SEND EMAIL
                    $this->email->from('admin@colanapps.in', 'Ummahstars.Com');
                    $this->email->to($result[0]['email_id']);
                    $this->email->subject('Ummahstars.com - Reset Password Link');
                    $mail_data["reset_link"] = $reset_link;
                    $mail_data["uname"] = $result[0]["uname"];
                    $message = $this->load->view('front/email_templates/forgot_password', $mail_data, TRUE);
                    $this->email->message($message);
                    $this->email->send();
                    
                    $this->session->set_flashdata('Success', 'Email sent to your registered email id. Please check your email for reset password link.');
                } else {
                    $this->session->set_flashdata('Error', 'Parent email id not exist.');
                }
            }
        }
        $this->load->view('front/common/header');
        $this->load->view('front/forgot_password/index');
        $this->load->view('front/common/footer');
    }

    public function reset() {
        $password_reset_key = $this->input->get('key');
        $data = array("password_reset_key" => $password_reset_key, "user_role" => "2");
        $result = $this->auth_model->user_authentication($data);
        $view_data['password_reset_key'] = base64_encode($password_reset_key);
        $this->load->view('front/common/header');
        if (isset($result) && sizeof($result) > 0) {
            $this->load->view('front/forgot_password/reset_password', $view_data);
        } else {
            $this->session->set_flashdata('Error', 'The password reset link is expired or key does not exist. Please try again.');
            $this->load->view('front/forgot_password/reset_password_status');
        }
        $this->load->view('front/common/footer');
    }

    public function reset_password() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
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
                    "password_reset_key" => base64_decode($this->input->post('password_reset_key')),
                    "user_role" => "2"
                );
                $result = $this->auth_model->user_authentication($data);

                if (isset($result) && sizeof($result) > 0) {
                    $password = md5($this->input->post('password'));
                    $reset_data = array("password" => $password, "password_reset_key" => "");
                    $reset_user_id = $result[0]['user_id'];
                    $this->auth_model->update_user($reset_data, $reset_user_id);
                    $this->session->set_flashdata('Success', 'Password reset successfully. Try to login with new password.');
                } else {
                    $this->session->set_flashdata('Error', 'The password reset request key is invalid.');
                }
            } else {
                $validation_errors = validation_errors();
                $this->session->set_flashdata('Error', $validation_errors);
                redirect('forgot_password/reset?key=' . base64_decode($this->input->post('password_reset_key')));
            }
        }
        $this->load->view('front/common/header');
        $this->load->view('front/forgot_password/reset_password_status');
        $this->load->view('front/common/footer');
    }

    public function child_forgotpassword() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
              array(
                'field' => 'email_id',
                'label' => 'Email Id',
                'rules' => 'trim|required|valid_email'
              )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {
                $data = array(
                  "email_id" => $this->input->post('email_id'),
                  "user_role" => "2"
                );
                $result = $this->auth_model->user_authentication($data);

                if (isset($result) && sizeof($result) > 0) {
                    $reset_key = random_string('alnum', 24);
                    $reset_data = array("password_reset_key" => $reset_key);
                    $reset_user_id = $result[0]['user_id'];
                    $this->auth_model->update_user($reset_data, $reset_user_id);
                    $reset_link = base_url() . 'forgot_password/reset?key=' . $reset_key;

                    // SEND EMAIL
                    $this->email->from('admin@colanapps.in', 'Ummahstars.Com');
                    $this->email->to($result[0]['email_id']);
                    $this->email->subject('Ummahstars.com - Reset Password Link');
                    $mail_data["reset_link"] = $reset_link;
                    $mail_data["uname"] = $result[0]["uname"];
                    $message = $this->load->view('front/email_templates/forgot_password', $mail_data, TRUE);
                    $this->email->message($message);
                    $this->email->send();

                    $this->session->set_flashdata('Success', 'Email sent to your registered email id. Please check your email for reset password link.');
                } else {
                    $this->session->set_flashdata('Error', 'Parent email id not exist.');
                }
            }
        }
        $this->load->view('front/common/header');
        $this->load->view('front/forgot_password/child');
        $this->load->view('front/common/footer');
    }

}
