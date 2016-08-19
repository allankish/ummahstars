<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Content Class
 *
 * @author Colan
 */
class Content extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/categories_model');
        $this->load->model('admin/age_groups_model');
        $this->load->model('admin/content_model');
        

        cipl_admin_auth();
    }

    public function index() {
        
    }

    // List Section

    public function list_content() {

        $data['contents'] = $this->content_model->getContentList();

        $this->load->view('admin/common/header');
        $this->load->view('admin/content/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Section 
    public function add_content() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'section_id',
                    'label' => 'Section Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'category_id',
                    'label' => 'Category Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'content_type',
                    'label' => 'Content Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'content',
                    'label' => 'Content',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'age_group_id',
                    'label' => 'Age Group',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'sort_order',
                    'label' => 'Sort Order',
                    'rules' => 'trim|is_natural_no_zero|required'
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "section_id"  => $this->input->post('section_id'),
                    "category_id"  => $this->input->post('category_id'),
                    "content_type"  => $this->input->post('content_type'),
                    "content"  => $this->input->post('content'),
                    "age_group_id"  => $this->input->post('age_group_id'),
                    "sort_order"    => $this->input->post("sort_order"),
                    "created_date"    => date('Y-m-d H:i:s')
                   
                );
                
                 $this->content_model->addContent($update_array);
                 $this->session->set_flashdata('Success', 'Content added successfully.');
                 redirect('usadmin/content', 'refresh');
         
            }
        }
        
        $data['root_categories'] = $this->categories_model->getRootCategories();
        $data['sections'] = $this->categories_model->getAllSections();
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/content/add',$data);
        $this->load->view('admin/common/footer');
    }

  
    
    public function get_categories_ajax()
    {
        
        $section_id = $this->input->post('section_id');
        $cats['categories'] = $this->categories_model->getCategoriesbySection($section_id);
        echo json_encode($cats);
        
    }
}