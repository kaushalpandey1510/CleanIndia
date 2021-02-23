<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Public_place extends Admin_Controller {
    public function index() {
        $result['public_place'] = $this->Public_place_Model->get_all();
        
        $this->load->view('header');
        $this->load->view('public_place/list', $result);
        $this->load->view('footer');
    }
    
    public function edit() {
        $public_place_id = $this->input->get('public_place_id');
        $result['public_place'] = $this->Public_place_Model->get_by_id($public_place_id);
        
        
        $this->load->view('header');
        $this->load->view('public_place/edit', $result);
        $this->load->view('footer');
    }
    
    public function save() {
        $public_place_name = $this->input->post('public_place_name');
        
        $data = array(
            "public_place_name"=>$public_place_name
        );
        $inserted = $this->Public_place_Model->save($data);
        if($inserted > 0)
        {
            $this->session->set_flashdata('msg', "Public place has been inserted successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Public place cannot be inserted. Please try again later.");
        }
        
        redirect(base_url().'admin/public_place');
    }
    
    public function update() {
        $public_place_id = $this->input->post('public_place_id');
        $public_place_name = $this->input->post('public_place_name');
        
        $data = array(
            "public_place_name"=>$public_place_name
        );
        $updated = $this->Public_place_Model->update($data, $public_place_id);
        if($updated > 0)
        {
            $this->session->set_flashdata('msg', "Public place has been updated successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Public place cannot be updated. Please try again later.");
        }
        
        redirect(base_url().'admin/public_place');
    }
    
    public function delete() {
        $public_place_id = $this->input->get('public_place_id');
        $deleted = $this->Public_place_Model->delete($public_place_id);
        if($deleted > 0)
        {
            $this->session->set_flashdata('msg', "Public Place has been deleted successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Public Place cannot be deleted. Please try again later.");
        }
        
        redirect(base_url().'admin/public_place');
    }
    
    public function unique()
    {
        $valid = true;
        $public_place_name = $this->input->get('public_place_name');
        $public_place_id = $this->input->get('public_place_id');
        $public_place = $this->Public_place_Model->unique($public_place_id, $public_place_name);
        if($public_place)
        {
            $valid = false;
        }
        $json = array(
            'valid'=>$valid
        );
        echo json_encode($json);
    }

}
