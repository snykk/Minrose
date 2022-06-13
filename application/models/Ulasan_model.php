<?php

class Ulasan_model extends CI_model
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

    public function getProduk($id_produk)
    {
        return $this->db->get_where('produk', ['id' => $id_produk])->row_array();
    }

    public function getAllUlasan($id_produk)
    {
        $this->db->select("user.id as id_user, ulasan.id as id_ulasan, rating, ulasan, ulasan.data_dibuat as upload_ulasan, email, username, user.image as profile_user, isEdited, ulasan.data_diubah as ulasan_diubah");
        $this->db->from("ulasan");
        $this->db->join("user", "ulasan.id_user=user.id");
        $this->db->join("produk", "ulasan.id_produk=produk.id");
        $this->db->where("id_produk",  $id_produk);

        return $this->db->get()->result_array();
    }

    public function getRateStar($id_produk)
    {
        $this->db->select_sum('rating');
        $this->db->where('id_produk', $id_produk);
        $jumlah = $this->db->get('ulasan')->row_array()["rating"];

        $kuantitas = $this->db->get_where("ulasan", ["id_produk" => $id_produk])->num_rows();

        if ($kuantitas == 0) {
            return false;
        }
        return $jumlah / $kuantitas;
    }

    public function getQtyByStarValue($star_value, $id_produk)
    {
        return $this->db->get_where("ulasan", ["rating" => $star_value, "id_produk" => $id_produk])->num_rows();
    }

    public function isPurchased($id_user, $id_produk)
    {
        $result = $this->db->get_where("pemesanan", ["id_produk" => $id_produk, "id_user" => $id_user, "is_done" => true])->num_rows();

        if ($result != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isReviewed($id_user, $id_produk)
    {
        $result = $this->db->get_where("ulasan", ["id_produk" => $id_produk, "id_user" => $id_user])->num_rows();

        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahUlasan($id_produk)
    {
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


    public function hapusUlasan($id_ulasan)
    {
        try {
            $this->db->delete('ulasan', array('id' => $id_ulasan));

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function isSameData($ulasan)
    {
        if ($this->input->post("star-rating_edit") == $ulasan["rating"] && $this->input->post("ulasan_edit") == $ulasan["ulasan"]) {
            return true;
        }

        return false;
    }


    public function getRowUlasan($id_user, $id_produk)
    {

        return  $this->db->get_where('ulasan', ['id_user' => $id_user, "id_produk" => $id_produk])->row_array();
    }


    public function editUlasan($id_user, $id_produk)
    {
        try {
            $data = [
                'rating' => (int)$this->input->post('star-rating_edit', true),
                'ulasan' => $this->input->post('ulasan_edit', true),
                'isEdited' => true,
                'data_diubah' => time()
            ];


            $this->db->set($data);
            $this->db->where(["id_user" => $id_user, "id_produk" => $id_produk]);
            $this->db->update('ulasan');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
