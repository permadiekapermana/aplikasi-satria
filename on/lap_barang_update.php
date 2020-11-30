<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN PENJUALAN //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Update Stok barang </h1>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box-header">
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Stok Awal</th>
                        <th>Jumlah Stok Keluar (Hari Ini)</th>
                        <th>Stok Akhir</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM produk  order by id_produk asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama_produk]"?></td>
                        <td><?php echo "$r[stokawal]"?></td>
                        
                        <?php
                        $sqlp = "SELECT
penjualan.nopenjualan,
penjualan.tglpenjualan,
produk.nama_produk,
produk.id_produk,
produk.stokproduk,
penjualan_detail.id_produk,
penjualan_detail.itemterjual, SUM(itemterjuaL)AS total_jual
FROM
penjualan
INNER JOIN penjualan_detail ON penjualan.nopenjualan = penjualan_detail.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk and produk.id_produk = '$r[id_produk]'
where penjualan.tglpenjualan=CURDATE() GROUP BY produk.nama_produk";

  $rs=mysql_query($sqlp);
  $data=mysql_fetch_array($rs);
                        
                        ?>

                        <td><?php echo "$data[total_jual]"?></td>
                       <td><?php echo "$r[stokproduk]"?></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
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
penjualan.nopenjualan,viewv
penjualan.tglpenjualan,
produk.nama_produk,
produk.stokproduk,
penjualan_detail.itemterjual
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
        <h1> Laporan Update Stok Barang</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lapbrgupdate&act=view"><i class="fa fa-dashboard"></i> Laporan Update Stok Barang</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
      <div class="col-md-5">
      <form action="?pg=lapbrgupdate&act=cek" method="POST">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Update Stok Awal</label>
          <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Update Stok Akhir</label>
          <input class="form-control" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn bg-orange">
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
<!--                             <th>No Penjualan</th>
                            <th>Tanggal Update Stok Keluar</th> -->
                            <th>Nama Produk</th>
                            <th>Jumlah Update Stok Keluar</th>
                            <th>Update Stok Produk Tersedia</th>
                            
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
where penjualan.tglpenjualan=CURDATE()
ORDER BY penjualan.nopenjualan ASC");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
<!--                             <td><?php echo "$r[nopenjualan]"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                            
                            <td align="center"><?php echo "$tglpenjualan"?></td> -->
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[itemterjual]"?></td>
                            <td align="center"><?php echo "$r[stokproduk]"?></td>
                            
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                       <!--  <tr>
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
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr> -->
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
              <form role="form" action="cetak_pdf_barang.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-danger">
                  <i class="fa fa-file-pdf-o">   Simpan ke PDF</i>  
                  </button>
                  </div>
                  <div class="form-group">
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
              <li><a href="?pg=lapbrgupdate&act=view"><i class="fa fa-dashboard"></i> laporan Update Stok Barang</a></li>
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