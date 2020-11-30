<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA Laporan pembayaran Kredit //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Pembayaran Kredit</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lapbyr&act=view"><i class="fa fa-dashboard"></i> Laporan Pembayaran Kredit</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
  <div class="col-md-5">
  <form action="?pg=lapbyr&act=cek" method="POST">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Pembayaran Awal</label>
      <input class="form-control" id="date" name="tglpembayaranaw" placeholder="MM/DD/YYY" type="text" required/>
      </div>
  </div>
  <div class="col-md-5">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Pembayaran Akhir</label>
      <input class="form-control" id="date" name="tglpembayaranak" placeholder="MM/DD/YYY" type="text" required/>
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
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No pembayaran</th>
                        <th>Tanggal pembayaran</th>
                        <th>Nama Produk</th>
                        <th>Stok Produk</th>
                        <th>Harga Produk</th>
                        <th>Jumlah Item Terjual</th>
                        <th>Total pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                    <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                    
                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[harga],-"?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[isv_sales],-"?></td>
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
  $sqlp = "SELECT * FROM pembayaran r where
          tglpembayaran BETWEEN  '$_POST[tglpembayaranaw]' AND  '$_POST[tglpembayaranak]'
          ORDER BY nopembayaran ASC";

  $rs=mysql_query($sqlp);
  $data=mysql_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Pembayaran Kredit</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lapbyr&act=view"><i class="fa fa-dashboard"></i> Laporan Pembayaran Kredit</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
      <div class="col-md-5">
      <form action="?pg=lapbyr&act=cek" method="POST">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal pembayaran Awal</label>
          <input class="form-control" id="date" name="tglpembayaranaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal pembayaran Akhir</label>
          <input class="form-control" id="date" name="tglpembayaranak" placeholder="MM/DD/YYY" type="text" required/>
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
                            <th>No Invoice</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Sisa Kredit</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT
pembayaran.no_invoice,
pelanggan.nama,
pembayaran.tglpembayaran,
pembayaran.jumlah_bayar,
pembayaran.sisa_kredit
FROM
pembayaran
INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan 
WHERE pembayaran.tglpembayaran BETWEEN  '$_POST[tglpembayaranaw]' AND  '$_POST[tglpembayaranak]' ORDER BY pembayaran.nopembayaran ASC");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[no_invoice]"?></td>
                            <td><?php echo "$r[nama]"?></td>
                            <?php 
                            $tglpembayaran=tgl_indo($r['tglpembayaran']);?>
                            <td align="center"><?php echo "$tglpembayaran"?></td>                        
                            <td align="center"><?php echo "Rp.". number_format("$r[jumlah_bayar]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[sisa_kredit]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                       <!--  <tr>
                        <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysql_fetch_array(mysql_query("SELECT sum(total_pembayaran) as total_pembayaran, 
                        sum(harga) as harga_produk, sum(itemterjual) as itemterjual FROM pembayaran r  
                        join produk p on (r.id_produk=p.id_produk)
                        where 
                        tglpembayaran BETWEEN '$_POST[tglpembayaranaw]' 
                        AND  '$_POST[tglpembayaranak]' ORDER BY nopembayaran ASC"));
                        ?>
						
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_pembayaran]",'0','.','.')?></td>
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
              <form role="form" action="cetak_pdf_pembayaran.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-danger">
                  <i class="fa fa-file-pdf-o">   Simpan ke PDF</i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="tglpembayaranaw" name="tglpembayaranaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpembayaranaw']?>">
                  <input type="hidden" class="form-control" id="tglpembayaranak" name="tglpembayaranak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpembayaranak']?>">
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
              <li><a href="?pg=lapbyr&act=view"><i class="fa fa-dashboard"></i> Laporan pembayaran Kredit</a></li>
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