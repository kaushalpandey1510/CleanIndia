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
	class User extends CI_Controller {
		
		public function index() {
			
		}
		
		public function login()
		{
			$json = array();
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			
			$row = $this->User_Model->is_email_exist($email);
			if($row)
			{
				// if email already exists, check for valid user
				$row = $this->User_Model->validate($email, $password);
				
				if ($row) {
					$json['success'] = 1;
					$json['msg'] = 'Login Succesful';
					$json['user'] = $row;
					
				} 
				else {
					$json['success'] = 0;
					$json['msg'] = 'Invalid Email or Password';
				}
				}else{
				
				$json['success'] = 0;
				
			}
			echo json_encode($json);
		}
		
		public function register()
		{
			$json = array();
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			
			$user = array(
			'email' => $email,
			'password' => $password
			
			);
			$user_id = $this->User_Model->save($user);		
			if($user_id > 0)
			{
				$user = $this->User_Model->get_by_id($user_id);
				
				$json['success'] = 1;
				$json['msg'] = 'Registration Succesful';
				$json['user'] = $user;
			}
			else{
				$json['success'] = 0;
				$json['msg'] = 'Account cannot be created. Please try again later';    
			}
			echo json_encode($json);
		}
		
		public function validate() {
			$json = array();
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$row = $this->User_Model->validate($email, $password);
			
			if ($row) {
				$json['success'] = 1;
				$json['msg'] = 'Login Succesful';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Invalid Email or Password';
			}
			echo json_encode($json);
		}
		
		public function get() {
			$user_id = $this->input->post('user_id');
			$json = array();
			$result = $this->User_Model->get_by_id($user_id);
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['user'] = $result;
				$json['msg'] = 'Result Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
		
		public function update() {
			
			$json = array();
			$user_id = $this->input->post('user_id');
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$phone_number = $this->input->post('phone_number');
			$email = $this->input->post('email');
			
			$user = array(
			'name' => $name,
			'address'=>$address,
			'city'=>$city,
			'state'=>$state,
			'email' => $email,
			'phone_number' => $phone_number
			
			);
			$updated = $this->User_Model->update($user, $user_id);
			if($updated > 0)
			{
				$json['success'] = 1;
				$json['msg'] = 'Your profile has been updated successfully.';    
				}else{
				$json['success'] = 0;
				$json['msg'] = 'Your profile cannot be updated. Please try again later.';    
			}
			echo json_encode($json);
		}
	}
