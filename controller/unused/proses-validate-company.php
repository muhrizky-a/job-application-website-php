<?php
require 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include_once("../model/company.php");
    //$com = new Company();
    
    return (new Company())->updateValidateAccount($connect, $id);
}

?>