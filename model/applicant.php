<?php
include "../controller/show-info.php";

class Applicant
{
    function registerAccount($connect, $data){
        $nama = $data['nama'];
        $nik = $data['nik'];
        $ttl = $data['ttl'];
        $alamat = $data['alamat'];
        $tentang = $data['tentang'];
        $no_telp = $data['no_telp'];
        
        $email = $data['email'];
        $pass = $data['password'];


        $query = mysqli_query($connect, "SELECT * FROM applicant WHERE email='{$email}'");
        if (mysqli_num_rows($query) == 0) {

            //Enkripsi password
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            include_once("../controller/upload-gambar.php");
            $gambar = uploadGambar("profile-pict", "applicant-profile");
            if (!$gambar) {
                echo '<script type="text/javascript">';
                echo 'alert("Unggah foto / gambar gagal!");';
                echo '</script>';
                showInfoAndredirectToPage(
                    "Pendaftaran Akun Gagal.",
                    "applicant/register.php"
                );
            } else {
                $result = mysqli_query(
                    $connect,
                    "INSERT INTO applicant(nama, nik, ttl, alamat, tentang, no_telp, image , email, password)
                    VALUES ('$nama','$nik','$ttl','$alamat','$tentang', '$no_telp', '$gambar','$email', '$pass')"
                );
                if( mysqli_affected_rows($connect) > 0) {
                    showInfoAndredirectToPage(
                        "Pendaftaran Akun Berhasil.",
                        "applicant/login.php"
                    );
                } else {
                    showInfoAndredirectToPage(
                        "Pendaftaran Akun Gagal.",
                        "applicant/register.php"
                    );
                }
                
            }
        } else {
            showInfoAndredirectToPage(
                "Email Pencari Kerja telah terdaftar. Pendaftaran Akun Gagal.",
                "applicant/login.php"
            );
        }
    }

    function updateInfoAccount($connect, $data){
        $nama = $data['nama'];
        $nik = $data['nik'];
        $ttl = $data['ttl'];
        $alamat = $data['alamat'];
        $tentang = $data['tentang'];
        $no_telp = $data['no_telp'];
        $email = $data['email'];
        $id = $data['id'];

        $query = mysqli_query($connect, "SELECT * FROM applicant WHERE email='{$email}';");
        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_query(
                $connect,
                "UPDATE applicant SET nama = '$nama', nik = '$nik', ttl = '$ttl',alamat = '$alamat', tentang = '$tentang', no_telp = '$no_telp', email = '$email'
                 WHERE id='{$id}';"
            );
            if( mysqli_affected_rows($connect) > 0) {
                showInfoAndredirectToPage(
                    "Update Info Akun Sukses.",
                    "applicant/settings.php"
                );
            } else {
                showInfoAndredirectToPage(
                    "Terjadi kesalahan. Update Info Akun Gagal.",
                    "applicant/settings.php"
                );
            }
        } else {
            showInfoAndredirectToPage(
                "Data Pencari kerja tidak ditemukan. Update Info Akun Gagal.",
                "applicant/settings.php"
            );
        }
    }

    function updatePasswordAccount($connect, $data){
        $oldpass = mysqli_real_escape_string($connect, $data['oldpassword']);
        $newpass = mysqli_real_escape_string($connect, $data['password']);

        session_start();
        $idUser = $_SESSION['data']['id'];
        $query = mysqli_query($connect, "SELECT password FROM applicant WHERE id='$idUser';");
        $user = mysqli_fetch_assoc($query);

        // Jika password lama sama dengan password pada akun, lakukan perintah ini.
        if ( password_verify($oldpass, $user["password"]) ) {

            //Enkripsi password
            $pass = password_hash($newpass, PASSWORD_DEFAULT);
            
            $result = mysqli_query($connect, "UPDATE applicant SET password='$pass' WHERE id='$idUser';");
            if( mysqli_affected_rows($connect) > 0) {
                showInfoAndredirectToPage(
                    "Update Password Akun Sukses.",
                    "applicant/settings.php"
                );
            } else {
                showInfoAndredirectToPage(
                    "Terjadi kesalahan. Update Password Akun Gagal.",
                    "applicant/settings.php"
                );
            }
        } else {
            showInfoAndredirectToPage(
                "Password yang diinput tidak cocok dengan Password Lama. Update Password Akun Gagal.",
                "applicant/settings.php"
            );
        }
    }

    function updatePhotoAccount($connect){
        include_once("../controller/upload-gambar.php");

        session_start();
        $idUser = $_SESSION['data']['id'];
        $query = mysqli_query($connect, "SELECT image FROM applicant WHERE id='$idUser';");
        $oldPhoto = mysqli_fetch_assoc($query);

        $gambar = updateGambar("profile-pict", "applicant-profile", $oldPhoto['image']);
        if (!$gambar) {
            showInfoAndredirectToPage(
                "Update foto / gambar gagal",
                "applicant/settings.php"
            );
        } else {
            $result = mysqli_query($connect, "UPDATE applicant SET image='$gambar' WHERE id='$idUser';");
            if( mysqli_affected_rows($connect) > 0) {
                showInfoAndredirectToPage(
                    "Update foto / gambar Sukses.",
                    "applicant/settings.php"
                );
            } else {
                showInfoAndredirectToPage(
                    "Terjadi kesalahan. Update foto / gambar gagal",
                    "applicant/settings.php"
                );
            }
        }
    }
}
