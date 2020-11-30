<?php
	error_reporting(0);
	include "config/koneksi.php";

	$no_invoice = $_POST['no_invoice'];

	$sql = mysql_query("SELECT
pembayaran.sisa_kredit
FROM
pembayaran
INNER JOIN penjualan ON pembayaran.no_invoice = penjualan.no_invoice
WHERE pembayaran.no_invoice LIKE '%$no_invoice%'
ORDER BY pembayaran.nopembayaran DESC LIMIT 1");
	$r = mysql_fetch_array($sql);
	$row = mysql_num_rows($sql);

	$sql2 = mysql_query("SELECT
pelanggan.id_pelanggan,
pelanggan.nama
FROM
penjualan
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
WHERE penjualan.no_invoice = '$no_invoice'");
	$r2 = mysql_fetch_array($sql2);
	$row2 = mysql_num_rows($sql2);

	if ($row > 0 || $row2 > 0){
		$data['sisa_kredit'] = $r['sisa_kredit'];
		$data['id_pelanggan'] = $r2['id_pelanggan'];
		echo json_encode($data);
	} else {
		$data['sisa_kredit'] = '';
		$data['id_pelanggan'] = '';
		echo json_encode($data);
	}
?>