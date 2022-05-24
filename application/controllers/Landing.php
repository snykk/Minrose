<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{
    public function index() {
        // akan diredirect jika masih memiliki sesi
        if ($this->session->userdata("email")) {
            redirect("home");
        }

        $this->load->view("landing/index");
    }
}