<?php

class Auth_model {
    private $table = "akun";
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cekDataUser($data) {
        $sql = "SELECT * FROM {$this->table} WHERE username=:username OR email=:email";

        $this->db->query($sql);
        $this->db->bind("username",$data["username"]);
        $this->db->bind("email",$data["email"]);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataUser($data) {
        // hashing password untuk mengamankan data password dari sisi database
        // $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT); gajadi dipake, biar remember-me jalan
        
        $sql = "INSERT INTO {$this->table} (nama_lengkap,username,jenis_kelamin,email,password,no_hp,alamat)
                VALUES (:nama, :username, :jenis_kelamin, :email, :password, :no_hp,:alamat)";

        $this->db->query($sql);
        $this->db->bind("nama", $data["nama_lengkap"]);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("jenis_kelamin", $data["jenis_kelamin"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("password", $data["password"]);
        $this->db->bind("no_hp", $data["no_hp"]);
        $this->db->bind("alamat", $data["alamat"]);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cekVerifPass($data) {
        $status = false;

        if ($data["password"] == $data["verif-password"]) {
            $status = true;
        }
        
        return $status;
    }

    public function rememberMe($username) {
        $sql = "SELECT username, password FROM {$this->table} WHERE username=:username";

        $this->db->query($sql);
        $this->db->bind("username",$username);

        return $this->db->single();
    }

    public function otentikasi($data) {
        $status = false;
        $sql = "SELECT * FROM {$this->table} WHERE username=:username and password=:password";
                    
        $this->db->query($sql);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("password", $data["password"]);
        $row = $this->db->single();
        $count =  $this->db->rowCount();

        // if ( ( $count == 1 && password_verify($data["password"], $row["password"])) ) {
        //     $status = true;
        // };
        
        if ( ( $count == 1 ) ) {
            $status = true;
        };

        return $status;
    }
}