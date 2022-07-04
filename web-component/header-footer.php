<?php

function displayNavBar()
{
    echo '<nav>';
    echo '<div class="nav-btn-section"><a><i class="fa fa-bars" aria-hidden="true"></i></a></div>';
    echo '<ul>';
    echo '<li><a href="../index.php">Home</a></li>';
    echo '<li><a href="../lowongan/daftar-lowongan.php">Daftar Lowongan</a></li>';
    //echo '<li><a href="../company/company-list.php">Daftar Company</a></li>';
    echo '<li><a>Daftar Company</a></li>';
    

    // Jika user login, tampilkan navbar Logout. Jika tidak, tampilkan 
    if (isset($_SESSION['data']['id'])) {
        if( isset($_SESSION['data']['company']) ){
            echo "<div class='login-nav'><a href='../company' class='bg-blue'>Akun</a></div>";
        } else if( isset($_SESSION['data']['applicant']) ){
            echo "<div class='login-nav'><a href='../applicant' class='bg-blue'>Akun</a></div>";    
        }
        
        echo '</ul>';
    } else {
        echo "<div class='login-nav'><a href='../applicant/login.php' class='bg-blue'>Login</a></div>";
        echo '</ul>';
        
    }
    echo '</nav>';
    echo '<script src="../js/header.js"></script>';
}

function displayFooter()
{
    echo "<footer>";
    echo "<p> &#169; 2021</p>";
    echo "</footer>";
}

?>