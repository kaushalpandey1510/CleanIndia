<?php

class Admin_Model extends CI_Model {

    public function validate($email, $password) {
        $this->db->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get('admin');
        return $query->row();
    }

    public function update($data, $admin_id)
    {
        $this->db->where('admin_id', $admin_id);
        $updated = $this->db->update('admin', $data);
        return $updated;
    }
}
