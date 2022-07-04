<?php
require('connect.php');


if (isset($_POST['login'])) {
    $user_type = $_POST['user_type'];
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = $user_type == "company" 
        ? "SELECT * FROM " . $user_type . " WHERE email='" . $email . "' and status='VALID';"
        : "SELECT * FROM " . $user_type . " WHERE email='" . $email . "';";
    $result = mysqli_query($connect, $query);
    

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            session_start();
            $data = array(
                "id"=>$row["id"],
                "nama"=>$row["nama"],
                "email"=>$row["email"],
                $user_type=>1
            );
            $_SESSION['data'] = $data;
            header("Location: ../" . $user_type . "/home.php");

        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Password salah!");';
            echo 'document.location.href = "../' . $user_type . '/login.php";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Email tidak ditemukan!.");';
        echo 'document.location.href = "../' . $user_type . '/login.php";';
        echo '</script>';
    }
}
