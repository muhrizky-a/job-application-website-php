<?php
require 'connect.php';


if (isset($_POST['register'])) {
    include_once("../model/applicant.php");
    //$com = new Company();
    (new Applicant())->registerAccount($connect, $_POST);
}

?>