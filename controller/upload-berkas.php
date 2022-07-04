<?php

function uploadBerkas($inputName, $idApplicant) {
    $namaFile = $_FILES[$inputName]['name'];
    $ukuranFile = $_FILES[$inputName]['size'];
    $error = $_FILES[$inputName]['error'];
    $tmpName = $_FILES[$inputName]['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('pilih berkas terlebih dahulu!')</script>";
        return false;
    }
    
    if ($ukuranFile / 1024 > 20480) {
        echo "<script>alert('Ukuran file terlalu besar!')</script>";
        return false;
    }
    $namaFile = "user" .$idApplicant . "-" . "job" .$idApplicant . "-" . $namaFile;
    move_uploaded_file($tmpName, '../assets/berkas_lamaran_kerja/' . $namaFile);    
    return $namaFile;
}
