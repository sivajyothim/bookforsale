<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Books extends CI_controller
{
    public $settingsfolder,$data,$adminid;
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('SettingsModel'=>'settings','BooksModel'=>'books'));
        $this->booksfolder='books/';
        $this->adminId=  $this->session->userdata(ADMIN_SESS_CODE.'adminid');
        $this->data=array();
        isAdminLogin();
     }
     
     public function index($param=NULL) {
             $this->data['main_title']='Books List';
             $this->data['url_title']='Books List';
             $param=[];
             $this->data['books_details']=$this->books->bookList($param);
             $this->load->view($this->booksfolder.'manage_books',$this->data);
     }
}