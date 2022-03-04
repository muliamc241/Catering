<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class User extends CI_Controller
	{	
		public function __construct()
		{	
			parent::__construct();
			$this->load->model('keranjang_model');
			$this->load->model('m_admin');
			$this->load->helper('date');
			$this -> load -> library('form_validation');
		}

		public function index()
		{	
			$data['title'] = 'Beranda User';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$id = $this -> db -> get_where('user', ['id' => $this->session->userdata('email')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$data['gambar']=$this->m_admin->get_tipe_galeri();
			$data['detail'] = $this->keranjang_model->get_email_id($id)->row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/index_user', $data);
			$this -> load -> view('templates/footer'); 
		}


		public function register_toko()
		{
			$data['title'] = 'Mitra Register';
	        $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$id = $this -> db -> get_where('user', ['id' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['gambar']=$this->m_admin->get_tipe_galeri($kategori);
			$data['tipe'] = $this->m_admin->get_galeri($kategori);
			$data['detail'] = $this->keranjang_model->get_email_id($id)->row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
	        $this -> load -> view('templates/header', $data);
	        $this -> load -> view('auth/register_toko',$data);
	        $this -> load -> view('templates/footer');
		}

		public function index_toko($id)
		{	
			$user = $this-> db -> get_where('user', ['id' => $id]) -> row_array();
			$mitra = $this-> db -> get_where('mitra', ['email' => $user['email']]) -> row_array();
		      //jika user aktif
		      if($user['toko'] == 1){
		      	if ($mitra['is_active'] == 1) {
		      		$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
		          Anda sedang menggunakan Akun Mitra.
		          </div></div>');
		      		redirect('mitra/index_mitra/'. $mitra['id'],'refresh');
		      	} else {
		      	   $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Maaf toko anda belum aktif, Tunggu akan segera kami proses 1 x 24 jam!!
			          </div></div>');
		      		redirect('user/Profil','refresh');
		      	  }
		      } else {
		      	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Maaf anda belum mempunyai toko!!
			          </div></div>');
		      	redirect('user/Profil/'. $id,'refresh');
		      }
		      	
		}

		public function register_mitra()
		{ 
		  	$this-> form_validation -> set_rules('nama_toko', 'Nama', 'required|trim|min_length[5]',[
		      'required' =>'Nama Tidak Boleh Kosong',
		      'min_length' => 'Nama terlalu pendek!'
		    ]);
		    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|is_unique[mitra.email]',[
		      'required' =>'Email Tidak Boleh Kosong',
		      'is_unique' => 'Email Telah Terdaftar, Gunakan Email yang lain!'
		    ]);
		    $this-> form_validation -> set_rules('password1', 'Password', 'required|trim|min_length[6]|max_length[16]|matches[password2]',[
		        'min_length' => 'Password terlalu pendek!',
		        'max_length' => 'Password terlalu panjang!',
		        'required' =>'Password Tidak Boleh Kosong'
		    ]);
		    $this-> form_validation -> set_rules('password2', 'Password', 'required|trim|matches[password1]',[
		        'matches' => 'Password Tidak sama!'
		    ]);
		    $this-> form_validation -> set_rules('no_hp', 'No_hp', 'required|trim|min_length[11]|max_length[13]|is_unique[mitra.no_hp]',[
		      'required' =>'No Telepon Tidak Boleh Kosong',
		      'is_unique' => 'Nomor Telepon Telah Terdaftar!'
		    ]);
		    if($this-> form_validation-> run() == false) {
		        $data['title'] = 'Mitra Register';
		        $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
				$id = $this -> db -> get_where('user', ['id' => $this->session->userdata('email')]) -> row_array();
				$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
				$user=($this->uri->segment(3))?$this->uri->segment(3):0;
				$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
				$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
				$data['gambar']=$this->m_admin->get_tipe_galeri($kategori);
				$data['tipe'] = $this->m_admin->get_galeri($kategori);
				$data['detail'] = $this->keranjang_model->get_email_id($id)->row_array();
				$data['kategori'] = $this->keranjang_model->get_kategori();
		        $dariDB = $this->m_admin->cekidmitra();
		        // contoh MTR, angka 3 adalah awal pengambilan angka, dan 1 jumlah angka yang diambil
		        $nourut = substr($dariDB, 3, 1);
		        $id_mitraSekarang = $nourut + 1;
		        $data['kode_mitra'] = $id_mitraSekarang;
		        $this -> load -> view('templates/header', $data);
		        $this -> load -> view('auth/register_toko',$data);
		        $this -> load -> view('templates/footer');
		    } else {
		        $email = $this -> input -> post('email');
		        $data = [
		        	'id' => $this -> input -> post('id_mitra'),
		            'nama_toko' =>htmlspecialchars( $this -> input -> post('nama_toko', true)),
		            'email' => htmlspecialchars($email),
		            'image' => 'default.jpg',
		            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
		            'no_hp' => $this -> input -> post('no_hp'),
		            'role_id' => 3,
		            'is_active' => 0,
		            'date_created' => time()

		        ];

		        $this-> db ->insert('mitra', $data);

		        $this->db->set('toko', 1);
	      		$this->db->where('email', $email);
	      		$this->db->update('user');
		        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
		          Selamat Toko anda berhasil di buat!, Silahkan Tunggu Admin untuk Aktivasi Toko!
		          </div></div>');
		        redirect('user/profil','refresh');
		    }
		    
		  }

		public function profil()
		{	
			$data['title'] = 'Profil User';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$data['kategori'] = $this->keranjang_model->get_kategori();   
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/profil', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function map()
		{	
			// $data['title'] = 'Profil User';
			// $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			// $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			// $id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$this->load->library('googlemaps');

			$config['center'] = '3.5912919, 98.6675712';
			$config['zoom'] = 'auto';
			$config['places'] = TRUE;
			$config['placesAutocompleteInputID'] = 'myPlaceTextBox';
			$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
			$config['placesAutocompleteOnChange'] = "var lat = event.latLng.lat();
												     var lng = event.latLng.lng();     
												     $('#latitude').val(lat);
												     $('#longitude').val(lng);";
			$this->googlemaps->initialize($config);
			$data['map'] = $this->googlemaps->create_map();

			// $this->load->view('view_file', $data);
			$this -> load -> view('templates/header_user_map', $data);
			$this -> load -> view('auth/map', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function alamat_peta()
		{	
			$user = $this -> input -> post('id');

			$data = [
			'id_user' => $user,
			'lat' => $this -> input -> post('latitude'),
			'lang' => $this -> input -> post('longitude'),


		];
        	$this-> db ->insert('map', $data);
        	redirect('user/profil','refresh');

		}

		function viewmarker(){
		$no_invoice=($this->uri->segment(3))?$this->uri->segment(3):0;
		$map = $this-> db -> get_where('map', ['no_invoice' => $no_invoice]) -> row_array();
		$this->load->library('googlemaps');
			$lat = $map['lat'];
            $lang = $map['lang'];
            $config=array();
            $config['center']="$lat, $lang";
            $config['zoom']=17;
            $config['map_height']="400px";
            $this->googlemaps->initialize($config);
            $marker=array();
            $marker['position']="$lat,$lang";
            $this->googlemaps->add_marker($marker);
            $data['map']=$this->googlemaps->create_map();
        $this->load->view('auth/alamat',$data);
		}

		public function pesanan_user()
		{	


			$data['title'] = 'Pesanan User';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
			$data['produk'] = $this->keranjang_model->get_pesanan_user($id,$kategori);
			$data['jmlh_pesanan'] = $this->keranjang_model->JumlahPesanan($id);	
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($id);			
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/pesanan_user', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function pesanan_belum_bayar()
		{	

			$data['title'] = 'Pesanan Belum Di Bayar';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['pesanan']= $this -> db -> get_where('pesanan', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['invoice']= $this -> db -> get_where('invoice', ['id_user' => $this->session->userdata('id')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['produk'] = $this->keranjang_model->get_invoice_blmBayar($id);
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($id);			
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/belum_di_bayar', $data);
			$this -> load -> view('templates/footer'); 
		}


		public function detail_pesanan()
		{	


			$data['title'] = 'Detail Pesanan';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$no_invoice=($this->uri->segment(3))?$this->uri->segment(3):0;
			$user=($this->uri->segment(4))?$this->uri->segment(4):0;
			$data['invoice']= $this -> db -> get_where('pesanan', ['invoice' => $no_invoice]) -> row_array();
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$data['produk'] = $this->keranjang_model->get_simpanpesanan_no_invoice($no_invoice);
			$this->load->library('ckeditor');
	        $this->ckeditor->basePath = base_url().'ckeditor/';
	        $this->ckeditor->config['toolbar'] = array(
	                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
	                                                    );
	        $this->ckeditor->config['language'] = 'it';
	        $this->ckeditor->config['width'] = '465px';
	        $this->ckeditor->config['height'] = '200px';			
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/detail_pesanan', $data);
			$this -> load -> view('templates/footer'); 
		}


		public function dompet()
		{	
			$data['title'] = 'Dompet';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array(); 
			$data['invoice']= $this -> db -> get_where('pesanan', ['email' => $this -> session-> userdata('email')]) -> row_array(); 
			$id = ($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($id);
			$data['isi_saldo'] = $this->keranjang_model->get_log_isisaldo($id);
			$data['tarik_saldo'] = $this->keranjang_model->get_log_tarik_saldo($id);
			$data['produk'] = $this->keranjang_model->get_pesanan_user($id);
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/dompet_home', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function history()
		{	
			$data['title'] = 'Dompet';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array(); 
			$data['invoice']= $this -> db -> get_where('pesanan', ['email' => $this -> session-> userdata('email')]) -> row_array(); 
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($id);
			$data['isi_saldo'] = $this->keranjang_model->get_log_isisaldo($id);
			$data['produk'] = $this->keranjang_model->get_pesanan_user($id);
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/histori_dompet', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function isi_saldo()
		{	
			$data['title'] = 'Dompet';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array(); 
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($id);
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/isi_saldo', $data);
			$this -> load -> view('templates/footer'); 
		}


		public function tarik_saldo()
	    {
	      $this-> form_validation -> set_rules('saldo', 'Saldo', 'required|trim|min_length[5]|is_numeric',[
	          'required' =>'Jumlah isi saldo Tidak Boleh Kosong',
	          'min_length' => 'Minimal Penarikan Rp, 50.000',
	          'is_numeric' => 'Yang anda masukkan bukan angka!!'
	      ]);
	      $this-> form_validation -> set_rules('bank', 'Bank', 'required|trim|in_list[BNI,Mandiri,BCA,BRI]',[
	          'required' =>'Bank tidak Boleh Kosong',
	          'in_list' => 'Pilih salah satu Bank'
	      ]);
	      $this-> form_validation -> set_rules('rekening', 'Rekening', 'required|trim|min_length[6]|is_numeric',[
	          'required' =>'Nomor rekening Tidak Boleh Kosong',
	          'min_length' => 'Minimal 6 digit',
	          'is_numeric' => 'Yang anda masukkan bukan angka!!'
	      ]);
	      if($this-> form_validation-> run() == false) {
	        $data['title'] = 'Dompet';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array(); 
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($id);
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/tarik_saldo', $data);
			$this -> load -> view('templates/footer');
	      } else {
	        $dompet = $this-> db -> get_where('dompet', ['email' => $this->session->userdata('email')]) -> row_array();
	        $user = $this-> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
	        if ($dompet['saldo'] > 50000) {
	          $email = $this-> input->post('email');
	          $saldo = $this-> input->post('saldo');
	          $bank = $this-> input->post('bank');
	          $rekening = $this-> input->post('rekening');

	          $data = [
	          'id_penarik' => $user['id'],
	          'email' => $email,
	          'jumlah' => $saldo,
	          'bank' => $bank,
	          'no_rekening' => $rekening,
	          'date_created' => time(),
	          'status' => 0

	          ];
	              $this-> db ->insert('tarik_saldo', $data);
	              $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
	                Permohonan tarik saldo anda akan di proses 1 x 24 jam oleh admin, Terima Kasih.
	                </div></div>');
	              redirect('user/dompet/' . $user['id'],'refresh');
	          } else {
	            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
	                Saldo anda kurang dari batas penarikan!
	                </div></div>');
	              redirect('mitra/dompet_mitra','refresh');
	          }
	        }
	    }

		public function vedit_profil()
		{	
			$data['title'] = 'Edit Profil';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$data['kategori'] = $this->keranjang_model->get_kategori();   
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/edit_profil', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function vedit_password()
		{	
			$data['title'] = 'Ganti Password';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori(); 
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);  
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/ganti_password', $data);
			$this -> load -> view('templates/footer'); 
		}


		public function detail_mitra()
		{	
			$data['title'] = 'Detail Mitra';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        	$data['nama_catering'] = $this->keranjang_model->get_produk_nama_catering($id);
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$data['mitra']= $this -> db -> get_where('mitra', ['id' => $id]) -> row_array();
			$data['makanan']= $this -> db -> get_where('makanan', ['product_id' => $id]) -> row_array();
			$user=($this->uri->segment(4))?$this->uri->segment(4):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('mitra/detail_mitra', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function detail_mitra2()
		{	
			$data['title'] = 'Detail Mitra';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$id=($this->uri->segment(3))?$this->uri->segment(3):0;
			if (($this->uri->segment(3))?$this->uri->segment(3):0 and $id) {
				$kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
				$data['nama_catering'] = $this->keranjang_model->get_produk_kategori($kategori);
			} else {

			}
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$data['mitra']= $this -> db -> get_where('mitra', ['id' => $id]) -> row_array();
			$data['makanan']= $this -> db -> get_where('makanan', ['product_id' => $id]) -> row_array();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);

			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/detail_mitra2', $data);
			$this -> load -> view('templates/footer'); 
		}

		public function edit_profil()
		{
			$this-> form_validation -> set_rules('nama', 'Nama', 'required|trim',[
		      'required' => 'Nama Tidak Boleh Kosong !',
		    ]);
		    $this-> form_validation -> set_rules('no_hp', 'No_hp', 'required|trim|min_length[11]|max_length[13]',[
		      'required' => 'Nomer HP Tidak Boleh Kosong !',
		      'min_length' => 'Nomer HP minimal 11 angka',
		      'max_length' => 'Nomer HP maximal 13 angka'
		    ]);
		    if($this-> form_validation-> run() == false) {
		    $data['title'] = 'Profil';
		    $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		    $data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
		    $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
		    $this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/edit_profil', $data);
			$this -> load -> view('templates/footer');
		    } else {
			$nama = $this -> input -> post('nama');
			$no_hp = $this -> input -> post('no_hp');
			$email = $this -> input -> post('email');
			
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$nmfile = "Profil " . $nama;
				$config['upload_path']          = './img/profile/';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['overwrite']            = true;
		        $config['max_size']             = 2048; // 2MB
		        $config['file_name'] = $nmfile;
		        $this->load->library('upload', $config);

		        if($this->upload->do_upload('image')){
		        	$user = $this-> db -> get_where('user', ['email' => $email]) -> row_array();
		        	$old_image = $user['image'];
		        	if ($old_image != 'default.jpg'){
		        		unlink(FCPATH . '/img/profile/' . $old_image);
		        	}


		        	$new_image = $this->upload->data('file_name');
		        	$this->db->set('image', $new_image);

		        }else{
		        	echo $this->upload->display_errors();
		        }
			}
	         
      
      		$this->db->set('nama', $nama);
      		$this->db->where('email', $email);
      		$this->db->update('user');

      		$this->db->set('no_hp', $no_hp);
      		$this->db->where('email', $email);
      		$this->db->update('user');
      		$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat Profil anda telah di perbarui!
          </div></div>');
        	redirect('user/profil','refresh');
		}	
	}

	public function edit_password()
		{
			$this-> form_validation -> set_rules('password_lama', 'Password_lama', 'required|trim',[
		      'required' =>'Password Lama Tidak Boleh Kosong',
		    ]);
		    $this-> form_validation -> set_rules('password_baru1', 'Password', 'required|trim|min_length[6]|max_length[16]|matches[password_baru2]',[
		        'min_length' => 'Password terlalu pendek!',
		        'max_length' => 'Password terlalu panjang!',
		        'required' =>'Password Tidak Boleh Kosong'
		    ]);
		    $this-> form_validation -> set_rules('password_baru2', 'Password', 'required|trim|matches[password_baru1]',[
		        'matches' => 'Password Tidak sama!'
		    ]);
		    if($this-> form_validation-> run() == false) {
		    $data['title'] = 'Ganti Password';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();  
			$user=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);   
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/ganti_password', $data);
			$this -> load -> view('templates/footer');
		    } else {
		    $email = $this -> input -> post('email');
		    $password_lama = $this -> input -> post('password_lama');
		    $password_baru = password_hash($this -> input -> post('password_baru1'), PASSWORD_DEFAULT);
		    $user = $this-> db -> get_where('user', ['email' => $email]) -> row_array();
		     if (password_verify($password_lama, $user['password'])) {
		     	if($this -> input -> post('password_baru1') != $this -> input -> post('password_lama')){
		     	$this->db->set('password', $password_baru);
	      		$this->db->where('email', $email);
	      		$this->db->update('user');
	      		$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
		        Selamat Password anda telah di perbarui!
		        </div></div>');
		        redirect('user/profil','refresh');
	      		} else {
	      			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
		          Password Baru Tidak boleh sama dengan Password lama!
		          </div></div>');
	      		redirect('user/vedit_password/'.$user['id'],'refresh');
	      		}
		     } else {
		     	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
	            Password Lama Salah!
 	            </div></div>');
 	            redirect('user/vedit_password/'.$user['id'],'refresh');
		     }      		
		}	
	}
	
	public function tambahh()
	{
		$user = $this->input->post('user');
		$email = $this->input->post('email');
		$keranjang = $this-> db -> get_where('keranjang', ['user' => $user]) -> row_array();

		if($keranjang){
			$invoice = $this-> db -> get_where('invoice', ['email' => $email]) -> row_array();
			$data = [
			'invoice' => $invoice['no_invoice'],
			'id_user' => $user,
			'email' => $email,
			'product_id' => $keranjang['product_id'],
			'name' => $keranjang['name'],
			'price' => $keranjang['price'],
			'date_create' => date(),

		];
        	$this-> db ->insert('pesanan', $data);
        	redirect('user','refresh');
		} else {
			$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Maaf saldo anda tidak mencukupi!!!
			          </div></div>');
			        	redirect('user/review','refresh');
		}
		
	}

	public function cek_out()
	{
		$this-> form_validation -> set_rules('nama', 'Nama', 'required|trim',[
      	'required' =>'Nama Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('last_nama', 'Last_Nama', 'required|trim',[
      	'required' =>'Nama Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('alamat', 'Alamat', 'required|trim|min_length[5]',[
      	'required' =>'alamat Tidak Boleh Kosong',
      	'min_length' => 'Alamat terlalu pendek!'
    ]);

    	$this-> form_validation -> set_rules('no_hp', 'No_hp', 'required|trim|min_length[11]|max_length[13]',[
      	'required' =>'No Telepon Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('kecamatan', 'Kecamatan', 'required',[
      	'required' =>'Kecamatan Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('tgl_acara', 'Tgl_acara', 'required',[
      	'required' =>'Kecamatan Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('jam_acara', 'Jam_acara', 'required',[
      	'required' =>'Kecamatan Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('kode_pos', 'Kode_Pos', 'required',[
      	'required' =>'Kode Pos Tidak Boleh Kosong',
    ]);
    	$this-> form_validation -> set_rules('latitude', 'LATITUDE', 'required',[
      	'required' =>'Harap Beri tanda lokasi pesta anda di Peta yang tersedia',
    ]);
    	$this-> form_validation -> set_rules('longitude', 'LONGITUDE', 'required',[
      	'required' =>'Harap Beri tanda lokasi pesta anda di Peta yang tersedia',
    ]);
    	
    	if($this-> form_validation-> run() == false) {
		$data['title'] = 'Cek Out Alamat';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$user=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
		 $this->load->library('googlemaps');
            $config = array();
			$config['center'] = 'auto';
			$config['onboundschanged'] = 'if (!centreGot) {
				var mapCentre = map.getCenter();
				marker_0.setOptions({
					position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
				});
			}
			centreGot = true;';
            $config['zoom']="auto";
            $config['map_width']="700";
            $config['map_height']="300";
            $config['scaleControlPosition'] = 'BOTTOM_RIGHT';
            $this->googlemaps->initialize($config);
            $marker = array();
            $marker['onclick'] = "var lat = event.latLng.lat();
							      var lng = event.latLng.lng();     
							      $('#latitude').val(lat);
							      $('#longitude').val(lng);";
			$marker['draggable'] = true;
			$marker['ondragend'] = "var lat = event.latLng.lat();
							      var lng = event.latLng.lng();     
							      $('#latitude').val(lat);
							      $('#longitude').val(lng);";					      
		$this->googlemaps->add_marker($marker);
        $data['map']=$this->googlemaps->create_map();
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['produk'] = $this->keranjang_model->get_kerajang($kategori);
		$data['kecamatan'] = $this->keranjang_model->kecamatan();
		$this -> load -> view('templates/header_user_map', $data);
		$this -> load -> view('auth/cek_out', $data);
		$this -> load -> view('templates/footer');
		} else {
			$tgl = $this -> input -> post('tgl_acara');	
			$jam = $this -> input -> post('jam_acara');		
			$user = $this-> input->post('user');
			$email= $this-> input->post('email');
			$jumlah = $this-> input->post('jumlah');
			$dp = 0.3*$jumlah ;
			$no_invoice = $this -> input -> post('no_invoice');
			$keranjang = $this-> db -> get_where('keranjang', ['user' => $user]) -> row_array();
			$dompet = $this-> db -> get_where('dompet', ['email' => $email]) -> row_array();
			if($tgl > date('Y-m-d')){
			  if($dompet){
				if($dompet['saldo'] < $dp){
					$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Maaf saldo anda tidak mencukupi!!!
			          </div></div>');
			        	redirect('user','refresh');
				} else {
	        	$data = [
	        	'no_invoice' => $no_invoice,
	        	'id_user' => $user,
	            'nama' =>htmlspecialchars( $this -> input -> post('nama', true)),
	            'last_nama' => $this -> input -> post('last_nama'),
	            'alamat' => $this -> input -> post('alamat'),
	            'no_hp' => $this -> input -> post('no_hp'),
	            'kecamatan' => $this -> input -> post('kecamatan'),
	            'kode_pos' => $this -> input -> post('kode_pos'),
	            'total' => $jumlah,
	            'tgl_acara' => $tgl,
	            'jam_acara' => $jam,
	            'date_created' => time()

		        ];

		        $this-> db ->insert('invoice', $data);

		        $data = [
				'no_invoice' => $no_invoice,
				'lat' => $this -> input -> post('latitude'),
				'lang' => $this -> input -> post('longitude'),

				];
	        	$this-> db ->insert('map', $data);
		        redirect('user/pembayaran2/' . $no_invoice . '/'.$user,'refresh');
				}
			} else {
				$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Anda belum mempunyai dompet!
			          </div></div>');
			        	redirect('user','refresh');
				}
			} else {
			  	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Tanggal acara tidak Valid!
			          </div></div>');
			  	redirect('user/cek_out/' . $user,'refresh');
			  }
		}
	}

	public function listKodePos(){
    // Ambil data ID kecamatan yang dikirim via ajax post
    $id_kecamatan = $this->input->post('id_kecamatan');
    
    $kodepos = $this->keranjang_model->viewByKecamatan($id_kecamatan);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($kodepos as $data){
      $lists .= "<option value='".$data->kode_pos ."'>".$data->kode_pos."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_kodepos'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }


	

	public function pembayaran2()
	{	
		$data['title'] = 'Cek Out Pembayaran';
		$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
		$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
		$no_invoice=($this->uri->segment(3))?$this->uri->segment(3):0;
		$user=($this->uri->segment(4))?$this->uri->segment(4):0;
		$data['invoice']= $this -> db -> get_where('invoice', ['no_invoice' => $no_invoice]) -> row_array();
		$data['kategori'] = $this->keranjang_model->get_kategori();
		$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
		$this -> load -> view('templates/header', $data);
		$this -> load -> view('auth/bayar_selesai', $data);
		$this -> load -> view('templates/footer');
	}

	public function test_test()
	{	
		$this -> load -> view('auth/test_map');
	}

	public function bayar()
	{	
		$user = $this->input->post('user');
		$email= $this-> input->post('email');
		$pin= $this-> input->post('pin');
		$saldo = $this-> input->post('saldo');
		$id_mitra = $this-> input->post('mitra');
		$total= $this-> input->post('total');
		$dp = 0.3*$total ;
		$no_invoice= $this-> input->post('id_invoice');
		$dompet = $this-> db -> get_where('dompet', ['email' => $email]) -> row_array();
		$mitra = $this-> db -> get_where('mitra', ['id' => $id_mitra]) -> row_array();
			// cek user sudah punnya dompet
			if($dompet){
			  if(password_verify($pin, $dompet['pin'])){	
				if ($saldo < $dp){
					$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Maaf saldo anda tidak mencukupi!!!
			          </div></div>');
						 $this->db->delete('invoice', ['email' => $email]);
			        	redirect('shopping/tampil_keranjang/' .$dompet['user_id'],'refresh');
				}else {
					$sisa =	$saldo - $dp;

					$this->db->set('saldo', $sisa);
		      		$this->db->where('email', $email);
		      		$this->db->update('dompet');

					$invoice = $this-> db -> get_where('invoice', ['no_invoice' => $no_invoice]) -> row_array();

					$data = [
					'invoice' => $invoice['no_invoice'],
					'id_user' => $user,
					'email' => $email,
					'total' => $invoice['total'],
					'saldo_awal' => $saldo,
					'date_created' => time(),
					'tgl_acara' => $invoice['tgl_acara'],
					'tgl_pesan' => date('Y-m-d')


					];
					
		        	$biaya = [
					'no_invoice' => $invoice['no_invoice'],
					'id_mitra' => $this->input->post('mitra'),
					'jumlah' => $invoice['total'],
					];
					$this-> db ->insert('simpan_biaya', $biaya);
					$this-> db ->insert('pesanan', $data);
		        	$keranjang = $this-> db -> get_where('keranjang', ['no_invoice' => $invoice['no_invoice']]) -> row_array();
		        	$noid_user = substr($user, 3, 1);
		        	$kode = $invoice['no_invoice'] + $noid_user;
		        	$this->db->set('no_invoice',  $invoice['no_invoice']);
				    $this->db->where('id_user', $user);
				    $this->db->update('simpan_pesanan');

				    $this->db->set('id_user', $kode);
				    $this->db->where('no_invoice',  $invoice['no_invoice']);
				    $this->db->update('simpan_pesanan');

		        	$this->db->delete('keranjang', ['no_invoice' => $invoice['no_invoice']]);
		        	$email_mitra = $mitra['email'];
		        	$no_invoicee = $invoice['no_invoice'];
		        	$this -> _sendMail_pesanan($email_mitra,$email,$no_invoicee, 'pesanan');
		        	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
			         	Pesanan anda telah di bayar, silahkan tunggu Mitra kami Menerima pesanan Anda
			          </div></div>');
		        	redirect('user/index/'. $user,'refresh');
		        }
		      }else {
				$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Pin anda salah
			          </div></div>');
			        	redirect('user/review/' . $no_invoice . '/'. $dompet['user_id'],'refresh');
			        }
			} else {
				$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Maaf anda belum mempunyai dompet
			          </div></div>');
			        	redirect('user/review/'. $no_invoice . '/' . $dompet['user_id'],'refresh');
			}
		}

		private function _sendMail_pesanan($email_mitra,$email,$no_invoicee, $type) 
    {
        $ci = get_instance();
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "cateringmart2019@gmail.com";
        $config['smtp_pass'] = "Angsana1";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        $ci->email->from('cateringmart2019@gmail.com', 'Catering (do not raply)');
        $ci->email->to($email_mitra);
        if($type == 'pesanan') {
          $ci->email->subject('Pesanan');
          $ci->email->message('<h3>Hai, '. $email_mitra . '</h3><br> <p> '.$email.' telah melakukan pesanan dengan nomor pesanan '.$no_invoicee.' segera konfirmasi pesanan tersebut dalam 2 x 24 jam, jika tidak pesanan akan batal otomatis.</p>');
        } else if($type == 'rubah_tanggal') {
          $ci->email->subject('Perubahan Tanggal Acara');
          $ci->email->message('<h3>Hai, '. $email_mitra . '</h3><br> <p> '.$email.' telah melakukan perubahan tanggal acara pada pesanan dengan nomor pesanan '.$no_invoicee.' Silahkan lihat detail pesanan tersebut.</p>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

		public function review()
		{
			$data['title'] = 'Cek Out Pembayaran';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
			$data['dompet']= $this -> db -> get_where('dompet', ['email' => $this -> session-> userdata('email')]) -> row_array();
			$data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
			
			$id = $this -> db -> get_where('user', ['id' => $this->session->userdata('email')]) -> row_array();
			$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
			$data['invoice']= $this -> db -> get_where('invoice', ['no_invoice' => $kategori]) -> row_array();
			$no_invoice=($this->uri->segment(3))?$this->uri->segment(3):0;
			$user=($this->uri->segment(4))?$this->uri->segment(4):0;
			$data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
			$data['produk'] = $this->keranjang_model->get_kerajang_no_invoice($no_invoice);
			$data['keranjang'] = $this->keranjang_model->get_email_id($id)->row_array();
			$data['kategori'] = $this->keranjang_model->get_kategori();
			$this -> load -> view('templates/header', $data);
			$this -> load -> view('auth/review', $data);
			$this -> load -> view('templates/footer');
		}

		public function selesaikan_pesanan($id_pesanan)
      { 
        $pesanan = $this-> db -> get_where('simpan_pesanan', ['id' => $id_pesanan]) -> row_array();
        $simpan_biaya = $this-> db -> get_where('simpan_biaya', ['no_invoice' => $pesanan['no_invoice']]) -> row_array();
        $makanan = $this-> db -> get_where('makanan', ['product_id' => $pesanan['product_id']]) -> row_array();
        $y = $makanan['harga'];
        $x = $simpan_biaya['jumlah'] - $y;

         $this->db->set('status_pesanan', 4);
         $this->db->where('id', $id_pesanan);
         $this->db->update('simpan_pesanan');

         $this->db->set('jumlah', $x);
         $this->db->where('no_invoice', $pesanan['no_invoice']);
         $this->db->update('simpan_biaya');

         $this->db->set('dompet_saldo', $y);
         $this->db->where('id', $pesanan['id_mitra']);
         $this->db->update('mitra');

         $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                Pesanan telah di selesaikan silahkan reting kinerja mitra kami dengan jujur. Dana akan di teruskan ke penjual, Terima kasih telah menggunakan Catering mart.
                </div></div>');
         redirect('user/detail_pesanan/'. $pesanan['no_invoice'].'/'.$pesanan['id_user'],'refresh');
      }


      public function rate_pesanan()
      { 
      	$id_pesanan = $this-> input->post('id_pesanan');
      	$product_id = $this-> input->post('product_id');
        $pesanan = $this-> db -> get_where('simpan_pesanan', ['id' => $id_pesanan]) -> row_array();
        $makanan = $this-> db -> get_where('makanan', ['product_id' => $product_id]) -> row_array();
        $saran = $this-> input->post('saran');
        if (empty($saran)) {
        	$saran ='User Tidak Memberi Saran';
        } else {
        	$saran = $this-> input->post('saran');
        }
        $makanan['rating'] += $this-> input->post('rate');
        $data = [
        		'no_invoice' => $pesanan['no_invoice'],
				'id_mitra' => $pesanan['id_mitra'],
				'id_user' => $this->input->post('id_user'),
				'product_id' => $product_id,
				'koment' => $this-> input->post('koment'),
				'saran' => $saran,
				'rate' => $this-> input->post('rate'),
				'date_created' => time()
				];

		 $this-> db ->insert('rating', $data);

		$cek = $this->keranjang_model->get_koment_produk($product_id);
        $i = 0;
        $x = 0;
        $z = 0;
        foreach ($cek as $row) {
        	$i++;
        	$x += $row['rate'];
        }

        $z = $x / $i;

		 
		 $this->db->set('status_pesanan', 6);
         $this->db->where('no_invoice', $pesanan['no_invoice']);
         $this->db->update('simpan_pesanan');

		 $this->db->set('rating', $z);
         $this->db->where('product_id', $product_id);
         $this->db->update('makanan');
					
         $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
               Terima kasih telah mereting Kinerja Mitra kami.
                </div></div>');
         redirect('user/pesanan_user/'. $pesanan['id_user'],'refresh');
      }

		public function tambah_saldo()
		{
			$this-> form_validation -> set_rules('saldo', 'Saldo', 'required|trim|min_length[6]|is_numeric',[
	      	'required' =>'Jumlah isi saldo Tidak Boleh Kosong',
	      	'min_length' => 'Minimal Isi Rp, 100.000',
	      	'is_numeric' => 'Yang anda masukkan bukan angka!!'
	    ]);
			if($this-> form_validation-> run() == false) {
				redirect('user/isi_saldo','refresh');
			} else {
			$user = $this-> input->post('id_user');
			$email = $this-> input->post('email');
			$saldo = $this-> input->post('saldo');

			

			$upload_image = $_FILES['image']['name'];
			$user_nama = $this-> db -> get_where('user', ['id' => $user]) -> row_array();
			if ($upload_image) {
				$nmfile = "BuktiTF " . $user_nama['nama'];
				$config['upload_path']          = './img/admin/bukti_pembayaran/';
		        $config['allowed_types']        = 'jpeg|jpg|png';
		        $config['overwrite']            = true;
		        $config['max_size']             = 2048; // 2MB
		        $config['file_name'] = $nmfile;
		        $this->load->library('upload', $config);

		        if($this->upload->do_upload('image')){
		        	$new_image = $this->upload->data('file_name');
		        }else{
		        	echo $this->upload->display_errors();
		        }
			}

			$data = [
					'id_user' => $user,
					'email' => $email,
					'nama_pengirim' => $this-> input->post('nama_pengirim'),
					'jumlah' => $saldo,
					'image' => $new_image,
					'date_created' => time(),
					'status_isisaldo' => 0

					];
		        	$this-> db ->insert('isi_saldo', $data);
		        	$this -> _sendMail_isisaldo($email,$saldo, 'permohonanisisaldo');
		        	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
			         	Permohonan Isi saldo anda telah kami terima, silahkan tunggu kami akan mengirim saldo anda! Terima Kasih
			          </div></div>');
		        	redirect('user/dompet/'.$user,'refresh');
		        }



		}

		private function _sendMail_isisaldo($email,$jumlah, $type) 
    {
        $ci = get_instance();
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "cateringmart2019@gmail.com";
        $config['smtp_pass'] = "Angsana1";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        $ci->email->from('cateringmart2019@gmail.com', 'Catering (do not raply)');
        $ci->email->to('cs.cateringmart2019@gmail.com');
        if($type == 'permohonanisisaldo') {
          $ci->email->subject('Permohonan Isi Saldo');
          $ci->email->message('<h3>Hai, Admin </h3><br> <p> '.$email.' telah mengajukan permohonan isi saldo sebesar Rp, '. number_format($jumlah,0,",",".").' segera konfirmasi Pengisian isi saldo akun tersebut.</p>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

		public function rubah_tanggal()
		{
			$invoice = $this -> input -> post('no_invoice');
			$id_user = $this -> input -> post('id_user');
			$this-> form_validation -> set_rules('tgl_acara', 'Tgl_acara', 'required',[
	      	'required' =>'Tanggal Acara Tidak boleh kosong!',
	    	]);
	    	$this-> form_validation -> set_rules('jam_acara', 'Jam_acara', 'required',[
	      	'required' =>'Jam Acara Tidak boleh kosong!',
	    	]);
			if($this-> form_validation-> run() == false) {
				redirect('user/detail_pesanan/'.$invoice.'/'.$id_user,'refresh');
			} else {

				$tgl_acara = $this -> input -> post('tgl_acara');
				$jam_acara = $this -> input -> post('jam_acara');
				$simpan_pesanan = $this->db->get_where('simpan_pesanan', ['no_invoice' => $invoice])-> row_array();
				$mitra = $this->db->get_where('mitra', ['id' => $simpan_pesanan['id_mitra']])->row_array();
				$user= $this->db->get_where('user', ['id' => $id_user])->row_array();
				$email_mitra = $mitra['email'];
				$email = $user['email'];
				if ($tgl_acara > date('d m Y')) {
					$this->db->set('tgl_acara', $tgl_acara);
		        	$this->db->where('invoice', $invoice);
		        	$this->db->update('pesanan');

		        	$this->db->set('tgl_acara', $tgl_acara);
		        	$this->db->set('jam_acara', $jam_acara);
		        	$this->db->where('no_invoice', $invoice);
		        	$this->db->update('invoice');

		        	$this -> _sendMail_pesanan($email_mitra,$email,$invoice, 'rubah_tanggal');
		        	$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
			          Tanggal Acara berhasil Di rubah!
			          </div></div>');
			        redirect('user/detail_pesanan/'.$invoice.'/'.$id_user,'refresh');
				} else {
					$this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
			          Tanggal Tidak Valid
			          </div></div>');
			        redirect('user/detail_pesanan/'.$invoice.'/'.$id_user,'refresh');
				}
				

			}



		}

		public function chat_mitra($id_mitra,$id_user)
		{	$chat = $this -> db -> get_where('chat', ['id_pengirim' => $id_user] AND ['id_penerima' => $id_mitra]) -> row_array();
			if ($chat) {
				redirect('user/chat/' . $id_mitra,'refresh');
			} else {
				$data = array(
				'id_mitra' => $id_mitra,
				'id_user' => $id_user,
			);
			$this->db->insert('chat', $data);
			redirect('user/chat/' . $id_user,'refresh');
			}
			
		}

		public function reated()
		{
			$bin = $this->input->post('bin');
			var_dump($bin);
			die();
		}
}
