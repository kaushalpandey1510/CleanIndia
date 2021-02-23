<?php

class Category_Model extends CI_Model{
    public function save($data)
    {
        $inserted = $this->db->insert('category', $data);
        return $inserted;
    }
    
    public function update($data, $category_id)
    {
        $this->db->where('category_id', $category_id);
        $updated = $this->db->update('category', $data);
        return $updated;
    }
    
    public function delete($category_id)
    {
        $this->db->where('category_id', $category_id);
        $deleted = $this->db->delete('category');
        return $deleted;
    }
    
    public function get_all()
    {
        $this->db->order_by('category_name');
        $query = $this->db->get('category');
        
        return $query->result();
    }
    
    public function get_remaining()
    {
        $query = $this->db->query('SELECT * FROM category where category_id not in (select category_id from ministry_category) order by category_name');
        return $query->result();
    }
    
    public function get_by_ministry_id($ministry_id)
    {
        $this->db->order_by('category_name');
        $this->db->select('*');
        $this->db->from('category');        
        $this->db->join('ministry_category', 'ministry_category.category_id = category.category_id and ministry_id = '.$ministry_id);       
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_by_id($category_id)
    {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('category');
        return $query->row();
    }
    
    public function unique($category_id, $category_name)
    {
        $this->db->where('category_name', $category_name);
        $this->db->where_not_in('category_id', $category_id);
        $query = $this->db->get('category');
        return $query->row();
    }
}
