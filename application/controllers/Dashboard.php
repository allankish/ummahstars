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
            if ($this->input->post('pass_req') === 'true') {
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
                        $age_group_details = $this->dashboard_model->get_age_group($child_details['age_group']);

                        $child_array = array(
                            "child_details" => array(
                                "user_id" => $child_details['user_id'],
                                "email_id" => $child_details['email_id'],
                                "uname" => $child_details['uname'],
                                "gender" => $child_details['gender'],
                                "profile_image" => $child_details['profile_image'],
                                "parent_id" => $child_details['parent_id']
                            ),
                            "child_age_group_id" => $child_details['age_group'],
                            "child_age_group_name" => $age_group_details[0]['age_group_name'],
                            "child_auth" => true
                        );

                        // Update last login date in database
                        $this->auth_model->update_last_login($child_details['user_id']);

                        $this->session->set_userdata($child_array);

                        redirect('child', 'refresh');
                    }
                }
            } else {
                $where_array = array(
                    "user_id" => $this->input->post('child_id'),
                );
                $result = $this->auth_model->user_authentication($where_array);

                if (isset($result) && sizeof($result) > 0) {
                    $child_details = $result[0];
                    $age_group_details = $this->dashboard_model->get_age_group($child_details['age_group']);

                    $child_array = array(
                        "child_details" => array(
                            "user_id" => $child_details['user_id'],
                            "uname" => $child_details['uname'],
                            "gender" => $child_details['gender'],
                            "profile_image" => $child_details['profile_image'],
                            "parent_id" => $child_details['parent_id']
                        ),
                        "child_age_group_id" => $child_details['age_group'],
                        "child_age_group_name" => $age_group_details[0]['age_group_name'],
                        "child_auth" => true
                    );

                    // Update last login date in database
                    $this->auth_model->update_last_login($child_details['user_id']);

                    $this->session->set_userdata($child_array);

                    redirect('child', 'refresh');
                }
            }
        }

        $parent_details = $this->session->userdata("user_details");
        $parentinfo = $this->dashboard_model->get_parent_info($parent_details['user_id']);
        $data["parent_details"] = $parent_details;
        $data["parent_details"]['child_allowed'] = $parentinfo['child_allowed'];
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
        $data["nchilds"] = count($all_childs);
        //echo $data["nchilds"]; exit;
        $data["age_groups"] = $age_groups;
        $this->load->view('front/common/header');

        if ($parent_details['child_mode'] === 'false') {
            $this->load->view('front/dashboard/parent_dashboard', $data);
        } else {
            $this->load->view('front/dashboard/child_login', $data);
        }

        $this->load->view('front/common/footer');
    }

    public function child() {
        // check child authentication is valid
        cipl_child_auth();

        $child_age_group = $this->session->userdata('child_age_group_name');
        $child_age_group = str_replace(' ', '', $child_age_group);
        $this->load->view('front/common/header');
        $this->load->view('front/dashboard/child_dashboard_' . $child_age_group);
        $this->load->view('front/common/footer');
    }

    public function child_logout() {
        if ($this->session->userdata('child_auth')) {
            $unset_items = array(
                'child_details',
                'child_age_group_id',
                'child_age_group_name',
                'child_auth'
            );
            $this->session->unset_userdata($unset_items);
        }
        redirect('dashboard', 'refresh');
    }

    public function change_child_mode() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $parent_details = $this->session->userdata('user_details');
            $parent_id = $parent_details['user_id'];
            $child_mode = $this->input->post('child_mode');
            $this->dashboard_model->update_child_mode($parent_id, $child_mode);
            // Update Parent Session
            $parent_details = $this->session->userdata('user_details');
            $parent_details['child_mode'] = $child_mode;
            $updated_parent_details = array("user_details" => $parent_details);
            $this->session->set_userdata($updated_parent_details);
        }
        redirect('/dashboard', 'refresh');
    }

    public function confirm_parent() {
        $parent_details = $this->session->userdata('user_details');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {
                $data = array(
                    "user_id" => $parent_details['user_id'],
                    "password" => md5($this->input->post('password')),
                    "user_role" => "2"
                );
                $result = $this->auth_model->user_authentication($data);

                if (isset($result) && sizeof($result) > 0) {
                    $parent_id = $parent_details['user_id'];
                    $child_mode = 'false';
                    $this->dashboard_model->update_child_mode($parent_id, $child_mode);
                    // Update Parent Session
                    $parent_details = $this->session->userdata('user_details');
                    $parent_details['child_mode'] = $child_mode;
                    $updated_parent_details = array("user_details" => $parent_details);
                    $this->session->set_userdata($updated_parent_details);
                    redirect('dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', 'Authentication failed. Please try again.');
                }
            }
        }
        $data['parent_name'] = $parent_details['uname'];
        $data['profile_image'] = $parent_details['profile_image'];
        $this->load->view('front/common/header');
        $this->load->view('front/dashboard/parent_confirm_login', $data);
        $this->load->view('front/common/footer');
    }

}
