<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Categories Class
 *
 * @author Colan
 */
class Categories extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/categories_model');

        cipl_admin_auth();
    }

    public function index() {}

    // List Categories
    public function list_categories() {

        $data['categories'] = $this->categories_model->getAllCategories();

        $this->load->view('admin/common/header');
        $this->load->view('admin/categories/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Category
    public function add_category() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'category_name',
                    'label' => 'Category Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'category_type',
                    'label' => 'Category Type',
                    'rules' => 'required'
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
                    "category_name" => $this->input->post('category_name'),
                    "category_type" => $this->input->post('category_type'),
                    "parent_id"     => $this->input->post('parent_id'),
                    "section_id"    => $this->input->post('section_id'),
                    "sort_order"    => $this->input->post("sort_order"),
                    "need_payment"  => $this->input->post("need_payment"),
                    "created_on"    => date('Y-m-d H:i:s'),
                    "updated_on"    => date('Y-m-d H:i:s')
                );

                if ( isset($_FILES['background_image']) && $_FILES['background_image']["name"] != '' ) {
                    $upload_path = 'assets/categoryImages/';
                    $ext_image_name = explode(".", $_FILES['background_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('category_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $image_info = getimagesize($_FILES["background_image"]["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $background_image = cipl_image_upload($_FILES['background_image'], 'background_image', $upload_path, $file_name, $image_width, $image_height);

                    if (isset($background_image['success'])) {
                        $background_image_array = array("background_image" => $upload_path . $file_name);
                        $update_array = array_merge($background_image_array, $update_array);
                       
                        $this->categories_model->addCategory($update_array);
                        $this->session->set_flashdata('Success', 'Category added successfully.');
                        redirect('usadmin/categories', 'refresh');
                    } else {
                        $this->session->set_flashdata('Error', $background_image['messages']['error']);
                    }
                } else {
                    $this->categories_model->addCategory($update_array);
                    $this->session->set_flashdata('Success', 'Category added successfully.');
                    redirect('usadmin/categories', 'refresh');
                }            
            }
        }
        
        $data['root_categories'] = $this->categories_model->getRootCategories();
        $data['sections'] = $this->categories_model->getAllSections();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/categories/add', $data);
        $this->load->view('admin/common/footer');
    }

    // Edit Category
    public function edit_category($category_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'category_name',
                    'label' => 'Category Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'category_type',
                    'label' => 'Category Type',
                    'rules' => 'required'
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
                    "category_name" => $this->input->post('category_name'),
                    "category_type" => $this->input->post('category_type'),
                    "parent_id"     => $this->input->post('parent_id'),
                    "section_id"    => $this->input->post('section_id'),
                    "sort_order"    => $this->input->post("sort_order"),
                    "need_payment"  => $this->input->post("need_payment"),
                    "updated_on"    => date('Y-m-d H:i:s')
                );

                if ( isset($_FILES['background_image']) && $_FILES['background_image']["name"] != '' ) {
                    $upload_path = 'assets/categoryImages/';
                    $ext_image_name = explode(".", $_FILES['background_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('category_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $image_info = getimagesize($_FILES["background_image"]["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $background_image = cipl_image_upload($_FILES['background_image'], 'background_image', $upload_path, $file_name, $image_width, $image_height);

                    if (isset($background_image['success'])) {
                        $background_image_array = array("background_image" => $upload_path . $file_name);
                        $update_array = array_merge($background_image_array, $update_array);
                       
                        $this->categories_model->updateCategory($update_array, $category_id);
                        $this->session->set_flashdata('Success', 'Category updated successfully.');
                        redirect('usadmin/categories', 'refresh');
                    } else {
                        $this->session->set_flashdata('Error', $background_image['messages']['error']);
                    }
                } else {
                    $this->categories_model->updateCategory($update_array, $category_id);
                    $this->session->set_flashdata('Success', 'Category updated successfully.');
                    redirect('usadmin/categories', 'refresh');
                }
            }
        }
        
        $result = $this->categories_model->getCategory($category_id);
        $data['category'] = $result[0];
        
        $data['root_categories'] = $this->categories_model->getRootCategories();
        $data['sections'] = $this->categories_model->getAllSections();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/categories/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete Category
    public function delete_category() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["category_id"] = $this->input->post('category_id');
            $result = $this->categories_model->deleteCategory($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'Category deleted successfully.');
                echo 'success';
            } else {
                echo 'Error when delete the data. Try again.';
            }
        }
    }
}