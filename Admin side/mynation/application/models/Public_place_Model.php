<?php

class Public_place_Model extends CI_Model{
    public function save($data)
    {
        $inserted = $this->db->insert('public_place', $data);
        return $inserted;
    }
    
    public function update($data, $public_place_id)
    {
        $this->db->where('public_place_id', $public_place_id);
        $updated = $this->db->update('public_place', $data);
        return $updated;
    }
    
    public function get_all()
    {
        $query = $this->db->get('public_place');
        return $query->result();
    }
    
    public function get_by_id($public_place_id)
    {
        $this->db->where('public_place_id', $public_place_id);
        $query = $this->db->get('public_place');
        return $query->row();
    }
    
    public function delete($public_place_id)
    {
        $this->db->where('public_place_id', $public_place_id);
        $deleted = $this->db->delete('public_place');
        return $deleted;
    }
    
     public function unique($public_place_id, $public_place_name)
    {
        $this->db->where('public_place_name', $public_place_name);
        $this->db->where_not_in('public_place_id', $public_place_id);
        $query = $this->db->get('public_place');
        return $query->row();
    }
}
