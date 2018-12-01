<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_controller
{
    public $settingsfolder,$data,$adminid;
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('SettingsModel'=>'settings'));
        $this->settingsfolder='foodsettings/';
        $this->adminId=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');
        $this->data=array();
        isAdminLogin();
     }

     
     public function menulist()
     {
             
             $this->data['main_title']='Menu';
             $this->data['url_title']='Menu';
             $param=[];
             $this->data['menu_details']=$this->settings->menuList($param);
             $this->load->view('menu/manage_menu',$this->data);
     }  

     public function createmenu()
     {
             
             $this->data['main_title']='Create Menu';
             $this->data['url_title']='Create menu';
             $param=[];
             $param['status']=1;
             $this->load->view('menu/create_menu',$this->data);
     } 
    

     public function insertMenu()
     {
           //  print_r($_POST);exit;
        $response=[];
        $title = $this->input->post('title');
       
        $allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
        $pic = $_FILES["upload_file"]["name"];
        $error=0;$error_msg='';
        if($title == ''){$error=1;$error_msg.='menu name is missing,';}
       
         
       // if($pic == '' ){$$error=1;$error_msg.='menu image is missing,';}
        if($error===1)
        {
                $response[CODE]=301;
                $response[MESSAGE]='validation';
                $response[DESCRIPTION]=$error_msg;
                
        }
        else
        {
                        $insertData=[
                                        'menu_title'=>$title,
                                    ];
                if($pic!='')
                {
                    $extension = @end(explode(".", $_FILES["upload_file"]["name"]));
                    $profile_pic = sha1(time().mt_rand(0000,99999)).'.'.$extension;
                    move_uploaded_file($_FILES["upload_file"]["tmp_name"],"uploads/menus/". $profile_pic); 
                    $insertData['menu_picture']=$profile_pic;
                }      
                $insert = $this->settings->insertMenu($insertData);
                echo $insert;exit;

        }
        echo json_encode($response);
     }

     /* >> Slider section code start */

     public function sliders()
     {
             
             $this->data['main_title']='Sliders';
             $this->data['url_title']='Sliders';
             $param=[];
             $this->data['slider_details']=$this->settings->sliderList($param);
             $this->load->view('slider/manage_slider',$this->data);
     }  

     public function createslider()
     {
             
             $this->data['main_title']='Create Slider';
             $this->data['url_title']='Create Slider';
             $param=[];
             
             $this->load->view('slider/create_slider',$this->data);
     } 
    

     public function insertSlider()
     {
           //  print_r($_POST);exit;
        $response=[];
        $title = $this->input->post('title');
        $sliderlink = $this->input->post('sliderlink');
        $allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
        $pic = $_FILES["upload_file"]["name"];
        $error=0;$error_msg='';
        if($title == ''){$error=1;$error_msg.='Slider name is missing,';}
       
         
                 if($pic == '' ){$error=1;$error_msg.='Slider is missing,';}
        if($error===1)
        {
                $response[CODE]=301;
                $response[MESSAGE]='validation';
                $response[DESCRIPTION]=$error_msg;
                
        }
        else
        {
                        $insertData=[
                                        'slider_title'=>$title,
                                        'slider_link'=>$sliderlink,
                                    ];
                if($pic!='')
                {
                    $extension = @end(explode(".", $_FILES["upload_file"]["name"]));
                    $profile_pic = sha1(time().mt_rand(0000,99999)).'.'.$extension;
                    move_uploaded_file($_FILES["upload_file"]["tmp_name"],"uploads/sliders/". $profile_pic); 
                    $insertData['slider_picture']=$profile_pic;
                }      
                $insert = $this->settings->insertSlider($insertData);
                echo $insert;exit;

        }
        echo json_encode($response);
     }

     /*<< Slider Section module end Here */


     /*>> Submenu module sectin code statr */
     public function submenu()
     {
             
             $this->data['main_title']='Sub-Menu';
             $this->data['url_title']='Sub-Menu';
             $param=[];
             $this->data['submenu_details']=$this->settings->subNenuList($param);
             $this->load->view('submenu/manage_submenu',$this->data);
     }  

     public function createsubmenu()
     {
             
             $this->data['main_title']='Create submenu';
             $this->data['url_title']='Create submenu';
             $param=[];
             $param['status']=1;
             $this->load->view('submenu/create_submenu',$this->data);
     } 
    

     public function insertsubmenu()
     {
           //  print_r($_POST);exit;
        $response=[];
        $title = $this->input->post('title');
       
        $allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
        $pic = $_FILES["upload_file"]["name"];
        $error=0;$error_msg='';
        if($title == ''){$error=1;$error_msg.='submenu name is missing,';}
       
         
       // if($pic == '' ){$$error=1;$error_msg.='menu image is missing,';}
        if($error===1)
        {
                $response[CODE]=301;
                $response[MESSAGE]='validation';
                $response[DESCRIPTION]=$error_msg;
                
        }
        else
        {
                        $insertData=[
                                        'submenu_title'=>$title,
                                    ];
                if($pic!='')
                {
                    $extension = @end(explode(".", $_FILES["upload_file"]["name"]));
                    $profile_pic = sha1(time().mt_rand(0000,99999)).'.'.$extension;
                    move_uploaded_file($_FILES["upload_file"]["tmp_name"],"uploads/submenus/". $profile_pic); 
                    $insertData['menu_picture']=$profile_pic;
                }      
                $insert = $this->settings->insertSubMenu($insertData);
                echo $insert;exit;

        }
        echo json_encode($response);
     }
     /*>> Submenu module sectioin code end  */

      /*>> Weight  sectin code statr */
      public function weight()
      {
              
              $this->data['main_title']='Manage Weight';
              $this->data['url_title']='Manage Weight';
              $param=[];
              $this->data['weight_details']=$this->settings->weightList($param);
              $this->load->view('weights/manage_weight',$this->data);
      }  
 
      public function createweight()
      {
              
              $this->data['main_title']='Create weight';
              $this->data['url_title']='Create weight';
              $param=[];
              $param['status']=1;
              $this->load->view('weights/create_weight',$this->data);
      } 
     
 
      public function insertweight()
      {
            //  print_r($_POST);exit;
         $response=[];
         $title = $this->input->post('title');
         $price = $this->input->post('price');
         $error=0;$error_msg='';
         if(!number_check($title)){$error=1;$error_msg.='weight is missing,';}
         if(!number_check($price)){$error=1;$error_msg.='price is missing,';}
        
         if($error===1)
         {
                 $response[CODE]=301;
                 $response[MESSAGE]='validation';
                 $response[DESCRIPTION]=$error_msg;
                 
         }
         else
         {
                         $insertData=[
                                         'weight'=>$title,
                                         'price'=>$price,
                                     ];
                 
                 $insert = $this->settings->insertWeight($insertData);
                 echo $insert;exit;
 
         }
         echo json_encode($response);
      }
      /*>> Weight module sectioin code end  */

       /*>> Sub-group module sectin code statr */
     public function subgroup()
     {
             
             $this->data['main_title']='Sub-Group';
             $this->data['url_title']='Sub-Group';
             $param=[];
             $this->data['submenu_details']=$this->settings->subGroupList($param);
             $this->load->view('subgroup/manage_submenu',$this->data);
     }  

     public function createsubgroup()
     {
             
             $this->data['main_title']='Create Sub-group';
             $this->data['url_title']='Create Sub-group';
             $param=[];
             $param['status']=1;
             $this->data['menu_details']=$this->settings->menuList($param);
             $this->load->view('subgroup/create_submenu',$this->data);
     } 
    

     public function insertsubgroup()
     {
           //  print_r($_POST);exit;
        $response=[];
        $title = $this->input->post('title');
        $menu = $this->input->post('menu');
        $years = $this->input->post('years');

        $allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
        $pic = $_FILES["upload_file"]["name"];
        $error=0;$error_msg='';
        if($title == ''){$error=1;$error_msg.='subgroup name is missing,';}
        if(!is_numeric($years)){$error=1;$error_msg.='year allows number only,';}
        if(!number_check($menu)){$error=1;$error_msg.='select the menu,';}
       // if($pic == '' ){$$error=1;$error_msg.='menu image is missing,';}
        if($error===1)
        {
                $response[CODE]=301;
                $response[MESSAGE]='validation';
                $response[DESCRIPTION]=$error_msg;
                
        }
        else
        {
                        $insertData=[
                                        'subgroup_title'=>$title,
                                        'menu_id'=>$menu,
                                        'years'=>$years,
                                    ];
                if($pic!='')
                {
                    $extension = @end(explode(".", $_FILES["upload_file"]["name"]));
                    $profile_pic = sha1(time().mt_rand(0000,99999)).'.'.$extension;
                    move_uploaded_file($_FILES["upload_file"]["tmp_name"],"uploads/submenus/". $profile_pic); 
                    $insertData['icon']=$profile_pic;
                }      
                $insert = $this->settings->insertSubGroup($insertData);
                echo $insert;exit;

        }
        echo json_encode($response);
     }
     /*>> Sub-group module sectioin code end  */
     
}