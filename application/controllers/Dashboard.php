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
        cipl_user_auth();

    }

    public function index() {
        $parent_details = $this->session->userdata("user_details");
        $data["parent_details"] = $parent_details;
        $all_childs = $this->dashboard_model->get_childs_by_parent($parent_details['user_id']);
        $age_groups = $this->dashboard_model->get_all_age_groups();
        
        $childs_array = array();
        foreach($age_groups as $age_group) {
            $childs_array[$age_group['age_group_id']] = array();
            foreach($all_childs as $child) {
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

}
