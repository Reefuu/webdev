<?php
//testttt
include("model.php");
include("modeloffice.php");
include("modelrelasi.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("controller.php");
include_once("controlleroffice.php");
include_once("controllerrelasi.php");

?>