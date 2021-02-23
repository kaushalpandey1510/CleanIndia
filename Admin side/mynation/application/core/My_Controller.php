<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Controller
 *
 * @author kaushal
 */
class My_Controller extends CI_Controller {
    
}

class Admin_Controller extends My_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect(base_url());
        } else if ($this->session->userdata('role') == 'ministry') {
            redirect(base_url() . 'welcome');
        }
    }

}

class Ministry_Controller extends My_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect(base_url());
        } else if ($this->session->userdata('role') == 'admin') {
            redirect(base_url() . 'admin/welcome');
        }
    }

}
