<?php 
defined('BASEPATH') or die('Some thing error occured');
/*
Purpose : User related here - Insert/update/ etc..

*/
class Userapi extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['UserModel'=>'user']);
        $this->userid = $this->session->userdata(USER_SESS_CODE.'userid'); 
    }   


    public function signup()
    {
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
            $name = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $email = (isset($req_response->useremail)) ? $req_response->useremail : '';
            $mobile = (isset($req_response->usermobile)) ? $req_response->usermobile : '';
            $password = (isset($req_response->userpassword)) ? trim($req_response->userpassword) : '';
            $app_type = (isset($req_response->app)) ?'app': 'web';
            /*Validatio Section */
            if ($name == '') {$error_message.='* Username is missing ,'; $error = 1;}
            if (!email_check($email)) { $error_message .= '* invalid email ,';$error = 1;}
            if (!mobile_check($mobile)) {$error_message .= '* invalid mobile ,';$error = 1;}
            if (strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
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
               $userData=[
                   'username'=>$name,
                   'email'=>$email,
                   'mobile'=>$mobile,
                   'password'=>$password,
                   'app_type'=>$app_type,
               ];
               $signUpResponseReq=  $this->user->createUser($userData);
               $signUpResponse=json_decode($signUpResponseReq);
               if($signUpResponse->code == SUCCESS_CODE)
               {
                   
                        $email_verification = base64_encode($signUpResponse->verificationcode);
                        $emailData=[
                                    'name'=>$name,
                                    'email'=>$email,
                                    'mobile'=>$mobile,
                                    'title'=>$name,
                                    'verification_link'=>base_url() . 'user-accountverification/' . $email_verification,
                                   ];
                                   if(SITE_MODE == 1)
                                   {
                                        //sending email code
                                        $sendEmail = $this->sendmail->sendEmail(
                                                            array(
                                                                'to' => array($email),
                                                                'bcc' => array(BCC_EMAIL),
                                                                'subject' => 'User Signup- verification mail',
                                                                'data' => array('user_details' =>$emailData),
                                                                'template' =>'email_templates/user_register_template',
                                                            )
                                                    );
                                   }
               
                  $response[CODE]=SUCCESS_CODE;
                  $response[MESSAGE]='success';
                  $response[DESCRIPTION]='Account created successfully.Please verify the email to continue';                  
               }
               else
               {
                   echo $signUpResponseReq;exit;
               }
            }
        }
        echo json_encode($response);
    }

    public function verifyaccount()
    {
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
            $verificationcode = (isset($req_response->verificationcode)) ? input_data($req_response->verificationcode) : '';
            
            /*Validatio Section */
            if ($verificationcode == '') {$error_message.='* verification is missing ,'; $error = 1;}
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
                   'verification_code'=>$verificationcode,
               ];
               $verificationResponse=  $this->user->newUserAccountVerification($reqData);
               echo $verificationResponse;exit;
               
            }
        }
        echo json_encode($response);
    }

    public function userLogin()
    {
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
            $username = (isset($req_response->loginusername)) ? input_data($req_response->loginusername) : '';
            $password = (isset($req_response->loginpassword)) ? input_data($req_response->loginpassword) : '';
            $app = 'web';
            $cururl = (isset($req_response->cur_url)) ? input_data($req_response->cur_url) : ''; 
            /*Validatio Section */
            if ($username == '') {$error_message.='* enter email/mobile ,'; $error = 1;}
            if ($password == '') {$error_message.='* password is missing ,'; $error = 1;}
            if ($password != '' && strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
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
               $loginData=[
                            'username'=>$username,
                            'password'=>$password,
                            'app'=>$app,
                          ];
               $loginResponse=  $this->user->userLogin($loginData);
               
                $logReq = json_decode($loginResponse);
                if($logReq->code==SUCCESS_CODE)
                {
                        $userInfo = $logReq->user_details;
                        $userId= $userInfo->user_id;
                        $username = $userInfo->user_name;
                        $email =$userInfo->email;
                        $mobile = $userInfo->mobile;
                        $profile_status= $userInfo->profile_status;
                        if($profile_status == 1)
                        {
                            $response[CODE]=SUCCESS_CODE;
                            $response[MESSAGE]='Login Success';
                            $response[DESCRIPTION]='Login success. Please wait..';
                            
                            if($app!='app')
                            {
                                $loginSessionData=[
                                                    USER_SESS_CODE.'userid'=>$userId,
                                                    USER_SESS_CODE.'username'=>$username,
                                                    USER_SESS_CODE.'useremail'=>$email,
                                                    USER_SESS_CODE.'usermobile'=>$mobile,
                                                    'user_login_status'=>1,
                                                  ];
                                $this->session->set_userdata($loginSessionData);
                                $response['redirection_link']=base_url().'profile';                  
                                /*if($cururl == base_url().'reservation') {
                                    $response['redirection_link']=base_url().'reservation';                  
                                } */     
                               // $response['redirection_link']=$cururl;
                                
                            }
                            else
                            {
                                $response['user_details']=$userInfo;
                                $response['redirection_link']=base_url();
                            }
                            
                        }
                        else
                        {
                            $status_msg='';
                            switch($profile_status)
                            {
                                case 0 :$status_msg='Your account blocked';break;
                                case 2 :$status_msg='Account de-activated';break;
                                case 3 :$status_msg='Please verify the email to activate account';break;
                                case 4 :$status_msg='Account under forgot password state.Please check the mail and reset the password';break;
                            }
                            
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'FAIL';
                            $response[DESCRIPTION] =$status_msg;
                            $response['user_details']=(object)(null);
                        }
                }   
                else
                {
                    //Login fail condition
                    echo $loginResponse;exit;   
                } 
            }
        }
        echo json_encode($response);
    }

    public function userForgotReq()
    {
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
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            
            /*Validatio Section */
            if ($username == '') {$error_message.='* enter email / mobile number ,'; $error = 1;}
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
                   'username'=>$username,
               ];
               $forgotReq=  $this->user->forgotPasswordReq($reqData);
               $forgotRes = json_decode($forgotReq);
               if($forgotRes->code!=SUCCESS_CODE)
               {
                    echo $forgotReq;exit;
               }
               elseif($forgotRes->code==SUCCESS_CODE)
               {
                        $userRes = $forgotRes->user_details;
                        $userName = $userRes->username;
                        $userEmail = $userRes->email;
                        $userMobile = $userRes->mobile;
                        $email_verification = base64_encode($forgotRes->verification_code);
                        $emailData=[
                            'name'=>$userName,
                            'email'=>$userEmail,
                            'mobile'=>$userMobile,
                            'title'=>$userName,
                            'verification_link'=>base_url() . 'user-forgotverification/' . $email_verification,
                        ];
                        $sendEmail = $this->sendmail->sendEmail(
                            array(
                                'to' => array($userEmail),
                                'bcc' => array(BCC_EMAIL),
                                'subject' => 'User Forgot password- verification mail',
                                'data' => array('user_details' =>$emailData),
                                'template' =>'email_templates/user_forgot_template',
                            )
                        );
                    $sendEmail=1;
                    $response[CODE]=SUCCESS_CODE;
                    $response[MESSAGE]='Success';
                    $response[DESCRIPTION]='Verification code sent to '.$userEmail.' Please check the email';              
                }               
            }
        }
        echo json_encode($response);
    }

    //Reset password
    public function setForgotPassword()
    {
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
            $verificationcode = (isset($req_response->verificationcode)) ? input_data($req_response->verificationcode) : '';
            $password = (isset($req_response->password)) ? input_data($req_response->password) : '';
            
            
            /*Validatio Section */
            if ($verificationcode == '') {$error_message.='* verification code is missing ,'; $error = 1;}
            if ($password == '') {$error_message.='* password is missing ,'; $error = 1;}
            if ($password != '' && strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
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
               $verification_code=  base64_decode($verificationcode);
               $reqData=[
                   'verification_code'=>$verification_code,
                   'password'=>$password,
               ];
               $verificationResponse=  $this->user->setUserForgotPassword($reqData);
               echo $verificationResponse;exit;
               
            }
        }
        echo json_encode($response);
    }

    public function changePassword()
    {
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
            $password = (isset($req_response->current_password)) ? input_data($req_response->current_password) : '';
            $old_password = (isset($req_response->old_password)) ? input_data($req_response->old_password) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($password == '') {$error_message.='* password is missing ,'; $error = 1;}
            if ($old_password == '') {$error_message.='* old password is missing ,'; $error = 1;}
            if ($old_password == $password) {$error_message.='* old password should not same as new password ,'; $error = 1;}
            if ($password != '' && strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
            if ($old_password != '' && strlen($old_password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
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
                   'userid'=>$userid,
                   'password'=>$password,
                   'old_password'=>$old_password,
               ];
               $changePasswordResponse=  $this->user->updatePassword($reqData);
               echo $changePasswordResponse;exit;
            }
        }
        echo json_encode($response);
    }
     //profile Details
    public function profileDetails()
    {
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
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            
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
                            'userid'=>$userid,
                        ];
               $userData=  $this->user->profileDetails($reqData);
               echo $userData;exit;
               
            }
        }
        echo json_encode($response);
    }

    //User profile - update
    public function updateProfile()
    {
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
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $mobile = (isset($req_response->usermobile)) ? input_data($req_response->usermobile) : '';
            $address = (isset($req_response->address)) ? input_data($req_response->address) : '';
            $landmark    = (isset($req_response->landmark)) ? input_data($req_response->landmark) : '';
            $area = (isset($req_response->area)) ? input_data($req_response->area) : '';
            $city = (isset($req_response->city)) ? input_data($req_response->city) : '';
            $state = (isset($req_response->state)) ? input_data($req_response->state) : '';
            $country = (isset($req_response->country)) ? input_data($req_response->country) : 'India';
            $pincode = (isset($req_response->pincode)) ? input_data($req_response->pincode) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            if ($mobile == '') {$error_message.='mobile number is missing ,'; $error = 1;}
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            //if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if ($city=='') {$error_message.='city is missing ,'; $error = 1;}
            if ($state=='') {$error_message.='state is missing ,'; $error = 1;}
            if ($country=='') {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            
            if($pincode!='' && !pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
            if($mobile!='' && !mobile_check($mobile)){$error_message.='invalid mobile number ,'; $error = 1;}
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
                            'userid'=>$userid,
                            'username'=>$username,
                            'address'=>$address,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                            'mobile_number'=>$mobile,
                        ];
               $userData=  $this->user->updateProfile($reqData);
               echo $userData;exit;
               
            }
        }
        echo json_encode($response);
    }

    /*
    | Address Module Section Code
    |
    */

    public function createaddress()
    {
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
            $userid = (isset($req_response->a_userid)) ? input_data($req_response->a_userid) : '';
            $username = (isset($req_response->a_username)) ? input_data($req_response->a_username) : '';
            $mobile = (isset($req_response->a_mobile)) ? input_data($req_response->a_mobile) : '';
            $address = (isset($req_response->a_address)) ? input_data($req_response->a_address) : '';
            $landmark    = (isset($req_response->a_landmark)) ? input_data($req_response->a_landmark) : '';
            $area = (isset($req_response->a_area)) ? input_data($req_response->a_area) : '';
            $city = (isset($req_response->a_city)) ? input_data($req_response->a_city) : '';
            $state = (isset($req_response->a_state)) ? input_data($req_response->a_state) : '';
            $country = (isset($req_response->a_country)) ? input_data($req_response->a_country) : '';
            $pincode = (isset($req_response->a_pincode)) ? input_data($req_response->a_pincode) : '';
            $address_title = (isset($req_response->a_addresstype)) ? input_data($req_response->a_addresstype) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            if ($mobile == '') {$error_message.='mobile is missing ,'; $error = 1;}
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            // if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if (!number_check($city)) {$error_message.='city is missing ,'; $error = 1;}
            if (!number_check($state)) {$error_message.='state is missing ,'; $error = 1;}
            if (!number_check($country)) {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            if ($address_title == '') {$error_message.='address type is missing ,'; $error = 1;}
            if(!mobile_check($mobile)){$error_message.='invalid mobile number ,'; $error = 1;}
            if(!pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
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
                            'userid'=>$userid,
                            'username'=>$username,
                            'mobile'=>$mobile,
                            'address'=>$address,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                            'address_title'=>$address_title
                        ];
               $userData=  $this->user->createNewAddress($reqData);
               echo $userData;exit;
               
            }
        }
        echo json_encode($response);
    }

    //address list 
    public function userAddressList()
    {
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
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            
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
                            'userid'=>$userid,
                        ];
               $addressData=  $this->user->addressBookList($reqData);
               echo $addressData;exit;
               
            }
        }
        echo json_encode($response);
    }

    public function addressDetails()
    {
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
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $addressid = (isset($req_response->addressid)) ? input_data($req_response->addressid) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($addressid == '') {$error_message.='* address id is missing ,'; $error = 1;}
            
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
                            'userid'=>$userid,
                            'addressid'=>$addressid,
                        ];
               $addressData=  $this->user->addressDetails($reqData);
               echo $addressData;exit;
               
            }
        }
        echo json_encode($response);
    }


    // update address 
    public function updateAddress()
    {
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
            $userid = (isset($req_response->e_userid)) ? input_data($req_response->e_userid) : '';
            $addressid = (isset($req_response->e_addressid)) ? input_data($req_response->e_addressid) : '';
            $username = (isset($req_response->e_username)) ? input_data($req_response->e_username) : '';
            $mobile = (isset($req_response->e_mobile)) ? input_data($req_response->e_mobile) : '';
            $address = (isset($req_response->e_address)) ? input_data($req_response->e_address) : '';
            $addresstype = (isset($req_response->e_addresstype)) ? input_data($req_response->e_addresstype) : '';
            
            $landmark    = (isset($req_response->e_landmark)) ? input_data($req_response->e_landmark) : '';
            $area = (isset($req_response->e_area)) ? input_data($req_response->e_area) : '';
            $city = (isset($req_response->e_city)) ? input_data($req_response->e_city) : '';
            $state = (isset($req_response->e_state)) ? input_data($req_response->e_state) : '';
            $country = (isset($req_response->e_country)) ? input_data($req_response->e_country) : '';
            $pincode = (isset($req_response->e_pincode)) ? input_data($req_response->e_pincode) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($addressid == '') {$error_message.='address id is missing ,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            if ($mobile == '') {$error_message.='mobile is missing ,'; $error = 1;}
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            if ($addresstype == '') {$error_message.='address title is missing ,'; $error = 1;}
            // if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if ($city == '') {$error_message.='city is missing ,'; $error = 1;}
            if ($state == '') {$error_message.='state is missing ,'; $error = 1;}
            if ($country == '') {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            if(!mobile_check($mobile)){$error_message.='invalid mobile number ,'; $error = 1;}
            if(!pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
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
                            'userid'=>$userid,
                            'addressid'=>$addressid,
                            'username'=>$username,
                            'mobile'=>$mobile,
                            'address'=>$address,
                            'address_title'=>$addresstype,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                        ];
               $updateAddresResoponse=  $this->user->updateAddress($reqData);
               echo $updateAddresResoponse;exit;
               
            }
        }
        echo json_encode($response);
    }
    // Delete address 
    public function deleteAddress()
    {
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
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $addressid = (isset($req_response->addressid)) ? input_data($req_response->addressid) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($addressid == '') {$error_message.='* address id is missing ,'; $error = 1;}
            
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
                            'userid'=>$userid,
                            'addressid'=>$addressid,
                        ];
               $deleteAddress=  $this->user->deleteUserAddress($reqData);
               echo $deleteAddress;exit;
               
            }
        }
        echo json_encode($response);
    }
    /*
    | Address Module Section Code End
    |
    */

    public function getProfileDetails($userid)
    {
        $reqData=[
            'userid'=>$userid,
        ];
        $userData=  $this->user->profileDetails($reqData);
        echo $userData;exit;
    }


    public  function userAccountVerification()
    {
        
        $verificationcode = $this->uri->segment(2);
        if($verificationcode!='')
        {
            $vendorcode = base64_decode($verificationcode);
            $reqData=[
                   'verification_code'=>$vendorcode,
               ];
            $res =  $this->user->newUserAccountVerification($reqData);
            $data= json_decode($res);
            $this->session->set_flashdata('vendor_verification_msg',$data);    
        }
        redirect(base_url());
    }


    public function ordercancel()
    {
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
         //   print_r($req_response);exit;
            $userid =$this->userid;
            $orderid = (isset($req_response->orderid)) ? input_data($req_response->orderid) : '';
            $order_module = (isset($req_response->order_module)) ? input_data($req_response->order_module) : '';
            $cancel_reason = (isset($req_response->cancel_reason)) ? input_data($req_response->cancel_reason) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($orderid == '') {$error_message.='* order id is missing ,'; $error = 1;}
            if ($order_module == '') {$error_message.='* invalid income details,'; $error = 1;}
            if ($cancel_reason == '') {$error_message.='* Cancellation reason is missing ,'; $error = 1;}
            
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
              if($order_module=='venue')
              {
                  $cancelData=[
                      'order_status'=>3,
                      'cancellation_reason'=>$cancel_reason,
                      'cancelled_on'=>DATE,
                      'cancelled_by'=>'user',
                  ];
                  $cancelWhere=['order_id'=>$orderid,'order_status'=>0];
                  $cancelVenueorder = $this->db->update_string('functionhall_order',$cancelData,$cancelWhere);
                  $cancelVenue = $this->db->query($cancelVenueorder);
                  $cancelStatus = $this->db->affected_rows();
                  $response[CODE] = ($cancelStatus > 0)?SUCCESS_CODE:FAIL_CODE;
                  $response[MESSAGE] = ($cancelStatus > 0)?'success':'fail';
                  $response[DESCRIPTION] =($cancelStatus > 0)?'Booking cancelled successfully. Amount will refunded 4-6 days in business days':'Not able to cancel the order';
              }
              if($order_module=='catering')
              {
                  $cancelData=[
                      'order_status'=>3,
                      'cancellation_reason'=>$cancel_reason,
                      'cancelled_on'=>DATE,
                      'cancelled_by'=>'user',
                  ];
                  $cancelWhere=['order_id'=>$orderid,'order_status'=>0];
                  $cancelVenueorder = $this->db->update_string('catering_order',$cancelData,$cancelWhere);
                  $cancelVenue = $this->db->query($cancelVenueorder);
                  $cancelStatus = $this->db->affected_rows();
                  $response[CODE] = ($cancelStatus > 0)?SUCCESS_CODE:FAIL_CODE;
                  $response[MESSAGE] = ($cancelStatus > 0)?'success':'fail';
                  $response[DESCRIPTION] =($cancelStatus > 0)?'Booking cancelled successfully. Amount will refunded 4-6 days in business days':'Not able to cancel the order';
              } 
            }
        }
        echo json_encode($response);
    }

    public function getaddressdetails($id)
    {
        $reqData=[
            'userid'=>$this->userid,
            'addressid'=>$id,
        ];
        //print_r($reqData);exit;
        $addressData=  $this->user->addressDetails($reqData);
        echo $addressData;exit;
    }

    // Set as default address
    public function shippingdefaultaddress()
    {
        $response=[];
        $error=0;$error_msg='';
        $address_id = $this->input->post('address_id');
        if(!number_check($address_id)){$error=1;$error_msg.='Address id is missing,';}
        if($this->userid==''){$error=1;$error_msg.='user id is missing';}
        if($error==1)
        {
            $response[CODE] =VALIDATION_CODE;
            $response[MESSAGE] ='validation';
            $response[DESCRIPTION] =$error_msg;
        }
        else
        {
            $params=[];
            $params['addressid']=$address_id;
            $params['userid']=$this->userid;
            $update=$this->user->makeShippingDefaultAddress($params);
            echo $update;exit;
        }
        echo json_encode($response);
    }

    public function orderRating()
    {
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
            $req = json_decode($req_input);
            $orderid = $req->rating_orderid;
            $module = $req->rating_order_module;
            $rating = $req->order_rating;
            $review = $req->order_rating_desc;

            $error=0;$error_msg='';
            if(!number_check($orderid)){$error=1;$error_message.='Order id is missing,';}
            if(!number_check($rating)){$error=1;$error_message.='rating is missing,';}
            if($review==''){$error=1;$error_message.='user review is missing,';}
            if($module==''){$error=1;$error_message.='module is missing,';}
            if($error==1)
            {
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation';
                $response[DESCRIPTION]=rtrim(',',$error_message);
            }
            else
            {
                if($module=='venue')
                {
                    $venueRatingParams=[
                        'rating'=>$rating,
                        'review'=>$review,
                        'orderid'=>$orderid,
                        'userid'=>$this->userid,
                    ];    
                    $venueRating=$this->user->functionhallRating($venueRatingParams);
                    echo $venueRating;exit;
                }
                else if($module=='catering')
                {
                    $cateringRatingParams=[
                        'rating'=>$rating,
                        'review'=>$review,
                        'orderid'=>$orderid,
                        'userid'=>$this->userid,
                    ];   
                    $cateringRating=$this->user->cateringRating($cateringRatingParams);
                    echo $cateringRating;exit; 
                }
            }
        }
        echo json_encode($response);
    }

}