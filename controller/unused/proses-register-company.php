<?php
require 'connect.php';


if (isset($_POST['register'])) {
    include_once("../model/company.php");
    //$com = new Company();
    (new Company())->registerAccount($connect, $_POST);
}

?>