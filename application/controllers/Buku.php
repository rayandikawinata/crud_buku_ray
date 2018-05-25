<?php

 class Buku extends CI_Controller{

 	public function __construct(){

 	parent::__construct();
 		$this->load->model('m_buku');
 	}

 	public function index(){
 		$data['buku'] = $this->m_buku->get_all_buku(); //function untuk menampilkan semua data
 		$this->load->view('v_buku', $data);
 	}

 	//function menambahkan data
 	public function add(){
 		$data = array(

 			'judul_buku' 	=> $this->input->post('judul_buku'),
 			'kategori_buku' => $this->input->post('kategori_buku'),
 			'isbn_buku' 	=> $this->input->post('isbn_buku'),	

 			);
 		$insert = $this->m_buku->add($data);
 		echo json_encode(array("status" => true));
 	}

 	//function untuk menampilkan data berdasarkan 'id'
 	public function ajax_edit($id){
 		$data = $this->m_buku->get_by_id($id);
 		echo json_encode($data);
 	}

 	//function update
 	public function buku_update(){
 		$data = array(
 			'judul_buku' 	=> $this->input->post('judul_buku'),
 			'kategori_buku' => $this->input->post('kategori_buku'),
 			'isbn_buku' 	=> $this->input->post('isbn_buku'),	
 			);

 		$this->m_buku->buku_update(array('id_buku'=> $this->input->post('id_buku')), $data);

 		echo json_encode(array("status" => TRUE));

 	}
 	// Function hapus
 	public function hapus($id){
 		$this->m_buku->delete($id);
 		echo json_encode(array("status" => TRUE));

 	}
 }