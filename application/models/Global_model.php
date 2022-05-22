<?php

class Global_model extends CI_model {

    public function flasher($message, $berhasil = false, $gagal = false) {
        if ($berhasil == true) {
            $status = "success";
            $logo = "check-circle-fill";
        } else if ($gagal == true) {
            $status = "danger";
            $logo = "exclamation-triangle-fill";
        }

        $this->session->set_flashdata('message', 
        '<div class="alert alert-' . $status .' d-flex justify-content-between align-items-center mt-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="' . $status .':"><use xlink:href="#' . $logo . '"/></svg>
            ' . $message .'
            <button type="button" class="btn-close ms-auto p-2 bd-highlight" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
    }
}