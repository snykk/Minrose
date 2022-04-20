<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Produk';
        $data['css'] = 'produk';
        $data['js'] = 'produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data["produk"] = $this->db->query("SELECT * FROM produk");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($data["user"]["role_id"] == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getDataProduk() {
        $film_id = (INT)$_POST["id"];
        $result = $this->db->query("SELECT * FROM produk WHERE id={$film_id}");
            
        $data = [];
        foreach ($result->result() as $row) {
            array_push($data, $row);
        }
    
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}
