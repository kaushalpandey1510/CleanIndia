<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City
 *
 * @author kaushal
 */
class City extends CI_Controller{
    public function get_by_state_id()
    {
        $state_id = $this->input->post('state_id');
        $city = $this->City_Model->get_all($state_id);
        echo json_encode($city);
    }
}
