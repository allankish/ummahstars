<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users Class
 *
 * @author Colan
 */
class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');

        cipl_admin_auth();
    }

    public function index() {
        $admin_id = $this->session->userdata('admin_id');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'admin_email',
                    'label' => 'Admin Email',
                    'rules' => 'trim|required|valid_email|callback_email_check'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim'
                ),
                array(
                    'field' => 'retype_password',
                    'label' => 'Retype Password',
                    'rules' => 'trim|matches[password]'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "first_name" => $this->input->post('first_name'),
                    "last_name" => $this->input->post("last_name"),
                    "admin_email" => $this->input->post("admin_email"),
                    "updated_on" => date('Y-m-d H:i:s')
                );
                         $admin_data = array(
                        'admin_email'         => $this->input->post("admin_email"),
                        'admin_first_name'    => $this->input->post('first_name'),
                        'admin_last_name'     => $this->input->post("last_name"),
                        );

                 $this->session->set_userdata($admin_data);  
                 
                if ($this->input->post('password') != ''):
                    $password_array = array("password" => md5($this->input->post('password')));
                    $update_array = array_merge($password_array, $update_array);
                endif;

                if ( isset($_FILES['profile_image']) && $_FILES['profile_image']["name"] != '' ) {
                    $upload_path = 'assets/adminImages/';
                    $ext_image_name = explode(".", $_FILES['profile_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('first_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $profile_image = cipl_image_upload($_FILES['profile_image'], 'profile_image', $upload_path, $file_name, 225, 225);

                    if (isset($profile_image['success'])) {
                        $profile_image_array = array("profile_image" => $upload_path . $file_name);
                        $update_array = array_merge($profile_image_array, $update_array);
                      
                        $this->admin_model->update_admin($update_array, $admin_id);
                        $this->session->set_flashdata('Success', 'Admin updated successfully.');
                        $this->session->set_userdata('admin_profile_image', $profile_image_array['profile_image']);
                    } else {
                        $this->session->set_flashdata('Error', $profile_image['messages']['error']);
                    }
                } else {
                    $this->admin_model->update_admin($update_array, $admin_id);
                    $this->session->set_flashdata('Success', 'Admin updated successfully.');
                }            
            }
        }

        $admin_details = $this->admin_model->get_admin_details($admin_id);
        $data['admin_details'] = $admin_details[0];

        $this->load->view('admin/common/header');
        $this->load->view('admin/profile/edit', $data);
        $this->load->view('admin/common/footer');
    }

    public function email_check($email) {
        $valid = $this->admin_model->validate_email($email);
        if ($valid != true) {
            $this->form_validation->set_message('email_check', 'The admin email id already exist in our records.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
