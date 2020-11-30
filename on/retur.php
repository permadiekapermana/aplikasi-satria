<?php
error_reporting
?>

<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA PRODUK //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Retur </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pggna&act=view">Data Retur   
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=retur&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data Retur</i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Retur</th>
                        <th>Satuan</th>
                        <th>Pelanggan</th>
                        <th>Tanggal Retur</th><!-- 
                        <th>Edit</th>
                        <th>Delete</th> -->
                      </tr>
                    </thead>
					
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT
                    *
                  FROM
                    `retur`
                    INNER JOIN `produk` ON `produk`.`id_produk` = `retur`.`id_produk`
                    INNER JOIN `pelanggan` ON `pelanggan`.`id_pelanggan` = `retur`.`id_pelanggan` order by id_retur asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama_produk]"?></td>
                        <td><?php echo "$r[jml_retur]"?></td>
                        <td><?php echo "$r[satuan]"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[tgl_retur]"?></td><!-- 
                        <td><a href="?pg=produk&act=edit&id=<?php echo $r['id_produk']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=produk&act=delete&id=<?php echo $r['id_produk']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td> -->
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
      // PROSES TAMBAH DATA PRODUK //
      case 'add':
//proses
    if(isset($_POST['add'])) {
    $nama_produk=$_POST['nama_produk'];
    $harga=$_POST['harga'];
    $stokproduk=$_POST['stokproduk'];
    $satuan=$_POST['satuan'];
    $tglmasuk=$_POST['tglmasuk'];
    $jml_retur=$_POST['jml_retur'];
    $tampil = mysql_query("SELECT * FROM produk WHERE 
  id_produk='$_POST[id_produk]'");
    $r=mysql_fetch_array($tampil);
    $jumlah = $r['stokproduk'] + $jml_retur;
   
//script validasi data
 
    $cek = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE 
	kode_produk='$kode_produk'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama Barang yang anda masukan sudah ada')
    window.location='?pg=produk&act=view'</script>";
    }else {
    $query = mysql_query("INSERT INTO retur VALUES ('','$_POST[id_produk]','$_POST[id_pelanggan]',
                '$_POST[jml_retur]','$_POST[tgl_retur]')");
    $query = mysql_query("UPDATE produk SET stokproduk = '$jumlah' WHERE id_produk='$_POST[id_produk]'");
                
    echo "<script>window.alert('Data Berhasil DI Simpan')
    window.location='?pg=retur&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Retur Produk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=retur&act=view">Data Retur</a></li>
            <li class="active"><a href="#">Tambah Data Retur Produk</a></li>
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
                      <label for="exampleInputEmail1">Nama Produk</label>
                      <select name="id_produk" class="form-control">
                        <option value="">- Pilih Produk -</option>
                        <?php
                          $qsls = mysql_query("SELECT * FROM produk ORDER BY id_produk ASC");
                          while ($dsls = mysql_fetch_array($qsls)) {
                        ?>
                        <option value="<?php echo $dsls['id_produk']; ?>"><?php echo $dsls['nama_produk']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Pelanggan</label>
                      <select name="id_pelanggan" class="form-control">
                        <option value="">- Pilih Pelanggan -</option>
                        <?php
                          $qsls = mysql_query("SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
                          while ($dsls = mysql_fetch_array($qsls)) {
                        ?>
                        <option value="<?php echo $dsls['id_pelanggan']; ?>"><?php echo $dsls['nama']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Retur</label>
                      <input type="text" class="form-control" id="jml_retur" name="jml_retur" placeholder="Jumlah Retur" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Retur</label>
                      <input class="form-control" id="date" name="tgl_retur" value="<?php echo date('Y-m-d');?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" />
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'add' class="btn btn-info">Simpan</button>
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
      // PROSES EDIT DATA PRODUK //
      case 'edit':
      $d = mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysql_query("UPDATE produk SET nama_produk='$_POST[nama_produk]',
                  harga='$_POST[harga]',stokawal='$_POST[stokproduk]',stokproduk='$_POST[stokproduk]',satuan='$_POST[satuan]',tglmasuk='$_POST[tglmasuk]' WHERE id_produk='$_POST[id]'");
                echo "<script>window.location='?pg=produk&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=produk&act=view">Data Produk</a></li>
            <li class="active">Update Data Produk</li>
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
                      <label for="exampleInputEmail1">Nama Produk</label>
                      <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nama_produk'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga Beli</label>
                      <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli" value= "<?php echo $d['harga_beli'];?>">
                      <input type="hidden" class="form-control" id="id" name="id" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['id_produk'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga Jual</label>
                      <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Produk" value= "<?php echo $d['harga'];?>">
                      <input type="hidden" class="form-control" id="id" name="id" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['id_produk'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stok Produk</label>
                      <input type="number" class="form-control" id="stokproduk" name="stokproduk" placeholder="Stok Produk" value= "<?php echo $d['stokproduk'];?>">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Satuan</label>
                      <input type="text" class="form-control" id="satuan" name="satuan" placeholder="satuan" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['satuan'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pemasukan</label>
                      <input type="text" class="form-control" id="date" name="tglmasuk" placeholder="MM/DD/YYY"  value= "<?php echo $d['tglmasuk'];?>">
                    </div>
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-info">Update</button>
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

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
      echo "<script>window.location='?pg=produk&act=view'</script>";
      break;

    }
    ?>