<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function buat_pemesanan() {
        $data['title'] = 'Buat Pemesanan';
        $data['css'] = 'pemesanan';
        $data['js'] = 'pemesanann';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if (isset($_GET["id"])){
            $data["produk"] =  $this->db->get_where('produk', ['id' => $_GET["id"]])->row_array();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }
        $this->load->view('pemesanan/buat_pemesanan', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer', $data);
    }

    public function data_pemesanan() {
        $data['title'] = 'Data Pemesanan';
        $data['css'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }
        $this->load->view('pemesanan/data_pemesanan', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('pemesanan/modal_upload_bukti');
        $this->load->view('pemesanan/modal_detail_data_pemesanan');
        $this->load->view('pemesanan/modal_ubah_data_pemesanan');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer');
    }

    public function riwayat_pemesanan() {
        $data['title'] = 'Riwayat Pemesanan';
        $data['css'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }
        $this->load->view('pemesanan/riwayat_pemesanan', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('pemesanan/modal_upload_bukti');
        $this->load->view('pemesanan/modal_detail_data_pemesanan');
        $this->load->view('pemesanan/modal_ubah_data_pemesanan');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer');
    }
}