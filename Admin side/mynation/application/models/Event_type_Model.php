<?php

class Event_type_Model extends CI_Model{
    public function save($data)
    {
        $inserted = $this->db->insert('event_type', $data);
        return $inserted;
    }
    
    public function update($data, $event_type_id)
    {
        $this->db->where('event_type_id', $event_type_id);
        $updated = $this->db->update('event_type', $data);
        return $updated;
    }
    
     public function delete($event_type_id)
    {
        $this->db->where('event_type_id', $event_type_id);
        $deleted = $this->db->delete('event_type');
        return $deleted;
    }
    
    public function get_all()
    {
        $query = $this->db->get('event_type');
        return $query->result();
    }
    
    public function get_by_id($event_type_id)
    {
        $this->db->where('event_type_id', $event_type_id);
        $query = $this->db->get('event_type');
        return $query->row();
    }
    
    public function unique($event_type_id, $event_type_name)
    {
        $this->db->where('event_type_name', $event_type_name);
        $this->db->where_not_in('event_type_id', $event_type_id);
        $query = $this->db->get('event_type');
        return $query->row();
    }
}
