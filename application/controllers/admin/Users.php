<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users Class
 *
 * @author Colan
 */
class Users extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/users_model');

        cipl_admin_auth($this);
    }

    // List all users
    public function list_users() {
        $data['users'] = $this->users_model->get_users_list();
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add new user
    public function add_user() {
        $data = '';
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/add', $data);
        $this->load->view('admin/common/footer');
    }

    // Edit user details
    public function edit_user() {
        $user_id = $this->uri->segment(4);
        $user_details = $this->users_model->get_user_details($user_id);
        $data["user_details"] = $user_details[0];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST

            $config = array(
                array(
                    'field' => 'parent_name',
                    'label' => 'Parent Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'parent_email',
                    'label' => 'Parent Email',
                    'rules' => 'trim|required'
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
                $upload_path = 'assets/userImages/';
                $ext_image_name = explode(".", $_FILES['profile_image']['name']);
                $count_ext_img = count($ext_image_name);
                $image_ext = $ext_image_name[$count_ext_img - 1];
                $file_name = base64_encode(trim($this->input->post('parent_name')) . '1') . '_' . md5(rand(1000000,1000000000)) . '.' . $image_ext;
                $profile_image = cipl_image_upload($_FILES['profile_image'], 'profile_image', $upload_path, $file_name, 225, 225);
                
                $update_array = array(
                            "uname"         => $this->input->post('parent_name'), 
                            "email_id"      => $this->input->post("parent_email"), 
                            "gender"        => $this->input->post("gender"),
                            "parent_type"   => $this->input->post("parent_type"),
                            "updated_on"    => date('Y-m-d H:i:s'),
                            "profile_image" => $upload_path . $file_name
                        );
                if ( $this->input->post('password') != '' ):
                    $password_array     = array("password" => md5($this->input->post('password')));
                    $update_array       = array_merge($password_array, $update_array);
                endif;
                
                if (isset($profile_image['success'])) {
                    $user_id = $this->input->post("user_id");
                    $this->users_model->update_user($update_array, $user_id);
                    $this->session->set_flashdata('Success', 'User updated successfully.');
                    redirect('usadmin/users', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', $profile_image['messages']['error']);
                }
            }
        }

        $this->load->view('admin/common/header');
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete user from database
    public function delete_user() {
        
    }

    // View a user details from database
    public function view_user() {
        $user_id = $this->uri->segment(4);
        $user_details = $this->users_model->get_user_details($user_id);
        $total_childs = $this->users_model->get_child_count($user_id);
        $all_child = $this->users_model->get_child_list($user_id);
        $data["user_details"] = $user_details[0];
        $data["total_childs"] = $total_childs;
        $data["all_child"] = $all_child;
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/view', $data);
        $this->load->view('admin/common/footer');
    }
    
    // View child details
    public function view_child() {
        $user_id = $this->uri->segment(4);
        $user_details = $this->users_model->get_child_details($user_id);
        $data["user_details"] = $user_details[0];
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/child_view', $data);
        $this->load->view('admin/common/footer');
    }

}
