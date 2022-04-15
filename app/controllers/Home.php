<?php

class Home extends Controller {

    public function index() {
        $data["judul"] = "Home";

        // if (isset($_COOKIE["remember-me"])) {
        //     $data["remember-me"] = $this->model("Auth_model")->rememberMe($_COOKIE["user"]);
        // }

        $this->view("templates/header", $data);
        $this->view("home/index", $data);
        $this->view("templates/footer", $data);
    }
}