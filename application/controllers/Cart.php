<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model(['Master_model'=>'master','Filter_model'=>'books','Cart_model'=>'cart','Order_model'=>'order']);
		$this->data=[];
                $this->data['header_menu']=$this->master->allMenuList();
                $this->cartsession=$this->session->userdata('cartsession');
                 $this->userid= $this->session->userdata(USER_SESS_CODE.'userid');
         }

    public function addToCart()
    {
       $productid = $this->input->post('cartid');
       $qty = $this->input->post('qty');
       
       $param=[
           'productid'=>$productid,
           'qty'=>$qty,
           'cartsession'=>$this->cartsession,
       ];
       echo $addtocart = $this->cart->addtocart($param);
    }

    public function cartitems()
    {
       
        $this->data['url_title']=PROJECT_NAME.' - Check out ';
        $param=[];
        $param['cartsession']=$this->cartsession;
        $this->data['checkout_details']=$this->cart->checkOutList($param);
        $this->data['cart_details']=$this->cart->cartStatistics($param);
	$this->load->view('checkout/cartlist',$this->data);
    }
    
     public function shippingDetails()
    {
        isUserLogin();
        $this->data['url_title']=PROJECT_NAME.' - Shipping';
        $param=[];
        $param['cartsession']=$this->cartsession;
        $this->data['cart_details']=$this->cart->cartStatistics($param);
	$this->load->view('checkout/shipping',$this->data);
    }
    
    public function deleteCart()
    {
        $deleteWhere=['cartsession_id'=> $this->cartsession];
        $this->db->delete('cart',$deleteWhere);
        redirect(base_url());
    }
    
    public function deletecartitem($cartid)
    {
        $deleteWhere=['cartsession_id'=> $this->cartsession,'cart_id'=>$cartid,'cart_status'=>0];
        $this->db->delete('cart',$deleteWhere);
        redirect(base_url().'checkout');
    }

    public function insertorder()
    {
        ini_set('max_execution_time',0);
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = $this->userid;
            $useremail = (isset($req_response->useremail)) ? input_data($req_response->useremail) : '';
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $mobile = (isset($req_response->usermobile)) ? input_data($req_response->usermobile) : '';
            $address = (isset($req_response->address)) ? input_data($req_response->address) : '';
            $landmark    = (isset($req_response->landmark)) ? input_data($req_response->landmark) : '';
            $area = (isset($req_response->area)) ? input_data($req_response->area) : '';
            $city = (isset($req_response->city)) ? input_data($req_response->city) : '';
            $state = (isset($req_response->state)) ? input_data($req_response->state) : '';
            $country = (isset($req_response->country)) ? input_data($req_response->country) : 'India';
            $pincode = (isset($req_response->pincode)) ? input_data($req_response->pincode) : '';
            $payment_mode = (isset($req_response->payment_mode)) ? input_data($req_response->payment_mode) : '';
            $ordernote =  (isset($req_response->ordernote)) ? input_data($req_response->ordernote) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* login is required,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            if ($mobile == '') {$error_message.='mobile number is missing ,'; $error = 1;}
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if ($city=='') {$error_message.='city is missing ,'; $error = 1;}
            if ($state=='') {$error_message.='state is missing ,'; $error = 1;}
            if ($country=='') {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            
            if($pincode!='' && !pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
            if($mobile!='' && !mobile_check($mobile)){$error_message.='invalid mobile number ,'; $error = 1;}
            if($useremail!='' && !email_check($useremail)){$error_message.='invalid email id ,'; $error = 1;}
            //if (($payment_mode!='cod') && ($payment_mode!='online')) {$error_message.='Please select payment option ,'; $error = 1;}
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$this->userid,
                            'username'=>$username,
                            'address'=>$address,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                            'mobile_number'=>$mobile,
                            'emailid'=>$useremail,
                            'cartsession'=>$this->cartsession,
                            'payment_method'=>$payment_mode,
                            'ordernote'=>$ordernote,
                        ];
               $orderReq=$this->cart->insertOrder($reqData);
               $orderRes = json_decode($orderReq);
               if($orderRes->code != 200)
               {
                    
                    echo $orderReq;exit;
               }
               else
               {
                   if($payment_mode !='cod')
                   {
                     $response[CODE]='200';
                     $response[MESSAGE]='200';
                     $response[DESCRIPTION]='Please wait.. Redirecting to payment gateway';  
                     $response['redirect_url']=base_url().'orders';
                   }
                   else
                   {
                       //Sending Email code section code start
                        if(SITE_MODE==1)
                        {
                            $this->sendOrderEmail($orderRes->orderid);
                        }
                        $response[CODE]='200';
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Your order created successfully.';  
                        $response['redirect_url']=base_url().'orders';
                   }
                   
               }
               
            }
        }
        echo json_encode($response);
    }

    public function sendOrderEmail($orderid)
    {
        $orders_details= $this->order->orderDetails(['orderid'=>$orderid,'userid'=>$this->userid]);
        $order_req = json_decode($orders_details);
        $this->data['orders_details']=$orders_details;
        if ($order_req->code == SUCCESS_CODE)
        {
                $order_response = $order_req->order_result;
               // $this->load->view(emailtemplatefolder.'order_template',  $this->data);
                $result=$this->sendmail->sendEmail(
                    array(
                        'to'=>array($order_response->email_id),
                        'cc'=>array('achariphp@gmail.com'),
                        'subject'=>$order_response->order_number.' Order from '.SITE_DOMAIN,
                        'data'=>array('orders_details'=>$orders_details),
                        'template'=>emailtemplatefolder . 'order_template',
                    )
                 );
        }
        return true;
    }
}