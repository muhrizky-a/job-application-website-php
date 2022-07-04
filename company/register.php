<?php
session_start();
if (isset($_SESSION['data']['company'])) {
    header('Location: home.php');
}
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Company</title>
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
                <h1>Registrasi Perusahaan</h1>
                <form action="../controller/proses-register-company.php" method="post" enctype="multipart/form-data">
                    <div class="form-section">
                        <div class="headline">
                            <h3><i class="fa fa-user" aria-hidden="true"></i> Informasi Akun</h3>
                        </div>
                        <div class="form-input">
                            <label>Nama HRD</label><br>
                            <input type="text" name="hrd_name" placeholder="Nama HRD" required>
                        </div>
                        <div class="form-input">
                            <label>No. Telp</label><br>
                            <input type="text" name="no_telp" placeholder="No. Telp" maxlength="13" required>
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

                    <div class="form-section">
                        <div class="headline">
                            <h3><i class="fa fa-building" aria-hidden="true"></i> Profil Perusahaan</h3>
                        </div>
                        <div class="form-input">
                            <label>Company Image</label><br>
                            <div class="company-image-wrapper">
                                <img class="profile-pic" src="../assets/images/company-logo-dummy.jpg" alt="">

                                <input type="file" accept="image/*" name="company-logo" class="profile-pic-upload">
                            </div>
                        </div>
                        <div class="form-input">
                            <label>Nama Company</label><br>
                            <input type="text" name="nama" placeholder="Nama Company" required>
                        </div>
                        <div class="form-input">
                            <label>Alamat Company</label><br>
                            <input type="text" name="alamat" placeholder="Alamat Company" required>
                        </div>
                        <div class="form-input">
                            <label>Tentang Company</label><br>
                            <textarea name="tentang" rows="10" placeholder="Tentang Company" required></textarea>
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