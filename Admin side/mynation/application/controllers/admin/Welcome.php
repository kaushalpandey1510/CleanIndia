<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Admin_Controller {

    public function index() {        
        $new = $this->Complaint_Model->get_total_new();
        $pending = $this->Complaint_Model->get_total_pending();
        $resolved = $this->Complaint_Model->get_total_resolved();
        
        
        //print_r($new);
        //print_r($pending); die();
        
        $result['total_new'] = $new->total;
        $result['total_pending'] = $pending->total;
        $result['total_resolved'] = $resolved->total;
        $this->load->view('header');
        $this->load->view('admin_dashboard', $result);
        $this->load->view('footer');
    }
      

}
