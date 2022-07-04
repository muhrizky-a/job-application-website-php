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
    <title>Tambah Data Lowongan Pekerjaan</title>
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
            <a href="kelola-lowongan.php" class="active"><i class="fa fa-briefcase" aria-hidden="true"></i> Kelola Lowongan</a>
            <a href="seleksi-applicant.php"><i class="fa fa-user" aria-hidden="true"></i> Seleksi Pencari Kerja</a>
            <a href="settings.php"><i class="fa fa-gear" aria-hidden="true"></i> Pengaturan</a>
            <a href="change-password.php"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password</a>
            <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
        <div class="dashboard-content">
            <div class="update-account-container">
                <div class="account-info">
                    <h3>Tambah Lowongan Pekerjaan Baru</h3>
                    <form action="../controller/lowongan-controller.php?add" method="post">
                        <input hidden type="text" name="id_company" value="<?php echo $_SESSION['data']["company"] . '"'; ?>>
                        <div class="form-section">
                            <div class="form-input">
                                <label>Nama (Posisi)</label><br>
                                <input type="text" name="nama" placeholder="Nama (Posisi)" required>
                            </div>
                            <div class="form-input">
                                <label>Lokasi Penempatan</label><br>
                                <input type="text" name="lokasi" placeholder="Lokasi Penempatan" required>
                            </div>
                            <div class="form-input">
                                <label>Deskripsi Lowongan</label><br>
                                <textarea name="deskripsi" rows="10" placeholder="Deskripsi Lowongan" required></textarea>
                            </div>

                            <div class="form-input">
                                <label>Deadline</label><br>
                                <input type="date" name="deadline" min=<?php echo '"' . date("Y-m-d", strtotime('tomorrow')). '"'; ?> required>
                            </div>
                            <div class="form-input">
                                <label>Kuota</label><br>
                                <input type="number" name="kuota" placeholder="Kuota" required>
                            </div>
                            <div class="form-input">
                                <label>Gaji</label><br>
                                <input type="number" name="gaji" placeholder="Gaji" required>
                            </div>                            
                        </div>
                        <div class="form-input">
                            <input type="submit" name="add" value="Tambah">
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