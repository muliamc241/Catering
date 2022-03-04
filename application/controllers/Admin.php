<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	class Admin extends CI_Controller
	{
  		public function __construct()
  		{
    		parent::__construct();
        $this->load->model('m_admin');
    		$this->load->library('form_validation');
    		if(!$this -> session -> userdata('email')){
    			redirect('auth','refresh');
    		}
  		}	


		private $_table = "dompet";

		public function index()
		{	$cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( !$cek['role_id'] == 1){
        redirect('auth','refresh');
      } else {
        $cek_iklan =  $this -> db -> get_where('iklan') -> row_array();
        $tgl_sekarang = date('d F Y');
        if ($cek_iklan['tgl_selesai'] < $tgl_sekarang) {
          $this->db->set('is_active', 0);
          $this->db->where('id', $cek_iklan['id']);
          $this->db->update('iklan');
        }
  			$data['title'] = 'Dashboard';
        $data['title2'] = 'Dashboard';
  			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        $tanggal = date('Y-m-d');
        $bulan_lalu = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
        $tgl_sebelum = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
        $semalam = date('Y-m-d', $tgl_sebelum);
        $sebulan = date('Y-m-d', $bulan_lalu);
        $data['online']= $this->m_admin->get_online();
        $data['pesan']= $this->m_admin->get_pesanansekarang($tanggal);
        $data['sblm_pesan']= $this->m_admin->get_pesanansekarang($semalam);
        $data['pesananbulanan']= $this->m_admin->pesananbulanan($sebulan,$tanggal);
        $data['biaya']= $this->m_admin->get_kirim_biaya();
       	$data['pesanan'] = $this->m_admin->get_pesanan();
        $data['rating'] = $this->m_admin->get_koment();
  			$this -> load -> view('templates/header_admin', $data);
  			$this -> load -> view('admin/index', $data);
  			$this -> load -> view('templates/footer_admin'); 
      }
		}

		public function tambah_saldo()
		{	
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
        redirect('auth','refresh');
      }
			$data['title'] = 'Isi Saldo';
      $data['title2'] = 'Isi Saldo';
			$data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['saldo']=$this->m_admin->get_isi_saldo();
			$this -> load -> view('templates/header_admin', $data);
			$this -> load -> view('admin/isi_saldo', $data);
			$this -> load -> view('templates/footer_admin'); 
		}

    public function kirim_biaya()
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
        redirect('auth','refresh');
      }
      $data['title'] = 'Kirim Biaya';
      $data['title2'] = 'Uang Mitra';
      $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['saldo']=$this->m_admin->get_simpan_pesanan();
      $this -> load -> view('templates/header_admin', $data);
      $this -> load -> view('admin/kirim_uang', $data);
      $this -> load -> view('templates/footer_admin'); 
    }

		public function actkirim_biaya($no_invoice)
		{	
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
        redirect('auth','refresh');
      }
      $jumlah = $this->input->post('saldo');
      $email = $this->input->post('email');
      $pesanan = $this-> db -> get_where('simpan_pesanan', ['no_invoice' => $no_invoice ]) -> row_array();
      $makanan = $this-> db -> get_where('makanan', ['product_id' => $pesanan['product_id']]) -> row_array(); 
      $mitra = $this-> db -> get_where('mitra', ['id' => $pesanan['id_mitra']]) -> row_array();
      if ($pesanan['invoice']) {
        if($pesanan['status_pesanan'] == 4 or 6 ){
        $jumlah += $mitra['dompet_saldo'];
        $this->db->set('dompet_saldo', $jumlah );
        $this->db->where('email', $email);
        $this->db->update('mitra');

        $this->db->delete('simpan_biaya', ['no_invoice' => $no_invoice]);
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                    Biaya telah terkirim, saldo '. $email . ' telah di tambah.
                </div></div>');
        redirect('admin/kirim_biaya','refresh');
        } else {
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Gagal Terkirim, Pesanan Belum Selesai!
          </div></div>');
        redirect('admin/kirim_biaya','refresh');
        }
      } else {
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Gagal Terkirim, Tidak menemukan Nomor Invoice!
          </div></div>');
        redirect('admin/kirim_biaya','refresh');
      }
	      	
		}

    public function kirim_tarik_saldo()
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
        redirect('auth','refresh');
      }
      $data['title'] = 'Kirim Uang';
      $data['title2'] = 'Kirim Uang';
      $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['saldo']=$this->m_admin->get_tarik_saldo();
      $this -> load -> view('templates/header_admin', $data);
      $this -> load -> view('admin/kirim_saldo', $data);
      $this -> load -> view('templates/footer_admin'); 
    }

    public function actkirim_saldo($id)
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
        redirect('auth','refresh');
      }
      $jumlah = $this->input->post('saldo');
      $email = $this->input->post('email');
      $role_id = $this->input->post('role_id');
      if ($role_id == 2) {
        $dompet = $this-> db -> get_where('dompet', ['email' => $email]) -> row_array();
        if (($dompet['saldo'] -= $jumlah) < 0) {
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
            Gagal Terkirim, Jumlah yang ingin ditarik melebihi Saldo Mitra!!
            </div></div>');
          redirect('admin/kirim_tarik_saldo','refresh');
          
        } else {
          $this->db->set('saldo', $dompet['saldo']);
          $this->db->where('email', $email);
          $this->db->update('dompet');

          $this->db->set('status', 1);
          $this->db->where('id', $id);
          $this->db->update('tarik_saldo');
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                      Biaya telah terkirim, saldo '. $email . ' telah di tambah.
                  </div></div>');
          redirect('admin/kirim_tarik_saldo','refresh');
        }
      } else {
        $mitra = $this-> db -> get_where('mitra', ['email' => $email]) -> row_array();
        if (($mitra['dompet_saldo'] -= $jumlah) < 0) {
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
            Gagal Terkirim, Jumlah yang ingin ditarik melebihi Saldo Mitra!!
            </div></div>');
          redirect('admin/kirim_tarik_saldo','refresh');
          
        } else {
          $this->db->set('dompet_saldo', $mitra['dompet_saldo']);
          $this->db->where('email', $email);
          $this->db->update('mitra');

          $this->db->set('status', 1);
          $this->db->where('id', $id);
          $this->db->update('tarik_saldo');
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                      Biaya telah terkirim, saldo '. $email . ' telah di tambah.
                  </div></div>');
          redirect('admin/kirim_tarik_saldo','refresh');
        }
      }
          
    }


		public function add()
    	{ 
        $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
        $tipe = $this->input->post('tipe');
        $image = $_FILES['image'];
        if($image = '') {

        } else {
        $nmfile = "file_".time();
        if($tipe == 1){
          $config['upload_path']          = './img/galeri/slide';
        }else{
          redirect('admin/tambah_galeri','refresh');
        }
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
        $config['width']            = 1200;
        $config['height']           = 563;
        $config['file_name'] = $nmfile;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                redirect('admin/tambah_galeri');
            } else{
            $image = $this->upload->data("file_name");
            }
        }


        $data = [
                'image' => $image,
                'tipe' => $tipe
             
            ];
        $data_iklan = [
                'image' => $image,
                'tipe' => $tipe,
                'is_active'=> 1,
                'date_created' => time() 
        ];
              if($tipe == 1){
                $this-> db ->insert('galeri', $data);
              } else {
                $this-> db ->insert('iklan', $data_iklan);
              }
                $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                    Selamat Galeri berhasil di Tambah!
                </div></div>');
                redirect('admin/index','refresh');

            }

        public function action_tambah_iklan()
      {
        $image = $_FILES['foto_iklan']['name'];
        $nmfile = "Iklan " . time();
        $config['upload_path']          = './img/galeri/iklan';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
        $config['file_name'] = $nmfile;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('foto_iklan')){
          $iklan_image = $this->upload->data('file_name');
        }else{
          echo $this->upload->display_errors();
        }
        $id_iklan = $this -> input -> post('id_iklan');
        $data = [
            'email' => $this -> input -> post('email'),
            'image' => $iklan_image,
            'tipe' => 2,
            'is_active'=> 1,
            'date_created' => time(),
            'tgl_selesai' => $this -> input -> post('tgl_selesai')

        ];

        $this-> db ->insert('iklan', $data);

      $this->db->set('status', 1);
      $this->db->where('id', $id_iklan);
      $this->db->update('req_iklan');

      $this -> _sendMail($iklan_image, 'infoiklan');


        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Iklan Telah terbit!
          </div></div>');
        redirect('admin/request_iklan','refresh');
    }

    private function _sendMail($iklan_image, $type) 
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
        $ci->email->to($this -> input -> post('email'));
        if($type == 'verify'){
          $ci->email->subject('Account Verificationl');
          $ci->email->message('Click this link to verify you Account : <a href="'. base_url() . 'auth/verify?email=' . $this -> input ->post('email') . '&token='. urlencode($token) .'">Activate</a>');
        } else if($type == 'infoiklan') {
          $ci->email->subject('Info Iklan');

          $filename = base_url() .'/img/galeri/iklan/'. $iklan_image;
          $this->email->attach($filename);
          $cid = $this->email->attachment_cid($filename);
          $tanggal = date('d F Y', strtotime($this -> input -> post('tgl_selesai')));
          $ci->email->message('Hallo '.$this -> input -> post('email').' kami dari cemart ingin menyampaikan.<br><h2>Iklan anda telah terbit sampai  : ' . $tanggal.'</h2><br> <img src="cid:'. $cid .'" alt="photo1" />');
        } else if($type == 'perpanjang_iklan') {
          $ci->email->subject('perpanjang');
          $filename = base_url() .'/img/galeri/iklan/'. $iklan_image;
          $this->email->attach($filename);
          $cid = $this->email->attachment_cid($filename);
          $ci->email->message('Hallo '.$this -> input -> post('email').' kami dari cemart ingin menyampaikan.<br><h2>Iklan anda telah hapis masa berlaku nya  : ' . $this -> input -> post('tgl_selesai').'</h2><br> <img src="cid:'. $cid .'" alt="photo1" /><br> <a href="'. base_url() . 'auth/verify?email=' . $this -> input ->post('email') . '&token='. urlencode($token) .'">Perpanjang Iklan</a>');
        }

        
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
    public function kirim_email_perpanjang()
    {
        $id_iklan = $this -> input -> post('id_iklan');
        $iklan_image = $this -> input -> post('gambar');
        $email = $this -> input -> post('email');
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email'        => $email,
          'token'        => $token,
          'date_created' => time()
        ];
        $this-> db ->insert('user_token', $user_token);
        $this -> _sendMail_perpanjang($token, $iklan_image, 'perpanjang_iklan');
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Iklan Telah terbit!
          </div></div>');
        redirect('admin/cek_iklan','refresh');
    }

    private function _sendMail_perpanjang($token,$iklan_image, $type) 
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
        $ci->email->to($this -> input -> post('email'));
        if($type == 'perpanjang_iklan') {
          $ci->email->subject('Perpanjang Iklan');
          $filename = base_url() .'/img/galeri/iklan/'. $iklan_image;
          $this->email->attach($filename);
          $cid = $this->email->attachment_cid($filename);
          $ci->email->message('Hallo '.$this -> input -> post('email').' kami dari cemart ingin menyampaikan.<br><h2>Iklan anda masa berlaku nya telah habis   : <a href="'. base_url() . 'auth/perpanjang_iklan?email=' . $this -> input ->post('email') . '&token='. urlencode($token) .'&id_iklan='. $this -> input ->post('id_iklan') .'" style="display: block;width: 115px;height: 25px;background: #4E9CAF;padding: 10px;text-align: center;border-radius: 5px;color: white;font-weight: bold; text-decoration:none;">Perpanjang Iklan</a></h2><br> <img src="cid:'. $cid .'" alt="photo1" /><br>');
        } 
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

        public function tambah_galeri()
  		{ 
        $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
  			$this-> form_validation -> set_rules('tipe', 'Tipe', 'required|trim|min_length[5]',[
      		'required' =>'Nama Tidak Boleh Kosong',
    		]);
    		$this-> form_validation -> set_rules('image', 'Image', 'required|trim',[
      		'required' =>'Gambar Tidak Boleh Kosong',
    		]);
        if($this-> form_validation-> run() == false) {
        $data['title'] = 'Tambah Galeri';
        $data['title2'] = 'Tambah Galeri';
        $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        $this -> load -> view('templates/header_admin', $data);
        $this -> load -> view('admin/tambah_galeri', $data);
        $this -> load -> view('templates/footer_admin'); 
          }
		  }

     public function cek_iklan()
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      
      $data['title'] = 'Cek Iklan';
      $data['title2'] = 'Cek Iklan';
      $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['iklan']=$this->m_admin->get_iklan();
      $this -> load -> view('templates/header_admin', $data);
      $this -> load -> view('admin/cek_iklan', $data);
      $this -> load -> view('templates/footer_admin'); 
    }

    public function vperpanjang_iklan()
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      
      $data['title'] = 'Perpanjang Iklan';
      $data['title2'] = 'Perpanjang Iklan';
      $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['perpanjangiklan']=$this->m_admin->get_perpanjang_iklan();
      $this -> load -> view('templates/header_admin', $data);
      $this -> load -> view('admin/perpanjang_iklan', $data);
      $this -> load -> view('templates/footer_admin'); 
    }

     public function request_iklan()
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      
      $data['title'] = 'Request Iklan';
      $data['title2'] = 'Request Iklan';
      $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['reqiklan']=$this->m_admin->get_request_iklan();
      $this -> load -> view('templates/header_admin', $data);
      $this -> load -> view('admin/request_iklan', $data);
      $this -> load -> view('templates/footer_admin'); 
    }

    public function perpanjang_iklan()
    {
      $id_iklan = $this-> input-> post('id_iklan');
      $id_perpanjang = $this-> input-> post('id_perpanjang');
      $tgl_selesai = $this-> input-> post('tgl_selesai');
      $tgl_sekarang = time();
      $email = $this-> input-> post('email');
      $iklan = $this -> db -> get_where('iklan', ['id' => $id_iklan]) -> row_array();

        $this->db->set('date_created', $tgl_sekarang);
        $this->db->where('id', $iklan['id']);
        $this->db->update('iklan');

        $this->db->set('tgl_selesai', $tgl_selesai);
        $this->db->where('id', $iklan['id']);
        $this->db->update('iklan');

        $this->db->set('is_active', 1);
        $this->db->where('id', $iklan['id']);
        $this->db->update('iklan');

        $this->db->set('status', 1);
        $this->db->where('id', $id_perpanjang);
        $this->db->update('perpanjang_iklan');

        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                    Iklan Berhasil Di perpanjang.
                </div></div>');
                redirect('admin/cek_iklan','refresh');
    }


      public function cek_mitra()
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      $data['title'] = 'Cek Mitra';
      $data['title2'] = 'Cek Mitra';
      $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
      $data['mitra']=$this->m_admin->get_mitra();
      $this -> load -> view('templates/header_admin', $data);
      $this -> load -> view('admin/cek_mitra', $data);
      $this -> load -> view('templates/footer_admin'); 
    }

    public function terima_mitra($id)
    {
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      $mitra = $this-> db -> get_where('mitra', ['id' => $id]) -> row_array();
      if (!$id) {
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Gagal aktif!
          </div></div>');
        redirect('admin/cek_mitra','refresh');
      } else{
        
        $this->db->set('is_active', 1);
        $this->db->where('id', $id);
        $this->db->update('mitra');

        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">' . $mitra['nama_toko'] . '
          Telah aktif!
          </div></div>');
        redirect('admin/cek_mitra','refresh');

      }
    }

    function hapus_mitra($id)
  {
    $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
    $mitra = $this-> db -> get_where('mitra', ['id' => $id]) -> row_array();

    $this->db->delete('mitra', ['id' => $id]);
    $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">' . $mitra['nama_toko'] . '
          Telah Dihapus!
          </div></div>');
    redirect('admin/cek_mitra','refresh');
  }

  public function kirim_saldo($id_isisaldo)
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      $isi_saldo = $this-> db -> get_where('isi_saldo', ['id_isisaldo' => $id_isisaldo]) -> row_array();
      $dompet =  $this-> db -> get_where('dompet', ['user_id' => $isi_saldo['id_user']]) -> row_array();
      $saldo_akhir = $dompet['saldo'] + $isi_saldo['jumlah'] ;
      $jumlah = $isi_saldo['jumlah'];
      $email = $dompet['email'];
      $this->db->set('saldo', $saldo_akhir);
      $this->db->where('user_id', $isi_saldo['id_user']);
      $this->db->update('dompet');

      $this->db->set('status_isisaldo', 1);
      $this->db->where('id_isisaldo', $id_isisaldo);
      $this->db->update('isi_saldo');
      $this -> _sendMail_isisaldo($email,$jumlah, 'terimasaldo');
      $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Saldo dompet user telah di update! ' . $dompet['email'] .'
          </div></div>');
      redirect('admin/tambah_saldo','refresh');


    }

    public function tolak_isiSaldo($id_isisaldo)
    { 
      $cek = $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
      if( $cek['role_id'] > 1){
          redirect('auth','refresh');
        }
      $isi_saldo = $this-> db -> get_where('isi_saldo', ['id_isisaldo' => $id_isisaldo]) -> row_array();
      $dompet =  $this-> db -> get_where('dompet', ['user_id' => $isi_saldo['id_user']]) -> row_array();
      $jumlah = $isi_saldo['jumlah'];
      $email = $dompet['email'];

      $this->db->set('status_isisaldo', 2);
      $this->db->where('id_isisaldo', $id_isisaldo);
      $this->db->update('isi_saldo');
      $this -> _sendMail_isisaldo($email,$jumlah, 'tolaksaldo');
      $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Anda Telah menolak Permintaan isi saldo dari ' . $dompet['email'] .'
          </div></div>');
      redirect('admin/tambah_saldo','refresh');


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
        $ci->email->to($email);
        if($type == 'terimasaldo') {
          $ci->email->subject('Isi Saldo Berhasil');
          $ci->email->message('<h3>Hai, '. $email . '</h3><br> <p>Admin Cemart telah menerima isi saldo di akun anda sebesar '.$jumlah.' terima kasih telah menggunakan cemart, selamat berbalanja</p>');
        } else if ($type == 'tolaksaldo') {
          $ci->email->subject('Isi Saldo Ditolak');
          $ci->email->message('<h3>Hai, '. $email . '</h3><br> <p>Maaf Admin Cemart telah menolak  isi saldo di akun anda sebesar '.$jumlah.', bukti transfer tidak valid. silahkan lakukan perohonan isi saldo kembali terima kasih telah menggunakan cemart</p>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function valid_iklan()
    {
      $cek_iklan =  $this -> db -> get_where('iklan') -> row_array();
      $tgl_sekarang = $this->input->post('tgl_sekarang');
      $tgl_selesai = $cek_iklan['tgl_selesai'];
      if ($tgl_selesai >= $tgl_sekarang) {
        $this->db->set('is_active', 0);
        $this->db->where('id', $cek_iklan['id']);
        $this->db->update('iklan');
      }
    }

}	
?>