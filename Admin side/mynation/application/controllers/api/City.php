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
	class City extends CI_Controller {
		
		public function index() {
			$state_id = $this->input->post('state_id');
			$json = array();
			$result = $this->City_Model->get_all($state_id);
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['city'] = $result;
				$json['msg'] = 'Record Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
	}
