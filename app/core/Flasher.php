<?php

class Flasher {
    public static function setFlashRegister($variabel, $pesan, $aksi, $tipe, $simbol) {
        $_SESSION["flashRegister"] = [
            "variabel" =>$variabel,
            "pesan" => $pesan,
            "aksi" => $aksi,
            "tipe" => $tipe,
            "simbol" => $simbol
        ];
    }

    public static function setFlashLogin($pesan, $aksi, $tipe, $simbol) {
        $_SESSION["flashLogin"] = [
            "pesan" => $pesan,
            "aksi" => $aksi,
            "tipe" => $tipe,
            "simbol" => $simbol
        ];
    }

    public static function flashRegister () {
        if (isset($_SESSION["flashRegister"])) {
            $msg = "{$_SESSION['flashRegister']['variabel']} <strong>  {$_SESSION['flashRegister']['pesan']} </strong> {$_SESSION['flashRegister']['aksi']}";

            echo '<div style="z-index:100;" class="alert alert-' . $_SESSION["flashRegister"]["tipe"] .' d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="' . $_SESSION["flashRegister"]["tipe"] .':"><use xlink:href="' . $_SESSION["flashRegister"]["simbol"] .'"/></svg>
            <div class="d-flex justify-content-between">
              <div>' . $msg . '</div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>';
          unset($_SESSION["flashRegister"]);
        }
    }
    public static function flashLogin () {
        if (isset($_SESSION["flashLogin"])) {
            $msg = "Note: {$_SESSION["flashLogin"]["pesan"]} anda   <strong> {$_SESSION["flashLogin"]["aksi"]} </strong>";

            echo '<div class="alert alert-' . $_SESSION["flashLogin"]["tipe"] .' d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="' . $_SESSION["flashLogin"]["tipe"] .':"><use xlink:href="' . $_SESSION["flashLogin"]["simbol"] .'"/></svg>
            <div class="d-flex justify-content-between">
              <div>' . $msg .'</div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>';
          unset($_SESSION["flashLogin"]);
        }
    }
}