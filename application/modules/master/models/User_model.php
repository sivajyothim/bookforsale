<?php
class User_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->adminid=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');
    }

public function userList($param=NULL)
    {
         
        $cols ="*";
        $status = (isset($param['status']))?$param['status']:'';
        $where=[];
        if($status!='')
        {
            $where['flag_status']=$status;
        }
        $result =  $this->crud->singleTableData(
           [
               'table'=>'users_info',
               'cols'=>$cols,
               'order_by'=>['column'=>'user_name','sort'=>'DESC'],
               'response_param'=>'user_result',
               'description_message'=>'Getting User list',
               'debug'=>FALSE,
               'where_condition'=>$where,
           ]
        );
       return $result; 
    }

}