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
        $data['js'] = 'produk';
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
        foreach ($result->result() as $row) {
            array_push($data, $row);
        }
    
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function addProduk()
    {
        if ($this->session->userdata('role_id') == 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda tidak memiliki previlege untuk menjalankan akses ini</div>');
            redirect('produk/index');
        }

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('orientasi', 'Orientasi', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim');
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim');

        if ($this->form_validation->run() == true) {

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
                'nama' => $this->input->post('nama_produk',true),
                'orientasi' => $this->input->post('orientasi',true),
                'deskripsi' => $this->input->post('deskripsi',true),
                'harga' => (INT)$this->input->post('harga',true),
                'stok' => (INT)$this->input->post('stok',true),
                'diskon' => (FLOAT)$this->input->post('diskon',true),
                'image' => $image,
                'data_dibuat' => time(),
                'data_diedit' => time()
            ];

            $this->db->insert('produk', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil ditambahkan</div>');
            redirect('produk/index');
        }
    }

    public function editProduk()
    {
        if ($this->session->userdata('role_id') == 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda tidak memiliki previlege untuk menjalankan akses ini</div>');
            redirect('produk/index');
        }

        $this->form_validation->set_rules('ubah_nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('ubah_orientasi', 'Orientasi', 'required|trim');
        $this->form_validation->set_rules('ubah_deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('ubah_harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('ubah_stok', 'Stok', 'required|trim');
        $this->form_validation->set_rules('ubah_diskon', 'Diskon', 'required|trim');


        if ($this->form_validation->run() == true) {

            // mengambil id produk
            $id = $this->input->post('produk_id',true);

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['ubah_image']['name'];

            if ($upload_image) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = "./assets/img/produk/";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('ubah_image')) {

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
                'nama' => $this->input->post('ubah_nama_produk',true),
                'orientasi' => $this->input->post('ubah_orientasi',true),
                'deskripsi' => $this->input->post('ubah_deskripsi',true),
                'harga' => (INT)$this->input->post('ubah_harga',true),
                'stok' => (INT)$this->input->post('ubah_stok',true),
                'diskon' => (FLOAT)$this->input->post('ubah_diskon',true),
                'data_diedit' => time()
            ];

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('produk');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil ditambahkan</div>');
            redirect('produk/index');
        }
    }
}
