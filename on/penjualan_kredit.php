<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW Data Penjualan Kredit //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan Kredit </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan_kredit&act=view">Data Penjualan Kredit</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=penjualan_kredit&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal Penjualan</th>
                        <th>No Invoice</th>
                        <th>Nama Produk</th>
                        <th>Nama Pelanggan</th>
                        <th>Harga Produk</th>
                        <th>Jumlah Pembelian(Item)</th>
                        <th>Total Penjualan</th>
                        <!-- <th>Delete</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM penjualan_kredit r join produk p join pelanggan c
                    on (p.id_produk=r.id_produk and c.id_pelanggan=r.id_pelanggan)  order by nopenjualan asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                        <td><?php echo "$tglpenjualan"?></td>
                        <td><?php echo "$r[no_invoice]"?></td>
                        <td><?php echo "$r[nama_produk]"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <!-- <td><?php echo "$r[stokproduk]"?></td> -->
                        <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                        <td><?php echo "$r[itemterjual]"?></td>
                        <td><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                        <!-- <td><a href="?pg=penjualan_kredit&act=delete&id=<?php echo $r['nopenjualan']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td> -->
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
      // PROSES TAMBAH DATA REALISASI //
      case 'add':
      if (isset($_POST['add'])) {

        $ambilProduk = mysql_fetch_array(mysql_query("select * from produk where id_produk = '$_POST[id_produk]'"));

        $total_penjualan = $_POST[itemterjual] * $ambilProduk[harga];
        $sisaStok = $ambilProduk[stokproduk] - $_POST[itemterjual];

        if ($_POST[itemterjual] > $ambilProduk[stokproduk]){
          echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan Kredit')
          </script>
          <script>window.location='?pg=penjualan_kredit&act=add'</script>";
        } else {

                $query = mysql_query("INSERT INTO penjualan_kredit VALUES ('$_POST[nopenjualan]',
                '$_POST[tglpenjualan]','$_POST[id_produk]',
                '$_POST[itemterjual]','$total_penjualan','$_POST[id_pelanggan]','$_POST[no_invoice]')");

                mysql_query("update produk set stokproduk = '$sisaStok'
                             where id_produk = '$_POST[id_produk]'");
                echo "<script>window.alert('Data Berhasil DI Simpan')
				window.location='?pg=penjualan_kredit&act=view'</script>";
              }
            }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan Kredit </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan_kredit&act=view">Data Penjualan Kredit</a></li>
            <li class="active"><a href="#">Tambah Data Penjualan Kredit</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <?php
                      //memulai mengambil datanya
                      $sql = mysql_query("select * from penjualan_kredit");
                      
                      $num = mysql_num_rows($sql);
                      
                      if($num <> 0)
                      {
                      $kode = $num + 1;
                      }else
                      {
                      $kode = 1;
                      }
                      
                      //mulai bikin kode
                      $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);
                      $tahun = date('Ym');
                      $kode_jadi = "PJKR$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">Nomor Penjualan</label>
                      <input type="text" class="form-control" id="nopenj" name="nopenj" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="nopenjualan" name="nopenjualan" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Penjualan</label>
                      <input class="form-control" id="date" name="tglpenjualan" placeholder="MM/DD/YYY" type="text"/>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">No Invoice</label>
                      <input class="form-control" id="no_invoice" name="no_invoice" placeholder="No Invoice" type="text"/>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Produk</label> <br>
                      <select class="form-control select2" name="id_produk" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama Produk ---">
                      <?php
                      $tampil=mysql_query("SELECT * FROM produk ORDER BY id_produk");
                      while($r=mysql_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['id_produk']?>"><?php echo $r['nama_produk'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Pembelian</label>
                      <input type="number" class="form-control" id="itemterjual" name="itemterjual" placeholder="Jumlah Pembelian" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Pelanggan</label> <br>
                      <select class="form-control select3" name="id_pelanggan" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama Pelanggan ---">
                      <?php
                      $tampil=mysql_query("SELECT * FROM pelanggan ORDER BY id_pelanggan");
                      while($r=mysql_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['id_pelanggan']?>"><?php echo $r['nama'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name ='add' class="btn btn-info">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


      <?php
      break;
      
    // PROSES HAPUS DATA REALISASI //
      case 'delete':
      $ambilProduk = mysql_fetch_array(mysql_query("select * from penjualan_kredit r
        join produk p on (r.id_produk=p.id_produk) where nopenjualan='$_GET[id]'"));

      $stokproduk = $ambilProduk[itemterjual] + $ambilProduk[stokproduk];

      mysql_query("update produk set stokproduk = '$stokproduk'
                    where id_produk = '$ambilProduk[id_produk]'");

      mysql_query("DELETE FROM penjualan_kredit WHERE nopenjualan='$_GET[id]'");
      echo "<script>window.location='?pg=penjualan_kredit&act=view'</script>";
      break;

    }
    ?>
    