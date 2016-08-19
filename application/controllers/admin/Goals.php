<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Goals Class
 *
 * @author Colan
 */
class Goals extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/goals_model');
        $this->load->model('admin/prizes_model');
        $this->load->model('admin/age_groups_model');

        cipl_admin_auth();
    }

    public function index() {}

    // List Goals
    public function list_Goals(){

        $data['goals'] = $this->goals_model->getAllGoals();

        $this->load->view('admin/common/header');
        $this->load->view('admin/goals/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Goal
    public function add_goal() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'goal_description',
                    'label' => 'Goal Description',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'deed_amount',
                    'label' => 'Deed Amount',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "goal_description"  => $this->input->post('goal_description'),
                    "deed_amount"       => $this->input->post('deed_amount'),
                    "prize_id"          => $this->input->post('prize_id'),
                    "created_by"        => 0,
                    "assigned_to"       => 0,
                    "age_group"         => $this->input->post('age_group'),
                    "created_on"        => date('Y-m-d H:i:s'),
                    "updated_on"        => date('Y-m-d H:i:s'),
                    "status"            => $this->input->post('status')
                );
                
                $this->goals_model->addGoal($update_array);
                $this->session->set_flashdata('Success', 'Goal added successfully.');
                redirect('usadmin/goals', 'refresh');
            }
        }
        
        $data['prizes'] = $this->prizes_model->getAllPrizes();
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/goals/add', $data);
        $this->load->view('admin/common/footer');
    }

    // Edit Goal
    public function edit_goal($goal_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'goal_description',
                    'label' => 'Goal Description',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'deed_amount',
                    'label' => 'Deed Amount',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "goal_description"  => $this->input->post('goal_description'),
                    "deed_amount"       => $this->input->post('deed_amount'),
                    "prize_id"          => $this->input->post('prize_id'),
                    "created_by"        => 0,
                    "assigned_to"       => 0,
                    "age_group"         => $this->input->post('age_group'),
                    "updated_on"        => date('Y-m-d H:i:s'),
                    "status"            => $this->input->post('status')
                );
                
                $this->goals_model->updateGoal($update_array);
                $this->session->set_flashdata('Success', 'Goal updated successfully.');
                redirect('usadmin/goals', 'refresh');
            }
        }
        
        $result = $this->goals_model->getGoal($goal_id);
        $data['goal'] = $result[0];
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/goals/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete Goal
    public function delete_goal() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["goal_id"] = $this->input->post('goal_id');
            $result = $this->goals_model->deleteGoal($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'Goal deleted successfully.');
                echo 'success';
            } else {
                echo 'Error when delete the data. Try again.';
            }
        }
    }
}