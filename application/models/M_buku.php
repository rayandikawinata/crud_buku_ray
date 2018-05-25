<?php

	class M_buku extends CI_Model{

		var $table = 'buku';

		public function add($data){
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}

		// menampilkan semua data 
		public function get_all_buku(){
			$this->db->from('buku');
			$query = $this->db->get();
			return $query -> result();
		}

		//menampilkan data berdasarkan 'id'
		public function get_by_id($id){
			$this->db->from($this->table);
			$this->db->where('id_buku', $id);
			$query = $this->db->get();

			return $query->row();
		}

		// melakukan update pada data
		public function buku_update($where, $data){
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
		}

		//menghapus data
		public function delete($id){
			$this->db->where('id_buku', $id);
			$this->db->delete($this->table);
		}
	}