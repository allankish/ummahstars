<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Section Class
 *
 * @author Colan
 */
class Section extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/section_model');
        $this->load->model('admin/age_groups_model');

        cipl_admin_auth();
    }

    public function index() {
        
    }

    // List Section

    public function list_section() {

        $data['sections'] = $this->section_model->listSection();

        $this->load->view('admin/common/header');
        $this->load->view('admin/section/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Section 
    public function add_section() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'section_name',
                    'label' => 'Section Name',
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
                    "section_name"  => $this->input->post('section_name'),
                    "slug"          => str_replace(' ', '-', strtolower($this->input->post('section_name'))),
                    "sort_order"    => $this->input->post("sort_order"),
                    "created_on"    => date('Y-m-d H:i:s'),
                    "updated_on"    => date('Y-m-d H:i:s')
                );
                
                $age_groups = $this->age_groups_model->get_all_age_groups();
                $background_images_array = array();
                $background_images_error = false;
                $background_images_error_messages = '';
                foreach($age_groups as $age_group):
                    if ( isset($_FILES['background_image-' . $age_group['age_group_id']]) && $_FILES['background_image-' . $age_group['age_group_id']]["name"] != '' ) {
                        $upload_path = 'assets/sectionImages/';
                        $ext_image_name = explode(".", $_FILES['background_image-' . $age_group['age_group_id']]['name']);
                        $count_ext_img = count($ext_image_name);
                        $image_ext = $ext_image_name[$count_ext_img - 1];
                        $file_name = base64_encode(trim($this->input->post('section_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                        $file_name = str_replace('=', '', $file_name);
                        $image_info = getimagesize($_FILES["background_image-" . $age_group["age_group_id"]]["tmp_name"]);
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];
                        $background_image = cipl_image_upload($_FILES['background_image-' . $age_group['age_group_id']], 'background_image-' . $age_group['age_group_id'], $upload_path, $file_name, $image_width, $image_height);

                        if (isset($background_image['success'])) {
                            $background_images_array[$age_group["age_group_id"]] = $upload_path . $file_name;
                        } else {
                            $background_images_error = true;
                            $background_images_array[$age_group["age_group_id"]] = '';
                            $background_images_error_messages .= $background_image['messages']['error'];
                        }
                    } else {
                        $background_images_array[$age_group["age_group_id"]] = '';
                    }
                endforeach;
                if ($background_images_error == false) {
                    $background_image_result_array = array("background_image" => serialize($background_images_array));
                    $update_array = array_merge($background_image_result_array, $update_array);
                    $this->section_model->addSection($update_array);
                    $this->session->set_flashdata('Success', 'Section added successfully.');
                    redirect('usadmin/section', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', $background_images_error_messages);
                }
            }
        }
        
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/section/add', $data);
        $this->load->view('admin/common/footer');
    }

    // Edit Section
    public function edit_section($section_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'section_name',
                    'label' => 'Section Name',
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
                    "section_name"  => $this->input->post('section_name'),
                    "slug"          => str_replace(' ', '-', strtolower($this->input->post('section_name'))),
                    "sort_order"    => $this->input->post("sort_order"),
                    "updated_on"    => date('Y-m-d H:i:s')
                );
                
                $age_groups = $this->age_groups_model->get_all_age_groups();
                $background_images_array = array();
                $background_images_error = false;
                $background_images_error_messages = '';
                foreach($age_groups as $age_group):
                    if ( isset($_FILES['background_image-' . $age_group['age_group_id']]) && $_FILES['background_image-' . $age_group['age_group_id']]["name"] != '' ) {
                        $upload_path = 'assets/sectionImages/';
                        $ext_image_name = explode(".", $_FILES['background_image-' . $age_group['age_group_id']]['name']);
                        $count_ext_img = count($ext_image_name);
                        $image_ext = $ext_image_name[$count_ext_img - 1];
                        $file_name = base64_encode(trim($this->input->post('section_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                        $file_name = str_replace('=', '', $file_name);
                        $image_info = getimagesize($_FILES["background_image-" . $age_group["age_group_id"]]["tmp_name"]);
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];
                        $background_image = cipl_image_upload($_FILES['background_image-' . $age_group['age_group_id']], 'background_image-' . $age_group['age_group_id'], $upload_path, $file_name, $image_width, $image_height);

                        if (isset($background_image['success'])) {
                            // Delete the old background image
                            unlink(FCPATH . base64_decode($this->input->post('background_image_old-' . $age_group['age_group_id'])));
                            $background_images_array[$age_group["age_group_id"]] = $upload_path . $file_name;
                        } else {
                            $background_images_error = true;
                            $background_images_array[$age_group["age_group_id"]] = '';
                            $background_images_error_messages .= $background_image['messages']['error'];
                        }
                    } else {
                        $background_images_array[$age_group["age_group_id"]] = base64_decode($this->input->post('background_image_old-' . $age_group['age_group_id']));
                    }
                endforeach;
                if ($background_images_error == false) {
                    $background_image_result_array = array("background_image" => serialize($background_images_array));
                    $update_array = array_merge($background_image_result_array, $update_array);
                    $this->section_model->editSection($update_array, $section_id);
                    $this->session->set_flashdata('Success', 'Section updated successfully.');
                    redirect('usadmin/section', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', $background_images_error_messages);
                }
            }
        }
        
        $result = $this->section_model->getSection($section_id);
        $data['section'] = $result[0];
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/section/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete Section
    public function delete_section() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["section_id"] = $this->input->post('section_id');
            $result = $this->section_model->deleteSection($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'Section deleted successfully.');
                echo 'success';
            } else {
                echo 'Error when delete the data. Try again.';
            }
        }
    }
}