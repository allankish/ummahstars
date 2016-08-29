<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Settings Model Class
 *
 *  @version         1.0
 *  @author          Colan
 */
class Settings_model extends CI_Model {

    /**
     * Constructor
     * 
     * @access public
     */
    protected $settings_tbl;
    protected $settings_vars;

    function __construct() {
        parent::__construct();

        $this->settings_tbl = "settings";
        $this->settings_vars = array("admin_email_id", "payment_email_id");
    }

    public function getAllSettings() {
        $this->db->select('*')->from($this->settings_tbl);
        $query = $this->db->get();
        $settings = $query->result_array();

        return $settings;
    }

    public function getSetting($setting_key) {
        $this->db->select('*')->from($this->settings_tbl)->where('key', $setting_key);
        $query = $this->db->get();
        return $setting_details = $query->result_array();
    }

    public function updateSettings() {
        foreach ($this->settings_vars as $settings_var):
            $data = array();
            if ($this->input->post($settings_var) != '') {
                $this->db->where('key', $settings_var);
                $data = array('value' => $this->input->post($settings_var));
                $this->db->update($this->settings_tbl, $data);
            }
        endforeach;
        
        return true;
    }
}
