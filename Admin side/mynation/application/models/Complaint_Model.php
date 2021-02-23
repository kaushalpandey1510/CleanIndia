<?php
	
	class Complaint_Model extends CI_Model {
		
		public function get_all() {
			
			$this->db->select('*');
			$this->db->from('complaint');
			$this->db->join('city', 'complaint.city_id = city.city_id');
			$this->db->join('state', 'complaint.state_id = state.state_id');
			$this->db->join('user', 'complaint.user_id = user.user_id');
			$this->db->order_by('complaint.complaint_date', 'desc');
			$query = $this->db->get();
			return $query->result();
		}
		
		public function get_by_user_id($user_id) {
			
			$this->db->where('user_id', $user_id);
			$this->db->order_by('complaint_date', 'desc');
			$query = $this->db->get('complaint');
			return $query->result();
		}
		
		public function get_by_ministry_id($ministry_id) {
			
			$this->db->select('*');
			$this->db->from('complaint');
			$this->db->join('city', 'complaint.city_id = city.city_id');
			$this->db->join('state', 'complaint.state_id = state.state_id');
			$this->db->join('user', 'complaint.user_id = user.user_id');
			$this->db->where('complaint.ministry_id', $ministry_id);
			$this->db->order_by('complaint.complaint_date', 'desc');
			$query = $this->db->get();
			return $query->result();
		}
		
		public function get_by_id($complaint_id) {
			$this->db->select('*');
			$this->db->from('complaint');
			$this->db->join('state', 'complaint.state_id = state.state_id');
			$this->db->join('city', 'complaint.city_id = city.city_id');
			$this->db->join('public_place', 'complaint.public_place_id = public_place.public_place_id');
			$this->db->join('user', 'complaint.user_id = user.user_id');
			
			$this->db->where('complaint_id', $complaint_id);
			$query = $this->db->get();
			return $query->row();
		}
		
		public function update($complaint, $complaint_id) {
			$this->db->where('complaint_id', $complaint_id);
			$this->db->update('complaint', $complaint);
		}
		
		public function save($complaint) {
			$inserted = $this->db->insert('complaint', $complaint);
			//echo $this->db->last_query();die;
			return $inserted;
		}
		
		public function get_total_new() {
			
			$this->db->select('count(*) as total');
			$this->db->from('complaint');
			$this->db->where('category_id', NULL);
			$query = $this->db->get();
			return $query->row();
		}
		
		public function get_total_pending() {
			
			$this->db->select('count(*) as total');
			$this->db->from('complaint');
			$this->db->where(array('category_id != ' => NULL, 'resolve_confirm' => NULL));
			
			//echo $this->db->last_query(); die();
			$query = $this->db->get();
			return $query->row();
		}
		
		public function get_total_resolved() {
			
			$this->db->select('count(*) as total');
			$this->db->from('complaint');
			$this->db->where('resolve_confirm', 1);
			
			
			
			//echo $this->db->last_query(); die();
			$query = $this->db->get();
			return $query->row();
		}
		
		//  ministry wise
		
		public function get_total_new_by_ministry($ministry_id) {
			
			$this->db->select('count(*) as total');
			$this->db->from('complaint');
			$this->db->where('ministry_id', $ministry_id);
			$query = $this->db->get();
			return $query->row();
		}
		
		public function get_total_pending_by_ministry($ministry_id) {
			
			$this->db->select('count(*) as total');
			$this->db->from('complaint');
			$this->db->where('resolve_confirm!=', 0);
			$this->db->where('ministry_id', $ministry_id);
			
			//echo $this->db->last_query(); die();
			$query = $this->db->get();
			return $query->row();
		}
		
		public function get_total_resolved_by_ministry($ministry_id) {
			
			$this->db->select('count(*) as total');
			$this->db->from('complaint');
			$this->db->where('resolve_confirm', 1);
			$this->db->where('ministry_id', $ministry_id);
			$query = $this->db->get();
			return $query->row();
		}
	}
