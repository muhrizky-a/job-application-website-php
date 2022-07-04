<?php
class LowonganController
{
    
    function __construct($param)
    {
        require 'connect.php';

        if( isset( $param['add'] ) ){
            $this->addData($connect);
        } else if( isset( $param['show_all'] ) ){
            $this->showAll($connect);
        } else if( isset( $param['show_all_managed'] ) ){
            $this->showAllManaged($connect);
        } else if( isset( $param['update'] ) ){
            $this->updateData($connect);
        } else if( isset( $param['delete'] ) ){
            $this->deleteData($connect);
        } 
    }

    function addData($connect)
    {
        if ( isset($_POST['add']) ) {
            include_once("../model/lowongan.php");
            (new Lowongan())->addData($connect, $_POST);
        }
    }

    function showAll($connect){
        include_once("../model/lowongan.php");
        (new Lowongan())->showAll($connect);
    }

    function showAllManaged($connect){
        session_start();
        $id = $_SESSION['data']['id'];
        include_once("../model/lowongan.php");
        return (new Lowongan())->showAllManaged($connect, $id);
    }


    function updateData($connect)
    {
        if ( isset($_POST['update']) ) {
            include_once("../model/lowongan.php");
            (new Lowongan())->updateData($connect, $_POST);
        }
    }

    function deleteData($connect){

    }

}

(new LowonganController( $_GET ));