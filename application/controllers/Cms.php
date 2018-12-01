<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Master_model'=>'master','Filter_model'=>'books','Cart_model'=>'cart','Order_model'=>'order']);
		$this->data=[];
                $this->data['header_menu']=$this->master->allMenuList();
                $this->cartsession=$this->session->userdata('cartsession');
                 $this->userid= $this->session->userdata(USER_SESS_CODE.'userid');
    }

    public function contactus()
    {

        $this->data['url_title']=PROJECT_NAME.' - Contact us ';
        $param=[];
        $this->load->view('cms/contactus',$this->data);
    }

		public function requestbook()
		{

				$this->data['url_title']=PROJECT_NAME.' - Request  a book ';
				$param=[];
				$this->load->view('cms/bookrequest',$this->data);
		}


		public function aboutus()
    {

        $this->data['url_title']=PROJECT_NAME.' - About us ';
        $param=[];
				$this->data['main_title']='About us';
        $this->load->view('cms/aboutus',$this->data);
    }

		public function terms()
		{

				$this->data['url_title']=PROJECT_NAME.' - Terms & condition ';
				$param=[];
				$this->data['main_title']='Terms & condition';
				$this->load->view('cms/terms',$this->data);
		}

		public function privacy()
		{

				$this->data['url_title']=PROJECT_NAME.' - Privacy Policy ';
				$param=[];
				$this->data['main_title']='Privacy Policy';
				$this->load->view('cms/privacy',$this->data);
		}

		public function insertContactRequest()
		{

			$response = array();
			$error_message = ''; $error=0;
			$req_input = file_get_contents('php://input');
			$req_response = json_decode($req_input);
			$username = (isset($req_response->username)) ? input_data($req_response->username) : '';
			$useremail = (isset($req_response->useremail)) ? $req_response->useremail : '';
			$phonenumber = (isset($req_response->usermobile)) ? $req_response->usermobile : '';
			$subject = (isset($req_response->subject)) ? trim($req_response->subject) : '';
		  $description = (isset($req_response->description)) ? trim($req_response->description) : '';
			if ($username == '') {$error_message.='* Username is missing ,'; $error = 1;}
			if (!email_check($useremail)) { $error_message .= '* invalid email ,';$error = 1;}
			if (!mobile_check($phonenumber)) {$error_message .= '* invalid mobile ,';$error = 1;}
			/*Validation Section ends here*/
			if($error==1)
			{
					$response[CODE] = VALIDATION_CODE;
					$response[MESSAGE] = 'Validation';
					$response[DESCRIPTION] =rtrim($error_message,',');
			}
			else
			{
				/*>>Insert contact request code start */
				$insertCols = [
					'username'=>$username,
					'emailid'=>$useremail,
					'phone_number'=>$phonenumber,
					'subject'=>$subject,
					'description'=>$description
				];
				$insertSql = $this->db->insert_string('contactus',$insertCols);
				$insertQuery = $this->db->query($insertSql);
				/*>>Insert contact request code end */
				$message='';
			 $to = 'achariphp@gmail.com';
			 $subject = "Contact request on ".date('d-M-Y');
			 $htmlContent = '
			 <html>
			 <head>
					 <title>Welcome to Books for sale</title>
			 </head>
			 <body>
					 <h1>Thanks you for requesting with us & Request details are</h1>
					 <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
							 <tr>
									 <th>User Name:</th><td>'.$username.'</td>
							 </tr>
							 <tr>
									 <th>User Email:</th><td>'.$useremail.'</td>
							 </tr>
							 <tr>
									 <th>Phone Number:</th><td>'.$phonenumber.'</td>
							 </tr>
							 <tr>
							 <th>Subject:</th><td>'.$subject.'</td>
							 </tr>
							 <tr>
									 <th>Description:</th><td>'.$description.'</td>
							 </tr>

					 </table>
			 </body>
			 </html>';

				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 $headers .= 'From: broadenblue<info@broadenblue.com>' . "\r\n";
				 $headers .= 'Bcc: achariphp@gmail.com' . "\r\n";
				 $mail=@mail($to,$subject,$htmlContent,$headers);
				 $response[CODE] = SUCCESS_CODE;
				 $response[MESSAGE] = 'successs';
				 $response[DESCRIPTION] ='Request has been sent successfully.';

			}
			echo json_encode($response);
		}


		public function insertBookRequest()
		{

			$response = array();
			$error_message = ''; $error=0;
			$req_input = file_get_contents('php://input');
			$req_response = json_decode($req_input);
			$username = (isset($req_response->username)) ? input_data($req_response->username) : '';
			$useremail = (isset($req_response->useremail)) ? $req_response->useremail : '';
			$phonenumber = (isset($req_response->usermobile)) ? $req_response->usermobile : '';
			$book_title = (isset($req_response->book_title)) ? trim($req_response->book_title) : '';
			$author = (isset($req_response->author)) ? trim($req_response->author) : '';
			$edition = (isset($req_response->edition)) ? trim($req_response->edition) : '';
			$expected_date = (isset($req_response->expected_date)) ? trim($req_response->expected_date) : '';
			$description = (isset($req_response->description)) ? trim($req_response->description) : '';
			if ($username == '') {$error_message.='* Username is missing ,'; $error = 1;}
			if (!email_check($useremail)) { $error_message .= '* invalid email ,';$error = 1;}
			if (!mobile_check($phonenumber)) {$error_message .= '* invalid mobile ,';$error = 1;}
			$pic ='';
			/*Validation Section ends here*/
			if($error==1)
			{
					$response[CODE] = VALIDATION_CODE;
					$response[MESSAGE] = 'Validation';
					$response[DESCRIPTION] =rtrim($error_message,',');
			}
			else
			{
				/*>>Insert  request code start */
				$insertCols = [
					'username'=>$username,
					'emailid'=>$useremail,
					'phone_number'=>$phonenumber,
					'expected_date'=>$expected_date,
					'book_title'=>$book_title,
					'author'=>$author,
					'edition'=>$edition,
					'description'=>$description,
					];
					if($pic!='')
					{
							$extension = @end(explode(".", $_FILES["book_image"]["name"]));
							$profile_pic = sha1(time().mt_rand(0000,99999)).'.'.$extension;
							move_uploaded_file($_FILES["book_image"]["tmp_name"],"uploads/bookrequests/". $profile_pic);
							$insertCols['sample_pic']=$profile_pic;
					}
				$insertSql = $this->db->insert_string('book_requests',$insertCols);
				$insertQuery = $this->db->query($insertSql);
				/*>>Insert  request code end */
				$message='';
			 $to = 'achariphp@gmail.com';
			 $subject = "Books request on ".date('d-M-Y');
			 $htmlContent = '
			 <html>
			 <head>
					 <title>Welcome to Books for sale</title>
			 </head>
			 <body>
					 <h1>Thanks you for requesting with us & Request details are</h1>
					 <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
							 <tr>
									 <th>User Name:</th><td>'.$username.'</td>
							 </tr>
							 <tr>
									 <th>User Email:</th><td>'.$useremail.'</td>
							 </tr>
							 <tr>
									 <th>Phone Number:</th><td>'.$phonenumber.'</td>
							 </tr>
							 <tr>
							 <th>Book Title:</th><td>'.$book_title.'</td>
							 </tr>
							 <tr>
									 <th>Author:</th><td>'.$author.'</td>
							 </tr
							 <tr>
									 <th>Edition:</th><td>'.$edition.'</td>
							 </tr>

					 </table>
			 </body>
			 </html>';

				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 $headers .= 'From: broadenblue<info@broadenblue.com>' . "\r\n";
				 $headers .= 'Bcc: achariphp@gmail.com' . "\r\n";
				 $mail=@mail($to,$subject,$htmlContent,$headers);
				 $response[CODE] = SUCCESS_CODE;
				 $response[MESSAGE] = 'successs';
				 $response[DESCRIPTION] ='Book request has been sent successfully.';

			}
			echo json_encode($response);
		}


		public function subscribeme()
		{

			$response = array();
			$error_message = ''; $error=0;


			$useremail = $this->input->post('subscribeid');

			if (!email_check($useremail)) { $error_message .= '* invalid email ,';$error = 1;}

			/*Validation Section ends here*/
			if($error==1)
			{
					$response[CODE] = VALIDATION_CODE;
					$response[MESSAGE] = 'Validation';
					$response[DESCRIPTION] =rtrim($error_message,',');
			}
			else
			{
				/*>>Insert contact request code start */
				$insertCols = [

					'email_id'=>$useremail,

				];
				$insertSql = $this->db->insert_string('subscriptions',$insertCols);
				$insertQuery = $this->db->query($insertSql);
				/*>>Insert contact request code end */
				$message='';
			 $to = 'achariphp@gmail.com';
			 $subject = "Contact request on ".date('d-M-Y');
			 $htmlContent = '
			 <html>
			 <head>
					 <title>Welcome to Books for sale</title>
			 </head>
			 <body>
					 <h1>Thanks you for requesting with us & Request details are</h1>
					 <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">

							 <tr>
									 <th>User Email:</th><td>'.$useremail.'</td>
							 </tr>
							 <tr>
									 <th>Registered Date:</th><td>'.date('d-M-Y h:i a').'</td>
							 </tr>



					 </table>
			 </body>
			 </html>';

				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 $headers .= 'From: broadenblue<info@broadenblue.com>' . "\r\n";
				 $headers .= 'Bcc: achariphp@gmail.com' . "\r\n";
				 $mail=@mail($to,$subject,$htmlContent,$headers);
				 $response[CODE] = SUCCESS_CODE;
				 $response[MESSAGE] = 'successs';
				 $response[DESCRIPTION] ='Thank you for subscribing with us.';

			}
			echo json_encode($response);
		}

}
