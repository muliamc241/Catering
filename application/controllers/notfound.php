<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	class notfound extends CI_Controller
	{

		public function __construct()
		{	
			parent::__construct();
			$this->load->model('keranjang_model');
			$this->load->model('m_admin');
		}
  	
		public function index()
		{	
      		$data['title'] = '404 Not Found';
      		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
      		if(!$this->session->userdata('email')){
			$this -> load -> view('templates/header_index',$data);
			} else {
			$this -> load -> view('templates/header',$data);
			}
			$this -> load -> view('auth/notfound');
			$this -> load -> view('templates/footer'); 
		}
}	
?>