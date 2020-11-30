<?php
	error_reporting(0);
	include "config/koneksi.php";
  include "config/fungsi_indotgl.php";

	$no_invoice = $_POST['no_invoice'];
	
	$sql  = "SELECT DISTINCT penjualan.no_invoice, pelanggan.nama, penjualan.tgl_jatuh_tempo FROM penjualan INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan WHERE penjualan.no_invoice LIKE '%$no_invoice%'";
  	$qry  = mysql_query($sql);
   	$arrnama = array();
    if (mysql_num_rows($qry) > 0) {
      while ($row = mysql_fetch_array($qry)){
        $json_array			 = array();
      	$json_array['value'] = $row['no_invoice'];
      	$json_array['label'] = $row['no_invoice']." - ".$row['nama']." - Tgl. Tempo: ".tgl_indo($row['tgl_jatuh_tempo']);
      	$arrnama[]	 = $json_array;
     	}
     		echo json_encode($arrnama);
    } else {
      $json_array = array();
      $json_array['value'] = '';
      $json_array['label'] = 'Nama Pelanggan Tidak Ditemukan';
      $arrnama[] = $json_array;
      echo json_encode($arrnama);
    }
?>