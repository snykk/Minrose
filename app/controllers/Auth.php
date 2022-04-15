<?php

class Auth extends Controller {

    public function login() {
        $data["judul"] = "Login";
        $data["css"] = "login";
        // $data["js"] = "login";

        // if (isset($_COOKIE["remember-me"])) {
        //     $data["remember-me"] = $this->model("Auth_model")->rememberMe($_COOKIE["user"]);
        // }

        $this->view("templates/header", $data);
        $this->view("auth/login", $data);
        $this->view("templates/footer", $data);
    }

    public function register() {
        $data["judul"] = "Register";
        $data["css"] = "register";
        $this->view("templates/header", $data);
        $this->view("auth/register", $data);
        $this->view("templates/footer", $data);
    }

    public function daftar() {
        $data = $_POST;
        if ($this->model("Auth_model")->cekDataUser($data) < 1) {
            if ($this->model("Auth_model")->cekVerifPass($data)) {
                if ($this->model("Auth_model")->tambahDataUser($data) > 0) {
                    Flasher::setFlashRegister("Data user","berhasil","ditambahkan","success", "#check-circle-fill");
                    header("Location: " . BASEURL . "/auth/login");
                    exit;
                } else {
                    Flasher::setFlashRegister("Data user","gagal","ditambahkan","danger", "#exclamation-triangle-fill");
                    header("Location: " . BASEURL . "/auth/register");
                    exit;
                }
            } else {
                Flasher::setFlashRegister("Password verifikasi","tidak sesuai","dengan yang dimasukkan","danger", "#exclamation-triangle-fill");
                header("Location: " . BASEURL . "/auth/register");
                exit;
            }
        } else {
            Flasher::setFlashRegister("Username atau email","telah","digunakan","danger", "#exclamation-triangle-fill");
            header("Location: " . BASEURL . "/auth/register");
            exit;
        }
    }

    public function validasiLogin() {
        $data = $_POST;
        if ($this->model("Auth_model")->otentikasi($data)) {
            if (isset($data["checkbox"])) {
                setcookie("remember-me", true, time() + 60*60, BASEURL, "localhost", 1);
            }

            setcookie("user",$data["username"], time() + 60*60, BASEURL, "localhost", 1); //memastikan jika berhasil login akan diberikan cookies untuk setiap user dengan key "user"

            Flasher::setFlashLogin("selamat","berhasil login","success", "#check-circle-fill");
            header("Location: " . BASEURL . "/home/index/");
            exit;
        } else {
            Flasher::setFlashLogin("mohon maaf","gagal login","danger", "#exclamation-triangle-fill");
            header("Location: " . BASEURL . "/auth/login");
            exit;
        }
    }
}