<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

class Common_loader {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();

        $data = array();
        if ($this->CI->session->userdata('admin_auth')) {
            $data['admin_id'] = $this->CI->session->userdata('admin_id');
            $data['admin_first_name'] = $this->CI->session->userdata('admin_first_name');
            $data['admin_last_name'] = $this->CI->session->userdata('admin_last_name');
            $data['admin_email'] = $this->CI->session->userdata('admin_email');
            $data['admin_created_on'] = $this->CI->session->userdata('admin_created_on');
            $data['admin_profile_image'] = $this->CI->session->userdata('admin_profile_image');

            $this->CI->load->vars($data);
        }
    }

}