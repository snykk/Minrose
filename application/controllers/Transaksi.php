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
}