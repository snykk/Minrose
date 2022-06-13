<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Transaksi_model');
        $this->load->model('Global_model');
    }

    public function index()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $data['title'] = 'Transaksi';
        $data["css"] = "transaksi";
        $data["cdn_datatable"] = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js";
        $data["js"] = "tabel_transaksi";

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["transaksi"] = $this->Transaksi_model->getAllTransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer', $data);
    }

    public function tambah_pengeluaran()
    {
        $data['title'] = 'Tambah Pengeluaran';
        $data["css"] = "transaksi";

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // set rules inputan
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', ["required" => "Kategori tidak boleh kosong"]);
        $this->form_validation->set_rules(
            'pengeluaran',
            'Pengeluaran',
            'required|trim|numeric',
            [
                "required" => "Pengeluaran tidak boleh kosong",
                "numeric" => "Data yang diinputkan bukan berupa karakter numerik"
            ]
        );
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', ["required" => "Keterangan tidak boleh kosong"]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);

            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }
            $this->load->view('transaksi/tambah_pengeluaran', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            if ($this->Transaksi_model->tambahPengeluaran()) {

                $message = "<div> Pengeluaran <strong>berhasil</strong> ditambahkan </div>";
                $this->Global_model->flasher($message, berhasil: true);

                redirect('transaksi');
            } else {

                $message = "<div>Pengeluaran <strong>gagal</strong> ditambahkan</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('transaksi/tambah_pengeluaran');
            }
        }
    }

    public function ubah_pengeluaran()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $data['title'] = 'Ubah Pengeluaran';
        $data["css"] = "transaksi";

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if (isset($_GET["id_transaksi"])) {
            $data["pengeluaran"] = $this->Transaksi_model->getTransaksiById($_GET["id_transaksi"]);
        } else {
            $data["pengeluaran"] = $this->Transaksi_model->getTransaksiById($this->input->post("id_transaksi"));
        }

        if ($data["pengeluaran"]["pengeluaran"] == null) {
            $this->Transaksi_model->systemHandler();
        }

        if ($this->Transaksi_model->isSameData($data["pengeluaran"])) {

            $message = "<div>Perubahan <strong>dibatalkan</strong> tidak ada data yang diubah</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect('transaksi/ubah_pengeluaran?id_transaksi=' . $this->input->post("id_transaksi"));
        }


        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', ["required" => "Kategori tidak boleh kosong"]);
        $this->form_validation->set_rules(
            'pengeluaran',
            'Pengeluaran',
            'required|trim|numeric',
            [
                "required" => "Pengeluaran tidak boleh kosong",
                "numeric" => "Data yang diinputkan bukan berupa karakter numerik"
            ]
        );
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', ["required" => "Keterangan tidak boleh kosong"]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);

            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }
            $this->load->view('transaksi/ubah_pengeluaran', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            if ($this->Transaksi_model->ubahPengeluaran($this->input->post("id_transaksi"))) {

                $message = "<div> Data transaksi pengeluaran <strong>berhasil</strong> diubah </div>";
                $this->Global_model->flasher($message, berhasil: true);

                redirect('transaksi');
            } else {

                $message = "<div>Pengeluaran <strong>gagal</strong> diubah</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('transaksi/ubah_pengeluaran');
            }
        }
    }
}
