<?php
session_start();
if (!isset($_SESSION['data']["applicant"])) {
    header('Location: ../applicant/login.php');
}

require("../controller/connect.php");
$idUser = $_SESSION['data']['id'];

$query = mysqli_query($connect, "SELECT * FROM applicant where id='" . $idUser . "';");

//Jika hasil query ada, jadikan array associative, atau set NULL.
$dataUser = (mysqli_num_rows($query) == 1) ? mysqli_fetch_assoc($query) : NULL;

function setInputEditable()
{
    global $dataUser;
    echo ($dataUser != NULL) ? '' : 'disabled';
}

$isDataNotNull = ($dataUser != NULL);
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaturan Akun</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/account-settings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("../web-component/header-footer.php");
    displayNavBar();
    ?>
    <main>
        <div class="dashboard-sidebar">
            <a href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a href="menu-lamaran-kerja.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Menu Lamaran Kerja</a>
            <a href="settings.php" class="active"><i class="fa fa-gear" aria-hidden="true"></i> Pengaturan</a>
            <a href="change-password.php"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password</a>
            <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
        <div class="dashboard-content">
            <div class="update-account-container">
                <div class="account-info">
                    <h3>Ubah Info Akun Company</h3>
                    <form action="../controller/applicant-controller.php?update_info" method="post">
                        <input hidden type="text" name="id" value=<?php echo $isDataNotNull ? "$idUser" : ""; ?>>
                        <div class="form-section">
                            <div class="headline">
                                <h3><i class="fa fa-user" aria-hidden="true"></i> Informasi Akun</h3>
                            </div>
                            <div class="form-input">
                                <label>Nama Lengkap</label><br>
                                <input type="text" name="nama" placeholder="Nama Lengkap" value=<?php echo $dataUser != NULL ? '"' . $dataUser['nama'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>NIK</label><br>
                                <input type="text" name="nik" placeholder="NIK" maxlength="16" value=<?php echo $dataUser != NULL ? '"' . $dataUser['nik'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <?php
                                //Get tanggal lahir
                                $date = $isDataNotNull ? explode(' ', $dataUser['ttl']) : "0-0-0 0:0:0";
                                $ttl = date('Y-m-d',strtotime($date[0]));
                                ?>
                                <?php 
                                ?>
                                <label>Tanggal Lahir</label><br>
                                <input type="date" name="ttl" style="width: auto;" 
                                    <?php
                                    echo $isDataNotNull ? 'value="' . $ttl . '"' : '"0-0-0"'; 
                                    ?>required>
                            </div>
                            <div class="form-input">
                            <label>No. Telp</label><br>
                                <input type="text" name="no_telp" placeholder="No. Telp" maxlength="13" value=<?php echo $dataUser != NULL ? '"' . $dataUser['no_telp'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Alamat Domisili</label><br>
                                <input type="text" name="alamat" placeholder="Alamat Domisili" value=<?php echo $dataUser != NULL ? '"' . $dataUser['alamat'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Tentang Diri</label><br>
                                <textarea name="tentang" rows="10" placeholder="Tentang Diri" required>
                                <?php echo $dataUser != NULL ? $dataUser['tentang'] : ''; ?>
                                </textarea>
                            </div>
                            <div class="form-input">
                                <label>Email</label><br>
                                <input type="text" name="email" placeholder="Email" value=<?php echo $dataUser != NULL ? '"' . $dataUser['email'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                        </div>

                        <div class="form-input">
                            <input type="submit" name="update_info" value="Ubah Info Akun Company" <?php setInputEditable(); ?>>
                        </div>
                    </form>
                </div>
                <div class="account-photo">
                    <h3>Ubah Foto Profil Akun</h3>                    
                    <form action="../controller/applicant-controller.php?update_photo" method="post" enctype="multipart/form-data">
                        <input hidden type="text" name="id" value=<?php echo $isDataNotNull ? "$idUser" : ""; ?>>
                        <div class="form-input">
                            <div class="image-wrapper">
                                <img class="profile-pic" src= <?php echo ($dataUser != NULL) ? '"../assets/images/applicant-profile/'.$dataUser["image"] . '"' : '../assets/images/foto-profil.png'; ?> alt="">
                                <input type="file" accept="image/*" name="profile-pict" class="profile-pic-upload">
                            </div>
                        </div>
                        <div class="form-input">
                            <input type="submit" name="update_photo" value="Ubah Foto Profil Akun" <?php setInputEditable(); ?>>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php
    displayFooter();
    ?>
    <script src="../js/register.js"></script>
</body>

</html>