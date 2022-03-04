<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
		

class M_admin extends CI_Model{


	public function cekiduser()
    {
        $query = $this->db->query("SELECT MAX(id) as id_user from user");
        $hasil = $query->row();
        return $hasil->id_user;
    }

    public function cekidmitra()
    {
        $query = $this->db->query("SELECT MAX(id) as id_mitra from mitra");
        $hasil = $query->row();
        return $hasil->id_mitra;
    }

    public function pesananbulanan($bulan_lalu,$sekarang)
    {
    	$query = $this->db->query("SELECT * FROM pesanan  WHERE tgl_pesan between '$bulan_lalu' AND '$sekarang' ORDER BY id_pesanan DESC");
    	return $query->result_array();
    }


	public function show_barang(){

		$hasil=$this->db->query("SELECT * FROM galeri");
		return $hasil;

	}

	public function get_galeri_tipe()
	{
		$query = $this->db->get('katagori_galeri');
		return $query->result_array();
	}

	public function get_request_iklan()
	{
		$query = $this->db->get('req_iklan');
		return $query->result_array();
	}

	public function get_perpanjang_iklan()
	{
		$query = $this->db->get('perpanjang_iklan');
		return $query->result_array();
	}

		public function get_tipe_galeri()
		{
			
			$query = $this->db->get('galeri');
			return $query->result_array();
		}

		public function get_tipe_iklan()
		{
			$this->db->where('is_active', 1);
			$this->db->order_by('id', 'RANDOM');
			$query = $this->db->get('iklan');
			return $query->result_array();
		}

		public function get_galeri($id)
		{
			$this->db->select('galeri.*,id');
			$this->db->from('galeri');
			$this->db->join('katagori_galeri', 'tipe=katagori_galeri.id','left');
	   		$this->db->where('id_galeri',$id);
	        return $this->db->get();
	    }

	    public function get_email_user($email)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}

		public function get_mitra()
	{
		$query = $this->db->get('mitra');
		return $query->result_array();
	}

	public function get_iklan()
	{
		$query = $this->db->get('iklan');
		return $query->result_array();
	}

		public function get_isi_saldo()
	{
		$query = $this->db->get('isi_saldo');
		return $query->result_array();
	}

	public function get_kirim_biaya()
	{
		$query = $this->db->get('simpan_biaya');
		return $query->result_array();
	}

	public function get_simpan_pesanan()
	{
		$where = "status_pesanan ='4' OR status_pesanan='6'";
		$this->db->where($where);
		$query = $this->db->get('simpan_pesanan');
		return $query->result_array();
	}

	public function get_tarik_saldo()
	{
		$query = $this->db->get('tarik_saldo');
		return $query->result_array();
	}

	public function get_online()
	{
		$this->db->order_by('off', 'ASC');
		$query = $this->db->get('log_login');
		return $query->result_array();
	}

	public function get_loglogin($id_mitra)
	{
		if($id_mitra>0)
			{
				$this->db->where('id_user',$id_mitra);
			}
		$query = $this->db->get('log_login');
		return $query->result_array();
	}
	
	public function get_pesanan()
	{

		$this->db->where('no_invoice >',0);
		$query = $this->db->get('simpan_pesanan');
		return $query->result_array();
	}

	public function get_koment()
	{
		$query = $this->db->get('rating');
		return $query->result_array();
	}

	public function get_pesanansekarang($tanggal)
	{	
		if($tanggal > 0)
			{
				$this->db->where('tgl_pesan',$tanggal);
			}
		$query = $this->db->get('pesanan');
		return $query->result_array();
	}




}