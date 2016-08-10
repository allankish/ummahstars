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
        $this->load->model('admin/age_groups_model');

        cipl_admin_auth();
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
                    'rules' => 'trim|required|valid_email|callback_email_check'
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

                $update_array = array(
                    "uname" => $this->input->post('parent_name'),
                    "email_id" => $this->input->post("parent_email"),
                    "password" => md5($this->input->post('password')),
                    "gender" => $this->input->post("gender"),
                    "parent_type" => $this->input->post("parent_type"),
                    "child_allowed" => $this->input->post("child_allowed"),
                    "age" => '0',
                    "age_group" => '0',
                    "user_role" => '2',
                    "parent_id" => '0',
                    "logged_in" => '0',
                    "status" => '0',
                    "child_mode" => 'true',
                    "created_on" => date('Y-m-d H:i:s'),
                    "updated_on" => date('Y-m-d H:i:s')
                );

                if (isset($_FILES['profile_image']) && $_FILES['profile_image']["name"] != '') {
                    $upload_path = 'assets/userImages/';
                    $ext_image_name = explode(".", $_FILES['profile_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('parent_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $profile_image = cipl_image_upload($_FILES['profile_image'], 'profile_image', $upload_path, $file_name, 225, 225);

                    if (isset($profile_image['success'])) {
                        $profile_image_array = array("profile_image" => $upload_path . $file_name);
                        $update_array = array_merge($profile_image_array, $update_array);

                        $this->users_model->add_user($update_array);
                        $this->session->set_flashdata('Success', 'User added successfully.');
                        redirect('usadmin/users', 'refresh');
                    } else {
                        $this->session->set_flashdata('Error', $profile_image['messages']['error']);
                    }
                } else {
                    $this->users_model->add_user($update_array);
                    $this->session->set_flashdata('Success', 'User added successfully.');
                    redirect('usadmin/users', 'refresh');
                }
            }
        }
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/add', $data);
        $this->load->view('admin/common/footer');
    }

    // Edit user details
    public function edit_user() {
        $user_id = $this->uri->segment(4);
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
                    "uname" => $this->input->post('parent_name'),
                    "email_id" => $this->input->post("parent_email"),
                    "gender" => $this->input->post("gender"),
                    "parent_type" => $this->input->post("parent_type"),
                    "child_allowed" => $this->input->post("child_allowed"),
                    "updated_on" => date('Y-m-d H:i:s')
                );

                if ($this->input->post('password') != ''):
                    $password_array = array("password" => md5($this->input->post('password')));
                    $update_array = array_merge($password_array, $update_array);
                endif;

                if (isset($_FILES['profile_image']) && $_FILES['profile_image']["name"] != '') {
                    $upload_path = 'assets/userImages/';
                    $ext_image_name = explode(".", $_FILES['profile_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('parent_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $profile_image = cipl_image_upload($_FILES['profile_image'], 'profile_image', $upload_path, $file_name, 225, 225);

                    if (isset($profile_image['success'])) {
                        $profile_image_array = array("profile_image" => $upload_path . $file_name);
                        $update_array = array_merge($profile_image_array, $update_array);

                        $this->admin_model->update_admin($update_array, $user_id);
                        $this->session->set_flashdata('Success', 'User updated successfully.');
                        redirect('usadmin/users', 'refresh');
                    } else {
                        $this->session->set_flashdata('Error', $profile_image['messages']['error']);
                    }
                } else {
                    $this->users_model->update_user($update_array, $user_id);
                    $this->session->set_flashdata('Success', 'User updated successfully.');
                    redirect('usadmin/users', 'refresh');
                }
            }
        }

        $user_details = $this->users_model->get_user_details($user_id);
        $data["user_details"] = $user_details[0];


        $this->load->view('admin/common/header');
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete user from database
    public function delete_user() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["user_id"] = $this->input->post('user_id');
            $result = $this->users_model->delete_user($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'User deleted successfully.');
            }
        
            echo $result;
        }
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
    
    // Add new child
    public function add_child() {
        $parent_id = $this->uri->segment(4);
        $age_groups = $this->age_groups_model->get_all_age_groups();
        $data['age_groups'] = $age_groups;
        $data['parent_id'] = $parent_id;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'child_name',
                    'label' => 'Child Name',
                    'rules' => 'trim|required'
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
                ),
                array(
                    'field' => 'age',
                    'label' => 'Age',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "uname" => $this->input->post('child_name'),
                    "password" => md5($this->input->post('password')),
                    "gender" => $this->input->post("gender"),
                    "age" => $this->input->post("age"),
                    "age_group" => $this->input->post("age_group"),
                    "user_role" => '3',
                    "parent_id" => $parent_id,
                    "logged_in" => '0',
                    "status" => '0',
                    "child_mode" => 'true',
                    "created_on" => date('Y-m-d H:i:s'),
                    "updated_on" => date('Y-m-d H:i:s')
                );

                if (isset($_FILES['profile_image']) && $_FILES['profile_image']["name"] != '') {
                    $upload_path = 'assets/userImages/';
                    $ext_image_name = explode(".", $_FILES['profile_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('child_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);                    
                    $profile_image = cipl_image_upload($_FILES['profile_image'], 'profile_image', $upload_path, $file_name, 225, 225);

                    if (isset($profile_image['success'])) {
                        $profile_image_array = array("profile_image" => $upload_path . $file_name);
                        $update_array = array_merge($profile_image_array, $update_array);

                        $this->users_model->add_user($update_array);
                        $this->session->set_flashdata('Success', 'Child added successfully.');
                        redirect('usadmin/users/view/' . $parent_id, 'refresh');
                    } else {
                        $this->session->set_flashdata('Error', $profile_image['messages']['error']);
                    }
                } else {
                    $this->users_model->add_user($update_array);
                    $this->session->set_flashdata('Success', 'Child added successfully.');
                    redirect('usadmin/users/view/' . $parent_id, 'refresh');
                }
            }
        }
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/child_add', $data);
        $this->load->view('admin/common/footer');
    }
    
    // Edit Child details
    public function edit_child() {
        
        $child_id = $this->uri->segment(4);
        $age_groups = $this->age_groups_model->get_all_age_groups();
        $child_details = $this->users_model->get_child_details($child_id);
        $data['age_groups'] = $age_groups;
        $data['child_details'] = $child_details[0];
        $parent_id = $child_details[0]['parent_id'];
        $data['parent_id'] = $parent_id;
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'child_name',
                    'label' => 'Child Name',
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
                ),
                array(
                    'field' => 'age',
                    'label' => 'Age',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "uname" => $this->input->post('child_name'),
                    "gender" => $this->input->post("gender"),
                    "age" => $this->input->post("age"),
                    "age_group" => $this->input->post("age_group"),
                    "updated_on" => date('Y-m-d H:i:s')
                );
                if ($this->input->post('password') != ''):
                    $password_array = array("password" => md5($this->input->post('password')));
                    $update_array = array_merge($password_array, $update_array);
                endif;

                if (isset($_FILES['profile_image']) && $_FILES['profile_image']["name"] != '') {
                    $upload_path = 'assets/userImages/';
                    $ext_image_name = explode(".", $_FILES['profile_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('child_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);                    
                    $profile_image = cipl_image_upload($_FILES['profile_image'], 'profile_image', $upload_path, $file_name, 225, 225);

                    if (isset($profile_image['success'])) {
                        $profile_image_array = array("profile_image" => $upload_path . $file_name);
                        $update_array = array_merge($profile_image_array, $update_array);

                        $this->users_model->update_user($update_array, $child_id);
                        $this->session->set_flashdata('Success', 'Child added successfully.');
                        redirect('usadmin/users/view/' . $parent_id, 'refresh');
                    } else {
                        $this->session->set_flashdata('Error', $profile_image['messages']['error']);
                    }
                } else {
                    $this->users_model->update_user($update_array, $child_id);
                    $this->session->set_flashdata('Success', 'Child added successfully.');
                    redirect('usadmin/users/view/' . $parent_id, 'refresh');
                }
            }
        }
        $this->load->view('admin/common/header');
        $this->load->view('admin/users/child_edit', $data);
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
    
    // Delete Child from database
    public function delete_child() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["child_id"] = $this->input->post('child_id');
            $result = $this->users_model->delete_child($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'Child deleted successfully.');
            }
        
            echo $result;
        }
    }

    // Check email 
    public function email_check($email) {
        $valid = $this->users_model->validate_email($email);
        if ($valid != true) {
            $this->form_validation->set_message('email_check', 'The email id already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
