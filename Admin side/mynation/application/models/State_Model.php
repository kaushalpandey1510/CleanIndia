<?php

class State_Model extends CI_Model{
    public function get_all()
    {
        $query = $this->db->get('state');
        return $query->result();
    }
}
