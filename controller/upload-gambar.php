<?php

function uploadGambar($inputName, $folderName) {
    $namaFile = $_FILES[$inputName]['name'];
    $ukuranFile = $_FILES[$inputName]['size'];
    $error = $_FILES[$inputName]['error'];
    $tmpName = $_FILES[$inputName]['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('pilih gambar terlebih dahulu!')</script>";
        return false;
    }
    
    if ($ukuranFile > 1044070) {
        echo "<script>alert('Ukuran file terlalu besar!')</script>";
        return false;
    }

    move_uploaded_file($tmpName, '../assets/images/'.$folderName.'/' . $namaFile);
    
    return $namaFile;
}

function updateGambar($inputName, $folderName, $oldPhoto) {

    // Hapus foto lama.
    unlink('../assets/images/'.$folderName.'/' . $oldPhoto);
    
    // Jika upload gambar baru berhasil, lakukan perintah berikut.
    $gambar = uploadGambar($inputName, $folderName);
    if($gambar){
        return $gambar;
    }

    return false;
}
?>
