<?php
	
	class User_Model extends CI_Model {
		
		public function validate($email, $password) 
		{
			$this->db->where(array('email' => $email, 'password' => $password));
			$query = $this->db->get('user');
			return $query->row();
		}
		
		public function get_by_id($user_id) 
		{
			$this->db->where('user_id', $user_id);
			$query = $this->db->get('user');
			return $query->row();
		}
		
		public function save($user) 
		{
			$this->db->insert('user', $user);
			return $this->db->insert_id();
			
		}
		
		public function update($user, $user_id) 
		{
			$this->db->where('user_id', $user_id);
			$updated = $this->db->update('user', $user);
			return $updated;
			
		}
		
		public function unique_email($email) 
		{
			$this->db->where(array('email' => $email));
			$query = $this->db->get('user');
			return $query->row();
			
		}
		
		public function is_email_exist($email) 
		{
			$this->db->where(array('email' => $email));
			$query = $this->db->get('user');
			return $query->row();
			
		}
		
	}
