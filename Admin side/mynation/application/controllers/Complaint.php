<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class complaint extends Ministry_Controller{
	
	

    public function index() {
        $result['complaint'] = $this->Complaint_Model->get_by_ministry_id($this->session->userdata('ministry_id'));

        $this->load->view('header');
        $this->load->view('complaint_list', $result);
        $this->load->view('footer');
    }

    public function detail() {

        $complaint_id = $this->input->get('complaint_id');
        $result['complaint'] = $this->Complaint_Model->get_by_id($complaint_id);
        $result['category'] = $this->Category_Model->get_all();
        $this->load->view('header');
        $this->load->view('complaint_detail', $result);
        $this->load->view('footer');
    }

    public function solve() {


        $config['upload_path'] = 'upload/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $uploaded_data = $this->upload->data();
            $image = $config['upload_path'] . $uploaded_data['file_name'];
            $complaint_id = $this->input->post('complaint_id');
            $complaint = array(
                'new_photo' => $image,
                'resolve' => 1,
                'resolve_confirm'=>null,
                'resolve_date'=>date('Y-m-d')
            );
            $this->Complaint_Model->update($complaint, $complaint_id);
            $this->session->set_flashdata('msg', "Complaint status has been updated successfully.");
        } else {
            $this->session->set_flashdata('err', "Image could not uploaded. Please try again later.");
        }
        
        redirect(base_url().'complaint/detail?complaint_id='.$complaint_id);
        //$category_id = $this->input->get('category_id');

        
    }

}
