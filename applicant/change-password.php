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
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Password Akun</title>
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
            <a href="settings.php"><i class="fa fa-gear" aria-hidden="true"></i> Pengaturan</a>
            <a href="change-password.php" class="active"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password</a>
            <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
        <div class="dashboard-content">
            <div class="update-account-container">
                <div class="account-password">
                <h3>Ubah Password Akun</h3>
                    <form action="../controller/company-controller.php?update_password" method="post">
                        <input hidden type="text" name="id" value=<?php echo "$idUser"; ?>>
                        
                        <div class="form-input">
                            <label>Password Lama</label><br>
                            <div class="password-field">
                                <input type="password" name="oldpassword" placeholder="Password" autocomplete="off" required <?php setInputEditable(); ?>>
                                <i id="show-oldpwd" class="fa fa-eye" aria-hidden="true" onclick="toggleOldPassword()"></i>
                            </div>
                        </div>
                        <div class="form-input">
                            <label>Password Baru (Password minimal 5 karakter dan memiliki karakter spesial, seperti. *!#$.,:;() )</label><br>
                            <div class="password-field">
                                <input type="password" name="password" placeholder="Password" autocomplete="off" required <?php setInputEditable(); ?>>
                                <i id="show-pwd" class="fa fa-eye" aria-hidden="true" onclick="togglePassword()"></i>
                            </div>
                        </div>
                        <div class="form-input">
                            <label>Konfirmasi Password Baru</label><br>
                            <div class="password-field">
                                <input type="password" name="cpassword" placeholder="Konfirmasi Password" autocomplete="off" required <?php setInputEditable(); ?>>
                                <i id="show-cpwd" class="fa fa-eye" aria-hidden="true" onclick="toggleConfirmPassword()"></i>
                            </div>
                        </div>
                        <div class="form-input">
                            <input type="submit" name="update_password" value="Ubah Password" <?php setInputEditable(); ?>>
                        </div>
                    </form>
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