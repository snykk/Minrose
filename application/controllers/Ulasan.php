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
        $data['js'] = 'ulasan';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id_produk = $this->Ulasan_model->idChooser();

        $data["produk"] = $this->Ulasan_model->getProduk($id_produk);
        $data["ulasan"] = $this->Ulasan_model->getAllUlasan($id_produk);
        $data["rateStar"] = $this->Ulasan_model->getRateStar($id_produk); 

        $data["isPurchased"] = $this->Ulasan_model->isPurchased($data['user']["id"], $id_produk);
        $data["isReviewed"] = $this->Ulasan_model->isReviewed($data['user']["id"],$id_produk);

        $data["starCounter"] = [];
        $data["sum"] = 0;
        for ($i = 1 ; $i <= 5; $i++) {
            $value = $this->Ulasan_model->getQtyByStarValue($i, $id_produk);
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

            if ($id_produk == false) {
                $this->load->view("ulasan/blank_produk");
            } else {
                $this->load->view('ulasan/index', $data);
            }
       
            $this->load->view('templates/sidebar_footer');
            $this->load->view('ulasan/modal_edit_review');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer', $data);
        } else {
            $this->_buat_ulasan();
        }
    }

    private function _buat_ulasan() {
        $id_produk = $this->Ulasan_model->idChooser();

        if ($this->Ulasan_model->tambahUlasan($id_produk)) {
            $message = "<div> Ulasan <strong>berhasil</strong> ditambahkan </div>";
            $this->Global_model->flasher($message, berhasil:true);
            
            redirect('ulasan?id_produk=' . $id_produk);
        }
    }


    public function hapus_ulasan() {
         // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
         if ($this->session->userdata('role_id') == 1) {
            redirect('auth/blocked');
        }

        $id_produk = $this->Ulasan_model->idChooser();

        $id_ulasan = $_GET["id_ulasan"];

        if ($this->Ulasan_model->hapusUlasan($id_ulasan)) {
            $message = "<div>Ulasan <strong>berhasil</strong> dihapus</div>";
            $this->Global_model->flasher($message, berhasil:true);
            
            redirect('ulasan?id_produk=' . $id_produk);
        } else {
            $message = "<div>Internal server error</div>";
            $this->Global_model->flasher($message, gagal:true);
            
            redirect('ulasan?id_produk=' . $id_produk);
        }
    }


    public function edit_ulasan() {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id_produk = $this->Ulasan_model->idChooser();
        $ulasan = $this->Ulasan_model->getRowUlasan($user["id"], $id_produk);

        if ($this->input->post("ulasan_edit")) {
            if (!$this->Ulasan_model->isSameData($ulasan)) {
                if ($this->Ulasan_model->editUlasan($user["id"], $id_produk)) {
                    $message = "<div>Ulasan <strong>berhasil</strong> diubah</div>";
                    $this->Global_model->flasher($message, berhasil:true);
                    
                    redirect('ulasan?id_produk=' . $id_produk);
                } else {
                    $message = "<div>Internal server error</div>";
                    $this->Global_model->flasher($message, gagal:true);
                    
                    redirect('ulasan?id_produk=' . $id_produk);
                }
            } else {
                $message = "<div>Aksi dibatalkan, tidak ada data yang berubah</div>";
                $this->Global_model->flasher($message, gagal:true);
                
                redirect('ulasan?id_produk=' . $id_produk);
            }
        } else {
            $message = "<div>Aksi <strong>dibatalkan</strong> field ulasan kosong</div>";
            $this->Global_model->flasher($message, gagal:true);
            
            redirect('ulasan?id_produk=' . $id_produk);
        }
    }


    public function getRowUlasan() {
        $id_user = $_POST["id_user"];
        $id_produk = $_POST["id_produk"];

        $ulasan = $this->Ulasan_model->getRowUlasan($id_user, $id_produk);

        $data = [];

        array_push($data, $ulasan);

        header("Content-Type: application/json");
        echo json_encode($data);
    }
}
