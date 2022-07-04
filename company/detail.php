<?php
session_start();
if (!isset($_SESSION['data']["company"])) {
    // header('Location: ../company/login.php');
}

require("../controller/connect.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = mysqli_query(
    $connect,
    "SELECT * FROM company 
    WHERE id= '$id'"
);

//Jika hasil query ada, jadikan array associative, atau set NULL.
$data = (mysqli_num_rows($query) == 1) ? mysqli_fetch_assoc($query) : NULL;

if ($data == NULL) {
    header('Location: ../error.php');
}
?>



</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Lowongan Pekerjaan</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/detail-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("../web-component/header-footer.php");
    displayNavBar();
    ?>

    <div class="banner">
        <div class="profile">
            <div class="profile-info image-wrapper">
                <img class="picture" src="../assets/images/company-profile/<?php echo($data['image']); ?>" alt="Company Logo">
            </div>
            <div class="profile-info profile-detail">
                <h2><?php echo $data['nama']; ?></h2>
                
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="content-info">
                    <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Tentang</h3>
                    <p><?php echo nl2br($data['tentang']); ?></p>
                </div>
            </div>
            <div class="sidebar">

                

                <?php
                if (isset($_SESSION['data']["company"])) {
                    if($_SESSION['data']['id'] == $data['id']){
                        echo '<div class="sidebar-action">
                                <a href="settings.php">Edit Akun</a>
                            </div>';
                    }
                }
                ?>
                <div class="sidebar-title">
                    <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Informasi Company</h3>
                </div>
                <div class="sidebar-info">
                    <div class="sidebar-detail">
                        <p><i class="fa fa-building" aria-hidden="true"></i> Lokasi</p>
                        <p><strong>
                            <?php echo $data['alamat']; ?>
                        </strong></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    displayFooter();
    ?>
</body>

</html>