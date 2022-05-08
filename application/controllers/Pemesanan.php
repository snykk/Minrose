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
        $data['js'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if (isset($_GET["id"])){
            $data["produk"] =  $this->db->get_where('produk', ['id' => $_GET["id"]])->row_array();
        }else {
            $data["produk"] =  $this->db->get_where('produk', ['id' => $this->input->post("id_produk")])->row_array();
        }

        $this->form_validation->set_rules('jumlah_produk', 'Jumlah produk','required|trim', ["required"=>"Jumlah produk tidak boleh kosong"]);
        $this->form_validation->set_rules('alamat', 'Alamat','required|trim', ["required"=>"Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules('id_metode', 'Metode transaksi','required|trim', ["required"=>"Pilih salah satu metode transaksi"]);
        $this->form_validation->set_rules('id_bank', 'Bank','required|trim', ["required"=>"Pilih salah satu bank"]);

        if ($this->form_validation->run() == false) {
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
        } else {
            $id_metode = (INT)$this->input->post('id_metode',true);

            // menyiapkan data pemesanan
            $data = [
                'id_produk' => (INT)$this->input->post('id_produk',true),
                'id_user' => (INT)$this->input->post('id_user',true),
                'jumlah_produk' => (INT)$this->input->post('jumlah_produk',true),
                'alamat' => $this->input->post('alamat',true),
                'total_harga' => (INT)$this->input->post('input_total',true),
                'id_metode' => $id_metode,
                'id_bank' => ($id_metode == 1) ? (INT)$this->input->post('id_bank',true) : null,
                'id_catatan' => ($id_metode == 1) ? 2 : 1,
                'id_status' => 2,
                'bukti_transfer' => 'default.png',
                'data_dibuat' => time(),
                'data_diubah' => time(),
            ];

            $this->db->insert('pemesanan', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pemesanan berhasil ditambahkan</div>');
            redirect('pemesanan/data_pemesanan');
        }

    }

    public function data_pemesanan() {
        $data['title'] = 'Data Pemesanan';
        $data['css'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // prepare data pemesanan
        $this->db->select('produk.image as image, status.bg as bg_status, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id','left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');

        if ($this->session->userdata('role_id') == 2) {
            $this->db->where('email', $this->session->userdata('email'));
        }
        
        $data["pemesanan"] = $this->db->get();

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