<?php

class Auth_model extends CI_model
{

    public function buatAkun()
    {
        try {
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'role_id' => 2,
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'image' => 'default.jpg',
                'data_dibuat' => time(),
                "point" => 0,
            ];

            $this->db->insert('user', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
