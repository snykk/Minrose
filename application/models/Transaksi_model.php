<?php

class Transaksi_model extends CI_model {
    
    public function getAllTransaksi() {
        return $this->db->get("transaksi")->result_array();
    }
}