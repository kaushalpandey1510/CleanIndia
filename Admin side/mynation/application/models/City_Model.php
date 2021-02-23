<?php

class City_Model extends CI_Model{
    public function get_all($state_id)
    {
        $this->db->where('state_id', $state_id);
        $query = $this->db->get('city');
        return $query->result();
    }
}
