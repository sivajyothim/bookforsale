<?php
defined('BASEPATH') or die('Some thing error occured');

class Order_model extends CI_Model{


	public function allOrderList($param)
    {
        

        $response=[];
        $status = isset($param['status'])?$param['status']:'';
        $where=[];
        if($status!='')
        {
        	$where['o.order_status']=$status;
        }
        $case_status="o.order_status WHEN 0 THEN 'Order Placed' WHEN 1 THEN 'Admin Approved' WHEN 2 THEN 'Seller Approved' WHEN 3 THEN 'Cancelled ' WHEN 4 THEN 'Order cancelled by Seller' WHEN 5 THEN 'In-transit' WHEN 6 THEN 'Delivered' WHEN 7 THEN 'Returned'";
        $payment_status="o.payment_method WHEN 'cod' THEN 'Cash On Delivery' WHEN 'online' THEN 'Paid Online'";
        $cols="o.*,"
                . "CASE $case_status END as order_status_message,o.order_status as order_status,CASE $payment_status END as payment_mode,";

        $sql=  $this->db->select($cols,FALSE)->from('orders o')
                ->where($where)->get();
                $db_error=  $this->db->error();
                if($db_error['code']==0)
                {
                        $count=$sql->num_rows();
                        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                        $response[MESSAGE]=($count > 0)?'Success':'Fail';
                        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
                        $response['order_result']=($count > 0)?$sql->result():array();
                }
                else
                {
                    $response[CODE]=DB_ERROR_CODE;
                    $response[MESSAGE]=DB_ERROR;
                    $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
                }
        return json_encode($response);

    }

    public function userOrderList($param)
    {
        $userid = $param['userid'];

        $response=[];
        $where=array('o.user_id'=>$userid);
        $case_status="o.order_status WHEN 0 THEN 'Order Placed' WHEN 1 THEN 'Admin Approved' WHEN 2 THEN 'Seller Approved' WHEN 3 THEN 'Cancelled ' WHEN 4 THEN 'Order cancelled by Seller' WHEN 5 THEN 'In-transit' WHEN 6 THEN 'Delivered' WHEN 7 THEN 'Returned'";
        $payment_status="o.payment_method WHEN 'cod' THEN 'Cash On Delivery' WHEN 'online' THEN 'Paid Online'";
        $cols="o.*,"
                . "CASE $case_status END as order_status_message,o.order_status as order_status,CASE $payment_status END as payment_mode,";

        $sql=  $this->db->select($cols,FALSE)->from('orders o')
                ->where($where)->get();
                $db_error=  $this->db->error();
                if($db_error['code']==0)
                {
                        $count=$sql->num_rows();
                        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                        $response[MESSAGE]=($count > 0)?'Success':'Fail';
                        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
                        $response['order_result']=($count > 0)?$sql->result():array();
                }
                else
                {
                    $response[CODE]=DB_ERROR_CODE;
                    $response[MESSAGE]=DB_ERROR;
                    $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
                }
        return json_encode($response);

    }
    public function orderDetails($param)
    {
        $orderid = $param['orderid'];
        
        $response=[];
        $where=array('o.order_id'=>$orderid);
        $case_status="o.order_status WHEN 0 THEN 'Order Placed' WHEN 1 THEN 'Admin Approved' WHEN 2 THEN 'Seller Approved' WHEN 3 THEN 'Cancelled ' WHEN 4 THEN 'Order cancelled by Seller' WHEN 5 THEN 'In-transit' WHEN 6 THEN 'Delivered' WHEN 7 THEN 'Returned'";
        $payment_status="o.payment_method WHEN 'cod' THEN 'Cash On Delivery' WHEN 'online' THEN 'Paid Online'";
        $cols="o.*,"
                . "CASE $case_status END as order_status_message,o.order_status as order_status,CASE $payment_status END as payment_mode,";

        $sql=  $this->db->select($cols,FALSE)->from('orders o')
                ->where($where)->limit(1)->get();
               // echo $this->db->last_query();exit;
                $db_error=  $this->db->error();
                if($db_error['code']==0)
                {
                        $count=$sql->num_rows();
                        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                        $response[MESSAGE]=($count > 0)?'Success':'Fail';
                        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
                        $response['order_result']=($count > 0)?$sql->row():array();
                        $response['order_products']=array();
                        if($count > 0)
                        {
                            $response['order_products']=  $this->orderProducts($orderid);
                        }
                }
                else
                {
                    $response[CODE]=DB_ERROR_CODE;
                    $response[MESSAGE]=DB_ERROR;
                    $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
                }
        return json_encode($response);
    }

    public function orderProducts($orderid)
    {
        $cartWhere =['c.order_id'=>$orderid,'c.cart_status'=>1];
        $this->db->select('c.*,p.book_image,p.book_title')->from('cart c');
        $this->db->join('books p','p.book_id=c.product_id','inner');
        $this->db->where($cartWhere);
        $sql = $this->db->get();
        $db_error=  $this->db->error();
        if($db_error['code']==0)
        {
               $count=$sql->num_rows();
               $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
               $response[MESSAGE]=($count > 0)?'Success':'Fail';
               $response[DESCRIPTION]=($count > 0)?$count.' items found':'No items found in your order';
               $response['product_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Db error';
            $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
        }
        return $response;
    }

    public function transactionList($param)
    {
        $response=[];

            $response[CODE]=204;
            $response[MESSAGE]='Error';
            $response[DESCRIPTION]='No results found..!';
        return json_encode($response);
    }


    public function sellerOrderList($param)
    {
        $userid = $param['userid'];

        $cartWhere =['c.seller_id'=>$userid,'c.cart_status'=>1];
        $this->db->select('c.*,p.book_image,p.book_title')->from('cart c');
        $this->db->join('books p','p.book_id=c.product_id','inner');
        $this->db->where($cartWhere);
        $sql = $this->db->get();
        $db_error=  $this->db->error();
        if($db_error['code']==0)
        {
               $count=$sql->num_rows();
               $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
               $response[MESSAGE]=($count > 0)?'Success':'Fail';
               $response[DESCRIPTION]=($count > 0)?$count.' items found':'No items found in your order';
               $response['product_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Db error';
            $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
        }
        return json_encode($response);

    }
}
