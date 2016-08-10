<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Subscription Class
 *
 * @author Colan
 */
class Subscription extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/subscription_model');

        cipl_admin_auth();
    }

    public function index() {
        
    }

    // List Subscription Plan

    public function list_subscription_plans() {

        $data['subscriptions'] = $this->subscription_model->listSubscriptionPlans();

        $this->load->view('admin/common/header');
        $this->load->view('admin/subscription/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Subscription Plan 

    public function add_subscription() {



        $this->load->view('admin/common/header');
        $this->load->view('admin/subscription/add');
        $this->load->view('admin/common/footer');
    }

    // Save Subscription Plan
    public function save_subscription() {

        $plan_name = $this->input->post('plan_name');
        $plan_duration = $this->input->post('duration');
        $plan_price = $this->input->post('price');

        if ($plan_name != "" && $plan_duration != "" && $plan_price != "") {
            if (is_numeric($plan_price)) {
                $result = $this->subscription_model->addSubscriptionPlan();
                if ($result) {
                    $this->session->set_flashdata('success', 'Subscription Plan Successfully Added');
                }

                redirect(base_url() . 'usadmin/subscription');
            } else {
                $this->session->set_flashdata('price', $plan_price);
                $this->session->set_flashdata('error', 'Invalid Price Value. Please enter a valid Price');
                redirect(base_url() . 'usadmin/subscription/add/' . $plan_id);
            }
        } else {
            $this->session->set_flashdata('plan_name', $plan_name);
            $this->session->set_flashdata('duration', $plan_duration);
            $this->session->set_flashdata('price', $plan_price);

            $this->session->set_flashdata('error', 'Please enter all the required fields');
            redirect(base_url() . 'usadmin/subscription/add');
        }
    }

    // Edit Subscription Plan
    public function edit_subscription($plan_id) {

        $result = $this->subscription_model->getSubscriptionPlans($plan_id);

        $data['subscription'] = $result[0];

        $this->load->view('admin/common/header');
        $this->load->view('admin/subscription/edit', $data);
        $this->load->view('admin/common/footer');
    }

    public function update_subscription($plan_id) {

        $plan_name = $this->input->post('plan_name');
        $plan_duration = $this->input->post('duration');
        $plan_price = $this->input->post('price');

        if (trim($plan_name) != "" && $plan_duration != "" && $plan_price != "") {
            if (is_numeric($plan_price)) {
                $result = $this->subscription_model->editSubscriptionPlan($plan_id);
                if ($result) {
                    $this->session->set_flashdata('success', 'Updated Successfully');
                }

                redirect(base_url() . 'usadmin/subscription/edit/' . $plan_id);
            } else {

                $this->session->set_flashdata('error', 'Invalid Price Value. Please enter a valid Price');
                redirect(base_url() . 'usadmin/subscription/edit/' . $plan_id);
            }
        } else {

            $this->session->set_flashdata('error', 'Please enter all the required fields');
            redirect(base_url() . 'usadmin/subscription/edit/' . $plan_id);
        }
    }

    // Delete Subscription Plan
    public function delete_subscription($plan_id) {


        $result = $this->subscription_model->deleteSubscriptionPlan($plan_id);

        redirect(base_url() . 'usadmin/subscription/');
    }

}
