<?php

class Pemesanan_model extends CI_model {
    public function idChooser() {
        if ( isset($_GET["id_produk"]) ){
            return $_GET["id_produk"];
        } else if ( $this->input->post("id_produk") !== null ) {
            return $this->input->post("id_produk");
        } else {
            return false;
        }
    }


    public function buatPemesanan() {
        try {
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
                'is_done' => 0,
            ];

            $this->db->insert('pemesanan', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getDataPemesanan($post = false, $get = false) {
        // prepare data pemesanan
        $this->db->select('pemesanan.id as id_pemesanan, produk.image as image_produk, status.style as style_status, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username, status.id as id_status, pemesanan.data_dibuat as tanggal_pemesanan, pemesanan.data_diubah as pesanan_diubah, alasan_penolakan, pemesanan.alamat as alamat_pemesanan, nama_bank, no_rekening, bukti_transfer, stok, produk.harga as harga_produk, is_done');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id','left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');

        if ($post == true && isset($_POST["id"])) { // get data dari ajax
            $this->db->where('pemesanan.id', (INT)$_POST["id"]);
        } else if ( $get == true )  { //get data dari ubah pemesanan
            if (isset($_GET["id"])){
                $this->db->where('pemesanan.id', $_GET["id"]);
            } else if ($this->input->post("id") !== null) {
                $this->db->where('pemesanan.id', $this->input->post("id"));
            }
        } else { //get data dari layout data pemesanan
            $this->db->where("is_done =", 0);
            $this->db->order_by("pemesanan.data_dibuat", "asc");

            if ($this->session->userdata('role_id') == 2) {
                $this->db->where('email', $this->session->userdata('email'));
            }
        }
        
        return $this->db->get();
    }


    public function getDataRiwayat() {
        // prepare data riwayat pemesanan
        $this->db->select('pemesanan.id as id_pemesanan, produk.image as image_produk, status.style as style_status, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username, status.id as id_status, pemesanan.data_dibuat as tanggal_pemesanan, pemesanan.data_diubah as pesanan_diubah, alasan_penolakan, produk.id as id_produk, is_done');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id','left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');
        $this->db->where("is_done =", 1);
        $this->db->order_by("data_diubah", "asc");

        if ($this->session->userdata('role_id') == 2) {
            $this->db->where('email', $this->session->userdata('email'));
        }
        
        return $this->db->get();
    }


    public function isSameData($pemesanan) {
        // proses akan diredirect jika tidak ada perubahan
        if ($pemesanan[0]["jumlah_produk"] == $this->input->post("jumlah_produk")  && $pemesanan[0]["alamat_pemesanan"] == $this->input->post("alamat_pemesanan") && !($_FILES['image']['name'])) {
            return true;
        }
        return false;
    }


    public function ubahPemesanan($pemesanan) {
        try {
            // mengambil id pemesanan
            $id = $this->input->post('id',true);
                
            // untuk membedakan antara metode transfer bank dengan cod
            if ($pemesanan[0]["metode_pembayaran"] == "Transfer Bank") {
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

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function setBuktiUpload($id, $new_image) {
        try {
            $this->db->set('bukti_transfer', $new_image);
            $this->db->where('id', $id);
            $this->db->update('pemesanan');
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getPemesananDisetujui($id_pemesanan) {
        // menyiapkan db data
        $this->db->select("bukti_transfer, id_metode, id_status, produk.stok as stok_produk, id_produk, jumlah_produk");
        $this->db->from("pemesanan");
        $this->db->join("produk", "pemesanan.id_produk=produk.id");
        $this->db->where("pemesanan.id", $id_pemesanan);

        return $this->db->get();
    }


    public function setujuiPemesanan($pemesanan, $id) {
        try {
            $data = [
                "id_status" => 1,
                "alasan_penolakan" => null,
                "id_catatan" => ($pemesanan["id_metode"] == 1) ? 4 : 1,
            ];
    
            // ubah tabel produk
            $this->db->set($data);
            $this->db->where("id", $id);
            $this->db->update('pemesanan');
    
            

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function ubahStok($pemesanan) {
        try {
            // ubah stok di tabel produk
            $this->db->set("stok", $pemesanan["stok_produk"] - $pemesanan["jumlah_produk"]);
            $this->db->where("id", $pemesanan["id_produk"]);
            $this->db->update('produk');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getPemesananDitolak($id_pemesanan) {
        // ambil data
        $this->db->select("jumlah_produk, produk.stok as stok_produk, id_produk, id_status");
        $this->db->from("pemesanan");
        $this->db->join("produk", "pemesanan.id_produk=produk.id");
        $this->db->where("pemesanan.id", $id_pemesanan);

        return $this->db->get();
    }


    public function setAlasanPenolakan($id_pemesanan, $alasan_penolakan) {
        try {
            $data = [
                "id_status" => 3,
                "alasan_penolakan" =>$alasan_penolakan
            ];
    
            $this->db->set($data);
            $this->db->where("id", $id_pemesanan);
            $this->db->update('pemesanan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function pengembalianStok($pemesanan) {
        $this->db->set("stok", $pemesanan["stok_produk"] + $pemesanan["jumlah_produk"]);
        $this->db->where("id", $pemesanan["id_produk"]);
        $this->db->update('produk');

        return true;
    }


    public function setPemesananSelesai($id) {
        try {
            // ubah status di tabel pemesanan
            $set_pemesanan = [
                "id_status" => 4,
                "id_catatan" => 3,
                "is_done" => 1,
                "alasan_penolakan" => null,
            ];

            $this->db->set($set_pemesanan);
            $this->db->where("id", $id);
            $this->db->update('pemesanan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function addPemesananToTransaksi($id) {
        try {
            $this->db->select("jumlah_produk, produk.nama as nama_produk, total_harga");
            $this->db->from("pemesanan");
            $this->db->join("produk", "pemesanan.id_produk=produk.id");
            $this->db->where("pemesanan.id", $id);
            $result = $this->db->get()->row_array();

            $data_pemasukan = [
                "kategori" => "Penjualan produk",
                "keterangan" => "Hasil dari penjualan produk " . $result["nama_produk"] . " sebanyak " . $result["jumlah_produk"] . " unit",
                "pemasukan" => $result["total_harga"],
                "pengeluaran" => null,
                "data_dibuat" => time(),
            ];

            $this->db->insert('transaksi', $data_pemasukan);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function batalkanPemesanan($id_pemesanan) {
        try {
            $set_pemesanan = [
                "id_status" => 5,
                "id_catatan" => 5,
                "alasan_penolakan" => null,
            ];
    
            $this->db->set($set_pemesanan);
            $this->db->where("id", $id_pemesanan);
            $this->db->update('pemesanan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}