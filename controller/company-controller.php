<?php
class CompanyController
{
    function __construct($param)
    {
        require 'connect.php';
        
        if( isset( $param['register'] ) ){
            $this->registerAccount($connect);
        } else if( isset( $param['show_pending_companies'] ) ){
            $this->showPendingCompanies($connect);
        }else if( isset( $param['show_active_companies'] ) ){
            $this->showActiveCompanies($connect);
        }else if( isset( $param['validate_company_id'] ) ){
            $this->validateAccount($connect);
        } else if( isset( $param['update_info'] ) ){
            $this->updateInfoAccount($connect);
        } else if( isset( $param['update_password'] ) ){
            $this->updatePasswordAccount($connect);
        } else if( isset( $param['update_photo'] ) ){
            $this->updatePhotoAccount($connect);
        }
        else if( isset( $param['delete_id'] ) ){
            $this->deleteAccount($connect);
        }
    }

    function registerAccount($connect)
    {
        if ( isset($_POST['register']) ) {
            include_once("../model/company.php");
            (new Company())->registerAccount($connect, $_POST);
        }
    }

    function showPendingCompanies($connect){
        include_once("../model/company.php");
        return (new Company())->showAllCompanies($connect, false);
    }

    function showActiveCompanies($connect){
        include_once("../model/company.php");
        return (new Company())->showAllCompanies($connect, true);
    }

    function validateAccount($connect){
        $id = $_GET['validate_company_id'];
        include_once("../model/company.php");
        (new Company())->updateValidateAccount($connect, $id);
    }

    function updateInfoAccount($connect)
    {
        if ( isset($_POST['update_info']) ) {
            include_once("../model/company.php");
            (new Company())->updateInfoAccount($connect, $_POST);
        }
    }

    function updatePasswordAccount($connect)
    {
        if ( isset($_POST['update_password']) ) {
            include_once("../model/company.php");
            (new Company())->updatePasswordAccount($connect, $_POST);
        }
    }

    function updatePhotoAccount($connect)
    {
        if ( isset($_POST['update_photo']) ) {
            include_once("../model/company.php");
            (new Company())->updatePhotoAccount($connect);
        }
    }

    function deleteAccount($connect){
        $id = $_GET['delete_id'];
        include_once("../model/company.php");
        (new Company())->deleteAccount($connect, $id);
    }
}

(new CompanyController( $_GET ));