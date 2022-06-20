<?php

function is_logged_in()
{
    $ci = get_instance();
    $ci->load->model("Global_model");
    if (!$ci->session->userdata('email')) {
        $message = "<div>Mohon untuk login dulu</div>";
        $ci->Global_model->flasherAuth($message, gagal: true);

        redirect('auth');
    }
}
