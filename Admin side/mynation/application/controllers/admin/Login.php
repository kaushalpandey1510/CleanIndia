<?php

class login extends CI_Controller {

    public function index() {

        $this->load->view('login');
        //$this->load->view('footer');
    }

    public function validate() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $row = $this->Admin_Model->validate($email, $password);
        if($row)
        {
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('admin_name', $row->name);
            $this->session->set_userdata('role', 'admin');
            redirect(base_url().'admin/welcome');
        }else
        {
			$this->session->set_flashdata('err', 'Invalid email or password');
            redirect(base_url().'admin/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url().'admin');
    }
}
