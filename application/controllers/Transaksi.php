<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Transaksi_model');
    }

    public function index() {
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

    public function tambah_pengeluaran() {
        $data['title'] = 'Tambah Pengeluaran';
        $data["css"] = "transaksi";

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('kategori', 'Kategori','required|trim', ["required"=>"Kategori tidak boleh kosong"]);
        $this->form_validation->set_rules('pengeluaran', 'Pengeluaran','required|trim|numeric',
        [
            "required"=>"Pengeluaran tidak boleh kosong",
            "numeric"=>"data yang diinputkan bukan berupa karakter numeric"
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan','required|trim', ["required"=>"Keterangan tidak boleh kosong"]);


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
                $this->session->set_flashdata('message', 
                '<div class="alert alert-success d-flex justify-content-between align-items-center mt-3" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div> Pengeluaran <strong>berhasil</strong> ditambahkan </div>
                    <button type="button" class="btn-close ms-auto p-2 bd-highlight" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

                redirect('transaksi');
        } else {
                $this->session->set_flashdata(
                'message', 
                '<div class="alert alert-danger d-flex justify-content-between align-items-center mt-3" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Pengeluaran <strong>gagal</strong>, ditambahkan
                    </div>
                    <button type="button" class="btn-close ms-auto p-2 bd-highlight" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );

                redirect('transaksi/tambah_pengeluaran');
            }

        }
    }
}