<?php

use LDAP\Result;

class Ulasan_model extends CI_model {

    public function getProduk() {
        if (isset($_GET["id_produk"])){
            return $this->db->get_where('produk', ['id' => $_GET["id_produk"]])->row_array();
        } else {
            return  $this->db->get_where('produk', ['id' => $this->input->post("id_produk")])->row_array();
        }
    }

    public function getAllUlasan() {
        $this->db->select("rating, ulasan, ulasan.data_dibuat as upload_ulasan, username, user.image as profile_user");
        $this->db->from("ulasan");
        $this->db->join("user", "ulasan.id_user=user.id");
        $this->db->join("produk", "ulasan.id_produk=produk.id");
        

        if (isset($_GET["id_produk"])){
            $this->db->where("id_produk",  $_GET["id_produk"]);
        } else {
            $this->db->where("id_produk", $this->input->post("id_produk"));
        }

        return $this->db->get()->result_array();
    }

    public function getRateStar() {

        if (isset($_GET["id_produk"])){
           $id_produk =   $_GET["id_produk"];
        } else {
           $id_produk =   $this->input->post("id_produk");
        }
        
        $this->db->select_sum('rating');
        $this->db->where('id_produk', $id_produk);
        $jumlah = $this->db->get('ulasan')->row_array()["rating"];
        
        $kuantitas = $this->db->get_where("ulasan", ["id_produk" => $id_produk])->num_rows();

        if ($kuantitas == 0) {
            return false;
        }
        return $jumlah/$kuantitas; 
    }

    public function getQtyByStarValue($star_value) {
        if (isset($_GET["id_produk"])){
            $id_produk =   $_GET["id_produk"];
        } else {
            $id_produk =   $this->input->post("id_produk");
        }

        return $this->db->get_where("ulasan", ["rating" => $star_value, "id_produk" => $id_produk])->num_rows();
    }

    public function getIsPurchased($id_user) {
        if (isset($_GET["id_produk"])){
            $id_produk =   $_GET["id_produk"];
        } else {
            $id_produk =   $this->input->post("id_produk");
        }

        $result = $this->db->get_where("pemesanan", ["id_produk" => $id_produk, "id_user" => $id_user, "is_done" => true])->num_rows();

        if ($result != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahUlasan() {
        try {
            $rating = $this->input->post("star-rating", true);
            $ulasan = $this->input->post("ulasan", true);
            $id_produk = $this->input->post("id_produk", true);

            $id_user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->id;

            $data = [
                "id_user" => $id_user,
                "id_produk" => $id_produk,
                "rating" => $rating,
                "ulasan" => $ulasan,
                "data_dibuat" => time(),
                "data_diubah" => time(),
            ];

            $this->db->insert('ulasan', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}