<?php
session_start();
if (!isset($_SESSION['data']["company"])) {
    header('Location: ../company/login.php');
}
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seleksi Pelamar Kerja</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/lowongan/lowongan-card.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .applicant-list {
            padding: 20px;
        }

        .applicant-list p {
            color: #333;
        }

        .applicant-status {
            padding: 2px;
            color: white;
            border-radius: 5px;
        }

        .popup {
            width: 75%;
            height: 75%;
            z-index: 3;
            position: fixed;
            left: 12vw;
            top: 12vh;
            background-color: #eee;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        .popup-info {
            display: flex;
        }

        .popup-info a {
            margin-left: auto;
            text-decoration: none;
            color: #eee;
            background-color: #2a41e8;
            border-radius: 5px;
            padding: 10px;
        }

        .popup-info a:hover {
            cursor: pointer;
        }

        .popup textarea {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("../web-component/header-footer.php");
    displayNavBar();
    ?>
    <div id="popup"></div>
    <main>
        <div class="dashboard-sidebar">
            <a href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a href="kelola-lowongan.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Kelola Lowongan</a>
            <a href="seleksi-applicant.php" class="active"><i class="fa fa-user" aria-hidden="true"></i> Seleksi Pencari Kerja</a>
            <a href="settings.php"><i class="fa fa-gear" aria-hidden="true"></i> Pengaturan</a>
            <a href="change-password.php"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password</a>
            <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
        <div class="dashboard-content">
            <div class="applicant-list">
            </div>
        </div>
    </main>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    displayFooter();
    ?>
    <script src="../js/company/seleksi-applicant.js"></script>
</body>

</html>