<?php
include "../controller/show-info.php";

class Lowongan
{
    function addData($connect, $data)
    {
        $idCompany = $data['id_company'];
        $nama = $data['nama'];
        //$kategori = $data['kategori'];
        $lokasi = $data['lokasi'];

        $deskripsi = $data['deskripsi'];
        $deadline = $data['deadline'];
        $kuota = $data['kuota'];
        $gaji = $data['gaji'];

        $query = mysqli_query(
            $connect,
            "INSERT INTO lowongan(id_company, nama, lokasi, deskripsi, deadline, kuota, gaji, status)
            VALUES ('$idCompany', '$nama', '$lokasi', '$deskripsi', '$deadline', '$kuota', '$gaji', 'OPEN')"
        );
        if( mysqli_affected_rows($connect) > 0) {
            showInfoAndredirectToPage(
                "Lowongan Baru Berhasil Ditambahkan.",
                "company/kelola-lowongan.php"
            );
        } else {
            showInfoAndredirectToPage(
                "Lowongan Baru Gagal Ditambahkan.",
                "company/kelola-lowongan.php"
            );
        }
    }

    function showAll($connect)
    {
        $lowongan = mysqli_query(
            $connect, "SELECT lowongan.*, company.image FROM lowongan, company
            WHERE company.id = lowongan.id_company;"
        );

        $response = array();
        if (mysqli_num_rows($lowongan) > 0) {
            while ($row = mysqli_fetch_assoc($lowongan)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function showAllManaged($connect, $idCompany)
    {
        
        $lowongan = mysqli_query(
            $connect, "SELECT lowongan.*, company.image FROM lowongan, company 
            WHERE company.id= '$idCompany' AND lowongan.id_company = '$idCompany';"
        );
        
        $response = array();
        if (mysqli_num_rows($lowongan) > 0) {
            while ($row = mysqli_fetch_assoc($lowongan)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }

    function updateData($connect, $data){
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
        if( mysqli_affected_rows($connect) > 0) {
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
