<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Admin_Controller {

    public function index() {
        $result['event'] = $this->Event_Model->get_all();

        $this->load->view('header');
        $this->load->view('event/list', $result);
        $this->load->view('footer');
    }

    public function add() {
        $result['event_type'] = $this->Event_type_Model->get_all();
        $result['state'] = $this->State_Model->get_all();

        $this->load->view('header');
        $this->load->view('event/add', $result);
        $this->load->view('footer');
    }

    public function save() {
        //  upload image
        $config['upload_path'] = 'upload/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $uploaded_data = $this->upload->data();
            $image = $config['upload_path'] . $uploaded_data['file_name'];
            $title = $this->input->post('title');
            $purpose = $this->input->post('purpose');
            $address = $this->input->post('address');
			$contact_person = $this->input->post('contact_person');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $event_date = $this->input->post('event_date');
			$event_time = $this->input->post('event_time');
            $state_id = $this->input->post('state_id');
            $city_id = $this->input->post('city_id');

            $data = array(
                "title" => $title,
                "purpose" => $purpose,
                "address" => $address,
                "contact_person"=>$contact_person,
            	"email" => $email,
                "mobile" => $mobile,
                "event_date" => $event_date,
				"event_time" => $event_time,
                "image" => $image,
                "state_id" => $state_id,
                "city_id" => $city_id
            );
			
			$inserted = $this->Event_Model->save($data);
			if ($inserted > 0) {
                $this->session->set_flashdata('msg', "Event has been inserted successfully.");
            } else {
                $this->session->set_flashdata('err', "Event cannot be inserted successfully. Please try again later.");
            }
        } else {
            $this->session->set_flashdata('err', "Image could not uploaded. Please try again later.");
        }



        redirect(base_url().'admin/event');
    }

    public function get_all() {
        $query = $this->db->get('event');
        return $query->result();
    }

    public function edit() {

        $event_id = $this->input->get('event_id');
        $event = $this->Event_Model->get_by_id($event_id);
        $result['event'] = $event;
        $result['event_type'] = $this->Event_type_Model->get_all();
        $result['city'] = $this->City_Model->get_all($event->state_id);
        $result['state'] = $this->State_Model->get_all();
        $result['event'] = $this->Event_Model->get_by_id($event_id);


        $this->load->view('header');
        $this->load->view('event/edit', $result);
        $this->load->view('footer');
    }

    public function update() {

        $event_id = $this->input->post('event_id');
        $title = $this->input->post('title');
        $purpose = $this->input->post('purpose');
        $address = $this->input->post('address');
        $contact_person = $this->input->post('contact_person');
		$email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $event_date = $this->input->post('event_date');
		$event_time = $this->input->post('event_time');
        //$image = $this->input->post('image');
        $state_id = $this->input->post('state_id');
        $city_id = $this->input->post('city_id');

        $data = array(
            "title" => $title,
            "purpose" => $purpose,
            "address" => $address,
			"contact_person"=>$contact_person,
            "email" => $email,
            "mobile" => $mobile,
            "event_date" => $event_date,
			"event_time" => $event_time,
            //"image" => $image,
            "state_id" => $state_id,
            "city_id" => $city_id
        );

        $updated = $this->Event_Model->update($data, $event_id);
        if ($updated > 0) {
            $this->session->set_flashdata('msg', "Event has been updated successfully.");
        } else {
            $this->session->set_flashdata('err', "Event cannot be updated. Please try again later.");
        }

        redirect(base_url().'admin/event');
    }

    public function delete() {
        $event_id = $this->input->get('event_id');
        $deleted = $this->Event_Model->delete($event_id);

        if ($deleted > 0) {
            $this->session->set_flashdata('msg', "Event has been deleted successfully.");
        } else {
            $this->session->set_flashdata('err', "Event cannot be deleted. Please try again later.");
        }

        redirect(base_url().'admin/event');
    }

    public function gallery() {

        $event_id = $this->input->get('event_id');
        $result['event'] = $this->Event_Model->get_by_id($event_id);
        $result['event_gallery'] = $this->Event_Model->get_gallery_by_event_id($event_id);
        
        $this->load->view('header');
        $this->load->view('event/gallery', $result);
        $this->load->view('footer');
    }

    public function upload_images() {
        $config['upload_path'] = 'upload/gallery/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        $event_id = $this->input->post('event_id');
        if ($this->upload->do_upload('file')) {
            $uploaded_data = $this->upload->data();
            $image = $config['upload_path'] . $uploaded_data['file_name'];
            $images = array(
                'event_id'=>$event_id,
                'image'=>$image
            );
            $this->Event_Model->save_gallery($images);
        }else{
            print_r($this->upload->display_errors());
        }
    }
    
     public function detail() {

        $event_id = $this->input->get('event_id');
        $result['event'] = $this->Event_Model->get_by_id($event_id);
        $this->load->view('header');
        $this->load->view('event/detail', $result);
        $this->load->view('footer');
    }
    
    public function unique()
    {
        $valid = true;
        $title = $this->input->get('title');
        $event_id = $this->input->get('event_id');
        $event = $this->Event_Model->unique($event_id, $title);
        if($event)
        {
            $valid = false;
        }
        $json = array(
            'valid'=>$valid
        );
        echo json_encode($json);
    }

}
