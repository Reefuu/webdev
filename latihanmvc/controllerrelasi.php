<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['listrelasi'])) {
    $_SESSION['listrelasi'] = array();
}
function insertRelasi(){
    $relasi = new relasi();

    $relasi->rnama = $_GET['nama'];
    $relasi->rjabatan = $_GET['jabatan'];
    $relasi->rusia = $_GET['usia'];
    $relasi->rnamakantor = $_GET['namakantor'];
    $relasi->ralamat = $_GET['alamat'];
    $relasi->rkota = $_GET['kota'];
    $relasi->rkontak = $_GET['kontak'];


    array_push($_SESSION['listrelasi'], $relasi);

}
function indexRelasi(){
    return $_SESSION['listrelasi'];
}
function deleteRelasi($id){
    unset($_SESSION['listrelasi'][$id]);
}
function editRelasiKar($namalama){
    foreach(indexRelasi() as $index => $relasi){
        if($namalama == $relasi->rnama){
            $relasi->rnama = $_POST['nama'];
            $relasi->rnama = $_POST['jabatan'];
            $relasi->rnama = $_POST['usia'];
        }
    }
}
?>