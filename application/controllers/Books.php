<?php
defined ('BASEPATH') or die('Some thing error occured');

class Books extends CI_Controller
{
        public $userid,$userfoleder;
        public function __construct()
        {
            parent::__construct();
            $this->load->model(['Books_model'=>'books']);
            $this->load->model(['Master_model'=>'master','Filter_model'=>'books','Cart_model'=>'cart']);
            $this->data=[];
            $this->data['header_menu']=$this->master->allMenuList();
            $this->cartsession=$this->session->userdata('cartsession');
            $this->userid= $this->session->userdata(USER_SESS_CODE.'userid');
            $this->booksfolder='books/';
        }

        public function insertBook()
        {
                $response=[];
                $menu = $this->input->post('menu');
                $region = $this->input->post('region');
                $region_name = $this->input->post('region_name');
                $title = $this->input->post('title');
                $published_year = $this->input->post('published_year');
                $age = $this->input->post('age');
                $language = $this->input->post('language');
                $mrp = $this->input->post('mrp');
                $selling_price = $this->input->post('selling_price');
                $stock = $this->input->post('stock');
                $length = $this->input->post('length');
                $width = $this->input->post('width');
                $height = $this->input->post('height');
                $book_weight = $this->input->post('book_weight');
                $description = $this->input->post('description');
                $book_image = $this->input->post('book_image');
                $author = $this->input->post('author');
                $subgroup = $this->input->post('subgroup');
                $courseyear = $this->input->post('courseyear');
            
                $allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
                $pic = $_FILES["book_image"]["name"];
                $error=0;$error_msg='';
                if($title == ''){$error=1;$error_msg.='title is missing,';}
            
                
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
                                                'menu_id'=>$menu,
                                                'region_id'=>$region,
                                                'book_title'=>$title,
                                                'published_year'=>$published_year,
                                                'book_age'=>$age,
                                                'region_name'=>$region_name,
                                                'author_name'=>$author,
                                                'language'=>$language,
                                                'book_weight'=>$book_weight,
                                                'dimension_height'=>$height,
                                                'dimension_width'=>$width,
                                                'dimension_length'=>$length,
                                                'mrp'=>$mrp,
                                                'selling_price'=>$selling_price,
                                                'stock'=>$stock,
                                                'description'=>$description,
                                                 'created_by'=>$this->userid,
                                                'user_id'=>$this->userid,
                                                'sub_group_id'=>$subgroup,
                                                'course_year'=>$courseyear,
                                            ];
                        if($pic!='')
                        {
                            $extension = @end(explode(".", $_FILES["book_image"]["name"]));
                            $profile_pic = sha1(time().mt_rand(0000,99999)).'.'.$extension;
                            move_uploaded_file($_FILES["book_image"]["tmp_name"],"uploads/products/". $profile_pic); 
                            $insertData['book_image']=$profile_pic;
                        }      
                        $insert = $this->books->insertBook($insertData);
                        echo $insert;exit;

                }
                echo json_encode($response);
        }

        public function deletebook($bookid)
        {
            if(number_check($bookid))
            {
                $updateWhere=['user_id'=>$this->userid,'book_id'=>$bookid];
                $this->db->update('books',['book_status'=>2],$updateWhere);
            
            }
            redirect(base_url().'managebooks');
        }


      
            public function booksstatuschange() 
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
                        case 'books':/* Books */
                    $table = 'books';
                    $setcols = 'book_status';
                    $condition = "book_id IN  (" . $input_data . ")";
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
}