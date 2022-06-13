<?php

class Transaksi_model extends CI_model
{

    public function getAllTransaksi()
    {
        return $this->db->get("transaksi")->result_array();
    }

    public function tambahPengeluaran()
    {
        try {
            $data = [
                "kategori" => $this->input->post("kategori"),
                "pemasukan" => null,
                "pengeluaran" => $this->input->post("pengeluaran"),
                "keterangan" => $this->input->post("keterangan"),
                "data_dibuat" => time(),
            ];

            $this->db->insert('transaksi', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getTransaksiById($id_transaksi)
    {
        return $this->db->get_where("transaksi", ["id" => $id_transaksi])->row_array();
    }

    public function systemHandler()
    {
        $message = "<div>Aksi <strong>ditolak</strong> oleh sistem</div>";
        $this->Global_model->flasher($message, gagal: true);

        redirect('transaksi');
    }

    public function ubahPengeluaran($id_transaksi)
    {
        try {
            $data = [
                "kategori" => $this->input->post("kategori"),
                "pemasukan" => null,
                "pengeluaran" => $this->input->post("pengeluaran"),
                "keterangan" => $this->input->post("keterangan"),
                "data_dibuat" => time(),
            ];

            $this->db->set($data);
            $this->db->where('id', $id_transaksi);
            $this->db->update('transaksi');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function isSameData($pengeluaran)
    {
        if ($this->input->post('kategori') == $pengeluaran["kategori"] && $this->input->post('pengeluaran') == $pengeluaran["pengeluaran"] && $this->input->post('keterangan') == $pengeluaran["keterangan"]) {
            return true;
        }
        return false;
    }
}
