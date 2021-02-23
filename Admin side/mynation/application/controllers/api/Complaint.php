<?php
	
	/*
		* To change this license header, choose License Headers in Project Properties.
		* To change this template file, choose Tools | Templates
		* and open the template in the editor.
	*/
	
	/**
		* Description of user
		*
		* @author kaushal
	*/
	class Complaint extends CI_Controller {
		
		/*public function __construct() {
			parent::__construct();
			include APPPATH . 'core/Message.php';
		}*/
		
		public function my() {
			$json = array();
			$user_id = $this->input->post('user_id');
			$result = $this->Complaint_Model->get_by_user_id($user_id);
			
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['complaint'] = $result;
				$json['msg'] = 'Result Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
		
		public function post()
		{
			
			$complaint_id = time();
			$photo = $_POST['photo'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$location = $_POST['location'];
			$user_id = $_POST['user_id'];
			$public_place_id = $_POST['public_place_id'];
			$state_id = $_POST['state_id'];
			$city_id = $_POST['city_id'];
			$ImagePath = "upload/";
			
			if (!is_dir($ImagePath)) {
				mkdir($ImagePath, 0777, TRUE);
			}
			
			$ImageFile = $ImagePath."$complaint_id.png";
			file_put_contents($ImageFile,base64_decode($photo));
			
			$complaint = array(
			'complaint_id'=>$complaint_id,
			'public_place_id'=>$public_place_id,
			'state_id'=>$state_id,
			'city_id'=>$city_id,
			'title'=>$title,
			'description'=>$description,
			'location'=>$location,
			'user_id'=>$user_id,
			'photo'=>$ImageFile,
			'complaint_date'=>date('Y-m-d H:i:s'),
			);
			
			$json = array();
			
			$inserted = $this->Complaint_Model->save($complaint);
			
			if($inserted > 0)
			{
				$json['success'] = 1;
				$json['msg'] = 'Thanks. Your complaint has been posted successfully.';
				
				//	send sms
				//  get user detail and send sms
                $user = $this->User_Model->get_by_id($user_id);
                $message = new Message();
                $message->sendMsgForComplaintConfirmation($user, $complaint_id);				
			}
			else
			{
				$json['success'] = 0;
				$json['msg'] = 'Opps!!! Your complaint cannot posted. Please try again later.';
			}
			
			
			echo json_encode($json);	
			
			
		}
		
	}
