<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN PENJUALAN //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Penjualan</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> Laporan Penjualan</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
    <form action="?pg=lappj&act=cek" method="POST">
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Metode Pembayaran</label>
          <select name="metode_penjualan" class="form-control">
            <option value="0">All</option>
            <option value="1">Cash</option>
            <option value="2">Kredit</option>
          </select>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Sales</label>
          <select name="sales" class="form-control">
            <option value="0">All</option>
            <?php
              $qsls = mysql_query("SELECT * FROM users WHERE level_user = 'sales' ORDER BY nama ASC");
              while ($dsls = mysql_fetch_array($qsls)) {
            ?>
            <option value="<?php echo $dsls['id_user']; ?>"><?php echo $dsls['nama']; ?></option>
            <?php } ?>
          </select>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
          <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
          <input class="form-control" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn btn-info">
          </div>
      </div>
    </form>

  <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table class="table table-hover responsive">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>No. Penjualan</th>
                            <th>No. Invoice</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Sales</th>
                            <th>Tanggal Penjualan</th>
                            <th>Jatuh Tempo</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Item Terjual</th>
                            <th>Harga Produk</th>
                            <th>Total Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($_SESSION['user_login']=='sales'){
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
users.nama AS nama_sales,
users.id_user
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user
WHERE users.id_user='$_SESSION[sess_id]'
ORDER BY penjualan.nopenjualan ASC");
                        }
                        else {
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
users.nama AS nama_sales,
users.id_user
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user
ORDER BY penjualan.nopenjualan ASC");
                        }
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[nopenjualan]"?></td>
                            <td><?php echo $r[no_invoice]; ?></td>
                            <?php 
                              $tglpenjualan=tgl_indo($r['tglpenjualan']);
                              $jatuh_tempo=tgl_indo($r['tgl_jatuh_tempo']);
                            ?>
                            <td><?php echo "$r[nama]"?></td>
                            <td><?php echo "$r[nama_sales]"?></td>
                            <td align="center"><?php echo "$tglpenjualan"?></td>
                            <td align="center"><?php echo "$jatuh_tempo"?></td>
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[item]"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="8"> <span style="font-weight:bold">TOTAL</span></td>
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
ORDER BY
  penjualan.nopenjualan ASC"));
                        ?>
            
                        <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[itemterjual]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<?php
break;

  case 'cek':
  // menampilkan pertanyaan pertama
  $sqlp = "SELECT
penjualan_detail.itemterjual,
penjualan_detail.total_penjualan,
penjualan.no_invoice,
penjualan.nopenjualan,
penjualan.tglpenjualan,
penjualan.tgl_jatuh_tempo,
produk.nama_produk,
produk.stokproduk,
produk.harga,
penjualan_detail.itemterjual AS item,
penjualan_detail.total_penjualan AS total
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
ORDER BY penjualan.nopenjualan ASC";

  $rs=mysql_query($sqlp);
  $data=mysql_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Penjualan</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> Laporan Penjualan</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
      <<form action="?pg=lappj&act=cek" method="POST">
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Metode Pembayaran</label>
          <select name="metode_penjualan" class="form-control">
            <option value="0">All</option>
            <option value="1">Cash</option>
            <option value="2">Kredit</option>
          </select>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Sales</label>
          <select name="sales" class="form-control">
            <option value="0">All</option>
            <?php
              $qsls = mysql_query("SELECT * FROM users WHERE level_user = 'sales' ORDER BY nama ASC");
              while ($dsls = mysql_fetch_array($qsls)) {
            ?>
            <option value="<?php echo $dsls['id_user']; ?>"><?php echo $dsls['nama']; ?></option>
            <?php } ?>
          </select>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
          <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
          <input class="form-control" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn btn-info">
          </div>
      </div>
    </form>

      <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-info">
                      <div class="box-body">
                      <div class="table-responsive">
                      <table class="table table-hover responsive">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>No. Penjualan</th>
                            <?php if ($_POST[metode_penjualan] == "2") { ?>
                            <th>No. Invoice</th>
                            <?php } ?>
                            <th>Nama Pelanggan</th>
                            <th>Nama Sales</th>
                            <th>Tanggal Penjualan</th>
                            <?php if ($_POST[metode_penjualan] == "2") { ?>
                            <th>Jatuh Tempo</th>
                            <?php } ?>
                            <th>Nama Produk</th>
                            <th>Jumlah Item Terjual</th>
                            <th>Harga Produk</th>
                            <th>Total Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($_POST[metode_penjualan] !== '0' || $_POST[sales] !== '0') {
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
users.nama AS nama_sales,
users.id_user
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user
WHERE
  penjualan.tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
AND '$_POST[tglpenjualanak]' AND penjualan.metode_penjualan = '$_POST[metode_penjualan]' AND users.id_user = '$_POST[sales]'
ORDER BY penjualan.nopenjualan ASC");
                      } else {
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
users.nama AS nama_sales,
users.id_user
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user
WHERE
  penjualan.tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
AND '$_POST[tglpenjualanak]' and users.id_user = '$_POST[sales]'
ORDER BY penjualan.nopenjualan ASC");
                      }
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
                            <td align="center"><?php echo "$r[item]"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" <?php if ($_POST[metode_penjualan] == "2") { ?> colspan="8" <?php } else { ?> colspan="6" <?php } ?> > <span style="font-weight:bold">TOTAL</span></td>
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
AND '$_POST[tglpenjualanak]' AND penjualan.metode_penjualan = '$_POST[metode_penjualan]' and users.id_user = '$_POST[sales]'
ORDER BY
  penjualan.nopenjualan ASC"));
                        ?>
						
                        <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[itemterjual]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>
                      </div><!-- /.box-body -->
                  </div>
                  </div><!-- /.box -->
                  </div> <!-- /.col -->
      </div>
        <!-- /.row (main row) -->

      <div class="row">
              <div class="col-md-4 col-md-offset-8">
              <form role="form" action="cetak_pdf.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-danger">
                  <i class="fa fa-file-pdf-o">   Simpan ke PDF</i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="metode_penjualan" name="metode_penjualan" placeholder="Nama Konsumen" value= "<?php echo $_POST['metode_penjualan']?>">
                  <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanaw']?>">
                  <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanak']?>">
                  </div>
              </form>
          </div>
          </div>
          </div>

    </section> <!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->

<?php
} else { 
  ?>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1> Silahkan pilih</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> laporan Penjualan</a></li>
             </ol>
      </section>

      <section class="content">
          <div class="box box-success">
              <div class="box-body">
                  <div class="form-group">
                  <?php
                  echo " <p> Maaf untuk pencarian yang anda cari tidak tersedia. <br>
                  Silahkan coba lakukan pencarian ulang. Terima Kasih </p>";
                  
                  ?>
                  </div>
              </div>
          </div>
      </section> <!-- /.content -->
    </div> <!-- /.container -->
  </div> <!-- /.content-wrapper -->

  <?php
  }
  ?>

<?php
break;
}
?>