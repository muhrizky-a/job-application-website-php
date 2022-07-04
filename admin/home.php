<?php
session_start();
if (!isset($_SESSION['data']["admin"])) {
    header('Location: ../admin/login.php');
}
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/admin-home.css">
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
        <a href="home.php" class="active"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a href="kelola-perusahaan.php"><i class="fa fa-building" aria-hidden="true"></i> Kelola Perusahaan</a>
            <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
        <div class="dashboard-content">
        </div>
    </main>
    <?php
    displayFooter();
    ?>

</body>

</html>