<?php

class Errors extends CI_Controller
{
    public function error404()
    {
        $this->load->view('errors/error404');
    }
}
