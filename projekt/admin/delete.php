<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}

include_once "../lib/DB.php";

use lib\DB;

$db = new DB("localhost", 3306, "root", "", "projekt");

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = $db->deleteMenuItem($id);

    if($delete) {
        header("Location: home.php?status=3");
    } else {
        header("Location: home.php?status=4");
    }
} else {
    header("Location: home.php");
}