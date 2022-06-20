<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Profile_model");
        $this->load->model("Global_model");
        is_logged_in();
    }

    public function user_profile()
    {
        $data['title'] = 'My Profile';
        $data['css'] = 'profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/sidebar_admin', $data);
        } else {
            $this->load->view('templates/sidebar_user', $data);
        }

        $this->load->view('profile/user_profile', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/modal_logout');
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['css'] = 'profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post('username') != $data["user"]["username"]) {
            $is_unique_username =  '|is_unique[user.username]';
        } else {
            $is_unique_username =  '';
        }
        if ($this->input->post('no_hp') != $data["user"]["no_hp"]) {
            $is_unique_no_hp =  '|is_unique[user.no_hp]';
        } else {
            $is_unique_no_hp =  '';
        }

        // proses akan diredirect jika tidak ada perubahan
        if ($this->Profile_model->isSameData($data["user"])) {
            $message = "<div>Perubahan <strong>dibatalkan</strong>, tidak ada data yang diubah</div>";
            $this->Global_model->flasher($message, gagal: true);

            redirect('profile/edit_profile');
        }

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim' . $is_unique_username, ['is_unique' => 'username ini telah terdaftar silahkan gunakan username lain!']);
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim' . $is_unique_no_hp, ['is_unique' => 'no hp ini telah terdaftar silahkan gunakan nomor lain!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);

            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }

            $this->load->view('profile/edit_profile', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            if ($this->Profile_model->editProfile($data["user"])) {
                $message = "<div> Profil anda <strong>berhasil</strong> diubah </div>";
                $this->Global_model->flasher($message, berhasil: true);

                redirect('home');
            } else {
                $message = "<div>Server error dimohon untuk coba lagi!</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('profile/edit_profile');
            }
        }
    }


    public function ganti_password()
    {
        $data['title'] = 'Ganti Password';
        $data['css'] = 'profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);

            if ($this->session->userdata('role_id') == 1) {
                $this->load->view('templates/sidebar_admin', $data);
            } else {
                $this->load->view('templates/sidebar_user', $data);
            }

            $this->load->view('templates/topbar', $data);
            $this->load->view('profile/ganti_password', $data);
            $this->load->view('templates/sidebar_footer');
            $this->load->view('templates/modal_logout');
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $message = "<div>Password saat ini salah !!!</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('profile/ganti_password');
            } else if ($current_password == $new_password) {
                $message = "<div>Password baru tidak boleh sama dengan password saat ini !!!</div>";
                $this->Global_model->flasher($message, gagal: true);

                redirect('profile/ganti_password');
            } else {
                if ($this->Profile_model->gantiPassword($new_password)) {
                    $message = "<div> Password berhasil diubah! </div>";
                    $this->Global_model->flasher($message, berhasil: true);

                    redirect('profile/ganti_password');
                } else {
                    $message = "<div>Server error dimohon untuk coba lagi!</div>";
                    $this->Global_model->flasher($message, berhasil: true);

                    redirect('profile/ganti_password');
                }
            }
        }
    }
}
