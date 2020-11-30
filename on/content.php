<?php 
/**
 * Aplikasi Insentif
 * 
 * 
 * 
 * @author B.E.
 */
if (!isset($_GET['pg'])) {
	include 'dashboard.php';
} else {
	switch ($_GET['pg']) {
		case 'dashboard':
			include 'dashboard.php';
			break;
    	case 'admin':
			include 'admin.php';
			break;
		case 'retur':
			include 'retur.php';
			break;
		case 'supplier':
			include 'supplier.php';
			break;
		case 'pelanggan':
			include 'pelanggan.php';
			break;
		case 'satuan':
			include 'satuan.php';
			break;
		case 'produk':
			include 'produk.php';
			break;
		case 'penjualan':
			include 'penjualan.php';
			break;
		case 'pembayaran': 
			include 'pembayaran.php';
			break;
		case 'penjualan_kredit':
			include 'penjualan_kredit.php';
			break;
		case 'lappjsales':
			include 'lap_penjualan_sales.php';
			break;
		case 'lappj':
			include 'lap_penjualan.php';
			break;
		case 'lapkr':
			include 'lap_penjualan_kredit.php';
			break;
		case 'lapbrg':
			include 'lap_barang.php';
			break;
		case 'lapbrgupdate':
			include 'lap_barang_update.php';
			break;
		case 'lapbyr':
			include 'lap_pembayaran_kredit.php';
			break;
		case 'laptempo':
			include 'lap_jatuh_tempo.php';
			break;
		case 'cetak':
			include 'cetak_pdf.php';
			break;
		case 'cetakbarang':
			include 'cetak_pdf_barang.php';
			break;
		default:	        
	    	echo "<label>404 Halaman tidak ditemukan</label>";
	    break;
		
	}
}

?>