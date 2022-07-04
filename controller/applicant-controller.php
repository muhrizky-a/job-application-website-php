<?php
class ApplicantController
{
    function __construct($param)
    {
        require 'connect.php';
        
        if( isset( $param['register'] ) ){
            $this->registerAccount($connect);
        } else if( isset( $param['update_info'] ) ){
            $this->updateInfoAccount($connect);
        } else if( isset( $param['update_password'] ) ){
            $this->updatePasswordAccount($connect);
        } else if( isset( $param['update_photo'] ) ){
            $this->updatePhotoAccount($connect);
        }
    }

    function registerAccount($connect)
    {
        if ( isset($_POST['register']) ) {
            include_once("../model/applicant.php");
            (new Applicant())->registerAccount($connect, $_POST);
        }
    }

    function updateInfoAccount($connect)
    {
        if ( isset($_POST['update_info']) ) {
            include_once("../model/applicant.php");
            (new Applicant())->updateInfoAccount($connect, $_POST);
        }
    }

    function updatePasswordAccount($connect)
    {
        if ( isset($_POST['update_password']) ) {
            include_once("../model/applicant.php");
            (new Applicant())->updatePasswordAccount($connect, $_POST);
        }
    }

    function updatePhotoAccount($connect)
    {
        if ( isset($_POST['update_photo']) ) {
            include_once("../model/applicant.php");
            (new Applicant())->updatePhotoAccount($connect);
        }
    }
}

(new ApplicantController( $_GET ));