<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Ministry_Controller {

    public function profile() {

        $ministry_id = $this->session->userdata('ministry_id');
        $result['ministry'] = $this->Ministry_Model->get_by_id($ministry_id);

        $this->load->view('header');
        $this->load->view('edit_profile', $result);
        $this->load->view('footer');
    }

    public function update_profile() {

        $ministry_id = $this->session->userdata('ministry_id');
        $contact_person = $this->input->post('contact_person');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $data = array(
            "contact_person" => $contact_person,
            "email" => $email,
            "mobile" => $mobile,
        );

        $updated = $this->Ministry_Model->update($data, $ministry_id);
        if ($updated > 0) {
            $this->session->set_flashdata('msg', "Your profile has been updated successfully.");
        } else {
            $this->session->set_flashdata('err', "Your profile cannot be updated. Please try again later.");
        }

        redirect(base_url() . 'account/profile');
    }

    public function password() {

        $this->load->view('header');
        $this->load->view('change_password');
        $this->load->view('footer');
    }

    public function change_password() {

        $ministry_id = $this->session->userdata('ministry_id');
        $password = $this->input->post('password');
        $data = array(
            "password" => $password,
        );

        $updated = $this->Ministry_Model->update($data, $ministry_id);
        if ($updated > 0) {
            $this->session->set_flashdata('msg', "Your password has been updated successfully.");
        } else {
            $this->session->set_flashdata('err', "Your password cannot be updated. Please try again later.");
        }

        redirect(base_url() . 'account/password');
    }

}
