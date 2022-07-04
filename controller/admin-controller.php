<?php
class AdminController
{
    function __construct($param)
    {
        require 'connect.php';
        
        if( isset($param['register']) ){
            $this->registerAccount($connect);
        }
    }

    function registerAccount($connect)
    {
        if ( isset($_POST['register']) ) {
            include_once("../model/admin.php");
            (new Admin())->registerAccount($connect, $_POST);
        }
    }
}

(new AdminController( $_GET ));