<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ulasan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Ulasan_model');
        $this->load->model("Global_model");
    }

    public function index () {
        $data['title'] = 'Ulasan';
        $data['css'] = 'ulasan';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["produk"] = $this->Ulasan_model->getProduk();
        $data["ulasan"] = $this->Ulasan_model->getAllUlasan();
        $data["rateStar"] = $this->Ulasan_model->getRateStar(); 

        $data["isPurchased"] = $this->Ulasan_model->isPurchased($data['user']["id"]);

        $data["starCounter"] = [];
        $data["sum"] = 0;
        for ($i = 1 ; $i <= 5; $i++) {
            $value = $this->Ulasan_model->getQtyByStarValue($i);
            array_push($data["starCounter"],  $value);
            $data["sum"] += $value;
        }

        $this->form_validation->set_rules('ulasan', 'Ulasan','required|trim', ["required"=>"Ulasan tidak boleh kosong"]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
    
            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }
            $this->load->view('ulasan/index', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            $this->_buat_ulasan();
        }
    }

    private function _buat_ulasan() {
        if ($this->Ulasan_model->tambahUlasan()) {
            $message = "<div> Ulasan <strong>berhasil</strong> ditambahkan </div>";
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success d-flex justify-content-between align-items-center mt-3" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div> Ulasan <strong>berhasil</strong> ditambahkan </div>
                <button type="button" class="btn-close ms-auto p-2 bd-highlight" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('ulasan?id_produk=' . $this->input->post("id_produk", true));
        }
    }
}
