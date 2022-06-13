<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model("Produk_model");
        $this->load->model("Global_model");
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
        $this->load->view('templates/footer', $data);
    }

    public function getDataProduk()
    {
        $produk_id = (int)$_POST["id"];
        $result = $this->db->query("SELECT * FROM produk WHERE id={$produk_id}");

        $data = [];

        array_push($data, $result->row());

        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function tambah_produk()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $data['title'] = 'Tambah Produk';
        $data['css'] = 'produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama produk', 'required|trim|is_unique[produk.nama]', [
            'is_unique' => 'Nama produk ini telah ada di daftar produk, silahkan gunakan nama lain!',
            "required" => "Nama produk tidak boleh kosong"
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric', [
            "required" => "Stok tidak boleh kosong",
            "numeric" => "Data yang diinputkan bukan berupa karakter numeric",
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric', [
            "required" => "Harga tidak boleh kosong",
            "numeric" => "Data yang diinputkan bukan berupa karakter numeric",
        ]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim|numeric', [
            "required" => "Diskon tidak boleh kosong",
            "numeric" => "Data yang diinputkan bukan berupa karakter numeric",
        ]);
        $this->form_validation->set_rules('orientasi', 'Orientasi', 'required|trim', ["required" => "Orientasi tidak boleh kosong"]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ["required" => "Deskripsi tidak boleh kosong"]);

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

            if ($this->Produk_model->tambahProduk()) {
                $message = "<div> Data produk <strong>berhasil</strong> ditambahkan </div>";
                $this->Global_model->flasher($message, berhasil: true);


                redirect('produk');
            } else {
                $message = "<div>Internal server error</div>";
                $this->Global_model->flasher($message, gagal: true);


                redirect('produk');
            }
        }
    }

    public function ubah_produk()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $data['title'] = 'Ubah Produk';
        $data['css'] = 'produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if (isset($_GET["id"])) {
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
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric', [
            "required" => "Stok tidak boleh kosong",
            "numeric" => "Data yang diinputkan bukan berupa karakter numeric",
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric', [
            "required" => "Harga tidak boleh kosong",
            "numeric" => "Data yang diinputkan bukan berupa karakter numeric",
        ]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim|numeric', [
            "required" => "Diskon tidak boleh kosong",
            "numeric" => "Data yang diinputkan bukan berupa karakter numeric",
        ]);
        $this->form_validation->set_rules('orientasi', 'Orientasi', 'required|trim', ["required" => "Orientasi tidak boleh kosong"]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ["required" => "Deskripsi tidak boleh kosong"]);

        // proses akan diredirect jika tidak ada perubahan
        if ($this->Produk_model->isSameData($data["produk"])) {
            $message = "<div>Perubahan <strong>dibatalkan</strong>, tidak ada data yang diubah</div>";
            $this->Global_model->flasher($message, gagal: true);

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

            if ($this->Produk_model->ubahProduk()) {
                $message = "<div>Data produk <strong>berhasil</strong> diubah</div>";
                $this->Global_model->flasher($message, berhasil: true);

                redirect('produk/index');
            } else {
                $message = "<div>Internal server error</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('produk/index');
            }
        }
    }
}
