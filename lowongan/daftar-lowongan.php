<?php
session_start();
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Lowongan Pekerjaan</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/lowongan/lowongan-card.css">
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
            
        </div>
        <div class="dashboard-content">
            <div class="lowongan-list">
            </div>
        </div>
    </main>
    <script src="../js/lowongan/lowongan.js"></script>
    <?php
    displayFooter();
    ?>
</body>
</html>