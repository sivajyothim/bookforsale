<?php
class AdminModel extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->adminid=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');
    }
    public function adminLogin($params)
    {
         
        $response=array();
        // print_r($params).exit;
        $username=$params['username'];
        $password=md5($params['user_password']);
        $cols='admin_id as adminid,admin_name as name,admin_email as email,admin_mobile as mobile,admin_flag_status as profile_status';
        $this->db->select($cols)
                ->from('const_master_admin_tbl')
                ->where('admin_securecode',$password);
        $this->db->group_start();
        $this->db->where('admin_email',$username);
        $this->db->or_where('admin_mobile',$username);
        $this->db->group_end();
        $sql=  $this->db->limit(1)->get();
        $dbError=  $this->db->error();
        if($dbError['code']==0)
        {
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0 )?'Login success..!':'Invalid credentials';
            $response['login_result']=($count > 0)?$sql->row():(object)(null);
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='DB Error ';
            $response[DESCRIPTION]=(QUERY_DEBUG==1)?$dbError['message']:'Something error occured.';
        }
        return json_encode($response);
    }
    
   
    
   
    
     

    
           
}