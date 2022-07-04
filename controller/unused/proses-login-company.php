<?php
require('connect.php');

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = "SELECT * FROM company WHERE email='" . $email . "' and status='VALID'";
    $result = mysqli_query($connect, $query);
    

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            session_start();
            $data = array(
                "id"=>$row["id"],
                "nama_hrd"=>$row["nama_hrd"],
                "email"=>$row["email"],
                "company"=>1
            );
            $_SESSION['data'] = $data;
            header("Location: ../company/home.php");

        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Password salah!");';
            echo 'document.location.href = "../company/login.php";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Email tidak ditemukan!.");';
        echo 'document.location.href = "../company/login.php";';
        echo '</script>';
    }
}
