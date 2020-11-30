<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN PENJUALAN //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Jatuh Tempo</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=laptempo&act=view"><i class="fa fa-dashboard"></i> Laporan Jatuh Tempo</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
    <form action="?pg=laptempo&act=cek" method="POST">
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Jatuh Tempo Awal</label>
          <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Jatuh Tempo Akhir</label>
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
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No. Penjualan</th>
                        <th>No. Invoice</th>
                        <th>Nama Pelanggan</th>
                        <th>Tgl. Jatuh Tempo</th>
                        <th>Lewat Jatuh Tempo</th>
                        <th>Sisa Kredit</th>
                      </tr>
                    </thead>
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
penjualan.nopenjualan,
penjualan.no_invoice,
pelanggan.nama,
penjualan.tgl_jatuh_tempo
FROM
penjualan
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan";

  $rs=mysql_query($sqlp);
  $data=mysql_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Jatuh Tempo</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=laptempo&act=view"><i class="fa fa-dashboard"></i> Laporan Jatuh Tempo</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
    <form action="?pg=laptempo&act=cek" method="POST">
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Jatuh Tempo Awal</label>
          <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Jatuh Tempo Akhir</label>
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
                      </div><!-- /.box-body -->
                  </div>
                  </div><!-- /.box -->
                  </div> <!-- /.col -->
      </div>
        <!-- /.row (main row) -->

      <div class="row">
              <div class="col-md-4 col-md-offset-8">
              <form role="form" action="cetak_jatuh_tempo.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-danger">
                  <i class="fa fa-file-pdf-o">   Simpan ke PDF</i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" value= "<?php echo $_POST['tglpenjualanaw']?>">
                  <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" value= "<?php echo $_POST['tglpenjualanak']?>">
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
              <li><a href="?pg=laptempo&act=view"><i class="fa fa-dashboard"></i> laporan Jatuh Tempo</a></li>
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