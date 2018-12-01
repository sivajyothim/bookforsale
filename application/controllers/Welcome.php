<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Master_model'=>'master','Filter_model'=>'books']);
		$this->data=[];
		$this->data['header_menu']=$this->master->allMenuList();
   	}
	public function index()
	{
		$this->data['url_title']=PROJECT_NAME.' :: Homepage';
		$this->data['slider_details']=$this->master->sliderList();
		$this->data['book_details']=$this->books->homeBookList();
		$this->load->view('home',$this->data);
	}

	public function signup()
	{
		$this->data['url_title']=PROJECT_NAME.' :: Signup';

		$this->load->view('signup',$this->data);
	}

	


}
