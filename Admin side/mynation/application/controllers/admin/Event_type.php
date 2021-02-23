<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_type extends Admin_Controller {
    public function index() {
        $result['event_type'] = $this->Event_type_Model->get_all();
        
        $this->load->view('header');
        $this->load->view('event_type/list', $result);
        $this->load->view('footer');
    }
    
    public function edit() {
        $event_type_id = $this->input->get('event_type_id');
        $result['event_type'] = $this->Event_type_Model->get_by_id($event_type_id);
        
        
        $this->load->view('header');
        $this->load->view('event_type/edit', $result);
        $this->load->view('footer');
    }
    
    public function save() {
        $event_type_name = $this->input->post('event_type_name');
        
        $data = array(
            "event_type_name"=>$event_type_name
        );
        $inserted = $this->Event_type_Model->save($data);
        if($inserted > 0)
        {
            $this->session->set_flashdata('msg', "Event type has been inserted successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Event type cannot be inserted. Please try again later.");
        }
        
        redirect(base_url().'admin/event_type');
    }
    
    public function update() {
        $event_type_id = $this->input->post('event_type_id');
        $event_type_name = $this->input->post('event_type_name');
        
        $data = array(
            "event_type_name"=>$event_type_name
        );
        $updated = $this->Event_type_Model->update($data, $event_type_id);
        if($updated > 0)
        {
            $this->session->set_flashdata('msg', "Event type has been updated successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Event type cannot be updated. Please try again later.");
        }
        
        redirect(base_url().'admin/event_type');
    }
    
    public function delete() {
        $event_type_id = $this->input->get('event_type_id');
        $deleted = $this->Event_type_Model->delete($event_type_id);
        if($deleted > 0)
        {
            $this->session->set_flashdata('msg', "Event type has been deleted successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Event type cannot be deleted. Please try again later.");
        }
        
        redirect(base_url().'admin/event_type');
    }
    
    public function get_all()
    {
        $query = $this->db->get('event_type');
        return $query->result();
    }
    
    public function unique()
    {
        $valid = true;
        $event_type_name = $this->input->get('event_type_name');
        $event_type_id = $this->input->get('event_type_id');
        $event_type = $this->Event_type_Model->unique($event_type_id, $event_type_name);
        if($event_type)
        {
            $valid = false;
        }
        $json = array(
            'valid'=>$valid
        );
        echo json_encode($json);
    }

}
