<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class tambah_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keranjang_model');
        $this->load->library('form_validation');
    }


    public function add()
    {   
        $this-> form_validation -> set_rules('nama', 'Nama', 'required|trim',[
            'required' =>'Nama Tidak Boleh Kosong',
            ]);
        $this-> form_validation -> set_rules('harga', 'Harga', 'required|trim|is_numeric',[
            'required' =>'harga Tidak Boleh Kosong',
            ]);
        $this-> form_validation -> set_rules('kategori', 'Kategori', 'required|trim',[
          'required' =>'Kategori Tidak Boleh Kosong',
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
        if($image = '') {} else {
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


        $data = [
                'nama' => $nama,
                'harga' => $harga,
                'kategori' => $kategori,
                'deskripsi'=> $deskripsi,
                'image' => $image,
                'nama_catering' => $nama_catering
             
            ];
                $this-> db ->insert('makanan', $data);
                $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
                    Selamat Makanan berhasil di Tambah!
                </div></div>');
                redirect('mitra/index_mitra','refresh');
        }
    }

    public function edit()
    {   
        $product_id = $this->input->post('product_id');
        $id_mitra = $this->input->post('id_mitra');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $kategori = $this->input->post('kategori');
        $deskripsi = $this->input->post('deskripsi');

        $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $nmfile = "Product ".time();
                $config['upload_path']          = './img/product/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['overwrite']            = true;
                $config['max_size']             = 2048; // 2MB
                $config['width']            = 680;
                $config['height']           = 383;
                $config['file_name'] = $nmfile;
                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $makanann = $this-> db -> get_where('makanan', ['product_id' => $product_id]) -> row_array();
                    $old_image = $makanann['image'];
                    unlink(FCPATH . '/img/profile/' . $old_image);



                    $new_image = $this->upload->data("file_name");
                    $this->db->set('image', $new_image);
                    

                }else{
                    echo $this->upload->display_errors();
                }
            }

        $this->db->set('nama', $nama);
        $this->db->where('product_id', $product_id);
        $this->db->update('makanan');

        $this->db->set('harga', $harga);
        $this->db->where('product_id', $product_id);
        $this->db->update('makanan');

        $this->db->set('kategori', $kategori);
        $this->db->where('product_id', $product_id);
        $this->db->update('makanan');

        $this->db->set('deskripsi', $deskripsi);
        $this->db->where('product_id', $product_id);
        $this->db->update('makanan');


        $this-> session->set_flashdata('message', '<div class="col-lg-12 text-center text-lg-left"><div class="alert alert-success" role="alert">
            Selamat Makanan berhasil di Tambah!
            </div></div>');
        redirect('mitra/index_mitra/'. $id_mitra,'refresh');

        }
}
    
