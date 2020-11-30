<?php
// sesuai kan root file mPDF anda
$nama_dokumen='Laporan Stok Barang'; //Beri nama file PDF hasil.
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
<h1>  LAPORAN STOK BARANG  <br><br> PT. Satria Karya Adiyhuda</h1> </br>

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

<table cellspacing="5" cellpadding="5" border="1">
                        
                          <tr>
                            <th>No</th>
                            <th>No Penjualan</th>
                            <th width="20%">Tanggal Stok Keluar</th>
                            <th width="20%">Nama Produk</th>
                            <th width="20%">Total produk Tersedia</th>
                            <th>Jumlah Stok Keluar</th>
<!--                             <th>Harga Produk</th>
                            <th>Total Penjualan</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT
penjualan.nopenjualan,
penjualan.tglpenjualan,
produk.nama_produk,
produk.stokproduk,
penjualan_detail.itemterjual
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
ORDER BY penjualan.nopenjualan ASC");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[nopenjualan]"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                            
                            <td align="center"><?php echo "$tglpenjualan"?></td>
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[stokproduk]"?></td>
                            <td align="center"><?php echo "$r[itemterjual]"?></td>
<!--                             <td align="center"><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td> -->
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysql_fetch_array(mysql_query("SELECT
SUM(penjualan_detail.total_penjualan) AS total_penjualan,
SUM(produk.harga) AS harga_produk,
SUM(penjualan_detail.itemterjual) AS itemterjual
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
WHERE penjualan.tglpenjualan BETWEEN '$_POST[tglpenjualanaw]' 
AND  '$_POST[tglpenjualanak]' 
ORDER BY penjualan.nopenjualan ASC"));
                        ?>

                      <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[itemterjual]",'0','.','.')?></td>
<!--                         <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td> -->
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