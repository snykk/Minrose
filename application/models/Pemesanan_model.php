<?php

class Pemesanan_model extends CI_model
{
    public function idChooser()
    {
        if (isset($_GET["id_produk"])) {
            return $_GET["id_produk"];
        } else if ($this->input->post("id_produk") !== null) {
            return $this->input->post("id_produk");
        } else {
            return false;
        }
    }


    public function buatPemesanan()
    {
        try {
            $id_metode = (int)$this->input->post('id_metode', true);

            $kuponUsed =  (int)$this->input->post('kuponUsed', true);

            // menyiapkan data pemesanan
            $data = [
                'id_produk' => (int)$this->input->post('id_produk', true),
                'id_user' => (int)$this->input->post('id_user', true),
                'jumlah_produk' => (int)$this->input->post('jumlah_produk', true),
                'alamat' => $this->input->post('alamat', true),
                'total_harga' => (int)$this->input->post('input_total', true),
                'id_metode' => $id_metode,
                'id_bank' => ($id_metode == 1) ? (int)$this->input->post('id_bank', true) : null,
                'id_catatan' => ($id_metode == 1) ? 2 : 1,
                'id_status' => 2,
                'bukti_transfer' => ($id_metode == 1) ? "default.png" : null,
                'data_dibuat' => time(),
                'data_diubah' => time(),
                'is_done' => 0,
                'kuponUsed' => ($kuponUsed == 0) ? null : $kuponUsed,
            ];

            $this->db->insert('pemesanan', $data);

            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $kuponSaatIni = $user["kupon"] - $kuponUsed;

            $this->db->set("kupon", $kuponSaatIni);
            $this->db->where("id", $user['id']);
            $this->db->update('user');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getDataPemesanan($post = false, $get = false)
    {
        // prepare data pemesanan
        $this->db->select('pemesanan.id as id_pemesanan, produk.id as id_produk, produk.image as image_produk, status.style as style_status, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username, status.id as id_status, pemesanan.data_dibuat as tanggal_pemesanan, pemesanan.data_diubah as pesanan_diubah, alasan_penolakan, pemesanan.alamat as alamat_pemesanan, nama_bank, no_rekening, bukti_transfer, stok, produk.harga as harga_produk, is_done, kuponUsed');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id', 'left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');

        if ($post == true && isset($_POST["id"])) { // get data dari ajax
            $this->db->where('pemesanan.id', (int)$_POST["id"]);
        } else if ($get == true) { //get data dari ubah pemesanan
            if (isset($_GET["id"])) {
                $this->db->where('pemesanan.id', $_GET["id"]);
            } else if ($this->input->post("id") !== null) {
                $this->db->where('pemesanan.id', $this->input->post("id"));
            }
        } else { //get data dari layout data pemesanan
            if (isset($_GET["filter"])  && $_GET["filter"] != 4) {
                $data = [
                    "is_done" => 0,
                    "id_status" => $_GET["filter"],
                ];
                $this->db->where($data);
            } else {
                $this->db->where("is_done =", 0);
            }
            $this->db->order_by("pemesanan.data_dibuat", "asc");

            if ($this->session->userdata('role_id') == 2) {
                $this->db->where('email', $this->session->userdata('email'));
            }
        }

        return $this->db->get();
    }


    public function getDataRiwayat()
    {
        // prepare data riwayat pemesanan
        $this->db->select('pemesanan.id as id_pemesanan, produk.image as image_produk, status.style as style_status, status_pemesanan, produk.nama as nama_produk, metode_pembayaran, jumlah_produk, total_harga, catatan_pemesanan, metode_pembayaran, username, status.id as id_status, pemesanan.data_dibuat as tanggal_pemesanan, pemesanan.data_diubah as pesanan_diubah, alasan_penolakan, produk.id as id_produk, is_done');
        $this->db->from('pemesanan');
        $this->db->join('produk', 'pemesanan.id_produk=produk.id');
        $this->db->join('user', 'pemesanan.id_user=user.id');
        $this->db->join('metode', 'pemesanan.id_metode=metode.id');
        $this->db->join('bank', 'pemesanan.id_bank=bank.id', 'left');
        $this->db->join('catatan', 'pemesanan.id_catatan=catatan.id');
        $this->db->join('status', 'pemesanan.id_status=status.id');
        $this->db->where("is_done =", 1);
        $this->db->order_by("data_diubah", "asc");

        if ($this->session->userdata('role_id') == 2) {
            $this->db->where('email', $this->session->userdata('email'));
        }

        return $this->db->get();
    }


    public function isSameData($pemesanan)
    {
        // proses akan diredirect jika tidak ada perubahan
        if ($pemesanan[0]["jumlah_produk"] == $this->input->post("jumlah_produk")  && $pemesanan[0]["alamat_pemesanan"] == $this->input->post("alamat_pemesanan") && !($_FILES['image']['name'])) {
            return true;
        }
        return false;
    }


    public function ubahPemesanan($pemesanan)
    {
        try {
            // mengambil id pemesanan
            $id = $this->input->post('id', true);

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

            // jika user ingin menggunakan kupon
            $kuponUsed =  (int)$this->input->post('kuponUsed', true);

            $data = [
                'jumlah_produk' => (int)$this->input->post('jumlah_produk', true),
                'alamat' => $this->input->post('alamat_pemesanan', true),
                'total_harga' => (int)$this->input->post('input_total', true),
                'data_diubah' => time(),
                'kuponUsed' => ($kuponUsed == 0) ? null : $kuponUsed,
            ];

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('pemesanan');

            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $kuponSaatIni = $user["kupon"] - $kuponUsed;

            $this->db->set("kupon", $kuponSaatIni);
            $this->db->where("id", $user['id']);
            $this->db->update('user');


            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function setBuktiUpload($id, $new_image)
    {
        try {
            $this->db->set([
                'bukti_transfer' => $new_image,
                "id_catatan" => 6
            ]);
            $this->db->where('id', $id);
            $this->db->update('pemesanan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getPemesananDisetujui($id_pemesanan)
    {
        // menyiapkan db data
        $this->db->select("bukti_transfer, id_metode, id_status, produk.stok as stok_produk, id_produk, jumlah_produk");
        $this->db->from("pemesanan");
        $this->db->join("produk", "pemesanan.id_produk=produk.id");
        $this->db->where("pemesanan.id", $id_pemesanan);

        return $this->db->get();
    }


    public function setujuiPemesanan($pemesanan, $id)
    {
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


    public function ubahStok($pemesanan)
    {
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

    public function getPemesananDitolak($id_pemesanan)
    {
        // ambil data
        $this->db->select("jumlah_produk, produk.stok as stok_produk, id_produk, id_status, pemesanan.id as id_pemesanan");
        $this->db->from("pemesanan");
        $this->db->join("produk", "pemesanan.id_produk=produk.id");
        $this->db->where("pemesanan.id", $id_pemesanan);

        return $this->db->get();
    }


    public function setAlasanPenolakan($id_pemesanan, $alasan_penolakan)
    {
        try {
            $data = [
                "id_status" => 3,
                "alasan_penolakan" => $alasan_penolakan
            ];

            $this->db->set($data);
            $this->db->where("id", $id_pemesanan);
            $this->db->update('pemesanan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function pengembalianStok($pemesanan)
    {
        $this->db->set("stok", $pemesanan["stok_produk"] + $pemesanan["jumlah_produk"]);
        $this->db->where("id", $pemesanan["id_produk"]);
        $this->db->update('produk');

        return true;
    }


    public function setPemesananSelesai($id_pemesanan)
    {
        try {
            // ubah status di tabel pemesanan
            $set_pemesanan = [
                "id_status" => 4,
                "id_catatan" => 3,
                "is_done" => 1,
                "alasan_penolakan" => null,
                "data_diubah" => time(),
            ];

            $this->db->set($set_pemesanan);
            $this->db->where("id", $id_pemesanan);
            $this->db->update('pemesanan');

            // tambahkan point di tabel user dengan kriteria sebagai berikut

            // produk 1 2 point
            // produk 2 3 point
            // produk 3 12 point

            $this->db->select("jumlah_produk, produk.id as id_produk, id_user, user.point as point_saat_ini");
            $this->db->from("pemesanan");
            $this->db->join("produk", "pemesanan.id_produk=produk.id");
            $this->db->join("user", "pemesanan.id_user=user.id");
            $this->db->where("pemesanan.id", $id_pemesanan);
            $result = $this->db->get()->row_array();

            $kriteria_point = [
                "1" => 2,
                "2" => 3,
                "3" => 12
            ];

            $jumlah_point = ($kriteria_point[$result["id_produk"]] * (int)$result["jumlah_produk"]) + $result["point_saat_ini"];

            $this->db->set('point', $jumlah_point);
            $this->db->where('id', $result["id_user"]);
            $this->db->update('user');
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function addPemesananToTransaksi($id_pemesanan)
    {
        try {
            $this->db->select("jumlah_produk, produk.nama as nama_produk, total_harga");
            $this->db->from("pemesanan");
            $this->db->join("produk", "pemesanan.id_produk=produk.id");
            $this->db->where("pemesanan.id", $id_pemesanan);
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


    public function batalkanPemesanan($id_pemesanan)
    {
        try {
            $set_pemesanan = [
                "id_status" => 5,
                "id_catatan" => 5,
                "alasan_penolakan" => null,
            ];

            $this->db->set($set_pemesanan);
            $this->db->where("id", $id_pemesanan);
            $this->db->update('pemesanan');

            $this->pengembalianKupon($id_pemesanan);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function pengembalianKupon($id_pemesanan)
    {
        // mengembalikan kupon user jika menggunakan kupon
        $pemesanan = $this->db->get_where('pemesanan', ['id' => $id_pemesanan])->row_array();
        $user = $this->db->get_where('user', ['id' => $pemesanan["id_user"]])->row_array();

        $kuponSaatIni = (int)$user['kupon'] + (int)$pemesanan["kuponUsed"];

        $this->db->set("kupon", $kuponSaatIni);
        $this->db->where("id", $user["id"]);
        $this->db->update('user');
    }

    public function isReadyTransfer()
    {
        $id = $this->input->post('id', true);
        $pemesanan = $this->db->get_where("pemesanan", ["id" => $id])->row_array();

        if ($pemesanan["id_metode"] == "1" && $pemesanan["jumlah_produk"] != $this->input->post("jumlah_produk", true) && ($pemesanan['bukti_transfer'] != "default.png" || $pemesanan['bukti_transfer'] == null)) {
            return true;
        }
        return false;
    }

    public function hapusBukti()
    {;
        try {
            $this->db->set("bukti_transfer", "default.png");
            $this->db->where("id",  $_GET["id"]);
            $this->db->update('pemesanan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
