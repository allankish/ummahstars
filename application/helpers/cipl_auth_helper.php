<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('cipl_admin_auth')) {

    function cipl_admin_auth() {
        $CI = & get_instance();

        $is_admin_auth = $CI->session->userdata('admin_auth');
        if (!isset($is_admin_auth) || $is_admin_auth != true) {
            redirect('/usadmin/login');
            die();
        }
    }

}

if (!function_exists('cipl_user_auth')) {

    function cipl_user_auth() {
        $CI = & get_instance();

        $is_user_auth = $CI->session->userdata('user_auth');
        if (!isset($is_user_auth) || $is_user_auth != true) {
            redirect('/login');
            die();
        }
    }

}