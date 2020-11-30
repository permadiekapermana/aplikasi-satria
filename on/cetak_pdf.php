<?php
// sesuai kan root file mPDF anda
$nama_dokumen='Laporan Penjualan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

//Tuliskan file HTML di bawah sini , sesuai File anda .
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->
<table border='0' align='LEFT'>
<tr>
<th>
<img src="dist/img/logo.jpg"  alt="" width="200" height="140" />
<!--<img src="../../images/kabupaten.gif"  align="left" width='110' height='100px' >-->
</th>
<th width="900px">
<h1>  LAPORAN PENJUALAN  <br><br> PT. Satria Karya Adiyhuda</h1> </br>

</th>
</tr>
</table>
<hr style="height:3px;" />



<?php

// Koneksi ke database //

error_reporting(0);
include "config/koneksi.php";
include "config/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tglpenjualanaw];
$tglpenjualanak = $_POST[tglpenjualanak];
?>

<p style="text-align:left;"> Periode (Tanggal <?php echo tgl_indo($tglpenjualanaw)?> S/D  <?php echo tgl_indo($tglpenjualanak) ?>) </p>

<table cellspacing="0" cellpadding="5" border="1">
                        
                          <tr>
                            <th>No</th>
                            <th>No Penjualan</th>
                            <?php if ($_POST[metode_penjualan] == "2") { ?>
                            <th>No. Invoice</th>
                            <?php } ?>
                            <th>Nama Pelanggan</th>
                            <th>Nama Sales</th>
                            <th width="15%">Tanggal Penjualan</th>
                            <?php if ($_POST[metode_penjualan] == "2") { ?>
                            <th>Jatuh Tempo</th>
                            <?php } ?>
                            <th width="20%">Nama Produk</th>
                            <th>Jumlah Item Terjual</th>
                            <th>Harga Produk</th>
                            <th>Total Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT
penjualan_detail.itemterjual,
penjualan_detail.total_penjualan,
penjualan.nopenjualan,
penjualan.no_invoice,
pelanggan.nama,
penjualan.tglpenjualan,
penjualan.tgl_jatuh_tempo,
produk.nama_produk,
produk.stokproduk,
produk.harga,
penjualan_detail.itemterjual AS item,
penjualan_detail.total_penjualan AS total,
users.nama AS nama_sales
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user
WHERE
  penjualan.tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
AND '$_POST[tglpenjualanak]' AND penjualan.metode_penjualan = '$_POST[metode_penjualan]'
ORDER BY penjualan.nopenjualan ASC");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[nopenjualan]"?></td>
                            <?php
                              if ($_POST[metode_penjualan] == "2") {
                            ?>
                            <td><?php echo $r[no_invoice]; ?></td>
                            <?php } ?>
                            <?php 
                              $tglpenjualan=tgl_indo($r['tglpenjualan']);
                              $jatuh_tempo=tgl_indo($r['tgl_jatuh_tempo']);
                            ?>
                            <td><?php echo "$r[nama]"?></td>
                            <td><?php echo "$r[nama_sales]"?></td>
                            <td align="center"><?php echo "$tglpenjualan"?></td>
                            <?php if ($_POST[metode_penjualan] == "2") { ?>
                            <td align="center"><?php echo "$jatuh_tempo"?></td>
                            <?php } ?>
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[itemterjual]"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" <?php if ($_POST[metode_penjualan] == "2") { ?> colspan="8" <?php } else { ?> colspan="6" <?php } ?>> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysql_fetch_array(mysql_query("SELECT
  SUM(
    penjualan_detail.total_penjualan
  ) AS total_penjualan,
  SUM(produk.harga) AS harga_produk,
  SUM(
    penjualan_detail.itemterjual
  ) AS itemterjual
FROM
  penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
WHERE
  penjualan.tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
AND '$_POST[tglpenjualanak]' AND penjualan.metode_penjualan = '$_POST[metode_penjualan]'
ORDER BY
  penjualan.nopenjualan ASC"));
                        ?>

                      <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[itemterjual]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>
                      
                      <br> <br>
                      <?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 460px;"> Cirebon, <?php echo "$tanggal"?>
                      <br><br></p>
                     <p style="margin: 50px 8px 5px 510px;"> Pimpinan </p>

<?php
//Batas file sampe sini
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//$stylesheet = file_get_contents('css/zebra.css');
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>