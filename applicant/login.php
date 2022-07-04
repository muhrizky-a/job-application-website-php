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
    <title>Login Pelamar Kerja</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("../web-component/header-footer.php");
    displayNavBar();
    ?>
    <main>
        <div class="row">
            <div class="col form-img">
                <img src="../assets/images/login.png" alt="">
            </div>
            <div class="col">
                <div class="form-box">
                    <form action="../controller/proses-login.php" method="post">
                        <h3>Login Pelamar Kerja</h3>
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
                        <div class="form-input">
                            <input type="text" name="user_type" value="applicant" hidden>
                            <input type="submit" name="login" value="Login">
                        </div>

                        <label>Belum ada akun? <a href="register.php">Daftar akun</a></label><br>
                        <label>Memiliki Akun Company? <a href="../company/login.php">Login disini</a></label>

                    </form>
                </div>

            </div>
        </div>

    </main>
    <footer>
        <p> &#169; 2021</p>
    </footer>
    <script src="../js/login.js"></script>
</body>

</html>