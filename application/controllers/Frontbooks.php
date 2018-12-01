<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Frontbooks extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['Master_model' => 'master', 'Filter_model' => 'books']);
        $this->data = [];
        $this->data['header_menu'] = $this->master->allMenuList();
    }

    public function menurelatedBooks($title, $id) {

        $this->data['url_title'] = PROJECT_NAME . ' :: ' . $title;
        $this->data['menu'] = $title;
        $param = [];
        $param['category'] = 'menu';
        $param['categrory_id'] = base64_decode($id);
        $this->data['book_details'] = $this->books->productList($param);
        $this->load->view('products/products_list', $this->data);
    }

    public function submenurelatedBooks($title, $id) {

        $this->data['url_title'] = PROJECT_NAME . ' :: ' . $title;
        $this->data['menu'] = $title;
        $param = [];
        $param['category'] = 'submenu';
        $param['categrory_id'] = base64_decode($id);
        $this->data['book_details'] = $this->books->productList($param);
        $this->load->view('products/products_list', $this->data);
    }

    public function bookdetails($title, $id) {

        $this->data['url_title'] = PROJECT_NAME . '-' . $title;
        $this->data['title'] = $title;

        $param = [];
        $param['productid'] = base64_decode($id);
        $this->data['book_details'] = $this->books->productDetails($param);
        $this->load->view('products/description', $this->data);
    }

     public function searchbooks($title) {

        $this->data['url_title'] = PROJECT_NAME . ' :: ' . $title;
        $this->data['menu'] = $title;
        $param = [];
        $param['title']=$title;
        $this->data['book_details'] = $this->books->searchProductList($param);
        $this->load->view('products/products_list', $this->data);
    }

}
