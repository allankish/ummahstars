<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Age Groups Class
 *
 * @author Colan
 */
class Age_groups extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/age_groups_model');

        cipl_admin_auth();
    }

    public function index() {
        
    }

    // List Age Groups
    public function list_age_groups() {
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        $this->load->view('admin/common/header');
        $this->load->view('admin/age_groups/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add age group
    public function add_age_group() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $this->form_validation->set_rules('age_group_name', 'Age Group Name', 'trim|required');
            $this->form_validation->set_rules('sort_order', 'Sort Order', 'trim|required');
            
            if ($this->form_validation->run() != FALSE) {
                $data = array("age_group_name" => $this->input->post("age_group_name"), "sort_order" => $this->input->post("sort_order"));
                $this->age_groups_model->add_age_group($data);
                $this->session->set_flashdata('Success', 'Age Group added successfully.');
                redirect('usadmin/age-groups', 'refresh');                
            }
        }
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/age_groups/add');
        $this->load->view('admin/common/footer');
    }

    // Edit age group
    public function edit_age_group() {
        $age_group_id = $this->uri->segment(4);
        $result = $this->age_groups_model->get_age_group($age_group_id);
        $data['age_group'] = $result[0];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $this->form_validation->set_rules('age_group_name', 'Age Group Name', 'trim|required');
            $this->form_validation->set_rules('sort_order', 'Sort Order', 'trim|required');
            
            if ($this->form_validation->run() != FALSE) {
                $data = array(
                            "age_group_id"      => $age_group_id, 
                            "age_group_name"    => $this->input->post("age_group_name"), 
                            "sort_order"        => $this->input->post("sort_order")
                        );
                $this->age_groups_model->update_age_group($data);
                $this->session->set_flashdata('Success', 'Age Group updated successfully.');
                redirect('usadmin/age-groups', 'refresh');
            }
        }
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/age_groups/edit', $data);
        $this->load->view('admin/common/footer');
    }
    
    public function delete_age_group() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["age_group_id"] = $this->input->post('age_group_id');
            $result = $this->age_groups_model->delete_age_group($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'Age Group deleted successfully.');
                echo 'success';
            } else {
                echo 'Error when delete the data. Try again.';
            }
        }
    }
}
