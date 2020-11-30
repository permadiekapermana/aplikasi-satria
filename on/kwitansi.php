<?php
  error_reporting(0);
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";

  $sql = "SELECT
penjualan.nopenjualan,
penjualan.no_invoice,
penjualan.tglpenjualan,
penjualan.tgl_jatuh_tempo,
pelanggan.nama,
users.nama AS sisales
FROM
penjualan
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan 
INNER JOIN users ON pelanggan.id_sales = users.id_user 
WHERE penjualan.nopenjualan = '$_GET[id]'";
  $dsql = mysql_query($sql);
  $dsta = mysql_fetch_assoc($dsql);
?>
<style type="text/css">
  body {
    font-size: 12px;
    background: white; 
    font-family: Garamond,"Times New Roman", serif;
  }
  page {
    background: white;
    display: block;
    margin: 0 auto;
    margin-bottom: 0.5cm;
  }
  page[size="A5"] {
    width: 14.8cm;
    height: 21cm;
  }
  page[size="A5"][layout="portrait"] {
    width: 21cm;
    height: 14.8cm;  
  }
  @media print {
    body, page {
      margin: 0;
      box-shadow: 0;
    }
  }
  table { margin: 1px; font-size: 12px; }
</style>
<page size="A5">
  <div class="body">
    <div class="row">
      <div class="col-md-12">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><b><h1>PT. Satria Karya Adiyhuda</h1></b></td>
            <td valign="bottom"><b>Cirebon, <?php echo tgl_indo($dsta['tglpenjualan']); ?></b></td>
          </tr>
          <tr>
            <td><b>Jl. Kisabalanang Bode Sari No.82, Cirebon - Telepon : (0231) 322043</b></td>
            <td><b><u>Toko/Tuan</u> : <?php echo ucwords($dsta['nama']); ?> - <?php echo $dsta['sisales']; ?></b>
            </td>
          </tr>
          <tr>
            <td><b>Nota No. <?php echo $dsta['nopenjualan']; ?></b></td>
            <td><b>Invoice No: <?php echo $dsta['no_invoice']; ?></b></td>
          </tr>
        </table>
        <hr>
        <table width="100%" border="1" cellpadding="2" cellspacing="0">
            <tr>
              <th width='30%'>Nama Produk</th>
                                <th width='18%'>Jumlah Pembelian (Item)</th>
                                <th width='20%'>Harga Produk</th>
              <th>Sub Total</th>
              </tr>
              <?php
                $qry = mysql_query("SELECT
penjualan_detail.nopenjualan,
produk.nama_produk,
produk.harga,
penjualan_detail.itemterjual,
penjualan_detail.total_penjualan
FROM
penjualan_detail
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
WHERE penjualan_detail.nopenjualan = '$_GET[id]'") or die(mysql_error());
                      while ($data = mysql_fetch_array($qry)) {
                        $sub_total = $data['itemterjual'] * $data['harga'];
                        $print_kwitansi="kwitansi.php?id=$b[nopenjualan]";
                    ?>
              <tr>
                  <td><?php echo ucwords($data['nama_produk']); ?></td>
                  <td align="center" style="font-size: 10px;"><?php echo $data['itemterjual']; ?></td>
                  <td align="center">Rp.<?php echo number_format($data['harga']).",-" ?></td>
                  <td align="center">Rp.<?php echo number_format($sub_total).",-" ?></td>
              </tr>
              <?php
                $subtotal = ($data['harga']*$data['itemterjual']);
                $sub_gtotal = $sub_gtotal + $subtotal; 
                }
              ?>
              <?php
                $gtotal_all = $gtotal_all + $sub_gtotal; 
              ?>
              <tr>
                <td colspan="3" align="right"><b>Grand Total</b></td>
                <td align="center"><b>Rp. <?php echo number_format($gtotal_all).",-"; ?></b></td>
              </tr>
          </table>
        <br>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <?php if ($dsta[tgl_jatuh_tempo] == "") { ?>
            <td width="50%" align="left" valign="top"><b>Tempo Pembayaran : __________________</b></td>
            <?php } else { ?>
            <td width="50%" align="left" valign="top"><b>Tempo Pembayaran : <?php echo tgl_indo($dsta[tgl_jatuh_tempo]); ?></b></td>
            <?php } ?>
            <td width="50%" align="right" valign="bottom">
              <b>
                PERHATIAN !!!<br>
                Barang yang sudah dibeli tidak dapat ditukar/dikembalikan
              </b>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</page>
<script type="text/javascript">   
    if (window.print) {
      document.write();
    }
    setTimeout('window.print()', 1000);
</script>