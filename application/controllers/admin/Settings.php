<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Settings Class
 *
 * @author Colan
 */
class Settings extends CI_Controller {
    
    public $settings_vars;

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/settings_model');
        
        $this->settings_vars = array(
                array("label" => "Admin Email Id", "key" => "admin_email_id"),
                array("label" => "Payment Email Id", "key" => "payment_email_id")
        );

        cipl_admin_auth();
    }

    public function index() {}

    // Edit Goal
    public function view_settings() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->settings_model->updateSettings();
            $this->session->set_flashdata('Success', 'Settings saved successfully.');
            redirect('usadmin/settings', 'refresh');

        }
        
        $result = $this->settings_model->getAllSettings();
        $settings = array();
        foreach ($result as $res) {
            $settings[$res["key"]] = $res["value"];
        }
        
        $data['settings'] = $settings;
        $data['setting_vars'] = $this->settings_vars;
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/settings/view', $data);
        $this->load->view('admin/common/footer');
    }
}