<?php
session_start();
if (!isset($_SESSION['data']["company"])) {
    header('Location: ../company/login.php');
}

require("../controller/connect.php");
$id= isset($_GET['id']) ? $_GET['id'] : '';
$idCompany = $_SESSION['data']['id'];

$query = mysqli_query($connect, 
    "SELECT lowongan.*, company.image FROM lowongan, company 
    WHERE lowongan.id= '$id' AND company.id= '$idCompany' AND lowongan.id_company = '$idCompany';");

//Jika hasil query ada, jadikan array associative, atau set NULL.
$lowongan = (mysqli_num_rows($query) == 1) ? mysqli_fetch_assoc($query) : NULL;
function setInputEditable() {
    global $lowongan;
    if ($lowongan != NULL) {
        
        if ($lowongan['status'] == "OPEN") {
            echo '';
        } else {
            echo 'disabled';
        }
    } else {
        echo 'disabled';
    }
    
}

$isDataNotNull = ($lowongan != NULL);

?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Lowongan Pekerjaan</title>
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
                    <h3>Ubah Info Lowongan Pekerjaan</h3>
                    <form action="../controller/lowongan-controller.php?update" method="post">
                        <input hidden type="text" name="id" value=<?php echo $isDataNotNull ? "$id" : ""; ?>>
                        <input hidden type="text" name="id_company" value=<?php echo $isDataNotNull ? "$idCompany" : ""; ?>>
                        <div class="form-section">
                            <div class="form-input">
                                <label>Nama (Posisi)</label><br>
                                <input type="text" name="nama" placeholder="Nama (Posisi)" value=<?php echo $isDataNotNull ? '"' . $lowongan['nama'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Lokasi Penempatan</label><br>
                                <input type="text" name="lokasi" placeholder="Lokasi Penempatan" value=<?php echo $isDataNotNull != NULL ? '"' . $lowongan['lokasi'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Deskripsi Lowongan</label><br>
                                <textarea name="deskripsi" rows="10" placeholder="Deskripsi Lowongan" value=<?php setInputEditable() ?> required>
                                <?php echo $isDataNotNull ? $lowongan['deskripsi'] : ''; ?>
                                </textarea>
                            </div>

                            <div class="form-input">
                                <?php
                                //Get deadline lowongan
                                $date = $isDataNotNull ? explode(' ', $lowongan['deadline']) : "0-0-0";
                                $deadline = date('Y-m-d',strtotime($date[0]));
                                ?>
                                <label>Deadline</label><br>
                                <input type="date" name="deadline" <?php echo $isDataNotNull ? 'value="' . $deadline . '" min="' . date("Y-m-d", strtotime('tomorrow')). '"' : '""'; ?>
                                      <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Kuota</label><br>
                                <input type="number" name="kuota" placeholder="Kuota" value=<?php echo $isDataNotNull ? '"' . $lowongan['kuota'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Gaji</label><br>
                                <input type="number" name="gaji" placeholder="Gaji" value=<?php echo $isDataNotNull ? '"' . $lowongan['gaji'] . '"' : '""'; ?> <?php setInputEditable() ?> required>
                            </div>
                            <div class="form-input">
                                <label>Status</label><br>
                                <input type="radio" style="width: auto;" name="status" value="OPEN"
                                    <?php
                                    setInputEditable();
                                    if($isDataNotNull) {
                                        if($lowongan['status'] == "CLOSED"){
                                            echo "disabled";
                                        } else {
                                            echo "checked";
                                        }
                                    }
                                ?> required>
                                <span>OPEN</span>
                                <br>
                                 <input type="radio" style="width: auto;" name="status" value="CLOSED"
                                    <?php
                                    setInputEditable();
                                    if($isDataNotNull) {
                                        if($lowongan['status'] == "CLOSED"){
                                            echo "disabled";
                                        }
                                    }
                                    ?> required>
                                <span>CLOSED</span>
                                
                            </div>
                            
                        </div>
                        <div class="form-input">
                            <input type="submit" name="update" value="Ubah Info Lowongan Pekerjaan" <?php setInputEditable(); ?>>
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