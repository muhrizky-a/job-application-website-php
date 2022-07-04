<?php
require 'connect.php';

if (isset($_POST['register'])) {
    include_once("../model/admin.php");
    //$com = new Company();
    (new Admin())->registerAccount($connect, $_POST);
}

?>