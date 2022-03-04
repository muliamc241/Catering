<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_controller 
{
  public function __construct()
  {
    parent::__construct();
    $this -> load -> library('form_validation');
    $this -> load -> library('email');
    $this -> load -> library('cart');
    $this->load->helper('string');
    $this->load->helper('cookie');
    $this->load->model('keranjang_model');
    $this->load->model('m_admin');
    date_default_timezone_set("ASIA/JAKARTA");
  }
  
  public function index()
  { 
    if($this->session->userdata('email')){
      redirect('user');
    } else{


    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email',[
      'required' =>'Email Tidak Boleh Kosong',
      'valid_email' => 'Email Tidak Valid!'
    ]);
    $this-> form_validation -> set_rules('password', 'Password', 'required|trim',[
      'required' =>'Password Tidak Boleh Kosong'
    ]);
    if($this-> form_validation-> run() == false) {
    $data['title'] = 'Catering Home';
    $kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
    $data['produk'] = $this->keranjang_model->get_produk_index($kategori);
    $data['gambar']=$this->m_admin->get_tipe_galeri($kategori);
    $data['kategori_event'] = $this->keranjang_model->get_kategori();
    $this-> pagenation();
    $this -> load -> view('templates/header_index', $data);
    $this -> load -> view('auth/index');
    $this -> load -> view('templates/footer');
    } else {
      $this->_login();
    }
    }

  }

  function pagenation(){
    $total_makanan = $this->keranjang_model->JumlahBarang();
    $this->load->library('pagination');
    $config['base_url'] = 'http://localhost/codeigniter/auth';
    $config['total_rows'] = 5;
    $config['per_page'] = 5;
    $this->pagination->initialize($config);
  }

  
  private function _login()
  {
    $email = $this-> input->post('email');
    $password = $this-> input->post('password');

    $user = $this-> db -> get_where('user', ['email' => $email]) -> row_array();
    $admin = $this-> db -> get_where('log_login', ['id' => $user['id']]) -> row_array();
    // $cek_iklan =  $this -> db -> get_where('iklan') -> row_array();
    //   $tgl_sekarang = time();
    //   $tgl_selesai = time(strtotime($cek_iklan['tgl_selesai']));
    //   if ($tgl_selesai > $tgl_sekarang) {
    //     $this->db->set('is_active', 0);
    //     $this->db->where('id', $cek_iklan['id']);
    //     $this->db->update('iklan');
    //   }
    //jika user ada
    if($user){
      //jika user aktif
      if($user['is_active'] == 1){
        //cek password
        if(password_verify($password, $user['password'])){
            $id_login = random_string('numeric', 4);
            $cek = [
              'id' => $id_login,
              'id_user' => $user['id'],
              'ip' => $this->input->ip_address(),
              'start' => time(),
              'off' => 0,
              'online' => 1,
            ];
            $this-> db ->insert('log_login', $cek);
            $data = [
              'id'  =>  $user['id'],
              'email' => $user['email'],
              'role_id' => $user['role_id'],
              'id_login' => $id_login,
            ];           
            $this->session->set_userdata($data);
            if($user['role_id'] == 1){
              redirect('admin');
            } else if($user['role_id'] == 2){
              redirect('user/index/'. $user['id']);
            }else{
            redirect('auth');
            }
        }else{
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Password salah!
          </div></div>');
        redirect('auth','refresh');
        }

      }else{
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          email belum aktivasi!
          </div></div>');
        redirect('auth','refresh');

      }
    }else{
      //jika user tidak ada
      $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Email Tidak terdaftar
          </div></div>');
        redirect('auth','refresh');
    }
  }
  public function loginMitra()
  {

    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email',[
      'required' =>'Email Tidak Boleh Kosong',
      'valid_email' => 'Email Tidak Valid!'
    ]);
    $this-> form_validation -> set_rules('password', 'Password', 'required|trim',[
      'required' =>'Password Tidak Boleh Kosong'
    ]);
    if($this-> form_validation-> run() == false) {
    $data['title'] = 'Catering Home';
    $kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
    $data['produk'] = $this->keranjang_model->get_produk_index($kategori);
    $data['gambar']=$this->m_admin->get_tipe_galeri($kategori);
    $data['kategori_event'] = $this->keranjang_model->get_kategori();
    $this-> pagenation();
    $this -> load -> view('templates/header_index', $data);
    $this -> load -> view('auth/index');
    $this -> load -> view('templates/footer');
    } else {
    $email = $this-> input->post('email');
    $password = $this-> input->post('password');

    $mitra = $this-> db -> get_where('mitra', ['email' => $email]) -> row_array();
    $cek_iklan =  $this -> db -> get_where('iklan') -> row_array();
      $tgl_sekarang = date('d F Y');
      if ($cek_iklan['tgl_selesai'] < $tgl_sekarang) {
        $this->db->set('is_active', 0);
        $this->db->where('id', $cek_iklan['id']);
        $this->db->update('iklan');
      }
    //jika user ada
    if($mitra){
      //jika user aktif
      if($mitra['is_active'] == 1){
        //cek password
        if(password_verify($password, $mitra['password'])){
            $id_login = random_string('numeric', 4);
            $cek = [
              'id' => $id_login,
              'id_user' => $mitra['id'],
              'start' => time(),
              'off' => 0,
              'online' => 1
            ];
            $this-> db ->insert('log_login', $cek);
            $data = [
              'email' => $mitra['email'],
              'role_id' => $mitra['role_id'],
              'id_login' => $id_login,
            ];
            $this->session->set_userdata($data);
            if($mitra['role_id'] == 1){
              redirect('admin');
            } else if($mitra['role_id'] == 3){
              redirect('mitra/index_mitra/' .$mitra['id'],'refresh');
            }
          }else{
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Password salah!
          </div></div>');
        redirect('auth','refresh');
        }

      }else{
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
                Maaf toko anda belum aktif, Tunggu akan segera kami proses 1 x 24 jam!!
                </div></div>');
        redirect('auth','refresh');

      }
    }else{
      //jika user tidak ada
      $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Email Tidak terdaftar
          </div></div>');
        redirect('auth','refresh');

      }
    }
  }

  public function register()
  { $this-> form_validation -> set_rules('nama', 'Nama', 'required|trim|min_length[5]',[
      'required' =>'Nama Tidak Boleh Kosong',
      'min_length' => 'Nama terlalu pendek!'
    ]);
    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
      'required' =>'Email Tidak Boleh Kosong',
      'valid_email' =>'Harap masukkan email yang valid!',
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
    $this-> form_validation -> set_rules('tgl_lahir', 'Tgl_lahir', 'required|trim',[
      'required' =>'Tanggal Lahir Tidak Boleh Kosong',
    ]);
    $this-> form_validation -> set_rules('no_hp', 'No_hp', 'required|trim|min_length[11]|max_length[13]|is_unique[user.no_hp]|is_numeric',[
      'required' =>'No Telepon Tidak Boleh Kosong',
      'is_unique' => 'Nomor Telepon Telah Terdaftar!',
      'is_numeric' => 'Harap masukkan Angka!'
    ]);

    if($this-> form_validation-> run() == false) {
        $data['title'] = 'Catering Register';
        $data['kategori'] = $this->keranjang_model->get_kategori();
        $dariDB = $this->m_admin->cekiduser();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 1);
        $id_userSekarang = $nourut + 1;
        $kode = array('kode_user' => $id_userSekarang);
        $this -> load -> view('templates/header_index', $data);
        $this -> load -> view('auth/register', $kode);
        $this -> load -> view('templates/footer');
    } else {

        $email = $this -> input -> post('email');
        $data = [
            'id' => $this -> input -> post('id_user'),
            'nama' =>htmlspecialchars( $this -> input -> post('nama', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'tgl_lahir' => $this -> input -> post('tgl_lahir'),
            'no_hp' => $this -> input -> post('no_hp'),
            'role_id' => 2,
            'is_active' => 0,
            'toko' => 0,
            'date_created' => time()

        ];

        // token
        $token = base64_encode(random_bytes(32));

        $user_token = [
          'email'        => $email,
          'token'        => $token,
          'date_created' => time()
        ];

        $this-> db ->insert('user', $data);
        $this-> db ->insert('user_token', $user_token);

        $this -> _sendMail($token, 'verify');

        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat akun anda berhasil di buat!, Silahkan Cek email untuk Aktivasi Akun!
          </div></div>');
        redirect('auth','refresh');
      }
  }
  public function register_mitra()
  { $this-> form_validation -> set_rules('nama_toko', 'Nama', 'required|trim|min_length[5]',[
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
        $data['kategori'] = $this->keranjang_model->get_kategori();
        $dariDB = $this->m_admin->cekidmitra();
        // contoh MTR4, angka 3 adalah awal pengambilan angka, dan 1 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 1);
        $id_mitraSekarang = $nourut + 1;
        $kode = array('kode_mitra' => $id_mitraSekarang);
        $this -> load -> view('templates/header_index', $data);
        $this -> load -> view('mitra/register', $kode);
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


        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat akun anda berhasil di buat!, Silahkan Tunggu Admin untuk Aktivasi Akun!
          </div></div>');
        redirect('auth','refresh');
    }
    
  }
    private function _sendMail($token, $type) 
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
        } else if($type == 'forgot') {
          $ci->email->subject('Reset Password');
          $ci->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpassword?email=' . $this -> input ->post('email') . '&token='. urlencode($token) .'">Reset Password</a>');
        } else if($type == 'forgotmitra') {
          $ci->email->subject('Reset Password');
          $ci->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpasswordMitra?email=' . $this -> input ->post('email') . '&token='. urlencode($token) .'">Reset Password</a>');
        }   
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function verify()
    {
      $email = $this -> input -> get('email');
      $token = $this -> input -> get('token');

      $user = $this -> db ->get_where('user', ['email' => $email])->row_array();

      if ($user) {
        $user_token = $this -> db ->get_where('user_token', ['token' => $token])->row_array();
        if($user_token){
          if(time() - $user_token['date_created'] < (60*60*24)){
            $this->db->set('is_active', 1);
            $this->db->where('email', $email);
            $this->db->update('user');


            $this->db->delete('user_token', ['email' => $email]);
            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">'. $email .'
          Telah aktif! Silah kan Login.
          </div></div>');
        redirect('auth','refresh');
          }else{
            $this->db->delete('user', ['email' => $email]);
            $this->db->delete('user_token', ['email' => $email]);

            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Aktivasi Akun Expired, Silahkan Daftar Ulang.
          </div></div>');
        redirect('auth','refresh');
          }
        }else{
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Aktivasi Akun Gagal! Token Salah.
          </div></div>');
        redirect('auth','refresh');
        }
      } else {
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Aktivasi Akun Gagal! Email Salah.
          </div></div>');
        redirect('auth','refresh');
      }

    }
 

  public function logout($id)
  { 
    $waktu = time();
    $this->db->set('off', $waktu);
    $this->db->where('id', $id);
    $this->db->update('log_login');

    $this->db->set('online', 0);
    $this->db->where('id', $id);
    $this->db->update('log_login');

    $this-> session->unset_userdata('email');
    $this-> session->unset_userdata('role_id');
    $this->cart->destroy();
    $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat anda berhasil Logout!
          </div></div>');
        redirect('auth','refresh');
  }

  public function kembali()
  {
    $this->cart->destroy();
    $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat anda Kembali menjadi Akun User
          </div></div>');
        redirect('user','refresh');
  }

  public function forgotPassword()
  { 
    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email',[
      'required' =>'Email Tidak Boleh Kosong',
      'valid_email' => 'Email Tidak Valid'
    ]);
    if($this-> form_validation-> run() == false) {
    $data['title'] = 'Forgot Password';
    $this -> load -> view('templates/header_index', $data);
    $this -> load -> view('auth/forgot');
    $this -> load -> view('templates/footer');
    } else {
      $email = $this -> input -> post('email');
      $user  = $this-> db-> get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

      if($user){
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];
        $this -> db->insert('user_token', $user_token);
        $this-> _sendMail($token, 'forgot');

        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Cek email Untuk Reset Password.
          </div></div>');
        redirect('auth/forgotPassword','refresh');

      } else{
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Email Belum Terdaftar atau Belum Aktivasi!
          </div></div>');
        redirect('auth/forgotPassword','refresh');
      }
    }
  }

  public function forgotPasswordMitra()
  { 
    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email',[
      'required' =>'Email Tidak Boleh Kosong',
      'valid_email' => 'Email Tidak Valid'
    ]);
    if($this-> form_validation-> run() == false) {
    $data['title'] = 'Forgot Password Mitra';
    $this -> load -> view('templates/header_mitra_index', $data);
    $this -> load -> view('auth/forgotmitra');
    $this -> load -> view('templates/footer');
    } else {
      $email = $this -> input -> post('email');
      $mitra  = $this-> db-> get_where('mitra', ['email' => $email, 'is_active' => 1])->row_array();

      if($mitra){
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];
        $this -> db->insert('user_token', $user_token);
        $this-> _sendMail($token, 'forgotmitra');

        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Cek email Untuk Reset Password.
          </div></div>');
        redirect('auth/forgotPasswordMitra','refresh');

      } else{
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Email Belum Terdaftar atau Belum Aktivasi!
          </div></div>');
        redirect('auth/forgotPasswordMitra','refresh');
      }
    }
  }

  public function resetpassword()
  {
      $email = $this -> input -> get('email');
      $token = $this -> input -> get('token');

      $user = $this -> db ->get_where('user', ['email' => $email])->row_array();
      if($user){
        $user_token = $this -> db ->get_where('user_token', ['token' => $token])->row_array();
        if($user_token){
          if(time() - $user_token['date_created'] < (60*5)){
          $this -> session-> set_userdata('reset_email', $email);
          $this->changePassword();
          } else {
            $this->db->delete('user', ['email' => $email]);
            $this->db->delete('user_token', ['email' => $email]);

            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Token Expired!
          </div></div>');
        redirect('auth','refresh');
          } 
        } else {
           $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Reset password failed, Token Salah. 
          </div></div>');
        redirect('auth','refresh');
        }
      } else {
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Reset password failed, Email Salah. 
          </div></div>');
        redirect('auth','refresh');
      }
  }

  public function resetpasswordMitra()
  {
      $email = $this -> input -> get('email');
      $token = $this -> input -> get('token');

      $mitra = $this -> db ->get_where('mitra', ['email' => $email])->row_array();
      if($mitra){
        $user_token = $this -> db ->get_where('user_token', ['token' => $token])->row_array();
        if($user_token){
          if(time() - $user_token['date_created'] < (60*5)){
          $this -> session-> set_userdata('reset_email', $email);
          $this->changePasswordMitra();
          } else {
            $this->db->delete('mitra', ['email' => $email]);
            $this->db->delete('user_token', ['email' => $email]);

            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Token Expired!
          </div></div>');
        redirect('auth','refresh');
          } 
        } else {
           $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Reset password failed, Token Salah. 
          </div></div>');
        redirect('auth','refresh');
        }
      } else {
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Reset password failed, Email Salah. 
          </div></div>');
        redirect('auth','refresh');
      }
  }

  public function changePassword()
  { 
    if(!$this->session->userdata('reset_email')){
      redirect('auth');
    }
    $this-> form_validation -> set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]',[
      'required' =>'Password Tidak Boleh Kosong',
      'min_length' => 'Password terlalu Pendek'
    ]);
    $this-> form_validation -> set_rules('password2', 'Password', 'required|trim|matches[password1]',[
        'matches' => 'Password Tidak sama!',
        'required' => 'Password Tidak Boleh Kosong'
    ]);
    if($this-> form_validation-> run() == false) {
    $data['title'] = 'Change Password';
    $data['kategori'] = $this->keranjang_model->get_kategori();
    $this -> load -> view('templates/header_index', $data);
    $this -> load -> view('auth/change_password');
    $this -> load -> view('templates/footer');
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this -> session -> userdata('reset_email');
      
      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('user');

       $this-> session->unset_userdata('reset_email');
       $this->db->delete('user_token', ['email' => $email]);
       $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat Password anda telah Dirubah, Silahkan Login.
          </div></div>');
        redirect('auth','refresh');
      }
  }

    public function changePasswordMitra()
  { 
    if(!$this->session->userdata('reset_email')){
      redirect('auth');
    }
    $this-> form_validation -> set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]',[
      'required' =>'Password Tidak Boleh Kosong',
      'min_length' => 'Password terlalu Pendek'
    ]);
    $this-> form_validation -> set_rules('password2', 'Password', 'required|trim|matches[password1]',[
        'matches' => 'Password Tidak sama!',
        'required' => 'Password Tidak Boleh Kosong'
    ]);
    if($this-> form_validation-> run() == false) {
    $data['title'] = 'Change Password';
    $data['kategori'] = $this->keranjang_model->get_kategori();
    $this -> load -> view('templates/header_mitra_index', $data);
    $this -> load -> view('auth/change_passwordMitra');
    $this -> load -> view('templates/footer');
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this -> session -> userdata('reset_email');
      
      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('mitra');

       $this-> session->unset_userdata('reset_email');
       $this->db->delete('user_token', ['email' => $email]);
       $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat Password anda telah Dirubah, Silahkan Login.
          </div></div>');
        redirect('auth','refresh');
      }
  }

  public function dompet()
  {
     $email = $this -> input ->post('email');
     $user_id = $this -> input ->post('user_id');
     $user = $this -> db ->get_where('dompet', ['email' => $email])->row_array();
      if(!$user){
         redirect('auth/dompet_buat/' . $user_id,'refresh');
      } else{
         redirect('user/dompet/' . $user_id,'refresh');
      }

  }

  public function dompet_buat()
  {  
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
    $this-> form_validation -> set_rules('pin1', 'Pin', 'required|trim|min_length[6]|max_length[6]|matches[pin2]',[
        'min_length' => 'Pin terlalu pendek!',
        'max_length' => 'Pin terlalu panjang!',
        'required' =>'Pin Tidak Boleh Kosong'
    ]);
    $this-> form_validation -> set_rules('pin2', 'Pin', 'required|trim|matches[pin1]',[
        'matches' => 'Pin Tidak sama!'
    ]);   
    if($this-> form_validation-> run() == false){
        $data['title'] = 'Dompet';
        $data['user']= $this -> db -> get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        $data['admin'] = $this -> db -> get_where('log_login', ['id' => $this->session->userdata('id_login')]) -> row_array();
        $user=($this->uri->segment(3))?$this->uri->segment(3):0;
        $data['jmlh_keranjang'] = $this->keranjang_model->JumlahKeranjang($user);
        $data['kategori'] = $this->keranjang_model->get_kategori();
        $this -> load -> view('templates/header', $data);
        $this -> load -> view('auth/dompet_buat', $data);
        $this -> load -> view('templates/footer');
    
      }else{
        $email = $this -> input -> post('email');
        $data = [
            'email' => htmlspecialchars($this->session->userdata('email')),
            'user_id' => $this->session->userdata('id'),
            'pin' => password_hash($this->input->post('pin1'), PASSWORD_DEFAULT),
            'saldo' => 0,
            'date_created' => time()

        ];


        $this-> db ->insert('dompet', $data);
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat dompet anda berhasil di buat!, Silahkan Isi untuk Berbelanja!
          </div></div>');
        redirect('user/profil','refresh');
    }
    
  }

  public function req_iklan()
  { $this-> form_validation -> set_rules('nama', 'Nama', 'required|trim|min_length[5]',[
      'required' =>'Nama Tidak Boleh Kosong',
      'min_length' => 'Nama terlalu pendek!'
    ]);
    $this-> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email',[
      'required' =>'Email Tidak Boleh Kosong',
      'valid_email' =>'Harap masukkan email yang valid!',
    ]);
    $this-> form_validation -> set_rules('jml_transfer', 'Jml_transfer', 'required|trim|min_length[6]|is_numeric',[
      'required' =>'No Telepon Tidak Boleh Kosong',
      'min_length' => 'Jumlah Kurang, min Rp, 200.000!',
      'is_numeric' => 'Harap masukkan Angka!'
    ]);


    if($this-> form_validation-> run() == false) {
        $data['title'] = 'Request Iklan';
        $data['kategori'] = $this->keranjang_model->get_kategori();
        $this -> load -> view('templates/header_index', $data);
        $this -> load -> view('auth/req_iklan');
        $this -> load -> view('templates/footer');
    } else {

      $upload_image = $_FILES['foto_transfer']['name'];
      
      $nama = $this -> input -> post('nama', true);

        $nmfile = "BuktiTF " . time();
        $config['upload_path']          = './img/admin/request_iklan/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 2MB
            $config['file_name'] = $nmfile;
            $this->load->library('upload', $config);

            if($this->upload->do_upload('foto_transfer')){
              $new_image = $this->upload->data('file_name');
            }else{
              echo $this->upload->display_errors();
            }

        $image = $_FILES['foto_iklan']['name'];
        $nmfile = "Iklan " . time();
        $config['upload_path']          = './img/galeri/iklan';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 2MB
            $config['file_name'] = $nmfile;
            $this->load->library('upload', $config);

            if($this->upload->do_upload('foto_iklan')){
              $iklan_image = $this->upload->data('file_name');
            }else{
              echo $this->upload->display_errors();
            }

        $email = $this -> input -> post('email');
        $data = [
            'nama' =>htmlspecialchars( $this -> input -> post('nama', true)),
            'email' => htmlspecialchars($email),
            'bukti' => $new_image,
            'iklan' => $iklan_image,
            'bulan' => $this -> input -> post('bulan'),
            'date_created' => time()

        ];

        $this-> db ->insert('req_iklan', $data);


        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat anda berhasil mendaftarkan iklan anda!, Silahkan Tunggu iklan anda terbit!
          </div></div>');
        redirect('auth','refresh');
    }
    
  }

      public function perpanjang_iklan()
    {
      $email = $this -> input -> get('email');
      $token = $this -> input -> get('token');

        $user_token = $this -> db ->get_where('user_token', ['token' => $token])->row_array();
        if($user_token){
          if(time() - $user_token['date_created'] < (60*60*24)){
            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">Silahkan Isi form dibawah ini
          </div></div>');
            $this-> form_validation -> set_rules('nama', 'Nama', 'required|trim|min_length[5]',[
              'required' =>'Nama Tidak Boleh Kosong',
              'min_length' => 'Nama terlalu pendek!'
            ]);
            $this-> form_validation -> set_rules('jml_transfer', 'Jml_transfer', 'required|trim|min_length[6]|is_numeric',[
              'required' =>'No Telepon Tidak Boleh Kosong',
              'min_length' => 'Jumlah Kurang, min Rp, 200.000!',
              'is_numeric' => 'Harap masukkan Angka!'
            ]);


            if($this-> form_validation-> run() == false) {
                $data['title'] = 'Request Iklan';
                $data['kategori'] = $this->keranjang_model->get_kategori();
                $data['email'] = $this -> input -> get('email');
                $data['id_iklan'] = $this -> input -> get('id_iklan');
                $data['token'] = $this -> input -> get('token');
                $this -> load -> view('templates/header_index', $data);
                $this -> load -> view('auth/perpanjang_iklan');
                $this -> load -> view('templates/footer');
            }
          }else{
            $this->db->delete('user', ['email' => $email]);
            $this->db->delete('user_token', ['email' => $email]);

            $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Perpanjang Iklan Expired, Silahkan Daftar Ulang Iklan anda.
          </div></div>');
        redirect('auth','refresh');
          }
        }else{
          $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-danger" role="alert">
          Perpanjang Iklan Gagal! Token Salah.
          </div></div>');
        redirect('auth','refresh');
        }

    }

    public function perpanjang_iklanAction()
    {
              $upload_image = $_FILES['foto_transfer']['name'];
      
              $nama = $this -> input -> post('nama', true);

              $nmfile = "BuktiTF " . time();
              $config['upload_path']          = './img/admin/bukti_pembayaran/';
                  $config['allowed_types']        = 'jpg|png';
                  $config['overwrite']            = true;
                  $config['max_size']             = 2048; // 2MB
                  $config['file_name'] = $nmfile;
                  $this->load->library('upload', $config);

                  if($this->upload->do_upload('foto_transfer')){
                    $new_image = $this->upload->data('file_name');
                  }else{
                    echo $this->upload->display_errors();
                  }

              $email = $this -> input -> post('email');
              $data = [
                  'nama' =>htmlspecialchars( $this -> input -> post('nama', true)),
                  'email' => htmlspecialchars($email),
                  'bukti' => $new_image,
                  'bulan' => $this -> input -> post('bulan'),
                  'date_created' => time()

              ];

              $this-> db ->insert('perpanjang_iklan', $data);
              $this->db->delete('user_token', ['email' => $email]);
              $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                Selamat anda berhasil memperpanjang iklan anda!, Silahkan Tunggu iklan anda terbit!
                </div></div>');
              redirect('auth','refresh');
    }

  

  public function test_email()
  {     
        $mesg = $this->load->view('auth/test_email','',true);
        $content = $this->load->view('auth/test_email');
        $ci = get_instance();
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "cateringmart2019@gmail.com";
        $config['smtp_pass'] = "Angsana1";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        $ci->email->from('cateringmart2019@gmail.com', 'Catering (do not raply)');
        $ci->email->to('muliaadhasiregar241@gmail.com');
        $ci->email->subject('Account Verificationl');
        // $ci->email->message($mesg);
        // $this->email->send();
        $filename = 'img/logo1.png';
        $this->email->attach($filename);
                $cid = $this->email->attachment_cid($filename);
                $this->email->message($mesg);
                $this->email->send();
        
        
        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
          Selamat anda berhasil mengirim!
          </div></div>');
        redirect('auth','refresh');

  }
  
}
