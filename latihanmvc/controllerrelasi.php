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
            $relasi->rjabatan = $_POST['jabatan'];
            $relasi->rusia = $_POST['usia'];
        }
    }
}
function editRelasiKantor($namalama){
    foreach(indexRelasi() as $index => $relasi){
        if($namalama == $relasi->rnamakantor){
            $relasi->rnamakantor = $_POST['namakantor'];
            $relasi->ralamat = $_POST['alamat'];
            $relasi->rkota = $_POST['kota'];
            $relasi->rkontak = $_POST['kontak'];
        }
    }
}
function editRelasi($nama, $jabatan, $usia, $nkantor, $alamat, $kota, $kontak){
    foreach(indexRelasi() as $index => $relasi){
        if($nama == $relasi->rnama){
            $relasi->rnama =$nama;
            $relasi->rjabatan = $jabatan;
            $relasi->rusia = $usia;
            $relasi->rnamakantor = $nkantor;
            $relasi->ralamat = $alamat;
            $relasi->rkota = $kota;
            $relasi->rkontak = $kontak;
        }
    }
}
?>