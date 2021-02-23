<?php

class Event_Model extends CI_Model {

    public function save($data) {
        $inserted = $this->db->insert('event', $data);
        return $inserted;
    }

    public function get_all() {
        
        //$query = $this->db->get('event');
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('event_type', 'event.event_type_id = event_type.event_type_id');
        $this->db->join('city', 'event.city_id = city.city_id');
        $this->db->join('state', 'event.state_id = state.state_id');
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_upcoming() {
        
        //$query = $this->db->get('event');
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('event_type', 'event.event_type_id = event_type.event_type_id');
        $this->db->join('city', 'event.city_id = city.city_id');
        $this->db->join('state', 'event.state_id = state.state_id');
		$this->db->where('event_date>', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_finished() {
        
        //$query = $this->db->get('event');
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('event_type', 'event.event_type_id = event_type.event_type_id');
        $this->db->join('city', 'event.city_id = city.city_id');
        $this->db->join('state', 'event.state_id = state.state_id');
		$this->db->where('event_date<=', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($event_id)
    {
        $query = $this->db->get('event');
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('event_type', 'event.event_type_id = event_type.event_type_id');
        $this->db->join('city', 'event.city_id = city.city_id');
        $this->db->join('state', 'event.state_id = state.state_id');        
        $this->db->where('event_id', $event_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function update($data, $event_id)
    {
        $this->db->where('event_id', $event_id);
        $updated = $this->db->update('event', $data);
        return $updated;
    }
    
    public function delete($event_id)
    {
        $this->db->where('event_id', $event_id);
        $deleted = $this->db->delete('event');
        return $deleted;
    }
    
    public function save_gallery($gallery)
    {
        $this->db->insert('event_gallery', $gallery);
    }
    
    public function get_gallery_by_event_id($event_id)
    {
        $this->db->where('event_id', $event_id);
        $query = $this->db->get('event_gallery');
        return $query->result();
    }
    
     public function unique($event_id, $title)
    {
        $this->db->where('title', $title);
        $this->db->where_not_in('event_id', $event_id);
        $query = $this->db->get('event');
        return $query->row();
    }
}
