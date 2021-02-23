<?php

class Ministry_Model extends CI_Model
{
    public function save($data)
    {
        $this->db->insert('ministry', $data);
        return $this->db->insert_id();
    }
    
     public function get_all()
    {
        $query = $this->db->get('ministry');
        return $query->result();
    }
    
    public function update($data, $ministry_id)
    {
        $this->db->where('ministry_id', $ministry_id);
        $updated = $this->db->update('ministry', $data);
        return $updated;
    }
    public function delete($ministry_id)
    {
        $this->db->where('ministry_id', $ministry_id);
        $deleted = $this->db->delete('ministry');
        return $deleted;
    }
    
    public function get_by_id($ministry_id)
    {
        $this->db->where('ministry_id', $ministry_id);
        $query = $this->db->get('ministry');
        return $query->row();
    }
    
    public function get_by_category_id($category_id)
    {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('ministry_category');
        return $query->row();
    }
    
    public function save_ministry_category($ministry_category)
    {
        $this->db->insert_batch('ministry_category', $ministry_category);
    }
    
    public function delete_category($ministry_category_id)
    {
        $this->db->where('ministry_category_id', $ministry_category_id);
        $deleted = $this->db->delete('ministry_category');
        return $deleted;
    }
    
     public function validate($email, $password) {
        $this->db->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get('ministry');
        return $query->row();
    }
    
    public function unique($ministry_id, $ministry_name)
    {
        $this->db->where('ministry_name', $ministry_name);
        $this->db->where_not_in('ministry_id', $ministry_id);
        $query = $this->db->get('ministry');
        return $query->row();
    }
    
    
}
