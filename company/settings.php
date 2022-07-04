<?php
session_start();
if (!isset($_SESSION['data']["company"])) {
    header('Location: ../company/login.php');
}

require("../controller/connect.php");
$idUser = $_SESSION['data']['id'];

$query = mysqli_query($connect, "SELECT * FROM company where id='" . $idUser . "';");

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
    <title>Pengaturan Company</title>
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
            <a href="kelola-lowongan.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Kelola Lowongan</a>
            <a href="seleksi-applicant.php"><i class="fa fa-user" aria-hidden="true"></i> Seleksi Pencari Kerja</a>
            <a href="settings.php" class="active"><i class="fa fa-gear" aria-hidden="true"></i> Pengaturan</a>
            <a href="change-password.php"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password</a>
            <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
        <div class="dashboard-content">
            <div class="update-account-container">
                <div class="account-info">
                    <h3>Ubah Info Akun Company</h3>
                    <form action="../controller/company-controller.php?update_info" method="post">
                        <input hidden type="text" name="id" value=<?php echo $isDataNotNull ? "$idUser" : ""; ?>>
                        <div class="form-section">
                            <div class="headline">
                                <h3><i class="fa fa-user" aria-hidden="true"></i> Informasi Akun</h3>
                            </div>
                            <div class="form-input">
                                <label>Nama HRD</label><br>
                                <input type="text" name="hrd_name" placeholder="Nama HRD" value=<?php echo $dataUser != NULL ? '"' . $dataUser['hrd_name'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>No. Telp</label><br>
                                <input type="text" name="no_telp" placeholder="No. Telp" maxlength="13" value=<?php echo $dataUser != NULL ? '"' . $dataUser['no_telp'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Email</label><br>
                                <input type="text" name="email" placeholder="Email" value=<?php echo $dataUser != NULL ? '"' . $dataUser['email'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="headline">
                                <h3><i class="fa fa-building" aria-hidden="true"></i> Profil Perusahaan</h3>
                            </div>
                            <div class="form-input">
                                <label>Nama Company</label><br>
                                <input type="text" name="nama" placeholder="Nama Company" value=<?php echo $dataUser != NULL ? '"' . $dataUser['email'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Alamat Company</label><br>
                                <input type="text" name="alamat" placeholder="Alamat Company" value=<?php echo $dataUser != NULL ? '"' . $dataUser['alamat'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Tentang Company</label><br>
                                <textarea name="tentang" rows="10" placeholder="Tentang Company" value=<?php setInputEditable() ?> required>
                                <?php echo $dataUser != NULL ? $dataUser['tentang'] : ''; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-input">
                            <input type="submit" name="update_info" value="Ubah Info Akun Company" <?php setInputEditable(); ?>>
                        </div>
                    </form>
                </div>
                <div class="account-photo">
                    <h3>Ubah Foto Profil Company</h3>
                    
                    <form action="../controller/company-controller.php?update_photo" method="post" enctype="multipart/form-data">
                        <input hidden type="text" name="id" value=<?php echo $isDataNotNull ? "$idUser" : ""; ?>>
                        <div class="form-input">
                            <div class="image-wrapper">
                                <img class="profile-pic" src= <?php echo ($dataUser != NULL) ? '"../assets/images/company-profile/'.$dataUser["image"] . '"' : '../assets/images/company-logo-dummy.jpg'; ?> alt="">
                                <input type="file" accept="image/*" name="company-logo" class="profile-pic-upload">
                            </div>
                        </div>
                        <div class="form-input">
                            <input type="submit" name="update_photo" value="Ubah Foto Profil Company" <?php setInputEditable(); ?>>
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