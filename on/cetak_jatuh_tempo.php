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
<h1>  LAPORAN JATUH TEMPO  <br><br> PT. Satria Karya Adiyhuda</h1> </br>

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
	                        <th>No. Penjualan</th>
	                        <th>No. Invoice</th>
	                        <th>Nama Pelanggan</th>
	                        <th>Tgl. Jatuh Tempo</th>
	                        <th>Lewat Jatuh Tempo</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT
penjualan.nopenjualan,
penjualan.no_invoice,
pelanggan.nama,
penjualan.tgl_jatuh_tempo,
datediff(tgl_jatuh_tempo,curdate()) AS lewat
FROM
penjualan
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
WHERE penjualan.tgl_jatuh_tempo BETWEEN '$_POST[tglpenjualanaw]' AND '$_POST[tglpenjualanak]'");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[nopenjualan]"?></td>
                            <td><?php echo "$r[no_invoice]"?></td>
                            <td><?php echo "$r[nama]"?></td>
                            <td><?php echo tgl_indo("$r[tgl_jatuh_tempo]")?></td>
                            <td>
                            	<?php 
								    if($r[lewat]>0){
								        echo $ket = "$r[lewat] Hari Lagi Jatuh Tempo";
								    } elseif($r[lewat]==0){
								        echo $ket = " Jatuh Tempo Telah Habis Hari Ini";
								    } else {
								    	echo $ket = " Jatuh Tempo Telah Habis $r[lewat] Hari Yang Lalu";
								    }
								?>
                            </td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>
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