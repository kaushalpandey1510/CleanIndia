<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Ministry_Controller {

    public function index() {
        $result['event'] = $this->Event_Model->get_all();

        $this->load->view('header');
        $this->load->view('event_list', $result);
        $this->load->view('footer');
    }

    public function gallery() {

        $event_id = $this->input->get('event_id');
        $result['event'] = $this->Event_Model->get_by_id($event_id);
        $result['event_gallery'] = $this->Event_Model->get_gallery_by_event_id($event_id);

        $this->load->view('header');
        $this->load->view('event_gallery', $result);
        $this->load->view('footer');
    }

    public function detail() {

        $event_id = $this->input->get('event_id');
        $result['event'] = $this->Event_Model->get_by_id($event_id);
        //$result['category'] = $this->Category_Model->get_all();
        $this->load->view('header');
        $this->load->view('event_detail', $result);
        $this->load->view('footer');
    }

}
