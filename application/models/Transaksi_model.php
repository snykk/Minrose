<?php

class Transaksi_model extends CI_model {

    public function getAllTransaksi() {
        return $this->db->get("transaksi")->result_array();
    }

    public function tambahPengeluaran() {
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
}