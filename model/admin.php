<?php
include "../controller/show-info.php";

class Admin
{

    function __construct()
    {
    }

    function registerAccount($connect, $data)
    {
        $nama = $data['nama'];
        $email = $data['email'];
        $pass = $data['password'];


        $query = mysqli_query($connect, "SELECT * FROM admin WHERE email='{$email}'");
        if (mysqli_num_rows($query) == 0) {

            //Enkripsi password
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $result = mysqli_query(
                $connect,
                "INSERT INTO admin(nama, email, password)
                    VALUES ('$nama','$email', '$pass')"
            );
            if( mysqli_affected_rows($connect) > 0) {
                    showInfoAndredirectToPage(
                        "Pendaftaran Akun Admin Berhasil.",
                        "admin/login.php"
                    );
            } else {
                showInfoAndredirectToPage(
                    "Pendaftaran Akun Gagal.",
                    "admin/register.php"
                );
            }
        } else {
            showInfoAndredirectToPage(
                "Admin telah terdaftar. Pendaftaran Akun Gagal.",
                "admin/login.php"
            );
        }
    }
}
