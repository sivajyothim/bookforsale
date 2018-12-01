<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('isAdminLogin'))
{
    function isAdminLogin()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata(ADMIN_SESS_CODE.'adminid');
       if(!isset($is_logged_in) || $is_logged_in != true)
       {
           redirect(ADMIN_LINK.'login');
       }
    }
    
    function isUserLogin()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata(USER_SESS_CODE.'userid');
       if(!isset($is_logged_in) || $is_logged_in != true)
       {
           redirect(base_url().'signup');
       }
    }

    function isStaffLogin()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata(STAFF_SESS_CODE.'adminid');
       if(!isset($is_logged_in) || $is_logged_in != true)
       {
           redirect(STAFF_LINK.'login');
       }
    }
}
