<?php
class LamaranKerjaController
{
    
    function __construct($param)
    {
        require 'connect.php';

        if( isset( $param['add'] ) ){
            $this->addData($connect);
        } else if( isset( $param['show_all_applied'] ) ){
            $this->showAllApplied($connect);
        } else if( isset( $param['show_all_managed'] ) ){
            $this->showAllManaged($connect);
        } else if( isset( $param['update'] ) ){
            $this->updateData($connect);
        }
    }

    function addData($connect)
    {
        if ( isset($_POST['add']) ) {
            include_once("../model/lamaran-kerja.php");
            (new LamaranKerja())->addData($connect, $_POST);
        }
    }

    function showAllApplied($connect){
        include_once("../model/lamaran-kerja.php");
        (new LamaranKerja())->showAllApplied($connect);
    }

    function showAllManaged($connect){
        include_once("../model/lamaran-kerja.php");
        return (new LamaranKerja())->showAllManaged($connect);
    }


    function updateData($connect)
    {
        if ( isset($_POST['update']) ) {
            include_once("../model/lamaran-kerja.php");
            (new LamaranKerja())->updateData($connect, $_POST);
        }
    }

}

(new LamaranKerjaController( $_GET ));