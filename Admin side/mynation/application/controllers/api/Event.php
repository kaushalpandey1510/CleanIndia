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
	class Event extends CI_Controller {
		
		public function get_upcoming() {
			$json = array();
			$result = $this->Event_Model->get_upcoming();
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['event'] = $result;
				$json['msg'] = 'Result Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
		
		public function get_finished() {
			$json = array();
			$result = $this->Event_Model->get_finished();
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['event'] = $result;
				$json['msg'] = 'Result Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
		
		public function detail() {
			$event_id = $this->input->post('event_id');
			$json = array();
			$result = $this->Event_Model->get_by_id($event_id);
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['event'] = $result;
				$json['msg'] = 'Result Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
		
		public function gallery() {
			$event_id = $this->input->post('event_id');
			$json = array();
			$result = $this->Event_Model->get_gallery_by_event_id($event_id);
			if (count($result) > 0) {
				$json['success'] = 1;
				$json['event_gallery'] = $result;
				$json['msg'] = 'Result Found';
				} else {
				$json['success'] = 0;
				$json['msg'] = 'Record Not Found';
			}
			echo json_encode($json);
		}
		
		
	}
