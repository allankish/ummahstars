<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Dashboard Class
 *
 * @author Colan
 */
class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('dashboard_model');
        $this->load->model('auth_model');

        cipl_user_auth();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->input->post('pass_required') === 'true') {
                $config = array(
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required'
                    )
                );

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() != FALSE) {
                    $where_array = array(
                        "user_id" => $this->input->post('child_id'),
                        "password" => md5($this->input->post('password'))
                    );
                    $result = $this->auth_model->user_authentication($where_array);
                    
                    if (isset($result) && sizeof($result) > 0) {
                        $child_details = $result[0];
                        $child_array = array(
                            "child_details" => array(
                                "user_id" => $child_details['user_id'],
                                "email_id" => $child_details['email_id'],
                                "uname" => $child_details['uname'],
                                "gender" => $child_details['gender'],
                                "profile_image" => $child_details['profile_image'],
                                "parent_id" => $child_details['parent_id']
                            ),
                            "child_auth" => true
                        );

                        // Update last login date in database
                        $this->auth_model->update_last_login($child_details['user_id']);

                        $this->session->set_userdata($child_array);

                        redirect('dashboard/child', 'refresh');
                    }
                }
            } else {
                $where_array = array(
                        "user_id" => $this->input->post('child_id'),
                    );
                    $result = $this->auth_model->user_authentication($where_array);
                    
                    if (isset($result) && sizeof($result) > 0) {
                        $child_details = $result[0];
                        $child_array = array(
                            "child_details" => array(
                                "user_id" => $child_details['user_id'],
                                "email_id" => $child_details['email_id'],
                                "uname" => $child_details['uname'],
                                "gender" => $child_details['gender'],
                                "profile_image" => $child_details['profile_image'],
                                "parent_id" => $child_details['parent_id']
                            ),
                            "child_auth" => true
                        );

                        // Update last login date in database
                        $this->auth_model->update_last_login($child_details['user_id']);

                        $this->session->set_userdata($child_array);

                        redirect('dashboard/child', 'refresh');
                    }
            }
        }

        $parent_details = $this->session->userdata("user_details");
        $data["parent_details"] = $parent_details;
        $all_childs = $this->dashboard_model->get_childs_by_parent($parent_details['user_id']);
        $age_groups = $this->dashboard_model->get_all_age_groups();

        $childs_array = array();
        foreach ($age_groups as $age_group) {
            $childs_array[$age_group['age_group_id']] = array();
            foreach ($all_childs as $child) {
                if ($child['age_group'] == $age_group['age_group_id'])
                    $childs_array[$age_group['age_group_id']][] = $child;
            }
        }
        $data["childs"] = $childs_array;
        $data["age_groups"] = $age_groups;
        $this->load->view('front/common/header');

        if ($parent_details['child_mode'] === 'false') {
            $this->load->view('front/dashboard/parent_index', $data);
        } else {
            $this->load->view('front/dashboard/child_index', $data);
        }

        $this->load->view('front/common/footer');
    }
    
    public function child() {
        $this->load->view('front/common/header');
        $this->load->view('front/dashboard/child_sections');
        $this->load->view('front/common/footer');
    }
}