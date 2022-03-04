<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('cart');
		$this->load->helper('string');
		$this->load->model('keranjang_model');
		$this->load->model('m_admin');

	}

	public function tampil_search()
	{	
		$data['title'] = 'kategori Event';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('admin', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang();
		$keyword = $this->input->post('keyword');
		$data['produk']=$this->keranjang_model->get_product_keyword($keyword);
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/search', $data);
		$this -> load -> view('templates/footer');
	}
	

	public function tampil_barang()
	{	
		if(!$this->session->userdata('email')){
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Harap Login untuk melihat Daftar Makanan
          </div></div>');
      	redirect('auth/index/');
    	} else{
		$data['title'] = 'Kategori';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$ka=($this->uri->segment(4))?$this->uri->segment(4):0;
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$data['gambar']=$this->m_admin->get_tipe_iklan();
		$data['tipe'] = $this->m_admin->get_galeri($kategori);
		$jumlah_data = $this->keranjang_model->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'shopping/tampil_barang/'.$kategori.'/'.$ka;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$from = $this->uri->segment(5);
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data['produk'] = $this->keranjang_model->get_produk_kategori($kategori,$config['per_page'],$from);		
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/category', $data);
		$this -> load -> view('templates/footer');
		}
	}

	public function tampil_barangkategori()
	{	
		if(!$this->session->userdata('email')){
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Harap Login untuk melihat Daftar Makanan
          </div></div>');
      	redirect('auth/index/');
    	} else{
		$data['title'] = 'Kategori';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$ka=($this->uri->segment(4))?$this->uri->segment(4):0;
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$data['gambar']=$this->m_admin->get_tipe_iklan();
		$data['tipe'] = $this->m_admin->get_galeri($kategori);
		$jumlah_data = $this->keranjang_model->jumlah_dataKetegori($kategori);
		$this->load->library('pagination');
		$from = $this->uri->segment(5);
		$config['base_url'] = base_url().'shopping/tampil_barangkategori/'.$kategori.'/'.$ka;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data['produk'] = $this->keranjang_model->get_produk_kategori($kategori,$config['per_page'],$from);		
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/category', $data);
		$this -> load -> view('templates/footer');
		}
	}

	public function tampil_keranjang()
	{

		if(!$this->session->userdata('email')){
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Harap Login untuk melihat Keranjang
          </div></div>');
      	redirect('auth');
    	} else{
		$data['title'] = 'Keranjang';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) ->row_array();
		$data['price']= $this -> db -> get_where('keranjang', ['price' => $this->session->userdata('price')]) ->row_array();
		$id = $this -> db -> get_where('user', ['id' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($kategori);
		$data['produk'] = $this->keranjang_model->get_kerajang_email($kategori);
		$data['keranjang'] = $this->keranjang_model->get_email_id($id)->row_array();
		$data['recent'] = $this->cart->contents();
		$this->load->view('templates/header',$data);
		$this->load->view('auth/basket',$data);
		$this->load->view('templates/footer');
		}
	}

	
	public function detail_produk()
	{	
		if(!$this->session->userdata('email')){
		$data['title'] = 'Detail Produk';
		
		$id=($this->uri->segment(3))?$this->uri->segment(3):0;
		
		$mitra = $this -> db ->get_where('makanan', ['product_id' => $id])->row_array();
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['keranjang'] = $this->keranjang_model->get_email_id($id)->row_array();
		$data['detail'] = $this->keranjang_model->get_produk_id($id)->row_array();
		$data['mitra']= $this -> db -> get_where('mitra', ['id' => $mitra['id_mitra']]) -> row_array();	
		$data['koment'] = $this->keranjang_model->get_koment_produk($id);
		$this->load->view('templates/header_index',$data);
		$this->load->view('auth/detail_barang',$data);
		$this->load->view('templates/footer');
    	} else{
		$data['title'] = 'Detail Produk';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$id=($this->uri->segment(3))?$this->uri->segment(3):0;
		$ka=($this->uri->segment(4))?$this->uri->segment(4):0;
		$mitra = $this -> db ->get_where('makanan', ['product_id' => $id])->row_array();
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['keranjang'] = $this->keranjang_model->get_email_id($id)->row_array();
		$data['detail'] = $this->keranjang_model->get_produk_id($id)->row_array();
		$data['mitra']= $this -> db -> get_where('mitra', ['id' => $mitra['id_mitra']]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$data['koment'] = $this->keranjang_model->get_koment_produk($id);
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$this->load->view('templates/header',$data);
		$this->load->view('auth/detail_barang',$data);
		$this->load->view('templates/footer');
		}
	}

	public function recent($product_id,$user_id){
		$qty = 1;
		$product = $this -> db ->get_where('makanan', ['product_id' => $product_id])->row_array();
		$data = array(
				'id' => $product['product_id'],
				'qty' => $qty,
				'price' => $product['harga'],
				'name'=> $product['nama'],
				'image' => $product['image'],
			);
		$this->cart->insert($data);
		redirect('shopping/detail_produk/'.$product_id.'/'.$user_id,'refresh');
		
	}

	public function cekout_makanan()
	{	

		$id_user = $this-> input -> post('id_user');
		$jumlah = $this-> input -> post('jumlah');
		$user = $this -> db ->get_where('user', ['id' => $id_user])->row_array();
		$keranjang = $this -> db ->get_where('keranjang', ['user' => $id_user])->row_array();
		$dompet = $this -> db ->get_where('dompet', ['user_id' => $id_user])->row_array();

		if ($dompet) {
			if ($dompet['saldo'] >= $jumlah) {

				if ($keranjang) {
				$no_invoice = random_string('numeric', 8);
				$this->db->set('no_invoice', $no_invoice);
			    $this->db->where('user', $id_user);
			    $this->db->update('keranjang');
				redirect('user/cek_out/' . $id_user,'refresh');
				
				} else {
				$this-> session->set_flashdata('message-keranjang', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">Keranjang anda Kosong!!</div></div>');
	            	redirect('shopping/tampil_keranjang/' . $id_user,'refresh');
				}
			} else {

				$this-> session->set_flashdata('message-keranjang', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">Saldo Anda Tidak Mencukupi ! Silahkan isi Saldo anda.</div></div>');
	            	redirect('shopping/tampil_keranjang/' . $id_user,'refresh');
			}
			
		} else {
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">Anda Belum Mempunyai Dompet!! Silahkan Buat Dompet. <form action="'. base_url('auth/dompet').'" method="post" class="form-horizontal"><input type="hidden" name="email" value="'. $user['email'].'"><input type="hidden" name="user_id" value="'. $user['id'].'"><button type="submit" name="simpan" class="btn btn-outline-secondary">Buat Dompet</button></div></div>');
            	redirect('shopping/tampil_keranjang/' . $id_user,'refresh');
		}
		
	}
	
	
	function tambah()
	{	

		$x = $this -> input -> post('product_id');
		$user = $this -> input -> post('user');
		$qty = $this -> input -> post('qty');
		$no = substr($user, 3, 1);
		$product_id = ($no * 10)+$x;
		$makanan = $this -> db ->get_where('keranjang', ['product_id' => $product_id])->row_array();
		$keranjang = $this -> db ->get_where('keranjang', ['no_invoice' => 0])->row_array();
		$id = $this -> db ->get_where('keranjang', ['user' => $user])->row_array();
		

		if($id){
			if($makanan)
			{	
				$z = $makanan['qty'] + $qty;
				$this->db->set('qty', $z );
				$this->db->where('no_invoice =', 0);
		      	$this->db->where('product_id', $makanan['product_id']);
		      	$this->db->update('keranjang');

		      	$this->db->set('qty', $z );
				$this->db->where('no_invoice =', 0);
				$this->db->where('id_user', $user);
		      	$this->db->where('product_id', $x);
		      	$this->db->update('simpan_pesanan');
            	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Barang Telah di tambah ke keranjang</div></div>');
			
            	redirect('shopping/tampil_barang/0/'. $user ,'refresh');
			}
			else{	

	    	$data_produk= array( 
							 'user' => $this->input->post('user'),
							 'product_id' => $product_id,
							 'name' => $this->input->post('nama'),
							 'price' => $this->input->post('harga'),
							 'gambar' => $this->input->post('gambar'),
							 'qty' =>$this->input->post('qty'),
							 'no_invoice' =>0,
							);
	    	$data_produk2= array( 
							 'id_user' => $this->input->post('user'),
							 'product_id' => $x,
							 'qty' =>1,
							 'no_invoice' =>0,
							 'id_mitra' => $this->input->post('mitra'),
							 'status_pesanan' =>0,
							);
			$this-> db ->insert('keranjang', $data_produk);
			$this-> db ->insert('simpan_pesanan', $data_produk2);
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Barang Telah di tambah ke keranjangi</div></div>');
			redirect('shopping/tampil_barang/0/'. $user ,'refresh');}
		}
		else{
		$data_produk= array( 
							 'user' => $this->input->post('user'),
							 'product_id' => $product_id,
							 'name' => $this->input->post('nama'),
							 'price' => $this->input->post('harga'),
							 'gambar' => $this->input->post('gambar'),
							 'qty' =>$this->input->post('qty'),
							 'no_invoice' =>0,
							 
							);
		$data_produk2= array( 
							 'id_user' => $this->input->post('user'),
							 'product_id' => $x,
							 'qty' =>1,
							 'no_invoice' =>0,
							 'id_mitra' => $this->input->post('mitra'),
							 'status_pesanan' =>0,
							);
			$this-> db ->insert('keranjang', $data_produk);
			$this-> db ->insert('simpan_pesanan', $data_produk2);
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Barang Telah di tambah ke keranjang</div></div>');
			redirect('shopping/tampil_barang/0/'. $user ,'refresh');}
		}

	

		

		
	

	function hapus($id_keranjang,$user)
	{	
		$keranjang = $this -> db ->get_where('keranjang', ['id_keranjang' => $id_keranjang])->row_array();
		$nourut = substr($user, 3, 1);
		$x = $keranjang['product_id'] - ($nourut * 10);
		$this->db->delete('keranjang', ['id_keranjang' => $id_keranjang]);

		$this->db->where('id_user', $user);
		$this->db->delete('simpan_pesanan', ['product_id' => $x]);
		$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Barang Telah dihapus</div></div>');
		redirect('shopping/tampil_keranjang/' . $user['user']);
	}

		function hapus_semua($user) 
	{
		
		$this->db->delete('keranjang', ['user' => $user]);
		$this->db->delete('simpan_pesanan', ['id_user' => $user]);
		$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Keranjang Telah dikosongkan</div></div>');	
		redirect('shopping/tampil_keranjang/' . $user);
	}


	public function search(){
		$keyword = $this->input->post('keyword');
		$data['title'] = 'kategori';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
		$ka=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['gambar']=$this->m_admin->get_tipe_iklan($kategori);
		$data['tipe'] = $this->m_admin->get_galeri($kategori);
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$data['produk']=$this->keranjang_model->get_product_keyword($keyword);
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/search', $data);
		$this -> load -> view('templates/footer');
		}


		function update($id_keranjang,$qty)
	{	
		$qty += 1;
		$keranjang = $this -> db ->get_where('keranjang', ['id_keranjang' => $id_keranjang])->row_array();
		$this->db->set('qty', $qty);
      	$this->db->where('id_keranjang', $id_keranjang);
      	$this->db->update('keranjang');
		$this-> session->set_flashdata('message-keranjang', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Barang Telah di Update</div></div>');
		redirect('shopping/tampil_keranjang/' . $keranjang['user']);
	}

	function kurang($id_keranjang,$qty)
	{	
		$qty -= 1;
		$keranjang = $this -> db ->get_where('keranjang', ['id_keranjang' => $id_keranjang])->row_array();
		if(!$qty < 1)
		{
			$this->db->set('qty', $qty);
      		$this->db->where('id_keranjang', $id_keranjang);
      		$this->db->update('keranjang');
			$this-> session->set_flashdata('message-keranjang', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Barang Telah di Update</div></div>');
			redirect('shopping/tampil_keranjang/' . $keranjang['user']);
		} else {
			$this->db->set('qty', 1);
      		$this->db->where('id_keranjang', $id_keranjang);
      		$this->db->update('keranjang');
			$this-> session->set_flashdata('message-keranjang', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">Jumlah pembelian minimal 1</div></div>');
			redirect('shopping/tampil_keranjang/' . $keranjang['user']);
		}
		
	}


	public function filter()
	{
		$filter = $this->input->post('filter');

		if ($filter == 1) {
			$this-> tampil_barangASC();
		} else if($filter == 2){
			$this-> tampil_barangDESC();
		}
		 else {
			$this-> penjual_terbaik();
		}

	}


	public function tampil_barangASC()
	{	
		if(!$this->session->userdata('email')){
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Harap Login untuk melihat Daftar Makanan
          </div></div>');
      	redirect('auth/index/');
    	} else{
		$data['title'] = 'kategori';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$ka=($this->uri->segment(4))?$this->uri->segment(4):0;
		
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$data['gambar']=$this->m_admin->get_tipe_iklan($kategori);
		$data['tipe'] = $this->m_admin->get_galeri($kategori);
		$jumlah_data = $this->keranjang_model->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'shopping/tampil_barangASC/'.$kategori.'/'.$ka;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$from = $this->uri->segment(5);
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data['produk'] = $this->keranjang_model->get_produk_kategoriASC($config['per_page'],$from);
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/category', $data);
		$this -> load -> view('templates/footer');
		}
	}

	public function tampil_barangDESC()
	{	
		if(!$this->session->userdata('email')){
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Harap Login untuk melihat Daftar Makanan
          </div></div>');
      	redirect('auth/index/');
    	} else{
		$data['title'] = 'kategori';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$ka=($this->uri->segment(4))?$this->uri->segment(4):0;
		
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$data['gambar']=$this->m_admin->get_tipe_iklan($kategori);
		$data['tipe'] = $this->m_admin->get_galeri($kategori);
		$jumlah_data = $this->keranjang_model->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'shopping/tampil_barangDESC/'.$kategori.'/'.$ka;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$from = $this->uri->segment(5);
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data['produk'] = $this->keranjang_model->get_produk_kategoriDESC($config['per_page'],$from);
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/category', $data);
		$this -> load -> view('templates/footer');
		}
	}

	public function penjual_terbaik()
	{
		if(!$this->session->userdata('email')){
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Harap Login untuk melihat Daftar Makanan
          </div></div>');
      	redirect('auth/index/');
    	} else{
		$data['title'] = 'kategori';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$ka=($this->uri->segment(4))?$this->uri->segment(4):0;
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($ka);
		$data['gambar']=$this->m_admin->get_tipe_iklan($kategori);
		$data['tipe'] = $this->m_admin->get_galeri($kategori);
		$jumlah_data = $this->keranjang_model->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'shopping/penjual_terbaik/'.$kategori.'/'.$ka;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$from = $this->uri->segment(5);
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data['produk'] = $this->keranjang_model->get_produk_ratingDESC($config['per_page'],$from);
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/category', $data);
		$this -> load -> view('templates/footer');
	}
  }


}
?>