<?php
    require_once "base.php";
    require_once "functions.php";


$id = $_GET['id'];

if(DeleteUser($id)){
    linkto('index.php');
}
