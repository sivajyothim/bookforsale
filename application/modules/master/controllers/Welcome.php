<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_controller
{
    public $profile_folder,$data,$adminid;
    function __construct() {

     parent::__construct();
     $this->load->model(array('AdminModel'=>'admin','SettingsModel'=>'settings'));

        $this->profile_folder='admin_profile/';
        $this->adminId=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');

        $this->data=array();
     }

	public function index()
	{
            isAdminLogin();
            $this->data['main_title']='Dashboard';
            
            $this->load->view('dashboard',$this->data);
    }

    public function gallery()
	{
            isAdminLogin();
            $this->data['main_title']='Gallery';
            $param=[];
            
            $this->data['gallery_details']=$this->settings->galleryList($param);
            $this->load->view('gallery',$this->data);
    }

    

    public function videos()
	{
            isAdminLogin();
            $this->data['main_title']='Videos';
            
            $this->load->view('videos',$this->data);
    }
    
    public function tables()
	{
            isAdminLogin();
            $this->data['main_title']='Dashboard';
            
            $this->load->view('tables',$this->data);
    }
    
    public function profile()
	{
            isAdminLogin();
            $this->data['main_title']='Dashboard';
            
            $this->load->view('profile',$this->data);
	}
    public function login()
    {
        $this->load->view($this->profile_folder."login");
    }
    public function adminLogin()
    {
        $response=array();
            $error=0;
            $errorMsg ='';
            $logMail=$this->input->post('username');
            $logPassword=$this->input->post('userpassword');
            $captcha = $this->input->post('g-recaptcha-response');
            if($logMail==''){ $error=1; $errorMsg.='Email is missing,';}
            if($logPassword==''){ $error=1; $errorMsg.='Password is missing,';}

            $userIp= $_SERVER['REMOTE_ADDR'];
            if($error==1)
            {
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation';

                $response[DESCRIPTION]=rtrim($errorMsg,',');
            }
            else
            {
                $logParams = array(
                    'username'=>$logMail,
                    'user_password'=>$logPassword,
                );
                $loginSendReq = $this->admin->adminLogin($logParams);
                $loginReq=  json_decode($loginSendReq);
                if($loginReq->code==SUCCESS_CODE)
                {
                    $loginResult=$loginReq->login_result;
                    $adminid=$loginResult->adminid;
                    $adminname=$loginResult->name;
                    $mobile=$loginResult->mobile;
                    $email=$loginResult->email;
                    $profile_status=$loginResult->profile_status;
                    if($profile_status==1)
                    {
                        $sess_array = array(
                                            ADMIN_SESS_CODE.'adminid'=>$adminid,
                                            ADMIN_SESS_CODE.'username'=>$adminname,
                                            ADMIN_SESS_CODE.'mobile'=>$mobile,
                                            ADMIN_SESS_CODE.'email'=>$email,
                                            ADMIN_SESS_CODE.'userstatus'=>$profile_status,
                                            );
                            // print_r($sess_array).exit;
                            $this->session->set_userdata($sess_array);
                            setcookie ("user", $email, time()+604800); 
                            $response[CODE]=SUCCESS_CODE;
                            $response[MESSAGE]='Success';
                            $response[DESCRIPTION]='Login success.Please wait...';
                            $response['redirect_url']=ADMIN_LINK;
                    }
                    else
                    {
                        $response[CODE]=FAIL_CODE;
                        $response[MESSAGE]='Fail';
                        $response[DESCRIPTION]='Profile blocked. Please contact admin for more details';
                    }
                }
                echo $loginSendReq;exit;
            }

        echo json_encode($response);
    }
    public function logout()
    {
        isAdminLogin();
        $this->session->sess_destroy();
        redirect(ADMIN_LINK.'login');
    }

    public function getPincodedetails($pincode)
    {
        $response=[];
        $stateName=$distName=$cityName='';

            $url = "http://postalpincode.in/api/pincode/".$pincode;
            $data = file_get_contents($url);
            $req=json_decode($data);
            $status= strtolower($req->Status);
            if($status=='success')
            {
                //print_r($req->PostOffice[0]);
                $statename=$req->PostOffice[0]->State;
                $stateName=strtolower(str_replace(' ','',$statename));
                $distname=$req->PostOffice[0]->District;
                $distName=strtolower(str_replace(' ','',$distname));
                $cityname=$req->PostOffice[0]->Circle;
                $cityName=strtolower(str_replace(' ','',$cityname));
            }

        $response['state']=  fetch_ucfirst($stateName);
        $response['dist']=fetch_ucfirst($distName);
        $response['city']=fetch_ucfirst($cityName);
        echo json_encode($response);
    }

    public function events()
	{
            isAdminLogin();
            $this->data['main_title']='Events';
            $param=[];
            $this->data['event_details']=$this->settings->eventList($param);
            $this->load->view('events/manage_events',$this->data);
    }

    public function deleteevent()
    {
         $eventid = $this->uri->segment(4);
        if(is_numeric($eventid) && !empty($eventid))
        {
            $delete = $this->db->delete('tbl_events',['event_id'=>$eventid]);
        }
         redirect(ADMIN_LINK.'Welcome/events');
    }

    public function eventdetails($eventid)
    {
        $result = $this->settings->eventDetails($eventid);
        echo $result;
    }

    public function editevent($eventid)
    {
        isAdminLogin();
        $this->data['main_title']='Event Details';
        $param=[];
        $this->data['event_details']=$this->settings->eventDetails($eventid);
        $this->load->view('events/edit_event',$this->data);
    }



    public function  modulesstatuschange() 
            {
                $response = array();
                $input_req = file_get_contents('php://input');
                $input_response = json_decode($input_req);
                $input_table = strtolower(trim($input_response->table));
                $input_status = trim($input_response->status);
                $input_data = $input_response->inputdata;
                $error = 0;
                $errror_message = '';
                if ($input_table == '') {
                    $error = 1;
                    $errror_message.='* Table name missing.';
                }
                if ($input_status > 5) {
                    $error = 1;
                    $errror_message.='* Status is missing.';
                }
                if ($input_data == '') {
                    $error = 1;
                    $errror_message.='* Input data is missing.';
                }

                if($error==1)
                {
                    $response[CODE] = VALIDATION_CODE;
                    $response[MESSAGE] = 'Validation error';
                     $response[DESCRIPTION] = $errror_message;
                     echo json_encode($response);exit;
                }
                else
                {
                    $table = $setcols = $condition = '';
                    switch ($input_table) {
                        case 'user':/* Users */
                                $table = 'users_info';
                                $setcols = 'profile_status';
                                $condition = "user_id IN  (" . $input_data . ")";
                        break;
                        case 'weight':/* weight */
                                $table = 'postal_weigths';
                                $setcols = 'flag_status';
                                $condition = "weight_id IN  (" . $input_data . ")";
                        break;
                         case 'slider':/* Slider */
                                $table = 'slider_tbl';
                                $setcols = 'flag_status';
                                $condition = "id IN  (" . $input_data . ")";
                        break;
                        case 'menu':/* Menu */
                                $table = 'menu_tbl';
                                $setcols = 'flag_status';
                                $condition = "id IN  (" . $input_data . ")";
                        break;

                         case 'subgroup':/* Subgroup */
                                $table = 'subgroups';
                                $setcols = 'flag_status';
                                $condition = "subgroup_id IN  (" . $input_data . ")";
                        break;
                         case 'submenu':/* Subgroup */
                                $table = 'submenu_tbl';
                                $setcols = 'flag_status';
                                $condition = "id IN  (" . $input_data . ")";
                        break;
                    }
                    if ($table != '' && $setcols != '' && $condition != '') {
                        $update = $this->crud->commonStatusUpdate(trim($table), array($setcols => $input_status), $condition, $input_status);
                        echo $update;
                        exit;
                    } else {
                        $response[CODE] = VALIDATION_CODE;
                        $response[MESSAGE] = 'Validation error';
                        $response[DESCRIPTION] = $errror_message;
                        echo json_encode($response);exit;
                    }
                }
        }


        public function deleteweight($weightid)
        {
            $this->db->delete('postal_weigths',['weight_id'=>$weightid]);
            redirect(ADMIN_LINK.'Settings/weight');
        }

        public function deleteslider($id)
        {
            $this->db->delete('slider_tbl',['id'=>$id]);
            redirect(ADMIN_LINK.'Settings/sliders');
        }

          public function deletemenu($id)
        {
            $this->db->delete('menu_tbl',['id'=>$id]);
            redirect(ADMIN_LINK.'Settings/menulist');
        }

          public function deletesubgroup($id)
        {
            $this->db->delete('subgroups',['subgroup_id'=>$id]);
            redirect(ADMIN_LINK.'Settings/subgroup');
        }

          public function deletesubmenu($id)
        {
            $this->db->delete('submenu_tbl',['id'=>$id]);
            redirect(ADMIN_LINK.'Settings/submenu');
        }
}
