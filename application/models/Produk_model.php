<?php

class Produk_model extends CI_model
{

    public function tambahProduk()
    {
        try {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = "./assets/img/produk/";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'nama' => $this->input->post('nama', true),
                'orientasi' => $this->input->post('orientasi', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'harga' => (int)$this->input->post('harga', true),
                'stok' => (int)$this->input->post('stok', true),
                'diskon' => (float)$this->input->post('diskon', true),
                'image' => (isset($image)) ? $image : "default.png",
                'data_dibuat' => time(),
                'data_diedit' => time()
            ];

            $this->db->insert('produk', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function isSameData($produk)
    {
        if ($this->input->post('nama') == $produk["nama"] && $this->input->post('deskripsi') == $produk["deskripsi"] && $this->input->post('stok') == $produk["stok"] && $this->input->post('harga') == $produk["harga"] && $this->input->post('diskon') == $produk["diskon"] && $this->input->post('orientasi') == $produk["orientasi"] && !($_FILES['image']['name'])) {
            return true;
        }

        return false;
    }

    public function ubahProduk()
    {
        try {
            // mengambil id produk
            $id = $this->input->post('id', true);

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = "./assets/img/produk/";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    // mengambil image lama menggunakan id produk
                    $old_image = $this->db->query("SELECT image FROM produk WHERE id={$id}")->row();

                    $new_image = $this->upload->data('file_name');

                    if ($new_image != $old_image->image && $old_image->image != "default.png") {
                        unlink(FCPATH . 'assets/img/produk/' . $old_image->image);
                    }
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'nama' => $this->input->post('nama', true),
                'orientasi' => $this->input->post('orientasi', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'harga' => (int)$this->input->post('harga', true),
                'stok' => (int)$this->input->post('stok', true),
                'diskon' => (float)$this->input->post('diskon', true),
                'data_diedit' => time()
            ];

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('produk');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
