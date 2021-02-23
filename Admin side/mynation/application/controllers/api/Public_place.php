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
class Public_place extends CI_Controller {

    public function get_all() {
        $json = array();
        $result = $this->Public_place_Model->get_all();
        if (count($result) > 0) {
            $json['success'] = 1;
            $json['public_place'] = $result;
            $json['msg'] = 'Result Found';
        } else {
            $json['success'] = 0;
            $json['msg'] = 'Record Not Found';
        }
        echo json_encode($json);
    }
	
	
}
