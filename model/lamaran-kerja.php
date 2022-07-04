<?php
include "../controller/show-info.php";

class LamaranKerja
{
    function addData($connect, $data)
    {
        $idLowongan = $data['id_lowongan'];
        $idApplicant = $data['id_applicant'];

        $query = mysqli_query($connect, "SELECT * FROM applicant WHERE email='{$idLowongan}'");

        if (mysqli_num_rows($query) == 0) {
            include_once("../controller/upload-berkas.php");
            $berkas = uploadBerkas("berkas", $idApplicant, $idLowongan);
            if (!$berkas) {
                echo '<script type="text/javascript">';
                echo 'alert("Unggah berkas gagal!");';
                echo '</script>';
                showInfoAndredirectToPage(
                    "Apply Lamaran Kerja Gagal Dikirim.",
                    "lowongan/detail.php?id=" . $idLowongan
                );
            } else {
                $query = mysqli_query(
                    $connect,
                    "INSERT INTO lamaran_kerja(id_lowongan, id_applicant, berkas)
                    VALUES ('$idLowongan', '$idApplicant', '$berkas')"
                );
                if (mysqli_affected_rows($connect) > 0) {
                    showInfoAndredirectToPage(
                        "Apply Lamaran Kerja Berhasil Dikirim.",
                        "lowongan/detail.php?id=" . $idLowongan
                    );
                } else {
                    showInfoAndredirectToPage(
                        "Apply Lamaran Kerja Gagal Dikirim.",
                        "lowongan/detail.php?id=" . $idLowongan
                    );
                }
            }
        } else {
            showInfoAndredirectToPage(
                "Apply Lamaran Kerja Gagal Dikirim (Telah dikirim dengan status PENDING).",
                "lowongan/detail.php?id=" . $idLowongan
            );
        }
    }

    function showAllApplied($connect)
    {
        session_start();
        $idApplicant = $_SESSION['data']['id'];
        $lamaran = mysqli_query(
            $connect,
            "SELECT lamaran_kerja.*, company.nama as company_nama, company.image as company_image, lowongan.nama as lowongan_nama, lowongan.lokasi as lowongan_lokasi FROM lamaran_kerja, company, lowongan
            WHERE lamaran_kerja.id_applicant='$idApplicant' AND lamaran_kerja.id_lowongan = lowongan.id and lowongan.id_company = company.id;"
        );

        $response = array();
        if (mysqli_num_rows($lamaran) > 0) {
            while ($row = mysqli_fetch_assoc($lamaran)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function showAllManaged($connect)
    {

        session_start();
        $idCompany = $_SESSION['data']['id'];
        $lamaran = mysqli_query(
            $connect,
            "SELECT lamaran_kerja.*, 
            applicant.nama as applicant_nama, applicant.nik as applicant_nik, applicant.alamat as applicant_alamat, applicant.tentang as applicant_tentang, applicant.no_telp as applicant_no_telp, applicant.email as applicant_email, applicant.image as applicant_image,
            lowongan.nama as lowongan_nama, company.nama AS company_name
            from lamaran_kerja
            INNER JOIN applicant on lamaran_kerja.id_applicant = applicant.id 
            INNER JOIN lowongan ON lamaran_kerja.id_lowongan = lowongan.id
            INNER JOIN company ON lowongan.id_company = company.id
            where lowongan.id_company = '$idCompany';"
        );

        $response = array();
        if (mysqli_num_rows($lamaran) > 0) {
            while ($row = mysqli_fetch_assoc($lamaran)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function updateData($connect, $data)
    {
        $id = $data['id'];
        $nama = $data['nama'];
        //$kategori = $data['kategori'];
        $lokasi = $data['lokasi'];

        $deskripsi = $data['deskripsi'];
        $deadline = $data['deadline'];
        echo $deadline;
        $kuota = $data['kuota'];
        $gaji = $data['gaji'];
        $status = $data['status'];

        $query = mysqli_query(
            $connect,
            "update lowongan SET nama='$nama',
             lokasi='$lokasi', deskripsi='$deskripsi',
              deadline='$deadline', kuota='$kuota', gaji='$gaji',
              status='$status' WHERE id='$id';"
        );
        if (mysqli_affected_rows($connect) > 0) {
            showInfoAndredirectToPage(
                "Info Lowongan Pekerjaan Berhasil Diupdate.",
                "company/kelola-lowongan.php"
            );
        } else {
            showInfoAndredirectToPage(
                "Info Lowongan Pekerjaan Gagal Diupdate.",
                "company/kelola-lowongan.php"
            );
        }
    }
}
