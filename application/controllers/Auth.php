<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Auth_model");
        $this->load->model("Global_model");
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect("home");
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya success
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                redirect("home");
                // if ($user['role_id'] == 1) {
                //     redirect('admin');
                // } else {
                //     redirect('user');
                // }
            } else {
                $message = "Password <strong>salah!</strong>";
                $this->Global_model->flasherAuth($message, gagal:true);
                
                redirect('auth');
            }
        } else {
            $message = "Email <strong>belum</strong> teregistrasi!";
            $this->Global_model->flasherAuth($message, gagal:true);

            redirect('auth');
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('home');
        }

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|matches[verif-password]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek'
        ]);

        $this->form_validation->set_rules('verif-password', 'Password', 'required|trim|matches[password]',[
            'matches' =>'Password tidak sama',
        ]);
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|is_unique[user.no_hp]', ['is_unique' => 'no hp ini telah terdaftar silahkan gunakan nomor hp lain!']);
        $this->form_validation->set_rules('alamat', 'Alamant', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi';
            $data["css"] = "register";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            if ($this->Auth_model->buatAkun()) {
                $message = "Selamat registrasi akun anda <strong>berhasil</strong>";
                $this->Global_model->flasherAuth($message, berhasil:true);

                redirect('auth');
            } else {
                $message = "Registrasi akun anda <strong>gagal</strong>";
                $this->Global_model->flasherAuth($message, gagal:true);

                redirect('registration');
            }
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $message = "Session berakhir, anda <strong>berhasil</strong> logout!";
        $this->Global_model->flasherAuth($message, berhasil:true);

        redirect('auth');
    }

    
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
