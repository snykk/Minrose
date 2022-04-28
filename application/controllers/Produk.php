<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Produk';
        $data['css'] = 'produk';
        $data['js'] = 'produkkk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data["produk"] = $this->db->query("SELECT * FROM produk");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view('produk/index', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('produk/modal_detail_produk');
        $this->load->view('produk/modal_tambah_produk');
        $this->load->view('produk/modal_ubah_produk');
        $this->load->view('templates/footer', $data);
    }

    public function getDataProduk() {
        $produk_id = (INT)$_POST["id"];
        $result = $this->db->query("SELECT * FROM produk WHERE id={$produk_id}");
            
        $data = [];

        array_push($data, $result->row());

        // $data[0]["data_dibuat"] =  date('d F Y', $data[0]["data_dibuat"]);
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function tambah_produk() {
        $data['title'] = 'Tambah Produk';
        $data['css'] = 'produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama produk', 'required|trim|is_unique[produk.nama]', [
            'is_unique' => 'Nama produk ini telah ada di daftar produk, silahkan gunakan nama lain!',
            "required" => "Nama produk tidak boleh kosong"
        ]);
        $this->form_validation->set_rules('stok', 'Stok','required|trim', ["required"=>"Stok tidak boleh kosong"]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', ["required"=>"Harga tidak boleh kosong"]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim', ["required"=>"Diskon tidak boleh kosong"]);
        $this->form_validation->set_rules('orientasi', 'Orientasi', 'required|trim',["required"=>"Orientasi tidak boleh kosong"]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim',["required"=>"Deskripsi tidak boleh kosong"]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
    
            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }
    
            $this->load->view('produk/tambah_produk', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer', $data);
        } else {

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = "./assets/img/produk/";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'nama' => $this->input->post('nama',true),
                'orientasi' => $this->input->post('orientasi',true),
                'deskripsi' => $this->input->post('deskripsi',true),
                'harga' => (INT)$this->input->post('harga',true),
                'stok' => (INT)$this->input->post('stok',true),
                'diskon' => (FLOAT)$this->input->post('diskon',true),
                'image' => (isset($image)) ? $image : "default.png",
                'data_dibuat' => time(),
                'data_diedit' => time()
            ];

            $this->db->insert('produk', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil ditambahkan</div>');
            redirect('produk/index');
        }
    }

    public function ubah_produk() {
        $data['title'] = 'Ubah Produk';
        $data['css'] = 'produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        if (isset($_GET["id"])){
            $data["produk"] =  $this->db->get_where('produk', ['id' => $_GET["id"]])->row_array();
        } else {
            $data["produk"] =  $this->db->get_where('produk', ['id' => $this->input->post("id")])->row_array();
        }

        if ($this->input->post('nama') != $data["produk"]["nama"]) {
            $is_unique_produk =  '|is_unique[produk.nama]';
        } else {
            $is_unique_produk =  '';
        }

        $this->form_validation->set_rules('nama', 'Nama produk', 'required|trim' . $is_unique_produk, [
            'is_unique' => 'Nama produk ini telah ada di daftar produk, silahkan gunakan nama lain!',
            "required" => "Nama produk tidak boleh kosong"
        ]);
        $this->form_validation->set_rules('stok', 'Stok','required|trim', ["required"=>"Stok tidak boleh kosong"]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', ["required"=>"Harga tidak boleh kosong"]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim', ["required"=>"Diskon tidak boleh kosong"]);
        $this->form_validation->set_rules('orientasi', 'Orientasi', 'required|trim',["required"=>"Orientasi tidak boleh kosong"]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim',["required"=>"Deskripsi tidak boleh kosong"]);

        // proses akan diredirect jika tidak ada perubahan
        if ($this->input->post('nama') == $data["produk"]["nama"] && $this->input->post('deskripsi') == $data["produk"]["deskripsi"] && $this->input->post('stok') == $data["produk"]["stok"] && $this->input->post('harga') == $data["produk"]["harga"] && $this->input->post('diskon') == $data["produk"]["diskon"] && $this->input->post('orientasi') == $data["produk"]["orientasi"] && !($_FILES['image']['name'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Perubahan dibatalkan, tidak ada data yang diubah</div>');
            redirect('produk/ubah_produk?id=' . $data["produk"]["id"]);
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);

            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }
            $this->load->view('produk/ubah_produk', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            // mengambil id produk
            $id = $this->input->post('id',true);

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = "./assets/img/produk/";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    // mengambil image lama menggunakan id produk
                    $old_image = $this->db->query("SELECT image FROM produk WHERE id={$id}")->row();

                    $new_image = $this->upload->data('file_name');

                    if ($new_image != $old_image) {
                        unlink(FCPATH . 'assets/img/produk/' . $old_image->image);
                        $this->db->set('image', $new_image);
                    }
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'nama' => $this->input->post('nama',true),
                'orientasi' => $this->input->post('orientasi',true),
                'deskripsi' => $this->input->post('deskripsi',true),
                'harga' => (INT)$this->input->post('harga',true),
                'stok' => (INT)$this->input->post('stok',true),
                'diskon' => (FLOAT)$this->input->post('diskon',true),
                'data_diedit' => time()
            ];

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('produk');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil diubah</div>');
            redirect('produk/index');
        }
    }

    // public function addProduk()
    // {
    //     if ($this->session->userdata('role_id') == 2) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda tidak memiliki previlege untuk menjalankan akses ini</div>');
    //         redirect('produk/index');
    //     }

    //     $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
    //     $this->form_validation->set_rules('orientasi', 'Orientasi', 'required|trim');
    //     $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
    //     $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
    //     $this->form_validation->set_rules('stok', 'Stok', 'required|trim');
    //     $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim');

    //     if ($this->form_validation->run() == true) {

    //         // cek jika ada gambar yang akan diupload
    //         $upload_image = $_FILES['image']['name'];

    //         if ($upload_image) {
    //             $config['allowed_types'] = 'gif|jpg|png';
    //             $config['max_size']      = '2048';
    //             $config['upload_path'] = "./assets/img/produk/";

    //             $this->load->library('upload', $config);

    //             if ($this->upload->do_upload('image')) {
    //                 $image = $this->upload->data('file_name');
    //             } else {
    //                 echo $this->upload->display_errors();
    //             }
    //         }

    //         $data = [
    //             'nama' => $this->input->post('nama_produk',true),
    //             'orientasi' => $this->input->post('orientasi',true),
    //             'deskripsi' => $this->input->post('deskripsi',true),
    //             'harga' => (INT)$this->input->post('harga',true),
    //             'stok' => (INT)$this->input->post('stok',true),
    //             'diskon' => (FLOAT)$this->input->post('diskon',true),
    //             'image' => $image,
    //             'data_dibuat' => time(),
    //             'data_diedit' => time()
    //         ];

    //         $this->db->insert('produk', $data);

    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil ditambahkan</div>');
    //         redirect('produk/index');
    //     }
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data produk gagal ditambahkan</div>');
    //     redirect('produk/index');
    // }

    // public function editProduk()
    // {
    //     if ($this->session->userdata('role_id') == 2) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda tidak memiliki previlege untuk menjalankan akses ini</div>');
    //         redirect('produk/index');
    //     }

    //     $this->form_validation->set_rules('ubah_nama_produk', 'Nama Produk', 'required|trim');
    //     $this->form_validation->set_rules('ubah_orientasi', 'Orientasi', 'required|trim');
    //     $this->form_validation->set_rules('ubah_deskripsi', 'Deskripsi', 'required|trim');
    //     $this->form_validation->set_rules('ubah_harga', 'Harga', 'required|trim');
    //     $this->form_validation->set_rules('ubah_stok', 'Stok', 'required|trim');
    //     $this->form_validation->set_rules('ubah_diskon', 'Diskon', 'required|trim');


    //     if ($this->form_validation->run() == true) {

    //         // mengambil id produk
    //         $id = $this->input->post('produk_id',true);

    //         // cek jika ada gambar yang akan diupload
    //         $upload_image = $_FILES['ubah_image']['name'];

    //         if ($upload_image) {

    //             $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //             $config['max_size']      = '2048';
    //             $config['upload_path'] = "./assets/img/produk/";

    //             $this->load->library('upload', $config);

    //             if ($this->upload->do_upload('ubah_image')) {

    //                 // mengambil image lama menggunakan id produk
    //                 $old_image = $this->db->query("SELECT image FROM produk WHERE id={$id}")->row();

    //                 $new_image = $this->upload->data('file_name');

    //                 if ($new_image != $old_image) {
    //                     unlink(FCPATH . 'assets/img/produk/' . $old_image->image);
    //                     $this->db->set('image', $new_image);
    //                 }
    //             } else {
    //                 echo $this->upload->display_errors();
    //             }
    //         }

    //         $data = [
    //             'nama' => $this->input->post('ubah_nama_produk',true),
    //             'orientasi' => $this->input->post('ubah_orientasi',true),
    //             'deskripsi' => $this->input->post('ubah_deskripsi',true),
    //             'harga' => (INT)$this->input->post('ubah_harga',true),
    //             'stok' => (INT)$this->input->post('ubah_stok',true),
    //             'diskon' => (FLOAT)$this->input->post('ubah_diskon',true),
    //             'data_diedit' => time()
    //         ];

    //         $this->db->set($data);
    //         $this->db->where('id', $id);
    //         $this->db->update('produk');


    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil diubah</div>');
    //         redirect('produk/index');
    //     }
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data produk gagal diubah</div>');
    //     redirect('produk/index');
    // }
}
