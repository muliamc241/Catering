<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mitra extends CI_Controller
	{	
		public function __construct()
  		{
    		parent::__construct();
        $this->load->model('keranjang_model');
    		$this -> load -> library('form_validation');
        if( !$this -> session -> userdata('email')){
          redirect('auth','refresh');
        }
  		}
    
		public function index_mitra()
		{	
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( !$cek['role_id'] = 3){
        redirect('auth','refresh');
      }
			$data['title'] = 'Dasboard Mitra';
			$data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();
      // $data['pesanan']= $this -> db -> get_where('pesanan', ['id_mitra' => $this->session->userdata('id')]) -> row_array();
      $kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
      $data['pesanan'] = $this->keranjang_model->get_pesanan_mitra($kategori);
    	$this -> load -> view('templates/header_mitra', $data);
    	$this -> load -> view('mitra/index_mitra', $data);
    	$this -> load -> view('templates/footer');
		}

    public function profil_mitra()
    { 
      $data['title'] = 'Dasboard Mitra';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/profil_mitra', $data);
      $this -> load -> view('templates/footer');
    }


    public function dompet_mitra()
    { 
      $data['title'] = 'Dompet Mitra';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/dompet_mitra', $data);
      $this -> load -> view('templates/footer');
    }

    public function vtarik_saldo()
    { 
      $data['title'] = 'Dompet Tarik Saldo';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/tarik_saldo', $data);
      $this -> load -> view('templates/footer');
    }

    public function tarik_saldo()
    {
      $this-> form_validation -> set_rules('saldo', 'Saldo', 'required|trim|min_length[5]|is_numeric',[
          'required' =>'Jumlah isi saldo Tidak Boleh Kosong',
          'min_length' => 'Minimal Penarikan Rp, 50.000',
          'is_numeric' => 'Yang anda masukkan bukan angka!!'
      ]);
      $this-> form_validation -> set_rules('bank', 'Bank', 'required|trim',[
          'required' =>'Bank tidak Boleh Kosong',
      ]);
      $this-> form_validation -> set_rules('rekening', 'Rekening', 'required|trim|min_length[6]|is_numeric',[
          'required' =>'Nomor rekening Tidak Boleh Kosong',
          'min_length' => 'Minimal 6 digit',
          'is_numeric' => 'Yang anda masukkan bukan angka!!'
      ]);
      if($this-> form_validation-> run() == false) {
        redirect('mitra/vtarik_saldo','refresh');
      } else {
        $mitra = $this-> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
        if ($mitra['dompet_saldo'] > 50000) {
          $email = $this-> input->post('email');
          $saldo = $this-> input->post('saldo');
          $bank = $this-> input->post('bank');
          $rekening = $this-> input->post('rekening');

          $data = [
          'id_penarik' => $mitra['id'],
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
              redirect('mitra/dompet_mitra','refresh');
          } else {
            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
                Saldo anda kurang dari batas penarikan!
                </div></div>');
              redirect('mitra/dompet_mitra','refresh');
          }
        }
    }

    public function vedit_toko()
    { 
      $data['title'] = 'Dasboard Mitra';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();  
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/edit_toko', $data);
      $this -> load -> view('templates/footer'); 
    }

    public function vedit_password()
    { 
      $data['title'] = 'Dasboard Mitra';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();  
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/ganti_password', $data);
      $this -> load -> view('templates/footer'); 
    }

    public function edit_toko()
    {
      $this-> form_validation -> set_rules('nama_toko', 'Nama', 'required|trim',[
          'required' => 'Nama Toko tidak Boleh Kosong'
        ]);
      $this-> form_validation -> set_rules('no_hp', 'No_hp', 'required|trim|min_length[11]|max_length[13]',[
          'required' => 'Nomor hp tidak boleh Kosong',
          'min_length' => 'Nomor hp Tidak Valid!',
          'max_length' => 'Nomor hp Tidak Valid!'
        ]);
      if($this-> form_validation-> run() == false) {
      $data['title'] = 'Edit Profil Toko';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['produk'] = $this->keranjang_model->get_nama_catering();  
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/edit_toko', $data);
      $this -> load -> view('templates/footer');
        } else {
      $nama = $this -> input -> post('nama_toko');
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
              $mitra = $this-> db -> get_where('mitra', ['email' => $email]) -> row_array();
              $old_image = $mitra['image'];
              if ($old_image != 'default.jpg'){
                unlink(FCPATH . '/img/profile/' . $old_image);
              }


              $new_image = $this->upload->data('file_name');
              $this->db->set('image', $new_image);

            }else{
              echo $this->upload->display_errors();
            }
      }
           
      
          $this->db->set('nama_toko', $nama);
          $this->db->where('email', $email);
          $this->db->update('mitra');

          $this->db->set('no_hp', $no_hp);
          $this->db->where('email', $email);
          $this->db->update('mitra');
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat Profil Toko anda telah di perbarui!
          </div></div>');
          redirect('mitra/profil_mitra','refresh');
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
            'matches' => 'Password Tidak Sama!'
        ]);
        if($this-> form_validation-> run() == false) {
        $data['title'] = 'Dasboard Mitra';
        $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
        $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        $data['produk'] = $this->keranjang_model->get_nama_catering();  
        $this -> load -> view('templates/header_mitra', $data);
        $this -> load -> view('mitra/ganti_password', $data);
        $this -> load -> view('templates/footer'); 
        } else {
        $email = $this -> input -> post('email');
        $password_lama = $this -> input -> post('password_lama');
        $password_baru = password_hash($this -> input -> post('password_baru1'), PASSWORD_DEFAULT);
        $mitra = $this-> db -> get_where('mitra', ['email' => $email]) -> row_array();
         if (password_verify($password_lama, $mitra['password'])) {
          if(!password_verify($password_baru, $mitra['password'])){
          $this->db->set('password', $password_baru);
            $this->db->where('email', $email);
            $this->db->update('mitra');
            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
            Selamat Password anda telah di perbarui!
            </div></div>');
            redirect('mitra/profil_mitra','refresh');
            } else {
              $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
              Password Baru Tidak boleh sama dengan Password lama!
              </div></div>');
            redirect('mitra/vedit_password','refresh');
            }
         } else {
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
              Password Lama Salah!
              </div></div>');
              redirect('mitra/vedit_password','refresh');
         }          
    } 
  }

		public function tambah_barang()
  		{ 
  			$this-> form_validation -> set_rules('nama', 'Nama', 'required|trim',[
            'required' =>'Nama Tidak Boleh Kosong',
            ]);
        $this-> form_validation -> set_rules('harga', 'Harga', 'required|trim|is_numeric',[
            'required' =>'Harga Tidak Boleh Kosong',
            ]);
        $this-> form_validation -> set_rules('kategori', 'Kategori', 'required|trim|in_list[1,2,3]',[
          'required' =>'Kategori Tidak Boleh Kosong',
          'in_list' => 'Kategori Tidak Boleh Kosong'
        ]);
        $this-> form_validation -> set_rules('deskripsi', 'Deskripsi', 'required|trim',[
          'required' =>'Deskripsi Tidak Boleh Kosong',
        ]);
        if($this-> form_validation-> run() == false) {
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                    );
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '500px';
        $this->ckeditor->config['height'] = '300px';
        $data['title'] = 'Tambah Makanan';
              $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
        $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        $data['produk'] = $this->keranjang_model->get_nama_catering();
        $data['kategori'] = $this->keranjang_model->get_kategori();
            $this -> load -> view('templates/header_mitra', $data);
            $this -> load -> view('mitra/tambah_barang',$data);
            $this -> load -> view('templates/footer');
        } else {
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $kategori = $this->input->post('kategori');
        $deskripsi = $this->input->post('deskripsi');
        $nama_catering = $this->input->post('nama_catering');
        $image = $_FILES['image'];
        if($image = '') {
           $this->form_validation->set_rules('image', 'Document', 'required',[
          'required' =>'Gambar Tidak Boleh Kosong',
        ]);
        } else {
        $nmfile = "Product_id ".time();
        $config['upload_path']          = './img/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
        $config['width']            = 680;
        $config['height']           = 383;
        $config['file_name'] = $nmfile;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                redirect('mitra/tambah_barang');
            } else{
            $image = $this->upload->data("file_name");
            }
        }

        $id_mitra = $this->input->post('id_mitra');
        $data = [
                'nama' => $nama,
                'harga' => $harga,
                'kategori' => $kategori,
                'deskripsi'=> $deskripsi,
                'image' => $image,
                'id_mitra' => $nama_catering
             
            ];
                $this-> db ->insert('makanan', $data);
                $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                    Selamat Makanan berhasil di Tambah!
                </div></div>');
                redirect('mitra/index_mitra/'.$id_mitra,'refresh');
        }
			}

      public function lihat_barang()
      { 
        $data['title'] = 'Catering Home';
        $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
        $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        $kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
        $data['produk'] = $this->keranjang_model->get_nama_catering();
        $data['nama_catering'] = $this->keranjang_model->get_produk_nama_catering($kategori);
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                    );
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '460px';
        $this->ckeditor->config['height'] = '300px';
          $this -> load -> view('templates/header_mitra', $data);
          $this -> load -> view('mitra/lihat_barang', $data);
          $this -> load -> view('templates/footer');
      }

      public function lihat_pesanan()
      { 
          $data['title'] = 'Catering Home';
          $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
          $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
          $id_mitra=($this->uri->segment(3))?$this->uri->segment(3):0;
          $status=($this->uri->segment(4))?$this->uri->segment(4):0;
          $data['produk'] = $this->keranjang_model->get_nama_catering();
          $data['nama_catering'] = $this->keranjang_model->get_pesanan_status($id_mitra,$status);
          $data['nama_catering'] = $this->keranjang_model->get_pesanan_mitra($id_mitra);
          $this -> load -> view('templates/header_mitra', $data);
          $this -> load -> view('mitra/pesanan', $data);
          $this -> load -> view('templates/footer');
      }

      public function detail_pesanan()
      { 
          $data['title'] = 'Catering Home';
          $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
          $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
          $no_invoice=($this->uri->segment(3))?$this->uri->segment(3):0;
          $id_mitra =($this->uri->segment(4))?$this->uri->segment(4):0;
          $data['produk'] = $this->keranjang_model->get_nama_catering();
          $data['reting'] = $this->keranjang_model->get_rating_invoice($no_invoice)->row_array();
          $data['nama_catering'] = $this->keranjang_model->get_detail_mitra_pesanan($no_invoice,$id_mitra);
          $this -> load -> view('templates/header_mitra', $data);
          $this -> load -> view('mitra/detail_pesanan_mitra', $data);
          $this -> load -> view('templates/footer');
      }

      public function alamat_pesanan()
      {
        $no_invoice = ($this->uri->segment(3))?$this->uri->segment(3):0;
        $maps = $this-> db -> get_where('map', ['no_invoice' => $no_invoice]) -> row_array();
        $invoice = $this-> db -> get_where('invoice', ['no_invoice' => $no_invoice]) -> row_array();
        $pesanann = $this-> db -> get_where('simpan_pesanan', ['no_invoice' => $no_invoice]) -> row_array();
        $alamat_mitra = $this-> db -> get_where('map_mitra', ['id_mitra' => $pesanann['id_mitra']]) -> row_array();
        $catering = $this-> db -> get_where('mitra', ['id' => $pesanann['id_mitra']]) -> row_array();
          $this->load->library('googlemaps');
            $lat = $maps['lat'];
            $lang = $maps['lang'];
            $lat_mitra =$alamat_mitra['lat'];
            $lang_mitra = $alamat_mitra['lang'];
            $config=array();
            $config['center']="$lat, $lang";
            $config['zoom']="auto";
            $config['map_width']="auto";
            $config['trafficOverlay'] = TRUE;
            $config['directions'] = TRUE;
            $config['directionsStart'] = "$lat_mitra,$lang_mitra";
            $config['directionsEnd'] = "$lat,$lang";
            $config['directionsDivID'] = 'directionsDiv';
            $this->googlemaps->initialize($config);
            $marker['position'] = "$lat_mitra,$lang_mitra";
            $marker['infowindow_content'] = '' . $catering['nama_toko'];
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld= home|3cf|fff';
            $marker2['position']="$lat,$lang";
            $marker2['infowindow_content'] = 'Alamat Acara : ' . $invoice['alamat'] . ',' . $invoice['kecamatan'] . ',' . $invoice['kode_pos'];
            $this->googlemaps->add_marker($marker);
            $this->googlemaps->add_marker($marker2);
          $data['map']=$this->googlemaps->create_map();
          $data['title'] = 'Catering Home';
          $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
          $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
          $data['pesanan'] = $this -> db -> get_where('invoice', ['no_invoice' => $no_invoice]) -> row_array();
          $data['produk'] = $this->keranjang_model->get_nama_catering();
          $this -> load -> view('templates/header_mitra_map', $data);
          $this -> load -> view('mitra/valamat_mitra', $data);
          $this -> load -> view('templates/footer');
      }

      public function map()
    { 
      $data['title'] = 'Catering Home';
      $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $this -> load -> view('templates/header_mitra', $data);
      $this -> load -> view('mitra/alamat_mitra', $data);
      $this -> load -> view('templates/footer');
    }

    public function alamat_tambah()
    { 
      $mitra = $this -> input -> post('id');

      $data = [
      'id_mitra' => $mitra,
      'lat' => $this -> input -> post('latitude'),
      'lang' => $this -> input -> post('longitude'),


    ];
          $this-> db ->insert('map_mitra', $data);
          redirect('mitra/profil_mitra','refresh');

    }

    public function alamat_update()
    { 
      $this-> form_validation -> set_rules('lat', 'Lat', 'required|trim',[
          'required' =>' ' . $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
              Anda belum memilih titik Alamat!
              </div></div>'),
        ]);
      $this-> form_validation -> set_rules('lang', 'Lang', 'required|trim',[
          'required' =>' ' . $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
              Anda belum memilih titik Alamat!
              </div></div>'),      
        ]);
      if($this-> form_validation-> run() == false) {
      redirect('mitra/map','refresh');
      }else {
      $mitra = $this -> input -> post('id');
      $lat = $this -> input -> post('lat');
      $lang = $this -> input -> post('lang');

      $this->db->set('lat', $lat);
      $this->db->where('id_mitra', $mitra);
      $this->db->update('map_mitra');

      $this->db->set('lang', $lang);
      $this->db->where('id_mitra', $mitra);
      $this->db->update('map_mitra');
      $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
            Selamat Alamat anda telah di perbarui!
            </div></div>');
      redirect('mitra/profil_mitra','refresh');
      }
    }

    public function alamat_mitra()
      {
        $mitra = $this-> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
        $alamat_mitra = $this-> db -> get_where('map_mitra', ['id_mitra' => $mitra['id']]) -> row_array();
        $catering = $this-> db -> get_where('mitra', ['id' => $alamat_mitra['id_mitra']]) -> row_array();
          $this->load->library('googlemaps');
            $lat_mitra =$alamat_mitra['lat'];
            $lang_mitra = $alamat_mitra['lang'];
            $config=array();
            $config['center']="$lat_mitra, $lang_mitra";
            $config['zoom']="auto";
            $config['map_width']="auto";
            $this->googlemaps->initialize($config);
            $marker['position'] = "$lat_mitra,$lang_mitra";
            $marker['placesName'] = '' . $catering['nama_toko'];
            $marker['infowindow_content'] = '' . $catering['nama_toko'];
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld= home|3cf|fff';
            $this->googlemaps->add_marker($marker);
          $data['map']=$this->googlemaps->create_map();
          $data['title'] = 'Catering Home';
          $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
          $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
          $data['produk'] = $this->keranjang_model->get_nama_catering();
          $this -> load -> view('templates/header_mitra_map', $data);
          $this -> load -> view('mitra/valamat_mitra', $data);
          $this -> load -> view('templates/footer');
      }

      public function lihat_pesanan_status()
      { 
          $data['title'] = 'Catering Home';
          $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
          $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
          $id_mitra =($this->uri->segment(3))?$this->uri->segment(3):0;
          $status =($this->uri->segment(4))?$this->uri->segment(4):0;
          $data['produk'] = $this->keranjang_model->get_nama_catering();
          $data['nama_catering'] = $this->keranjang_model->get_pesanan_status($id_mitra,$status);
          $this -> load -> view('templates/header_mitra', $data);
          $this -> load -> view('mitra/pesanan_belumTerima', $data);
          $this -> load -> view('templates/footer');
      }

      public function lihat_status_pesanan()
      { 
          $data['title'] = 'Catering Home';
          $data['mitra']= $this -> db -> get_where('mitra', ['email' => $this->session->userdata('email')]) -> row_array();
          $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
          $id_mitra =($this->uri->segment(3))?$this->uri->segment(3):0;
          $status =($this->uri->segment(4))?$this->uri->segment(4):0;
          $data['produk'] = $this->keranjang_model->get_nama_catering();
          $data['nama_catering'] = $this->keranjang_model->get_pesanan_status($id_mitra,$status);
          $this -> load -> view('templates/header_mitra', $data);
          $this -> load -> view('mitra/pesanan', $data);
          $this -> load -> view('templates/footer');
      }
         

      public function tolak_pesanan($id_pesanan,$id_mitra)
      { 

        $simpan_pesanan = $this-> db -> get_where('simpan_pesanan', ['id' => $id_pesanan]) -> row_array();
        $simpan_biaya = $this-> db -> get_where('simpan_biaya', ['no_invoice' => $simpan_pesanan['no_invoice']]) -> row_array();
        $pesanan = $this-> db -> get_where('pesanan', ['invoice' => $simpan_pesanan['no_invoice']]) -> row_array();
        $user = $this-> db -> get_where('user', ['id' => $pesanan['id_user']]) -> row_array();
        $dompet = $this-> db -> get_where('dompet', ['email' => $user['email']]) -> row_array();
        $mitra = $this-> db -> get_where('mitra', ['id' => $simpan_pesanan['id_mitra']]) -> row_array();
        $nama_catering = $mitra['nama_toko'];
        $no_invoicee = $simpan_pesanan['no_invoice'];
        $email = $user['email'];
        $dompet['saldo'] += $simpan_biaya['jumlah'];
         $this->db->set('status_pesanan', 5);
         $this->db->where('id', $id_pesanan);
         $this->db->where('id_mitra', $id_mitra);
         $this->db->update('simpan_pesanan');

         $this->db->set('saldo', $dompet['saldo']);
         $this->db->where('email', $user['email']);
         $this->db->update('dompet');

         $this -> _sendMail_pesanan($nama_catering,$email,$no_invoicee, 'tolakpesanan');
         $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                Pesanan dengan no Invoice ' .$simpan_pesanan['no_invoice'] .' telah di tolak!
                </div></div>');
         redirect('mitra/lihat_pesanan/'. $id_mitra,'refresh');
      }

      public function update_status_terima($id_pesanan,$id_mitra)
      { 
        $simpan_pesanan = $this-> db -> get_where('simpan_pesanan', ['id' => $id_pesanan]) -> row_array();
        $simpan_biaya = $this-> db -> get_where('simpan_biaya', ['no_invoice' => $simpan_pesanan['no_invoice']]) -> row_array();
        $pesanan = $this-> db -> get_where('pesanan', ['invoice' => $simpan_pesanan['no_invoice']]) -> row_array();
        $user = $this-> db -> get_where('user', ['id' => $pesanan['id_user']]) -> row_array();
        $mitra = $this-> db -> get_where('mitra', ['id' => $simpan_pesanan['id_mitra']]) -> row_array();
        
        $simpan_biaya['status_simpan'] += 1;
         $this->db->set('status_pesanan', 1);
         $this->db->where('id', $id_pesanan);
         $this->db->where('id_mitra', $id_mitra);
         $this->db->update('simpan_pesanan');

         $this->db->set('status_simpan', $simpan_biaya['status_simpan']);
         $this->db->where('no_invoice', $simpan_pesanan['no_invoice']);
         $this->db->update('simpan_biaya');
         $nama_catering = $mitra['nama_toko'];
         $no_invoicee = $simpan_pesanan['no_invoice'];
         $email = $user['email'];
         $this -> _sendMail_pesanan($nama_catering,$email,$no_invoicee, 'terimapesanan');
         $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                Status Pesanan Mitra Telah di Update.
                </div></div>');
         redirect('mitra/lihat_pesanan/'. $id_mitra,'refresh');
      }

      public function update_status_proses($id_pesanan,$id_mitra)
      { 
        $simpan_pesanan = $this-> db -> get_where('simpan_pesanan', ['id' => $id_pesanan]) -> row_array();
        $pesanan = $this-> db -> get_where('pesanan', ['invoice' => $simpan_pesanan['no_invoice']]) -> row_array();
        $user = $this-> db -> get_where('user', ['id' => $pesanan['id_user']]) -> row_array();
        $mitra = $this-> db -> get_where('mitra', ['id' => $simpan_pesanan['id_mitra']]) -> row_array();
        $nama_catering = $mitra['nama_toko'];
        $no_invoicee = $simpan_pesanan['no_invoice'];
        $email = $user['email'];
        $tanggal_acara = strtotime($pesanan['tgl_acara']);
        $tgl_sebelum = mktime(0, 0, 0, date("m",$tanggal_acara), date("d",$tanggal_acara)-7, date("Y",$tanggal_acara));
        $tgl_proses = date('Y-m-d', $tgl_sebelum);
        $sekarang = date('Y-m-d');
        if ($sekarang == $tgl_proses) {

           $this->db->set('status_pesanan', 2);
           $this->db->where('id', $id_pesanan);
           $this->db->where('id_mitra', $id_mitra);
           $this->db->update('simpan_pesanan');
           $this -> _sendMail_pesanan($nama_catering,$email,$no_invoicee, 'prosespesanan');
           $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                  Status Pesanan Mitra Telah di Update.
                  </div></div>');
           redirect('mitra/lihat_pesanan/'. $id_mitra,'refresh');
        } else {
            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
                  Anda tidak boleh memproses pesanan sebelum H - 7!!
                  </div></div>');
           redirect('mitra/lihat_pesanan/'. $mitra['id'],'refresh');

       }

      }

      public function update_status_kirim()
      { 

        $id_pesanan = $this -> input -> post('id_pesanan');
        $simpan_pesanan = $this-> db -> get_where('simpan_pesanan', ['id' => $id_pesanan]) -> row_array();
        $pesanan = $this-> db -> get_where('pesanan', ['invoice' => $simpan_pesanan['no_invoice']]) -> row_array();
        $user = $this-> db -> get_where('user', ['id' => $pesanan['id_user']]) -> row_array();
        $mitra = $this-> db -> get_where('mitra', ['id' => $simpan_pesanan['id_mitra']]) -> row_array();
        $nama_catering = $mitra['nama_toko'];
        $no_invoicee = $simpan_pesanan['no_invoice'];
        $email = $user['email'];

        $sekarang = date('Y-m-d');
        
        if ($pesanan['tgl_acara'] == $sekarang) {

           $this->db->set('status_pesanan', 3);
           $this->db->where('id', $id_pesanan);
           $this->db->where('id_mitra', $mitra['id']);
           $this->db->update('simpan_pesanan');

           
           $this -> _sendMail_pesanan($nama_catering,$email,$no_invoicee, 'kirimpesanan');
           $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                  Status Pesanan Mitra Telah di Update.
                  </div></div>');
           redirect('mitra/lihat_pesanan/'. $mitra['id'],'refresh');
       } else {
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
                  Anda tidak boleh mengirim pesanan sebelum tanggal Acara Tiba!!
                  </div></div>');
           redirect('mitra/lihat_pesanan/'. $mitra['id'],'refresh');
       }
      }

      private function _sendMail_pesanan($nama_catering,$email,$no_invoicee, $type) 
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
        $ci->email->to($email);
        if($type == 'terimapesanan') {
          $ci->email->subject('Pesanan Diterima');
          $ci->email->message('<h3>Hai, '.$email. '</h3><br> <p> '.$nama_catering.' telah memenerima pesanan anda dengan nomor Pesanan '.$no_invoicee.' , tunggu konfirmasi selanjutnya dari '.$nama_catering.' Terima Kasih Telah berbelanja di Cemart.</p>');
        } else if($type == 'prosespesanan') {
          $ci->email->subject('Pesanan Diproses');
          $ci->email->message('<h3>Hai, '.$email. '</h3><br> <p> '.$nama_catering.' Sedang Memproses pesanan anda dengan nomor Pesanan '.$no_invoicee.' , tunggu konfirmasi selanjutnya dari '.$nama_catering.' Terima Kasih Telah berbelanja di Cemart.</p>');
        } else if($type == 'kirimpesanan') {
          $ci->email->subject('Pesanan Dikirim');
          $ci->email->message('<h3>Hai, '.$email. '</h3><br> <p> '.$nama_catering.' Sedang mengirim pesanan anda dengan nomor Pesanan '.$no_invoicee.' , tunggu sampai pesanan anda tiba di lokasi. jika pesanan telah tiba dilokasi harap lakukan konfirmasi pesanan tiba, Terima Kasih Telah berbelanja di Cemart.</p>');
        } else if($type == 'tolakpesanan') {
          $ci->email->subject('Pesanan Ditolak');
          $ci->email->message('<h3>Hai, '.$email. '</h3><br> <p> '.$nama_catering.' telah menolak pesanan anda dengan nomor Pesanan '.$no_invoicee.' , saldo anda akan di kembalikan ke dompet cemart anda,  Kami dari cemart meminta maaf atas ketidaknyamanan atas penolakan pesanan anda.</p>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

		}

	
?>
