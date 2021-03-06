<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Add Child Class
 *
 * @author Colan
 */
class Add_child extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->model('auth_model');
        $this->load->model('dashboard_model');
        
        cipl_user_auth();
    }

    public function index() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'uname',
                    'label' => 'Child\'s Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'age',
                    'label' => 'Child\'s Age',
                    'rules' => 'trim|required'
                )
            );

            //echo $this->input->post('password_required'); exit;

            if($this->input->post('password_required') != '') {
                $config[] = array(
                  'field' => 'password',
                  'label' => 'Password',
                  'rules' => 'trim|required'
                );

                $config[] = array(
                  'field' => 'retype_password',
                  'label' => 'Retype Password',
                  'rules' => 'trim|required|matches[password]'
                );
            }

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {
                $parent_details = $this->session->userdata('user_details');
                $password = '';
                if($this->input->post('password_required') != '') {
                    $password = $this->input->post('password');
                }
                //$password = random_string('alnum', 16);
                $input_data = array(
                    "email_id" => '',
                    "password" => md5($password),
                    "gender" => $this->input->post('gender'),
                    "uname" => $this->input->post('uname'),
                    "profile_image" => '',
                    "user_role" => '3',
                    "age" => $this->input->post('age'),
                    "age_group" => $this->input->post('age_group_id'),
                    "parent_id" => $parent_details['user_id'],
                    "logged_in" => '0',
                    "status" => '0',
                    "created_on" => date('Y-m-d H:i:s'),
                    "child_mode" => 'false',
                    "parent_type" => 'active',
                    "child_allowed" => '0',
                    "password_autogenerated" => 'true',
                    "password_reset_key" => '',
                    "register_confirm_key" => ''
                );

                if($this->input->post('profile_img')!="")
                {

                    //echo "<img src='".$this->input->post('profile_img')."'>";
                    $parent_image = $this->input->post('profile_img');
                    $image_name = base64_encode($this->input->post('uname'));

                    $filename = $image_name.'_'.md5(rand(1000000,1000000000)).'.jpg';
                    $profile_image = 'assets/userImages/'.$filename;

                    $imgdata = $parent_image;

                    list($type, $imgdata) = explode(';', $imgdata);
                    list(, $imgdata)      = explode(',', $imgdata);
                    $imgdata = base64_decode($imgdata);
                    file_put_contents($profile_image, $imgdata);

                    $input_data['profile_image'] = $profile_image;

                }

                $result = $this->auth_model->add_child($input_data);
                // SEND EMAIL
                $this->email->from('admin@colanapps.in', 'Ummahstars.Com');
                $this->email->to($parent_details['email_id']);
                $this->email->subject('Ummahstars.com - Welcome');

                $mail_data["uname"] = $parent_details['uname'];
                $mail_data['child_name'] = $this->input->post('uname');
                $mail_data['child_age'] = $this->input->post('age');
                $mail_data['child_password'] = $password;
                
                $message = $this->load->view('front/email_templates/new_child', $mail_data, TRUE);
                $this->email->message($message);
                $this->email->send();

                if($this->input->post('more_child') != '') {
                    $this->session->set_flashdata('Success', 'New child added successfully.');
                }
                else
                {
                    redirect('dashboard', 'refresh');
                }
            }
        }
        $data['age_groups'] = $this->dashboard_model->get_all_age_groups();
        $this->load->view('front/common/header');
        $this->load->view('front/add_child/index', $data);
        $this->load->view('front/common/footer');
    }

}
