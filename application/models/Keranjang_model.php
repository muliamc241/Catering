<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

	public function get_produk_all()
	{
		$query = $this->db->get('makanan');
		return $query->result_array();
	}
	
	public function get_produk_nama_catering($nama_catering)
	{

		$this->db->where('id_mitra',$nama_catering);
		$query = $this->db->get('makanan');
		return $query->result_array();
	}

	public function get_kerajang_email($user)
	{	
		$this->db->where('user',$user);
		$this->db->where('no_invoice =', 0);
		$query = $this->db->get('keranjang');
		return $query->result_array();
	}
	public function get_kerajang($user)
	{
		$this->db->where('user',$user);
		$query = $this->db->get('keranjang');
		return $query->result_array();
	}

	public function JumlahBarang()
	{
	   $query = $this->db->get('makanan');
	   if($query->num_rows()>0)
	   {
	     return $query->num_rows();
	   }
	   else
	   {
	     return 0;
	   }
	}

	public function JumlahKeranjang($user)
	{
	   $this->db->select_sum('qty');
	   $this->db->where('user',$user);
	   $query = $this->db->get('keranjang');
	   if($query->num_rows()>0)
	   {
	     return $query->row()->qty;
	   }
	   else
	   {
	     return 0;
	   }
	}
	public function get_produk_index($kategori)
	{
		$this->db->order_by('rating', 'DESC');
		$this->db->order_by('rating', 'RANDOM');
		$query = $this->db->get('makanan');
		return $query->result_array();
	}
	
	public function get_produk_kategori($kategori,$number,$offset)
	{
		if($kategori>0)
			{	
				$this->db->where('kategori',$kategori);
			}
		$query = $this->db->get('makanan',$number,$offset);
		return $query->result_array();
	}

	public function get_produk_kategoriASC($number,$offset)
	{
		$this->db->order_by('harga', 'ASC');
		$query = $this->db->get('makanan',$number,$offset);
		return $query->result_array();
	}

	public function get_produk_kategoriDESC($number,$offset)
	{
		$this->db->order_by('harga', 'DESC');
		$query = $this->db->get('makanan',$number,$offset);
		return $query->result_array();
	}

	public function get_produk_ratingDESC($number,$offset)
	{
		$this->db->order_by('rating', 'DESC');
		$query = $this->db->get('makanan',$number,$offset);
		return $query->result_array();
	}



	public function get_nama_catering()
	{
		$query = $this->db->get_where('mitra','nama_toko');
		return $query->result_array();
	}

	public function get_user_id()
	{
		$query = $this->db->get('user','id');
		return $query->result_array();
	}
	
	public function get_kerajang_no_invoice($no_invoice)
	{
		if($no_invoice>0)
			{	
				$this->db->where('no_invoice',$no_invoice);
			}
		$query = $this->db->get('keranjang');
		return $query->result_array();
	}

	public function get_simpanpesanan_no_invoice($no_invoice)
	{
		if($no_invoice>0)
			{	
				$this->db->where('no_invoice',$no_invoice);
			}
		$query = $this->db->get('simpan_pesanan');
		return $query->result_array();
	}

	public function get_kategori()
	{
		$query = $this->db->get('katagori');
		return $query->result_array();
	}



	public function get_produk_mitra($id)
	{
		$this->db->select('makanan.*,nama_toko');
		$this->db->from('makanan');
		$this->db->join('mitra', 'id_mitra=mitra.id','left');
   		$this->db->where('product_id',$id);
        return $this->db->get();
	}

	public function get_email_id($id)
	{
		$this->db->select('keranjang.*,id');
		$this->db->from('keranjang');
		$this->db->join('user', 'user=user.id','left');
   		$this->db->where('user',$id);
        return $this->db->get();
	}
	
	public  function get_produk_id($id)
	{
		$this->db->select('makanan.*,id');
		$this->db->from('makanan');
		$this->db->join('katagori', 'kategori=katagori.id','left');
   		$this->db->where('product_id',$id);
        return $this->db->get();
    }
	public function get_product_keyword($keyword){
			$this->db->select('*');
			$this->db->from('makanan');
			$this->db->like('nama',$keyword);
			$this->db->or_like('harga',$keyword);
			return $this->db->get()->result();
	}

	public function get_produk_pesanan($id)
	{	
		$this->db->where('invoice >', 0);
		$this->db->where('id_mitra',$id);
		$query = $this->db->get('pesanan');
		return $query->result_array();
	}

	public  function get_pesanan_mitra($id)
	{
	 	$this->db->select('*');
	 	$this->db->from('pesanan');
	 	$this->db->join('simpan_pesanan','pesanan.invoice=simpan_pesanan.no_invoice');
	 	$this->db->where('id_mitra',$id);
	 	$query = $this->db->get();
	 	return $query->result_array();    
	 }

	 public  function get_pesanan_status($id,$status)
	{
	 	$this->db->select('*');
	 	$this->db->from('pesanan');
	 	$this->db->join('simpan_pesanan','pesanan.invoice=simpan_pesanan.no_invoice');
	 	$this->db->where('id_mitra',$id);
	 	$this->db->where('status_pesanan',$status);
	 	$query = $this->db->get();
	 	return $query->result_array();    
	 }

	public function get_kerajang_mitra($id_mitra)
	{
		$this->db->where('id_mitra',$id_mitra);
		$query = $this->db->get('keranjang');
		return $query->result_array();
	}

	public function get_pesanan_user($id_user)
	{
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('pesanan');
		return $query->result_array();
	}

	public function JumlahPesanan($id_user)
	{	
	
	   $this->db->select_sum('status_pesanan');
	   $this->db->where('id_user',$id_user);
	   $query = $this->db->get('simpan_pesanan');
	   if($query->num_rows()>0)
	   {
	     return $query->row()->status_pesanan;
	   }
	   else
	   {
	     return 0;
	   }
	}


	public function get_invoice_blmBayar($id_user)
	{
		$this->db->where('no_invoice >',0);
		$this->db->where('user',$id_user);
		$query = $this->db->get('keranjang');
		return $query->result_array();
	}

	public function get_status_pesanan()
	{
		$query = $this->db->get('setatus_pesanan');
		return $query->result_array();
	}

	public function get_koment_produk($product_id)
	{
		if($product_id>0)
			{	
				$this->db->where('product_id',$product_id);
			}
		$query = $this->db->get('rating');
		return $query->result_array();
	}

	public  function get_rating_invoice($no_invoice)
	{
		$this->db->select('*');
		$this->db->from('rating');
   		$this->db->where('no_invoice',$no_invoice);
        return $this->db->get();
    }

	public function get_detail_mitra_pesanan($invoice,$id)
	{
		if($invoice>0)
			{	
				$this->db->where('id_mitra',$id);
				$this->db->where('no_invoice',$invoice);
			}
		$query = $this->db->get('simpan_pesanan');
		return $query->result_array();
	}

	public function kecamatan(){
    return $this->db->get('kecamatan')->result(); // Tampilkan semua data yang ada di tabel kecamatan
  }


	public function viewByKecamatan($id_kecamatan){
    $this->db->where('id_kodePos', $id_kecamatan);
    $result = $this->db->get('kode_pos')->result(); // Tampilkan semua data kota berdasarkan id kecamatan
    return $result; 
  }


	public function get_jumlah_memesan($id_user)
	{

		$where = "status_pesanan ='4' OR status_pesanan='6'";
		$this->db->where($where);
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('simpan_pesanan');
		return $query->result_array();
	}

	public function data($number,$offset){
		return $query = $this->db->get('makanan',$number,$offset)->result();		
	}
 
	public function jumlah_data(){
		return $this->db->get('makanan')->num_rows();
	}

	public function jumlah_dataKetegori($kategori){
		if($kategori>0)
		{	
			$this->db->where('kategori',$kategori);
		}
		return $this->db->get('makanan')->num_rows();
	}

	public function get_log_isisaldo($id_user)
	{
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('isi_saldo');
		return $query->result_array();
	}

	public function get_log_tarik_saldo($id_user)
	{
		$this->db->where('id_penarik',$id_user);
		$query = $this->db->get('tarik_saldo');
		return $query->result_array();
	}

	public function save_batch($data){
    return $this->db->insert_batch('simpan_biaya', $data);
  }

}

?>