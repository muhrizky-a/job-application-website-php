<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: index.php');
}
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pelamar Kerja</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/register.css">
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
                <h1>Registrasi Pelamar Kerja</h1>
                <form action="../controller/applicant-controller.php?register" method="post" enctype="multipart/form-data">
                    <div class="form-section">
                        <div class="headline">
                            <h3><i class="fa fa-user" aria-hidden="true"></i> Informasi Akun</h3>
                        </div>
                        <div class="form-input">
                            <label>Nama Lengkap</label><br>
                            <input type="text" name="nama" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-input">
                            <label>NIK</label><br>
                            <input type="text" name="nik" placeholder="NIK" maxlength="16" required>
                        </div>
                        <div class="form-input">
                            <label>Tanggal Lahir</label><br>
                            <input type="date" name="ttl" style="width: auto;" required>
                        </div>
                        <div class="form-input">
                            <label>No. Telp</label><br>
                            <input type="text" name="no_telp" placeholder="No. Telp" maxlength="13" required>
                        </div>
                        <div class="form-input">
                            <label>Alamat Domisili</label><br>
                            <input type="text" name="alamat" placeholder="Alamat Domisili" required>
                        </div>
                        <div class="form-input">
                            <label>Tentang Diri</label><br>
                            <textarea name="tentang" rows="10" placeholder="Tentang Diri" required>Halo, saya seorang ...</textarea>
                        </div>
                        <div class="form-input">
                            <label>Foto Profil</label><br>
                            <div class="company-image-wrapper">
                                <img class="profile-pic" src="../assets/images/foto-profil.png" alt="">
                                <input type="file" accept="image/*" name="profile-pict" class="profile-pic-upload">
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-section">
                        <div class="headline">
                            <h3><i class="fa fa-lock" aria-hidden="true"></i> Informasi Login</h3>
                        </div>
                        <div class="form-input">
                            <label>Email</label><br>
                            <input type="text" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-input">
                            <label>Password</label><br>
                            <div class="password-field">
                                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                                <i id="show-pwd" class="fa fa-eye" aria-hidden="true" onclick="togglePassword()"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-input">
                        <input type="submit" name="register" value="Register">
                    </div>

                    <label>Sudah ada akun? <a href="login.php">Login akun</a></label>
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