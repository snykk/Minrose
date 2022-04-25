<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in("User");
    }

    public function index()
    {
        $data['title'] = 'Home';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/sidebar_footer');
        $this->load->view('templates/footer');
    }

    // public function my_profile(){
    //     $data['title'] = 'My Profile';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('user/sidebar', $data);
    //     $this->load->view('user/my_profile', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function edit()
    // {
    //     $data['title'] = 'Edit Profile';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required|trim');
    //     $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', ['is_unique' => 'username ini telah terdaftar silahkan gunakan username lain!']);
    //     $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|is_unique[user.no_hp]', ['is_unique' => 'no hp ini telah terdaftar silahkan gunakan username lain!']);
    //     $this->form_validation->set_rules('alamat', 'Alamant', 'required|trim');


    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('user/sidebar', $data);
    //         $this->load->view('user/edit', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $name = $this->input->post('nama_lengkap');
    //         $email = $this->input->post('email');

    //         // cek jika ada gambar yang akan diupload
    //         $upload_image = $_FILES['image']['name'];

    //         if ($upload_image) {
    //             $config['allowed_types'] = 'gif|jpg|png';
    //             $config['max_size']      = '2048';
    //             $config['upload_path'] = './assets/img/profile/';

    //             $this->load->library('upload', $config);

    //             if ($this->upload->do_upload('image')) {
    //                 $old_image = $data['user']['image'];
    //                 if ($old_image != 'default.jpg') {
    //                     unlink(FCPATH . 'assets/img/profile/' . $old_image);
    //                 }
    //                 $new_image = $this->upload->data('file_name');
    //                 $this->db->set('image', $new_image);
    //             } else {
    //                 echo $this->upload->dispay_errors();
    //             }
    //         }

    //         $this->db->set('nama_lengkap', $name);
    //         $this->db->where('email', $email);
    //         $this->db->update('user');

    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
    //         redirect('user');
    //     }
    // }


    // public function changePassword()
    // {
    //     $data['title'] = 'Change Password';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
    //     $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
    //     $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('user/changepassword', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $current_password = $this->input->post('current_password');
    //         $new_password = $this->input->post('new_password1');
    //         if (!password_verify($current_password, $data['user']['password'])) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
    //             redirect('user/changepassword');
    //         } else {
    //             if ($current_password == $new_password) {
    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
    //                 redirect('user/changepassword');
    //             } else {
    //                 // password sudah ok
    //                 $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    //                 $this->db->set('password', $password_hash);
    //                 $this->db->where('email', $this->session->userdata('email'));
    //                 $this->db->update('user');

    //                 $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
    //                 redirect('user/changepassword');
    //             }
    //         }
    //     }
    // }
}
