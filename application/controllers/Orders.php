<?php
defined ('BASEPATH') or die('Some thing error occured');

class Orders extends CI_Controller
{
        public $userid,$orderfolder;
        public function __construct()
        {
            parent::__construct();
            isUserLogin();
            $this->userid= $this->session->userdata(USER_SESS_CODE.'userid');
            $this->orderfolder='orders/';
            $this->load->model(['Master_model'=>'master','Order_model'=>'order']);
            $this->data=[];
            $this->data['header_menu']=$this->master->allMenuList();
            $this->cartsession=$this->session->userdata('cartsession');
        }


       public function index()
        {
            $this->data['url_title']=PROJECT_NAME.' :: Orders';
            $param=[];
            $param['userid']=$this->userid;
            $this->data['order_details']=$this->order->userOrderList($param);
		    $this->load->view($this->orderfolder.'manage_orders',$this->data);
        }

        public function orderdetails()
        {
            $ordernumber = $this->uri->segment(2);
            $orderid = $this->uri->segment(3);
            $this->data['url_title']=$ordernumber.' details';
            $param=[];
            $param['userid']=$this->userid;
            $param['orderid']=base64_decode($orderid);
            $this->data['order_num']=$ordernumber;
            $this->data['orders_details']=$this->order->orderDetails($param);
            $this->load->view($this->orderfolder.'order_details',$this->data);
        }


        public function transactions()
        {
            $this->data['url_title']=PROJECT_NAME.' :: Transactions';
            $param=[];
            $param['userid']=$this->userid;
            $this->data['transaction_details']=$this->order->transactionList($param);
		    $this->load->view($this->orderfolder.'manage_transactions',$this->data);
        }

        public function sellerOrders()
         {
             $this->data['url_title']=PROJECT_NAME.' :: My Orders';
             $param=[];
             $param['userid']=$this->userid;
             $this->data['order_details']=$this->order->sellerOrderList($param);
 		           $this->load->view($this->orderfolder.'manage_seller_orders',$this->data);
         }

         //Approve seller order_result
         public function approvevendororder()
         {
            $cartid = $this->input->post('cartid');
            $response=[];
            $error=0;$error_msg='';
            if(!number_check($cartid)){$error=1;$error_msg='Cart id missing,';}
             if($error == 0)
             {
                  $statusWhere=['cart_id'=>$cartid,'seller_id'=>$this->userid];
                  $updateStatus = $this->db->update('cart',['seller_approve_status'=>1,'seller_approved_date'=>DATE],$statusWhere);
                  $response[CODE]=($updateStatus > 0)?SUCCESS_CODE:FAIL_CODE;
                  $response[MESSAGE]=($updateStatus > 0)?'success':'fail';
                  $response[DESCRIPTION]=($updateStatus > 0)?'Item is ready to deliver.':'Some thing error occured';
             }
            echo json_encode($response);
         }
    }
