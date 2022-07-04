<?php
session_start();
if (!isset($_SESSION['data']["applicant"])) {
    header('Location: ../applicant/login.php');
}

require("../controller/connect.php");
$idUser = $_SESSION['data']['id'];
$idLowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : '';

// Query identitas applicant
$query = mysqli_query($connect, "SELECT * FROM applicant where id='" . $idUser . "';");
$dataUser = (mysqli_num_rows($query) == 1) ? mysqli_fetch_assoc($query) : NULL;

// Query info lowongan
$query = mysqli_query(
    $connect,
    "SELECT lowongan.*, company.id as company_id, company.nama as company_name, company.image as company_image FROM lowongan, company 
    WHERE lowongan.id= '$idLowongan' AND company.id = lowongan.id_company ;"
);
$dataLowongan = (mysqli_num_rows($query) == 1) ? mysqli_fetch_assoc($query) : NULL;

//Jika dataLowongan kosong, redirect ke 404
if ($dataLowongan == NULL) {
    header('Location: ../error.php');
}

//Jika lowongan TUTUP, redirect ke halaman detail lowongan
if ($dataLowongan['status'] == "CLOSED") {
    header('Location: ../lowongan/detail.php?id='.$dataLowongan['id']);
}

//Query lamaran kerja ini (sudah di-apply & masih pending)
$queryApply = mysqli_query(
    $connect,
    "SELECT lamaran_kerja.* FROM lamaran_kerja
    WHERE lamaran_kerja.id_lowongan = '".$dataLowongan['id']."' AND lamaran_kerja.id_applicant='".$_SESSION['data']['id']."' AND lamaran_kerja.status = 'PENDING';"
);

//Jika hasil query ada, redirect ke halaman detail lowongan
if (mysqli_num_rows($queryApply) > 0) {
    header('Location: ../lowongan/detail.php?id='.$dataLowongan['id']);
}
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Form Apply Lamaran Kerja</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("../web-component/header-footer.php");
    displayNavBar();
    ?>
    <main>
        <div class="container">
            <div class="form-box">
                <h1>Form Apply Lowongan</h1>
                <div class="card">
                    <div class="card-info company-image-wrapper">
                        <img class="company-pic" src="../assets/images/company-profile/<?php echo $dataLowongan['company_image']; ?>" alt="Company Logo">
                    </div>
                    <div class="card-info card-detail">
                        <h3><?php echo $dataLowongan['nama']; ?></h3>
                        <br>
                        <p><i class="fa fa-building" aria-hidden="true"></i> <?php echo $dataLowongan['company_name']; ?></p>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $dataLowongan['lokasi']; ?></p>
                    </div>
                </div>
                <form action="../controller/lamaran-kerja-controller.php?add" method="post" enctype="multipart/form-data">
                    <div class="form-section">
                        <input type="text" name="id_lowongan" value="<?php echo $dataLowongan['id']; ?>" hidden required>
                        <input type="text" name="id_applicant" value="<?php echo $dataUser['id']; ?>" hidden required>
                        <div class="headline">
                            <h3><i class="fa fa-user" aria-hidden="true"></i> Informasi Akun</h3>
                        </div>
                        <div class="form-input">
                            <label>Nama Lengkap</label><br>
                            <input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo $dataUser['nama']; ?>" disabled required>
                        </div>
                        <div class="form-input">
                            <label>NIK</label><br>
                            <input type="text" name="nik" placeholder="NIK" maxlength="16" value="<?php echo $dataUser['nik']; ?>" disabled required>
                        </div>
                        <div class="form-input">
                            <label>Upload CV</label><br>
                            <input type="file" accept=".zip,.rar,.7zip,.tar.gz" name="berkas">
                        </div>

                        <div class="form-input">
                            <input type="submit" name="add" value="Apply">
                        </div>
                </form>
            </div>


        </div>

    </main>
    <footer>
        <p> &#169; 2021</p>
    </footer>
    <script src="../js/register.js"></script>
</body>

</html>