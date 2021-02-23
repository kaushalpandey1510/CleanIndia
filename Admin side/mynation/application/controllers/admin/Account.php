<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller {

    public function password() {

        $this->load->view('header');
        $this->load->view('password/change_password');
        $this->load->view('footer');
    }

    public function change_password() {

        $admin_id = $this->session->userdata('admin_id');
        $password = $this->input->post('password');
        $data = array(
            "password" => $password,
        );

        $updated = $this->Admin_Model->update($data, $admin_id);
        if ($updated > 0) {
            $this->session->set_flashdata('msg', "Your password has been updated successfully.");
        } else {
            $this->session->set_flashdata('err', "Your password cannot be updated. Please try again later.");
        }

        redirect(base_url() . 'admin/account/password');
    }

}
