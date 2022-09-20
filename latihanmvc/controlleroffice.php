<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['listoffice'])) {
    $_SESSION['listoffice'] = array();
}
function insertOffice(){
    $office = new office();

    $office->namakantor = $_POST['namakantor'];
    $office->alamat = $_POST['alamat'];
    $office->kota = $_POST['kota'];
    $office->kontak = $_POST['kontak'];


    array_push($_SESSION['listoffice'], $office);

}
function indexOffice(){
    return $_SESSION['listoffice'];
}
function deleteOffice($id){
    unset($_SESSION['listoffice'][$id]);

}
?>