<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('home/home_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('home/home_user', $data);
        }

        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer');
    }

    public function customers()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            redirect('auth/blocked');
        }

        $data['title'] = 'Customers';
        $data["cdn_datatable"] = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js";
        $data["js"] = "tabel_user";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["user_member"] = $this->db->query("SELECT nama_lengkap, username, email, jenis_kelamin, no_hp, alamat, data_dibuat FROM user WHERE role_id=2");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view('home/customers', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer', $data);
    }

    public function myPoint()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 1) {
            redirect('auth/blocked');
        }

        $data['title'] = 'My Point';
        $data['css'] = "point";
        $data['js'] = "point";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view("home/myPoint", $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer', $data);
    }

    public function ambilPoint()
    {

        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 1) {
            redirect('auth/blocked');
        }

        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($user['point'] >= 150) {
            $kupon = (int) $user['kupon'] + 1;
            $point = (int) $user['point'] - 150;
            $set_data = [
                'kupon' => $kupon,
                'point' => $point
            ];

            $this->db->set($set_data);
            $this->db->where('id', $user['id']);
            $this->db->update('user');

            redirect('home/myPoint');
        } else {
            redirect('home/action_blocked');
        }
    }

    public function action_blocked()
    {
        $this->load->view('home/action_blocked');
    }

    public function penjualan()
    {
        // action akan dilempar ke status 403 jika diakses oleh role yang tidak berwenang
        if ($this->session->userdata('role_id') == 2) {
            return;
        }

        $oneWeekAgo = $this->db->query('SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 6 DAY), "%Y-%m-%d") AS tanggal')->result_array()[0]['tanggal'];
        $now = date('Y-m-d', time());

        $data = [
            "one_week_ago" => $oneWeekAgo,
            "now" => $now,
        ];

        $query2 = "select count(*) as total_penjualan, from_unixtime(data_diubah, '%d') as tanggal, from_unixtime(data_diubah, '%Y-%m-%d') as waktu
        from pemesanan 
        where is_done=1 AND from_unixtime(data_diubah, '%Y-%m-%d') BETWEEN '$oneWeekAgo' AND '$now'
        GROUP BY 
        from_unixtime(data_diubah, '%Y-%m-%d')";
        $data["data"] = $this->db->query($query2)->result_array();

        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function keuntungan()
    {
        $six_month_ago = $this->db->query('SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 5 MONTH), "%Y-%m") AS date')->result_array()[0]['date'];
        $now = date('Y-m', time());
        $data = [
            "six_month_ago" => $six_month_ago,
            "now" => $now,
        ];

        $query = "select (SUM(pemasukan) - SUM(pengeluaran)) as keuntungan, from_unixtime(data_dibuat, '%Y-%m') as date
        from transaksi 
        where from_unixtime(data_dibuat, '%Y-%m') BETWEEN '$six_month_ago' AND '$now'
        GROUP BY 
        from_unixtime(data_dibuat, '%Y-%m')";
        $data["data"] = $this->db->query($query)->result_array();

        header("Content-Type: application/json");
        echo json_encode($data);
    }
}
