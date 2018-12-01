<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_controller
{
    public $settingsfolder,$data,$adminid;
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('order_model'=>'order'));
        $this->orderfolder='orders/';
        $this->adminId=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');
        $this->data=array();
        isAdminLogin();
     }
     
     public function index() {
             $this->data['main_title']='Orders List';
             $this->data['url_title']='Orders List';
             $param=[];
             $this->data['order_details']=$this->order->allOrderList($param);
             $this->load->view($this->orderfolder.'manage_orders',$this->data);
     }


      public function completedorders() {
             $this->data['main_title']='Completed Order';
             $this->data['url_title']='Completed Order';
             $param=[];
             $param['status']=6;
             $this->data['order_details']=$this->order->allOrderList($param);
             $this->load->view($this->orderfolder.'manage_orders',$this->data);
     }

           public function pendingorders() {
             $this->data['main_title']='Pending Order';
             $this->data['url_title']='Pending Order';
             $param=[];
             $param['status']=0;
             $this->data['order_details']=$this->order->allOrderList($param);
             $this->load->view($this->orderfolder.'manage_orders',$this->data);
     }

       public function orderdetails($ordernum,$orderid) {
             $this->data['main_title']=$ordernum.' - order details';
             $this->data['url_title']=$ordernum.' - order details';
             $param=[];
             $param['orderid']=$orderid;
             $this->data['order_details']=$this->order->orderDetails($param);
             $this->load->view($this->orderfolder.'order_details',$this->data);
     }

     public function maketodeliver($orderid)
     {
         //Update order status 
         if(!empty($orderid))
         {

             $updatewhere=['order_id'=>$orderid,'order_status'=>0];
             $updateData=['order_status'=>6,'delivered_on'=>DATE];
             $sql = $this->db->update_string('orders',$updateData,$updatewhere);
             $qry = $this->db->query($sql);
         }
         redirect(ADMIN_LINK.'Orders');
     }
}