<?php
    @$halaman = $_GET['halaman'];

    if ($halaman == 'instansi') {
        //echo "<h1>Halaman Instansi</h1>";
        include "modul/instansi/instansi.php";
    }else if ($halaman == 'pengirim_surat') {
        //echo "<h1>Halaman Pengirim Surat</h1>";
        include "modul/pengirim surat/pengirim.php";

    }else if ($halaman == 'arsip_surat') {
        if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus"){
            include "modul/arsip/form.php";
        }else{
            include "modul/arsip/data.php";
        }
    }
    else{
        //echo "<h1>Halaman Home</h1>";
        include "modul/home.php";
    }
?>