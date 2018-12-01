<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_controller
{
    public $settingsfolder,$data,$adminid;
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('User_model'=>'user','Order_model'=>'order'));
        $this->userfolder='users/';
        $this->adminId=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');
        $this->data=array();
        isAdminLogin();
     }
     
     public function index($param=NULL) {
             $this->data['main_title']='User List';
             $this->data['url_title']='User List';
             $param=[];
             $this->data['user_details']=$this->user->userList($param);
             $this->load->view($this->userfolder.'manage_users',$this->data);
     }

     public function userorders($username,$userid) {

             $this->data['main_title']=$username.' - Orders List';
             $this->data['url_title']=$username.' - Orders List';
             $param=[];
             $param['userid']=$userid;
             $this->data['order_details']=$this->order->userOrderList($param);
             $this->load->view($this->userfolder.'manage_orders',$this->data);
     }

     public function deleteuser($userid)
     {
         if(!empty($userid))
         {
             $this->db->delete('users_info',['user_authtoken'=>$userid]);
         }
         redirect(ADMIN_LINK.'User');
     }
}