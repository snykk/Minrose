<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model("Pemesanan_model");
        $this->load->model("Global_model");
        is_logged_in();
    }

    public function custom_select_validate($str)
    {
        if ($str != "0") {
            return TRUE;
        } else {
            $this->form_validation->set_message('custom_select_validate', 'The "{field}" field have to select');
            return FALSE;
        }
    }


    public function buat_pemesanan()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 1) {
            redirect('auth/blocked');
        }

        $data['title'] = 'Buat Pemesanan';
        $data['css'] = 'pemesanan';
        $data['js'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id_produk = $this->Pemesanan_model->idChooser();

        $data["produk"] =  $this->db->get_where('produk', ['id' => $id_produk])->row_array();

        $stok = 0; //mengantisipasi error di lane 46
        if ($id_produk != false && $data["produk"] != "") {
            $stok = $data["produk"]['stok'];
        } else {
            $id_produk = false;
        }

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ["required" => "Alamat tidak boleh kosong"]);
        $this->form_validation->set_rules('id_metode', 'Metode transaksi', 'required|trim', ["required" => "Pilih salah satu metode transaksi"]);
        $this->form_validation->set_rules('id_bank', 'Bank', 'required|trim', ["required" => "Pilih salah satu bank"]);
        $this->form_validation->set_rules(
            'jumlah_produk',
            'Jumlah produk',
            'trim|greater_than_equal_to[1]|less_than_equal_to' . "[$stok]",
            [
                "required" => "Alamat tujuan tidak boleh kosong",
                "greater_than_equal_to" => "Jumlah produk tidak boleh 0",
                "less_than_equal_to" => "Produk yang tersedia untuk saat ini hanya $stok unit"
            ],
        );
        $this->form_validation->set_rules('provinsi_tujuan', 'Provinsi', 'callback_custom_select_validate');
        $this->form_validation->set_rules('kota_tujuan', 'Kota', 'callback_custom_select_validate');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);

            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }

            if ($id_produk == false) {
                $this->load->view("pemesanan/blank_produk");
            } else {
                $this->load->view('pemesanan/buat_pemesanan', $data);
            }

            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->Pemesanan_model->buatPemesanan()) {
                $message = "<div>Data pemesanan <strong>berhasil</strong> ditambahkan</div>";
                $this->Global_model->flasher($message, berhasil: true);

                redirect('pemesanan/data_pemesanan');
            } else {
                $message = "<div>Internal server error</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('pemesanan/buat_pemesanan?id_produk=' . $id_produk);
            }
        }
    }


    public function data_pemesanan()
    {
        $data['title'] = 'Data Pemesanan';
        $data['css'] = 'pemesanan';
        $data['js'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["pemesanan"] = $this->Pemesanan_model->getDataPemesanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view('pemesanan/pre_content', $data);

        if ($data["pemesanan"]->num_rows() == 0) {
            $this->load->view('pemesanan/blank_data', $data);
        } else {
            $this->load->view('pemesanan/data_pemesanan', $data);
        }

        $this->load->view('pemesanan/pra_content', $data);

        $this->load->view('templates/sidebar_footer');
        $this->load->view('pemesanan/modal_upload_bukti');
        $this->load->view('pemesanan/modal_detail_data_pemesanan', $data);
        $this->load->view('pemesanan/modal_pemesanan');
        $this->load->view('pemesanan/modal_upload_bukti_ditolak.php');
        $this->load->view('pemesanan/modal_detail_bukti_transfer.php');
        $this->load->view('pemesanan/modal_penolakan.php');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer');
    }


    public function riwayat_pemesanan()
    {
        $data['title'] = 'Riwayat Pemesanan';
        $data['css'] = 'pemesanan';
        $data['js'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["pemesanan"] = $this->Pemesanan_model->getDataRiwayat();

        // membuat session untuk membatasi akses admin dari fitur konfirmasi pemesanan
        $this->session->set_userdata("restrict_confirm_admin", "1");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view('pemesanan/pre_content', $data);

        if ($data["pemesanan"]->num_rows() == 0) {
            $this->load->view('pemesanan/blank_data', $data);
        } else {
            $this->load->view('pemesanan/data_pemesanan', $data);
        }

        $this->load->view('pemesanan/pra_content', $data);

        $this->load->view('templates/sidebar_footer');
        $this->load->view('pemesanan/modal_detail_data_pemesanan', $data);
        $this->load->view('pemesanan/modal_pemesanan');
        $this->load->view('pemesanan/modal_upload_bukti_ditolak.php');
        $this->load->view('pemesanan/modal_detail_bukti_transfer.php');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer');

        // menghapus session ketika selesai dari view riwayat pemesanan
        $this->session->unset_userdata('restrict_confirm_admin');
    }


    public function getDataPemesanan()
    {
        $data_dipesan = $_POST["data_dipesan"];

        $result = $this->Pemesanan_model->getDataPemesanan(post: true);

        $data = $result->result();

        // array_push($data, $result->result());
        array_push($data, $data_dipesan);

        header("Content-Type: application/json");
        echo json_encode($data);
    }


    public function ubah_pemesanan()
    {
        // set link files data
        $data['title'] = 'Ubah Pemesanan';
        $data['css'] = 'pemesanan';
        $data['js'] = 'pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["pemesanan"] = $this->Pemesanan_model->getDataPemesanan(get: true)->result_array();

        // set rules
        $stok =  $data["pemesanan"][0]["stok"];

        $this->form_validation->set_rules('alamat_pemesanan', 'Alamat', 'required|trim', ["required" => "Alamat tujuan tidak boleh kosong"]);
        $this->form_validation->set_rules(
            'jumlah_produk',
            'Alamat',
            'trim|greater_than_equal_to[1]|less_than_equal_to' . "[$stok]",
            [
                "required" => "Alamat tujuan tidak boleh kosong",
                "greater_than_equal_to" => "Jumlah produk tidak boleh 0",
                "less_than_equal_to" => "Produk yang tersedia untuk saat ini hanya $stok unit"
            ],
        );
        $this->form_validation->set_rules('provinsi_tujuan', 'Provinsi', 'callback_custom_select_validate');
        $this->form_validation->set_rules('kota_tujuan', 'Kota', 'callback_custom_select_validate');

        // proses akan diredirect jika tidak ada perubahan
        if ($this->Pemesanan_model->isSameData($data["pemesanan"])) {
            $message = "<div>Perubahan <strong>dibatalkan</strong>, tidak ada data yang diubah</div>";
            $this->Global_model->flasher($message, gagal: true);

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
            if ($this->Pemesanan_model->isReadyTransfer()) {
                $message = "<div>Bukti transfer sudah terkirim, <strong>tidak dapat mengubah data pemesanan</strong> </div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('pemesanan/ubah_pemesanan?id=' . $this->input->post("id", true));
            } else if ($this->Pemesanan_model->ubahPemesanan($data["pemesanan"])) {
                $message = "<div>Data pemesanan <strong>berhasil</strong> diubah</div>";
                $this->Global_model->flasher($message, berhasil: true);


                redirect('pemesanan/data_pemesanan');
            } else {
                $message = "<div>Internal server error</div>";
                $this->Global_model->flasher($message, berhasil: true);

                redirect('pemesanan/ubah_pemesanan');
            }
        }
    }


    public function getBuktiTransfer()
    {
        // $pemesanan = $this->db->get_where('pemesanan', ['id' => $_POST["id"]])->result();
        $this->db->select("id, bukti_transfer");
        $this->db->from("pemesanan");
        $this->db->where("id",  $_POST["id"]);
        $pemesanan = $this->db->get()->result();

        if (isset($_POST["data_dipesan"])) {
            array_push($pemesanan, $_POST["data_dipesan"]);
        }

        header("Content-Type: application/json");
        echo json_encode($pemesanan);
    }


    public function setBuktiTransfer()
    {
        $id = $this->input->post('id', true);

        $upload_image = $_FILES['image']['name'];
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

                if ($this->Pemesanan_model->setBuktiUpload($id, $new_image)) {
                    $message = "<div>Bukti transfer <strong>berhasil</strong> diupload</div>";
                    $this->Global_model->flasher($message, berhasil: true);

                    redirect('pemesanan/data_pemesanan');
                } else {
                    $message = "Internal server error";
                    $this->Global_model->flasher($message, gagal: true);

                    redirect('pemesanan/data_pemesanan');
                }
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $message = "<div>Upload bukti <strong>gagal</strong> tidak ada gambar yang diupload ke sistem</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }
    }


    public function disetujui()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $id_pemesanan = $_GET["id_pemesanan"];

        $pemesanan = $this->Pemesanan_model->getPemesananDisetujui($id_pemesanan)->result_array();

        // akan otomatis dicancel jika id status sebelumnya sudah "disejutui"
        if ($pemesanan[0]["id_status"] == 1) {
            $message = "<div>Aksi <strong>dibatalkan</strong> status pemesanan sebelumnya sudah disetujui</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }


        // jika pemesanan belum ada bukti transfer otomatis akan dicancel oleh sistem
        if ($pemesanan[0]["bukti_transfer"] == "default.png") {
            $message = "<div>Aksi <strong>dibatalkan</strong> tidak ada bukti transfer di database</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }

        // cek apakah produk tersedia
        if ($pemesanan[0]["stok_produk"] - $pemesanan[0]["jumlah_produk"] < 0) {
            $message = "<div>[Stok tidak tersedia] <strong> gagal </strong> mengubah status pemesanan</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }

        if ($this->Pemesanan_model->setujuiPemesanan($pemesanan[0], $id_pemesanan) && $this->Pemesanan_model->ubahStok($pemesanan[0])) {
            $message = "<div>Status pemesanan <strong>berhasil</strong> diubah</div>";
            $this->Global_model->flasher($message, berhasil: true);

            redirect("pemesanan/data_pemesanan");
        } else {
            $message = "<div>Internal server error</div>";
            $this->Global_model->flasher($message, berhasil: true);

            redirect("pemesanan/data_pemesanan");
        }
    }


    public function ditolak()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $id_pemesanan =  $this->input->post("id");
        $alasan_penolakan =  $this->input->post("alasan_penolakan");

        $pemesanan = $this->Pemesanan_model->getPemesananDitolak($id_pemesanan)->result_array();

        // akan dibatalkan jika inputan alasan penolakan kosoong
        if ($alasan_penolakan == "") {
            $message = "<div>Aksi <strong>dibatalkan</strong> inputan alasan penolakan <strong>kosong</strong></div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }

        // akan otomatis dicancel jika id status sebelumnya sudah "ditolak"
        if ($pemesanan[0]["id_status"] == 3) {
            $message = "<div>Aksi <strong>dibatalkan</strong> status pemesanan sebelumnya sudah ditolak</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }

        if ($this->Pemesanan_model->setAlasanPenolakan($id_pemesanan, $alasan_penolakan)) {
            if ($pemesanan[0]["id_status"] == 1) {
                // ubah stok di tabel produk
                $this->Pemesanan_model->pengembalianStok($pemesanan[0]);
            }

            $this->Pemesanan_model->pengembalianKupon($pemesanan[0]["id_pemesanan"]);

            $message = "<div> Status pemesanan <strong>berhasil</strong> diubah </div>";
            $this->Global_model->flasher($message, berhasil: true);

            redirect("pemesanan/data_pemesanan");
        }
    }

    public function selesai()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $id_pemesanan = $_GET["id_pemesanan"];

        $data_pemesanan =  $this->db->get_where('pemesanan', ['id' => $id_pemesanan])->row();

        if ($data_pemesanan->id_status != "1") {
            $message = "<div>Pemesanan harus <strong>disetujui</strong> terlebih dahulu oleh admin</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }

        if ($this->Pemesanan_model->setPemesananSelesai($id_pemesanan) && $this->Pemesanan_model->addPemesananToTransaksi($id_pemesanan)) {
            $message = "<div>Pemesanan <strong>berhasil</strong> diakhiri dan data pemesanan <strong>berhasil</strong> ditambahkan di transaksi </div>";
            $this->Global_model->flasher($message, berhasil: true);

            redirect("pemesanan/riwayat_pemesanan");
        } else {
            $message = "<div>Internal server error</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }
    }

    public function dibatalkan()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 1) {
            redirect('auth/blocked');
        }

        $id_pemesanan = $_GET["id_pemesanan"];

        if ($this->Pemesanan_model->batalkanPemesanan($id_pemesanan)) {
            $message = "<div>Transaksi pemesanan <strong>berhasil</strong> dibatalkan</div>";
            $this->Global_model->flasher($message, berhasil: true);

            redirect("pemesanan/data_pemesanan");
        } else {
            $message = "<div>Internal server error</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/data_pemesanan");
        }
    }

    public function hapus_bukti()
    {
        if ($this->Pemesanan_model->hapusBukti()) {
            $message = "<div>Bukti transfer <strong>berhasil</strong> dihapus</div>";
            $this->Global_model->flasher($message, berhasil: true);

            redirect("pemesanan/ubah_pemesanan?id=" . $_GET["id"]);
        } else {
            $message = "<div>Internal server error</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect("pemesanan/ubah_pemesanan?id=" . $_GET["id"]);
        }
    }
}
