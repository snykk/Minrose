<?php

class Profile_model extends CI_model {

    public function isSameData($user) {

        if ($this->input->post('email') == $user["email"] && $this->input->post('username') == $user["username"] && $this->input->post('nama_lengkap') == $user["nama_lengkap"] && $this->input->post('jenis_kelamin') == $user["jenis_kelamin"] && $this->input->post('no_hp') == $user["no_hp"] && $this->input->post('alamat') == $user["alamat"] && !($_FILES['image']['name'])) {
            return true;
        }

        return false;
    }

    public function editProfile($user) {
        try {
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $user['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            ];

            $this->db->set($data);
            $this->db->where('email', $email);
            $this->db->update('user');
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function gantiPassword($new_password) {
        try {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

            $this->db->set('password', $password_hash);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}