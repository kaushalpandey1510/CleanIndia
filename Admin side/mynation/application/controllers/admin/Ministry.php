<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ministry extends Admin_Controller {

    public function index() {
        $result['ministry'] = $this->Ministry_Model->get_all();

        $this->load->view('header');
        $this->load->view('ministry/list', $result);
        $this->load->view('footer');
    }

    public function add() {

        $result['category'] = $this->Category_Model->get_remaining();

        $this->load->view('header');
        $this->load->view('ministry/add', $result);
        $this->load->view('footer');
    }

    public function save() {

        $ministry_name = $this->input->post('ministry_name');
        $contact_person = $this->input->post('contact_person');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');
        $category = $this->input->post('category');


        $data = array(
            "ministry_name" => $ministry_name,
            "contact_person" => $contact_person,
            "email" => $email,
            "mobile" => $mobile,
            "password" => $password
        );
        //print_r($category);
        $ministry_id = $this->Ministry_Model->save($data);
        $ministry_category = array();
        foreach ($category as $c) {
            $ministry_category[] = array(
                'ministry_id' => $ministry_id,
                'category_id' => $c,
            );
        }

        $this->Ministry_Model->save_ministry_category($ministry_category);

        $this->session->set_flashdata('msg', "Ministry has been inserted successfully.");

        redirect(base_url().'admin/ministry');
    }

    public function get_all() {
        $query = $this->db->get('ministry');
        return $query->result();
    }

    public function edit() {

        $ministry_id = $this->input->get('ministry_id');
        $result['category_assigned'] = $this->Category_Model->get_by_ministry_id($ministry_id);
        $result['category_remaining'] = $this->Category_Model->get_remaining();
        $result['ministry'] = $this->Ministry_Model->get_by_id($ministry_id);


        $this->load->view('header');
        $this->load->view('ministry/edit', $result);
        $this->load->view('footer');
    }

    public function update() {
        $ministry_id = $this->input->post('ministry_id');
        $ministry_name = $this->input->post('ministry_name');
        $contact_person = $this->input->post('contact_person');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $data = array(
            "ministry_name" => $ministry_name,
            "contact_person" => $contact_person,
            "email" => $email,
            "mobile" => $mobile,
        );

        $updated = $this->Ministry_Model->update($data, $ministry_id);
        if ($updated > 0) {
            $this->session->set_flashdata('msg', "Ministry has been updated successfully.");
        } else {
            $this->session->set_flashdata('err', "Ministry cannot be updated. Please try again later.");
        }

        redirect(base_url().'admin/ministry');
    }

    public function delete() {
        $ministry_id = $this->input->get('ministry_id');
        $deleted = $this->Ministry_Model->delete($ministry_id);
        if ($deleted > 0) {
            $this->session->set_flashdata('msg', "Ministry has been deleted successfully.");
        } else {
            $this->session->set_flashdata('err', "Ministry cannot be deleted. Please try again later.");
        }

        redirect(base_url().'admin/ministry');
    }

    public function delete_category() {
        $ministry_category_id = $this->input->get('ministry_category_id');
        $deleted = $this->Ministry_Model->delete_category($ministry_category_id);
        if ($deleted > 0) {
            $this->session->set_flashdata('msg', "Category has been deleted from ministry successfully.");
        } else {
            $this->session->set_flashdata('err', "Category cannot be deleted from ministry. Please try again later.");
        }

        redirect(base_url().'admin/ministry');
    }

    public function save_category() {

        $ministry_id = $this->input->post('ministry_id');
        $category = $this->input->post('category');
        $ministry_category = array();
        foreach ($category as $c) {
            $ministry_category[] = array(
                'ministry_id' => $ministry_id,
                'category_id' => $c,
            );
        }

        $this->Ministry_Model->save_ministry_category($ministry_category);

        $this->session->set_flashdata('msg', "Category has been assigned to ministry successfully.");

        redirect(base_url().'admin/ministry');
    }
    
    public function unique()
    {
        $valid = true;
        $ministry_name = $this->input->get('ministry_name');
        $ministry_id = $this->input->get('ministry_id');
        $ministry = $this->Ministry_Model->unique($ministry_id, $ministry_name);
        if($ministry)
        {
            $valid = false;
        }
        $json = array(
            'valid'=>$valid
        );
        echo json_encode($json);
    }

}
