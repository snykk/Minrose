<?php

class Global_model extends CI_model
{

    public function flasher($message, $berhasil = false, $gagal = false)
    {
        if ($berhasil == true) {
            $status = "success";
            $logo = "check-circle-fill";
        } else if ($gagal == true) {
            $status = "danger";
            $logo = "exclamation-triangle-fill";
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-' . $status . ' d-flex justify-content-between align-items-center mt-3" role="alert">
            <i class="bi bi-' . $logo . ' me-2" style="font-size:1.5rem"></i>
            ' . $message . '
            <button type="button" class="btn-close ms-auto p-2 bd-highlight" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
    }

    public function flasherAuth($message, $berhasil = false, $gagal = false)
    {
        if ($berhasil == true) {
            $status = "success";
            $logo = "check-circle-fill";
        } else if ($gagal == true) {
            $status = "danger";
            $logo = "exclamation-triangle-fill";
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-' . $status . ' d-flex align-items-center" role="alert">
            <i class="bi bi-' . $logo . ' mr-2" style="font-size:1.5rem"></i>
                <div>' . $message . '</div>
            </div>'
        );
    }
}
