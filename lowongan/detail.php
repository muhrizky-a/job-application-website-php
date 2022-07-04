<?php
session_start();
require("../controller/connect.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = mysqli_query(
    $connect,
    "SELECT lowongan.*, company.id as company_id, company.nama as company_name, company.image as company_image FROM lowongan, company 
    WHERE lowongan.id= '$id' AND company.id = lowongan.id_company"
);

//Jika hasil query ada, jadikan array associative, atau set NULL.
$data = (mysqli_num_rows($query) == 1) ? mysqli_fetch_assoc($query) : NULL;

if ($data == NULL) {
    header('Location: ../error.php');
}
?>



</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Lowongan Pekerjaan</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/detail-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("../web-component/header-footer.php");
    displayNavBar();
    ?>

    <div class="banner">
        <div class="profile">
            <div class="profile-info image-wrapper">
                <img class="picture" src="../assets/images/company-profile/<?php echo ($data['company_image']); ?>" alt="Company Logo">
            </div>
            <div class="profile-info profile-detail">
                <h2><?php echo $data['nama']; ?></h2>
                <h3><a style="color: white;" href="../company/detail.php?id=<?php echo $data['id_company']; ?>"><?php echo $data['company_name']; ?></a></h3>
                <p><i class="fa fa-clock-o" aria-hidden="true"></i>
                    <?php
                    $date = explode(' ', $data['deadline']);
                    $deadline = date('Y-m-d', strtotime($date[0]));
                    echo $deadline;
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="content-info">
                    <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Deskripsi</h3>
                    <p><?php echo nl2br($data['deskripsi']); ?></p>
                </div>
                <div class="content-info">
                    <h3><i class="fa fa-building" aria-hidden="true"></i> Lokasi</h3>
                    <p><?php echo $data['lokasi']; ?></p>
                </div>
            </div>
            <div class="sidebar">

                <?php
                // Kondisi jika lowongan CLOSED, atau jika yang login adalah company/applicant
                if ($data['status'] == "CLOSED") {
                    echo '<div class="sidebar-action">
                        <a class="bg-red">Lowongan Ditutup</a>
                    </div>';
                } else {
                    //Jika company yang login.,
                    if (isset($_SESSION['data']["company"])) {
                        if ($_SESSION['data']['id'] == $data['company_id']) {
                            echo '<div class="sidebar-action">
                                    <a href="../company/edit-lowongan.php?id=' . $data['id'] . '">Edit Loker</a>
                                </div>';
                        }
                    }
                    //Jika applicant yang login..
                    if (isset($_SESSION['data']["applicant"])) {
                        //Query lamaran kerja ini (sudah di-apply & masih pending)
                        $queryApply = mysqli_query(
                            $connect,
                            "SELECT lamaran_kerja.* FROM lamaran_kerja
                            WHERE lamaran_kerja.id_lowongan = '".$data['id']."' AND lamaran_kerja.id_applicant='".$_SESSION['data']['id']."' AND lamaran_kerja.status = 'PENDING';"
                        );
                        
                        //Jika hasil query ada, jadikan array associative, atau set NULL.
                        if (mysqli_num_rows($queryApply) == 0) {
                            echo '<div class="sidebar-action">
                                <a href="../applicant/apply-lowongan.php?id_lowongan=' .$data['id'] . '">Apply Lamaran Kerja</a>
                            </div>';    
                        } else {
                            echo '<div class="sidebar-action">
                                <a>Lamaran Kerja Telah Dikirim</a>
                            </div>';
                        }
                    }
                }
                ?>

                <div class="sidebar-title">
                    <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Informasi Company</h3>
                </div>
                <div class="sidebar-info">
                    <div class="sidebar-detail">
                        <p><i class="fa fa-user" aria-hidden="true"></i> Kuota</p>
                        <p><strong>
                                <?php echo $data['kuota']; ?>
                            </strong></p>
                    </div>
                    <div class="sidebar-detail">
                        <p><i class="fa fa-money" aria-hidden="true"></i> Gaji</p>
                        <p><strong>Rp. <?php echo $data['gaji']; ?></strong></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    displayFooter();
    ?>
</body>

</html>