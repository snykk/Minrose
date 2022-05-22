<?php

class Ulasan_model extends CI_model {

    public function idChooser() {
        if ( isset($_GET["id_produk"]) ){
            return $_GET["id_produk"];
        } else if ( $this->input->post("id_produk") !== null ) {
            return $this->input->post("id_produk");
        } else {
            return false;
        }
    }

    public function getProduk($id_produk) {
        return $this->db->get_where('produk', ['id' => $id_produk])->row_array();
    }

    public function getAllUlasan($id_produk) {
        $this->db->select("rating, ulasan, ulasan.data_dibuat as upload_ulasan, username, user.image as profile_user");
        $this->db->from("ulasan");
        $this->db->join("user", "ulasan.id_user=user.id");
        $this->db->join("produk", "ulasan.id_produk=produk.id");
        $this->db->where("id_produk",  $id_produk);

        return $this->db->get()->result_array();
    }

    public function getRateStar($id_produk) {        
        $this->db->select_sum('rating');
        $this->db->where('id_produk', $id_produk);
        $jumlah = $this->db->get('ulasan')->row_array()["rating"];
        
        $kuantitas = $this->db->get_where("ulasan", ["id_produk" => $id_produk])->num_rows();

        if ($kuantitas == 0) {
            return false;
        }
        return $jumlah/$kuantitas; 
    }

    public function getQtyByStarValue($star_value, $id_produk) {
        return $this->db->get_where("ulasan", ["rating" => $star_value, "id_produk" => $id_produk])->num_rows();
    }

    public function isPurchased($id_user, $id_produk) {
        $result = $this->db->get_where("pemesanan", ["id_produk" => $id_produk, "id_user" => $id_user, "is_done" => true])->num_rows();

        if ($result != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahUlasan($id_produk) {
        try {
            $rating = $this->input->post("star-rating", true);
            $ulasan = $this->input->post("ulasan", true);

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