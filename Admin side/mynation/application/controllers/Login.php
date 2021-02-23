<?php
	
	class login extends CI_Controller {
		
		public function index() {
			
			$this->load->view('login_ministry');
			//$this->load->view('footer');
		}
		
		public function validate() {
			
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$row = $this->Ministry_Model->validate($email, $password);
			if($row)
			{
				$this->session->set_userdata('ministry_name', $row->ministry_name);
				$this->session->set_userdata('contact_person', $row->contact_person);
				$this->session->set_userdata('role', 'ministry');
				$this->session->set_userdata('ministry_id', $row->ministry_id);
				
				redirect(base_url().'welcome');
			}else
			{
				$this->session->set_flashdata('err', 'Invalid email or password');
				redirect(base_url().'login');
			}
		}
		
		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}
