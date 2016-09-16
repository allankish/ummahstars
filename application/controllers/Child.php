<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Child Class
 *
 * @author Colan
 */
class Child extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('child_model');
        $this->load->model('auth_model');
       
       

        cipl_user_auth();
    }

    public function index() {
        // check child authentication is valid
        cipl_child_auth();

        $child_age_group = $this->session->userdata('child_age_group_name');
        $child_age_group = str_replace(' ', '', $child_age_group);
       // print_r($this->session->userdata); 
        $this->load->view('front/common/header');
        $this->load->view('front/dashboard/child_dashboard_' . $child_age_group);
        $this->load->view('front/common/footer');
    }
    public function section($slug){
         $child_age_group = $this->session->userdata('child_age_group_name');
         $child_age_group = str_replace(' ', '', $child_age_group);
        $section_data = $this->child_model->get_sections($slug);
      //  print_r($section_data);
        $image_data = unserialize($section_data['background_image']);
        //print_r($image_data);
       if($child_age_group=='4-6'){
           $data['bg_image'] = $image_data[1];
       }
       elseif($child_age_group=='7-10'){
           $data['bg_image'] = $image_data[2];
       }
       else{ //Age group 11-14
           $data['bg_image'] = $image_data[3];
       }
        $categories = $this->child_model->get_parent_categories($section_data['section_id']);
        $data['categories'] = $categories;
       // print_r($data);
        $this->load->view('front/common/header');
        $this->load->view('front/sections/'.$slug.'/child_section_' . $child_age_group, $data);
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

    


}
