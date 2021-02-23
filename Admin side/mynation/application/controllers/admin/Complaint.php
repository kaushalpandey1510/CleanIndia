<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class complaint extends Admin_Controller {
		
		/*public function __construct() {
			parent::__construct();
			include APPPATH . 'core/Message.php';
		}*/
		
		public function index() {
			$result['complaint'] = $this->Complaint_Model->get_all();
			
			$this->load->view('header');
			$this->load->view('complaint/list', $result);
			$this->load->view('footer');
		}
		
		public function detail() {
			
			$complaint_id = $this->input->get('complaint_id');
			$result['complaint'] = $this->Complaint_Model->get_by_id($complaint_id);
			$result['category'] = $this->Category_Model->get_all();
			$this->load->view('header');
			$this->load->view('complaint/detail', $result);
			$this->load->view('footer');
		}
		
		
		
		public function assign() {
			$complaint_id = $this->input->post('complaint_id');
			$category_id = $this->input->post('category_id');
			$ministry = $this->Ministry_Model->get_by_category_id($category_id);
			$complaint = array(
            'ministry_id' => $ministry->ministry_id,
            'category_id' => $category_id,
            'resolve'=>null,
            'resolve_confirm'=>null
			);
			$this->Complaint_Model->update($complaint, $complaint_id);
			$this->session->set_flashdata('msg', "Complaint has been assigned successfully.");
			
			redirect(base_url() . 'admin/complaint');
		}
		
		public function confirm_solution() {
			$complaint_id = $this->input->post('complaint_id');
			$resolve_confirm = $this->input->post('resolve_confirm');
			$complaint = array(
            'resolve_confirm' => $resolve_confirm,
            'resolve_date'=>date('Y-m-d')
			);
			
			$this->Complaint_Model->update($complaint, $complaint_id);
			$this->session->set_flashdata('msg', "Complaint status has been updated successfully.");
			
			//	send sms
			$complaint = $this->Complaint_Model->get_by_id($complaint_id);
			$user = $this->User_Model->get_by_id($complaint->user_id);
			$message = new Message();
			$message->sendMsgForComplaintResolution($user, $complaint_id);		
			
			redirect(base_url() . 'admin/complaint');
		}
		
	}
