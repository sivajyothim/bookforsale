<?php
defined ('BASEPATH') or die('Some thing error occured');

class User extends CI_Controller
{
        public $userid,$userfoleder;
        public function __construct()
        {
            parent::__construct();
            isUserLogin();
            $this->userid= $this->session->userdata(USER_SESS_CODE.'userid');
            $this->userfoleder='user/';
            $this->booksfolder='books/';
            $this->load->model(['Master_model'=>'master','Filter_model'=>'books','Cart_model'=>'cart']);
            $this->data=[];
            $this->data['header_menu']=$this->master->allMenuList();
            $this->cartsession=$this->session->userdata('cartsession');
        }

        public function logout(Type $var = null)
        {
            $this->session->sess_destroy();
            redirect(base_url());
        }

        public function index()
        {
            $this->data['url_title']=PROJECT_NAME.' :: Profile';
		    $this->load->view($this->userfoleder.'profile',$this->data);
        }

       

        public function changepassword()
        {
            $this->data['url_title']=PROJECT_NAME.' :: Change password';
		    $this->load->view($this->userfoleder.'changepassword',$this->data);
        }

        public function addnewbook()
        {
            $this->data['url_title']=PROJECT_NAME.' :: Create Book';
            $this->data['menu_details']=$this->master->common('menu');
            $this->data['region_details']=$this->master->common('region');
            $this->data['language_details']=$this->master->common('language');
            
		    $this->load->view($this->booksfolder.'create_book',$this->data);
        }

        public function manageBooks()
        {
            $param=[];
            $param['status']='';
            $param['userid']=$this->userid;
            $this->data['book_details']=$this->master->bookList($param);
            $this->data['url_title']=PROJECT_NAME.' :: Manage Books';
		    $this->load->view($this->booksfolder.'manage_books',$this->data);
        }

        public function subgrouplist($menuid)
        {
            if(!number_check($menuid))
            {
                $response=[];
                $response[CODE] =VALIDATION_CODE;
                $response[MESSAGE] ='validation';
                $response[DESCRIPTION] ='Country id is missing';
                echo json_encode($response);
            }
            else
            {
                $result =  $this->crud->singleTableData(
                                                            [
                                                                'table'=>'subgroups',
                                                                'cols'=>'*',
                                                                'order_by'=>['column'=>'subgroup_title','sort'=>'ASC'],
                                                                'response_param'=>'subgrop_result',
                                                                'description_message'=>'Getting subgroup List',
                                                                'debug'=>FALSE,
                                                                'where_condition'=>['flag_status'=>1,'menu_id'=>$menuid],
                                                            ]
                                                        );
                echo $result;exit;
            }
        }

        public function editBook()
        {
            $this->data['url_title']=PROJECT_NAME.' :: Edit Book';
            $this->data['menu_details']=$this->master->common('menu');
            $this->data['region_details']=$this->master->common('region');
            $this->data['language_details']=$this->master->common('language');
            $param=[];
            $this->data['bookid']=$this->uri->segment(3);
            $this->data['book_title']=$this->uri->segment(2);
            $this->load->view($this->booksfolder.'edit_book',$this->data);
        }
}