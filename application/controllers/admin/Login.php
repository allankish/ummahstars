<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($this->session->userdata('admin_auth'))
            redirect('usadmin/dashboard', 'refresh');

        $this->load->model('admin/login_model');
    }

    public function index() {
        $data["title"] = 'Ummah Stars Admin';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->auth();
        }
        $this->load->view('admin/login/index', $data);
    }

    public function auth() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $this->request = $this->input->post();

            $this->form_validation->set_rules('email_id', 'Email id', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->response = array("error" => true,
                    "messages" => array("email_id" => form_error('email_id'),
                        "password" => form_error('password')));
                $this->session->set_flashdata('flashError', 'Please enter valid login credentials');
            } else {
                $result = $this->login_model->admin_authentication($this->request);

                if (sizeof($result) > 0) {
                    $adminDetail = $result[0];
                    $admin_data = array('admin_id' => $adminDetail['admin_id'],
                        'admin_email_id' => $adminDetail['admin_email'],
                        'admin_auth' => True);

                    $this->session->set_userdata($admin_data);

                    if ($this->session->userdata('admin_auth')) {
                        redirect('usadmin/dashboard', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('flashError', 'Invalid EmailId or Password');
                }
            }
        }
    }

    public function doforgot() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $this->request = $this->input->post();

            $this->form_validation->set_rules('forgot_email', 'Forgot Email', 'trim|required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $this->response = array("error" => true,
                    "messages" => array("email" => form_error('forgot_email')));
            } else {
                $result = $this->LoginModel->userForgotPassword($this->request);

                $adminDetail = $result['admin'];
                if ($result['admin_count'] > 0) {
                    $username = $adminDetail['first_name'] . $adminDetail['last_name'];
                    $email = $adminDetail['email_id'];
                    $url = base_url('admin/resetpass');

                    $this->email->from('admin@mycipl.in', 'admin');
                    $this->email->to($email);

                    $this->email->subject('Reset Password');
                    $this->email->message($url);

                    $this->email->send();

                    $this->response = array("success" => true,
                        "messages" => array("form_success" => "Please Check your Inbox"));
                } else {
                    $this->response = array("error" => true,
                        "messages" => array("form_error" => "Invalid EmailId"));
                }
            }
            header('Content-Type: application/json');
            echo json_encode($this->response);
        }
    }

}
