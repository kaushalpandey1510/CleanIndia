<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author kaushal
 */
class State extends CI_Controller {

    public function index() {
        $json = array();
        $result = $this->State_Model->get_all();
        if (count($result) > 0) {
            $json['success'] = 1;
            $json['state'] = $result;
            $json['msg'] = 'Record Found';
        } else {
            $json['success'] = 0;
            $json['msg'] = 'Record Not Found';
        }
        echo json_encode($json);
    }
}
