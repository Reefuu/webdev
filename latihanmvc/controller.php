<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['listkaryawan'])) {
    $_SESSION['listkaryawan'] = array();
}


function insertKar()
{
        $karyawan = new karyawan();

        $karyawan->nama = $_POST['nama'];
        $karyawan->jabatan = $_POST['jabatan'];
        $karyawan->usia = $_POST['usia'];

        array_push($_SESSION['listkaryawan'], $karyawan);
    }


function indexKar()
{
        return $_SESSION['listkaryawan'];
    
}

function deleteKar($id)
{
        unset($_SESSION['listkaryawan'][$id]);
    
}
