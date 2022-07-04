<?php
include "../controller/show-info.php";

class Company
{
    function registerAccount($connect, $data)
    {
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $tentang = $data['tentang'];

        $nama_hrd = $data['hrd_name'];
        $no_telp = $data['no_telp'];
        $email = $data['email'];
        $pass = $data['password'];


        $query = mysqli_query($connect, "SELECT * FROM company WHERE email='{$email}'");
        if (mysqli_num_rows($query) == 0) {

            //Enkripsi password
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            include_once("../controller/upload-gambar.php");
            $gambar = uploadGambar("company-logo", "company-profile");
            if (!$gambar) {
                echo '<script type="text/javascript">';
                echo 'alert("Unggah foto / gambar gagal!");';
                echo '</script>';
                showInfoAndredirectToPage(
                    "Pendaftaran Akun Gagal.",
                    "register.php"
                );
            } else {
                $result = mysqli_query(
                    $connect,
                    "INSERT INTO company(nama, alamat, tentang, image, hrd_name, no_telp, email, password)
                    VALUES ('$nama','$alamat','$tentang', '$gambar', '$nama_hrd','$no_telp','$email', '$pass')"
                );
                if (mysqli_affected_rows($connect) > 0) {
                    showInfoAndredirectToPage(
                        "Pendaftaran Akun Berhasil. Tunggu hingga status akun Diterima oleh Sistem.",
                        "company/login.php"
                    );
                } else {
                    showInfoAndredirectToPage(
                        "Pendaftaran Akun Gagal.",
                        "company/register.php"
                    );
                }
            }
        } else {
            showInfoAndredirectToPage(
                "Company telah terdaftar. Pendaftaran Akun Gagal.",
                "company/login.php"
            );
        }
    }

    function showAllCompanies($connect, $isActive)
    {
        $condition = $isActive ? "1" : "status='PENDING'";
        
        $pending_companies = mysqli_query(
            $connect,
            "SELECT id, nama, alamat, tentang, image, hrd_name, no_telp, email FROM company WHERE ".$condition." ORDER BY id ASC"
        );

        //return $pending_companies;
        $response = array();
        if (mysqli_num_rows($pending_companies) > 0) {
            while ($row = mysqli_fetch_assoc($pending_companies)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function showPendingCompanies()
    {
        require_once("../controller/connect.php");
        $pending_companies = mysqli_query(
            $connect,
            "SELECT id, nama, alamat, tentang, image, hrd_name, no_telp, email FROM company WHERE status='PENDING' ORDER BY id ASC"
        );

        //return $pending_companies;
        $response = array();
        if (mysqli_num_rows($pending_companies) > 0) {
            while ($row = mysqli_fetch_assoc($pending_companies)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function showAllActiveCompanies()
    {
        require_once("../controller/connect.php");
        $companies = mysqli_query(
            $connect,
            "SELECT id, nama, alamat, tentang, image, hrd_name, no_telp, email FROM company WHERE status='VALID' ORDER BY id ASC"
        );

        $response = array();
        if (mysqli_num_rows($companies) > 0) {
            while ($row = mysqli_fetch_assoc($companies)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function updateValidateAccount($connect, $id)
    {
        $query = mysqli_query($connect, "UPDATE company set status='VALID' WHERE id='{$id}'");
        //$query = mysqli_query($connect, "SELECT id from company where 0");

        echo json_encode(
            (mysqli_affected_rows($connect) > 0)
                ? array('code' => 1, 'status' => 'sukses')
                : array('code' => 0, 'status' => 'gagal')
        );
    }

    function updateInfoAccount($connect, $data)
    {
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $tentang = $data['tentang'];

        $nama_hrd = $data['hrd_name'];
        $no_telp = $data['no_telp'];
        $email = $data['email'];

        $id = $data['id'];

        $query = mysqli_query($connect, "SELECT * FROM company WHERE email='{$email}';");
        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_query(
                $connect,
                "UPDATE company SET nama = '$nama', alamat = '$alamat', tentang = '$tentang', hrd_name = '$nama_hrd', no_telp = '$no_telp', email = '$email'
                 WHERE id='{$id}';"
            );
            mysqli_escape_string($connect, $data['alamat']);
            if (mysqli_affected_rows($connect) > 0) {
                showInfoAndredirectToPage(
                    "Update Info Akun Sukses.",
                    "company/home.php"
                );
            } else {
                showInfoAndredirectToPage(
                    "Terjadi kesalahan. Update Info Akun Gagal.",
                    "company/settings.php"
                );
            }
        } else {
            showInfoAndredirectToPage(
                "Company tidak ditemukan. Update Info Akun Gagal.",
                "company/settings.php"
            );
        }
    }

    function updatePasswordAccount($connect, $data)
    {
        $oldpass = mysqli_real_escape_string($connect, $data['oldpassword']);
        $newpass = mysqli_real_escape_string($connect, $data['password']);
        $cpass = mysqli_real_escape_string($connect, $data['cpassword']);

        session_start();
        $idUser = $_SESSION['data']['id'];
        $query = mysqli_query($connect, "SELECT password FROM company WHERE id='$idUser';");
        $user = mysqli_fetch_assoc($query);

        if ($cpass == $newpass) {
            // Jika password lama sama dengan password pada akun, lakukan perintah ini.
            if (password_verify($oldpass, $user["password"])) {

                //Enkripsi password
                $pass = password_hash($newpass, PASSWORD_DEFAULT);

                $result = mysqli_query($connect, "UPDATE company SET password='$pass' WHERE id='$idUser';");
                if (mysqli_affected_rows($connect) > 0) {
                    showInfoAndredirectToPage(
                        "Update Password Akun Sukses.",
                        "company/home.php"
                    );
                } else {
                    showInfoAndredirectToPage(
                        "Terjadi kesalahan. Update Password Akun Gagal.",
                        "company/change-password.php"
                    );
                }
            } else {
                showInfoAndredirectToPage(
                    "Password yang diinput tidak cocok dengan Password Lama. Update Password Akun Gagal.",
                    "company/change-password.php"
                );
            }
        } else {
            showInfoAndredirectToPage(
                "Password yang diinput tidak cocok dengan Password Lama. Update Password Akun Gagal.",
                "company/change-password.php"
            );
        }
    }

    function updatePhotoAccount($connect)
    {
        include_once("../controller/upload-gambar.php");

        session_start();
        $idUser = $_SESSION['data']['id'];
        $query = mysqli_query($connect, "SELECT image FROM company WHERE id='$idUser';");
        $oldPhoto = mysqli_fetch_assoc($query);

        $gambar = updateGambar("company-logo", "company-profile", $oldPhoto['image']);
        if (!$gambar) {
            showInfoAndredirectToPage(
                "Update foto / gambar gagal",
                "company/settings.php"
            );
        } else {
            $result = mysqli_query($connect, "UPDATE company SET image='$gambar' WHERE id='$idUser';");
            if (mysqli_affected_rows($connect) > 0) {
                showInfoAndredirectToPage(
                    "Update foto / gambar Sukses.",
                    "company/home.php"
                );
            } else {
                showInfoAndredirectToPage(
                    "Terjadi kesalahan. Update foto / gambar gagal",
                    "company/settings.php"
                );
            }
        }
    }

    function deleteAccount($connect, $id)
    {
        $query = mysqli_query($connect, "DELETE FROM company WHERE id='{$id}'");

        echo json_encode(
            (mysqli_affected_rows($connect) > 0)
                ? array('code' => 1, 'status' => 'sukses')
                : array('code' => 0, 'status' => 'gagal')
        );
    }
}
