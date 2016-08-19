<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Prizes Class
 *
 * @author Colan
 */
class Prizes extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/prizes_model');

        cipl_admin_auth();
    }

    public function index() {}

    // List Prizes
    public function list_prizes() {

        $data['prizes'] = $this->prizes_model->getAllPrizes();

        $this->load->view('admin/common/header');
        $this->load->view('admin/prizes/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Prize
    public function add_prize() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'prize_name',
                    'label' => 'Prize Name',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "prize_name" => $this->input->post('prize_name'),
                    "created_by"  => 0,
                    "created_on"    => date('Y-m-d H:i:s'),
                    "updated_on"    => date('Y-m-d H:i:s')
                );
                
                $prize_image_error = false;
                if ( isset($_FILES['prize_image']) && $_FILES['prize_image']["name"] != '' ) {
                    $upload_path = 'assets/prizeImages/';
                    $ext_image_name = explode(".", $_FILES['prize_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('prize_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $image_info = getimagesize($_FILES["prize_image"]["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $prize_image = cipl_image_upload($_FILES['prize_image'], 'prize_image', $upload_path, $file_name, $image_width, $image_height);

                    if (isset($prize_image['success'])) {
                        $prize_image_name = $upload_path . $file_name;
                    } else {
                        $prize_image_error = true;
                        $prize_image_name = '';
                        $prize_image_error_message = $prize_image['messages']['error'];
                    }
                } else {
                    $prize_image_name = '';
                }
 
                if ($prize_image_error == false) {
                    $prize_image_result_array = array("prize_image" => $prize_image_name);
                    $update_array = array_merge($prize_image_result_array, $update_array);
                    $this->prizes_model->addPrize($update_array);
                    $this->session->set_flashdata('Success', 'Prize added successfully.');
                    redirect('usadmin/prizes', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', $prize_image_error_message);
                }         
            }
        }
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/prizes/add');
        $this->load->view('admin/common/footer');
    }

    // Edit Prize
    public function edit_prize($prize_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'prize_name',
                    'label' => 'Prize Name',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {

                $update_array = array(
                    "prize_name" => $this->input->post('prize_name'),
                    "updated_on"    => date('Y-m-d H:i:s')
                );
                
                $prize_image_error = false;
                if ( isset($_FILES['prize_image']) && $_FILES['prize_image']["name"] != '' ) {
                    $upload_path = 'assets/prizeImages/';
                    $ext_image_name = explode(".", $_FILES['prize_image']['name']);
                    $count_ext_img = count($ext_image_name);
                    $image_ext = $ext_image_name[$count_ext_img - 1];
                    $file_name = base64_encode(trim($this->input->post('prize_name'))) . '_' . md5(rand(1000000, 1000000000)) . '.' . $image_ext;
                    $file_name = str_replace('=', '', $file_name);
                    $image_info = getimagesize($_FILES["prize_image"]["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $prize_image_name = cipl_image_upload($_FILES['prize_image'], 'prize_image', $upload_path, $file_name, $image_width, $image_height);

                    if (isset($prize_image['success'])) {
                        unlink(FCPATH . base64_decode($this->input->post('prize_image_old')));
                        $prize_image_name = $upload_path . $file_name;
                    } else {
                        $prize_image_error = true;
                        $prize_image_name = '';
                        $prize_image_error_message = $prize_image['messages']['error'];
                    }
                } else {
                    $prize_image_name = base64_decode($this->input->post('prize_image_old'));
                }
 
                if ($prize_image_error == false) {
                    $prize_image_result_array = array("prize_image" => $prize_image_name);
                    $update_array = array_merge($prize_image_result_array, $update_array);
                    $this->prizes_model->updatePrize($update_array, $prize_id);
                    $this->session->set_flashdata('Success', 'Prize updated successfully.');
                    redirect('usadmin/prizes', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', $prize_image_error_message);
                }         
            }
        }
        
        $result = $this->prizes_model->getPrize($prize_id);
        $data['prize'] = $result[0];
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/prizes/edit', $data);
        $this->load->view('admin/common/footer');
    }

    // Delete Prize
    public function delete_prize() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["prize_id"] = $this->input->post('prize_id');
            $result = $this->prizes_model->deletePrize($data);
            
            if ($result) {
                $this->session->set_flashdata('Success', 'Prize deleted successfully.');
                echo 'success';
            } else {
                echo 'Error when delete the data. Try again.';
            }
        }
    }
}