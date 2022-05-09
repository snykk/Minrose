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

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 1) {
            redirect('auth/blocked');
        }

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
                'bukti_transfer' => ($id_metode == 1) ? "default.png" : null,
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
        $data['js'] = 'pemesanan'; 
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // prepare data pemesanan
        $this->db->select('pemesanan.id as id_pemesanan, produk.image as image, status.style as style_status, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username');
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
        $this->load->view('pemesanan/modal_detail_data_pemesanan', $data);
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

    public function getDataPemesanan() {
        $pemesanan_id = (INT)$_POST["id"];
        $data_dipesan = $_POST["data_dipesan"];
        
        
        // $result = $this->db->query("SELECT * FROM produk WHERE id={$produk_id}");
        // array_push($data, $result->row());
        
        $this->db->select('pemesanan.id as id_pemesanan, produk.image as image_produk, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username, total_harga, pemesanan.data_dibuat as tanggal_dipesan, pemesanan.alamat as alamat_pemesanan, nama_bank, no_rekening, bukti_transfer, status.style as style_status');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id','left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');
        
        $this->db->where('pemesanan.id', $pemesanan_id);
        
        $result = $this->db->get();

        $data = $result->result();
        // array_push($data, $result->result());
        array_push($data, $data_dipesan);

        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function ubah_pemesanan() {
        // set link files data
        $data['title'] = 'Ubah Pemesanan';
        $data['css'] = 'pemesanan';
        $data['js'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // set database data
        $this->db->select('pemesanan.id as id_pemesanan, produk.image as image_produk, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username, total_harga, pemesanan.data_dibuat as pesanan_dibuat, pemesanan.data_diubah as pesanan_diubah, pemesanan.alamat as alamat_pemesanan, nama_bank, no_rekening, bukti_transfer, status.style as style_status, stok, produk.harga as harga_produk');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id','left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');

        if (isset($_GET["id"])){
            $this->db->where('pemesanan.id', $_GET["id"]);
        } else {
            $this->db->where('pemesanan.id', $this->input->post("id"));
        }
        
        $data["pemesanan"] = $this->db->get()->result_array();

        // set rules
        $stok =  $data["pemesanan"][0]["stok"];
        
        $this->form_validation->set_rules('alamat_pemesanan', 'Alamat','required|trim', ["required"=>"Alamat tujuan tidak boleh kosong"]);
        $this->form_validation->set_rules('jumlah_produk', 'Alamat','trim|greater_than_equal_to[1]|less_than_equal_to'. "[$stok]", 
        ["required"=>"Alamat tujuan tidak boleh kosong",
        "greater_than_equal_to"=>"Jumlah produk tidak boleh 0",
        "less_than_equal_to"=>"Produk yang tersedia untuk saat ini hanya $stok unit" 
        ],
        );

        // proses akan diredirect jika tidak ada perubahan
        if ($data["pemesanan"][0]["jumlah_produk"] == $this->input->post("jumlah_produk")  && $data["pemesanan"][0]["alamat_pemesanan"] == $this->input->post("alamat_pemesanan") && !($_FILES['image']['name'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Perubahan dibatalkan, tidak ada data pemesanan yang diubah</div>');
            redirect('pemesanan/ubah_pemesanan?id=' . $this->input->post("id"));
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
    
            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }
            $this->load->view('pemesanan/ubah_pemesanan');
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            // mengambil id pemesanan
            $id = $this->input->post('id',true);
            
            // untuk membedakan antara metode transfer bank dengan cod
            if ($data["pemesanan"][0]["metode_pembayaran"] == "Transfer Bank") {
                // cek jika ada gambar yang akan diupload
                $upload_image = $_FILES['image']['name'];
            } else {
                $upload_image = false;
            }

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = "./assets/img/bukti/";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    // mengambil image lama menggunakan id pemesanan
                    $old_image = $this->db->query("SELECT bukti_transfer FROM pemesanan WHERE id={$id}")->row();

                    $new_image = $this->upload->data('file_name');

                    if ($new_image != $old_image->bukti_transfer && $old_image->bukti_transfer != "default.png") {
                        unlink(FCPATH . 'assets/img/bukti/' . $old_image->bukti_transfer);
                    }
                    $this->db->set('bukti_transfer', $new_image);

                } else {
                    echo $this->upload->display_errors();
                }
            }

            
            $data = [
                'jumlah_produk' => (INT)$this->input->post('jumlah_produk',true),
                'alamat' => $this->input->post('alamat_pemesanan',true),
                'total_harga' => (INT)$this->input->post('input_total',true),
                'data_diubah' => time()
            ];


            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('pemesanan');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data produk berhasil diubah</div>');
            redirect('pemesanan/data_pemesanan');
        }

    }
}