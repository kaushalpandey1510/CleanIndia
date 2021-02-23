<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Ministry_Controller {

    public function index() {
        $new = $this->Complaint_Model->get_total_new_by_ministry($this->session->userdata('ministry_id'));
        $pending = $this->Complaint_Model->get_total_pending_by_ministry($this->session->userdata('ministry_id'));
        $resolved = $this->Complaint_Model->get_total_resolved_by_ministry($this->session->userdata('ministry_id'));


        //print_r($new);
        //print_r($pending); die();

        $result['total_new'] = $new->total;
        $result['total_pending'] = $pending->total;
        $result['total_resolved'] = $resolved->total;
        $this->load->view('header');
        $this->load->view('welcome', $result);
        $this->load->view('footer');
    }

}
