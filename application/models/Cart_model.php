<?php 
defined('BASEPATH') or die('Some thing error occured');

class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        /*Setting the Cart Session (Temporary session) COde Start*/
        $this->cartsession=$this->session->userdata('cartsession');
        if(!isset($this->cartsession) && empty($this->cartsession))
        {
            $set_new_session=md5('VAV'.PROJECT_NAME.time().rand(3,99999));
            $this->session->set_userdata('cartsession',$set_new_session);
            $this->cartsession=$set_new_session;
            
        }
        /*Setting the Cart Session (Temporary session) COde End*/
    }


    public function addtocart($param)
    {
        $response=[];
        $productid = $param['productid'];
        $qty = $param['qty'];
        $cartsession = $param['cartsession'];
        $cartWhere=['cartsession_id'=>$cartsession,'product_id'=>$productid,'cart_status'=>0];
        $checkcart = $this->db->select('cart_id')->from('cart')->where($cartWhere)->get();
        $checkCount = $checkcart->num_rows();
        if($checkCount > 0)
        {
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE]='Fail';
            $response[DESCRIPTION]='This product already in your cart';
        }
        else
        {
              $booksWhere=['book_id'=>$productid,'stock > '=>0];
              $productSql = $this->db->select('*')->from('books')->where($booksWhere)->get();
              //echo $this->db->last_query();exit;
              $productCount = $productSql->num_rows();
              if($productCount > 0)
              {
                  $productRow = $productSql->row();
                  $sellingprice = $productRow->selling_price;
                  $bookWeight = $productRow->book_weight;
                  $height = $productRow->dimension_height;
                  $width = $productRow->dimension_width;
                  $length = $productRow->dimension_length;
                  $sellerid = $productRow->user_id;
                  /*> Weight details module section code start */
                  $deliver_charge =30;
                  $deliverSql = $this->db->select('price')->from('postal_weigths')->where('weight <=',$bookWeight)->order_by('price','DESC')->get();
                  $deliverCount = $deliverSql->num_rows();
                  if($deliverCount > 0)
                  {
                      $deliver_charge = $deliverSql->row()->price;
                  }
                  /*> Weight details module section code end */
                  $insertPrice = ($sellingprice * $qty);
                  $insertDeliverCharge = ($qty * $deliver_charge);
                  $insertData=[
                    'cartsession_id'=>$cartsession,
                    'product_id'=>$productid,
                    'product_price'=>$sellingprice,
                    'product_delivercharge'=>$deliver_charge,
                    'selling_price'=>($insertPrice),
                    'deliver_chage'=>$insertDeliverCharge,
                    'cart_price'=>($insertPrice + $insertDeliverCharge),
                    'seller_id'=>$sellerid,
                    'cart_status'=>0,
                    'product_weight'=>$bookWeight,
                    'product_width'=>$width,
                    'product_length'=>$length,
                    'product_height'=>$height,
                    'product_qty'=>$qty,
                  ];
                  $insertQurey=$this->db->insert_string('cart',$insertData);
                  $insertSql = $this->db->query($insertQurey);
                  $insertStatus= $this->db->affected_rows();
                  $response[CODE]=($insertStatus > 0)?SUCCESS_CODE:FAIL_CODE;
                  $response[MESSAGE]=($insertStatus > 0)?'success':'fail';
                  $response[DESCRIPTION]=($insertStatus > 0)?'Book added to cart successfully':'Unable to add to the cart. Please try later';
              } 
              else
              {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='fail';
                $response[DESCRIPTION]='No book details found or book in out of stock';
              }
            
        }
        return json_encode($response);
    }

    public function checkOutList($param)
    {
        $response=[];
        $cartsession = $param['cartsession'];
        $cartWhere =['c.cartsession_id'=>$cartsession,'cart_status'=>0];
        $this->db->select('c.*,p.book_image,p.book_title')->from('cart c');
        $this->db->join('books p','p.book_id=c.product_id','inner');
        $this->db->where($cartWhere);
        $sql = $this->db->get();
        $count = $sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'success':'fail';
        $response[DESCRIPTION]=($count > 0)?'Getting checkout list':'No items found in cart';
        $response['cart_result']=($count > 0)?$sql->result():[];
        return json_encode($response);
    }

     public function cartStatistics($param)
     {
         $response=[];
        $cartsession = $param['cartsession'];
        $cartWhere =['cartsession_id'=>$cartsession,'cart_status'=>0];
        $cartsql = $this->db->select('SUM(selling_price) as subtotal,SUM(deliver_chage) as delivercharge,SUM(cart_price) as total,COUNT(cart_id) as cart_itemcount')
        ->from('cart')->where($cartWhere)->get();
        $cartRow = $cartsql->row();
        $response['subtotal']=$cartRow->subtotal;
        $response['deliver_charges']=$cartRow->delivercharge;
        $response['total']=$cartRow->total;
        $response['cart_count']=$cartRow->cart_itemcount;
        return json_encode($response);
     }

     //Create New Order
     public function insertOrder($param)
     {
         $response=[];
         $userid = $param['userid'];
         $username = $param['username'];
         $address = $param['address'];
         $landmark = $param['landmark'];
         $area = $param['area'];
         $city = $param['city'];
         $state = $param['state'];
         $country = $param['country'];
         $pincode = $param['pincode'];
         $mobile_number = $param['mobile_number'];
         $cartsession = $param['cartsession'];
         $payment_method = $param['payment_method'];
         $emailid = $param['emailid'];
         $ordernote = $param['ordernote'];
         $cartRes = json_decode($this->cartStatistics(['cartsession'=>$cartsession]));
         $noofitems = $cartRes->cart_count;
         $subtotal = $cartRes->subtotal;
         $deliver_charges = $cartRes->deliver_charges;
         $total = $cartRes->total;
         
         /* Insert Cart Data  code start*/
         $orderNumber = ORDER_CODE.mt_rand(0000,9999);
         $insertOrderData=[
             'order_num'=>$orderNumber,
             'user_id'=>$userid,
             'user_name'=>$username,
             'email_id'=>$emailid,
             'phone_number'=>$mobile_number,
             'address'=>$address,
             'landmark'=>$landmark,
             'area'=>$area,
             'city'=>$city,
             'state'=>$state,
             'country'=>$country,
             'pincode'=>$pincode,
             'cartsession'=>$cartsession,
             'payment_method'=>$payment_method,
             'cart_item_count'=>$noofitems,
             'subtotal'=>$subtotal,
             'deliver_charges'=>$deliver_charges,
             'order_total'=>$total,
             'order_status'=>0,
             'order_note'=>$ordernote,
            ];
         $insertOrder = $this->db->insert_string('orders',$insertOrderData);
         $orderSql = $this->db->query($insertOrder);
         $insertStatus=  $this->db->affected_rows();
         $cartUpdateStaus = 0;
         if($insertStatus > 0)
         {
             $orderid = $this->db->insert_id();
             /*Updating cart table based on cart session*/
             $updateCartData=['cart_status'=>1,'order_number'=>$orderNumber,'order_id'=>$orderid];
             $cartWhere=['cartsession_id'=>$cartsession,'cart_status'=>0];
             $cartUpdate = $this->db->update_string('cart',$updateCartData,$cartWhere);
             $updateCart = $this->db->query($cartUpdate);
             $cartUpdateStaus = $this->db->affected_rows();
             /*Updating cart table */
         }
         $response[CODE]=($cartUpdateStaus > 0)?SUCCESS_CODE:FAIL_CODE;
         $response[MESSAGE]=($cartUpdateStaus > 0)?'success':'fail';
         $response[DESCRIPTION]=($cartUpdateStaus > 0)?'Order placed successfully':'Some thing error occured';
         $response['orderid']=($cartUpdateStaus > 0)?$orderid:0;
         /* Insert Cart Data  code end*/ 
         return json_encode($response);
     }
}