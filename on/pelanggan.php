<?php
error_reporting
?>

<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA pelanggan //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data pelanggan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pelanggan&act=view">Data pelanggan
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=pelanggan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Sales</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Tanggal Masuk</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
					
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT
pelanggan.id_pelanggan,
pelanggan.id_sales,
pelanggan.nama,
pelanggan.alamat,
pelanggan.telepon,
pelanggan.tglmasuk,
users.nama AS nama_sales
FROM
pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user
ORDER BY pelanggan.id_pelanggan ASC");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[nama_sales]"?></td>
                        <td><?php echo "$r[alamat]"?></td>
                        <td><?php echo "$r[telepon]"?></td>
                        <td><?php echo "$r[tglmasuk]"?></td>
                        <td><a href="?pg=pelanggan&act=edit&id=<?php echo $r['id_pelanggan']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=pelanggan&act=delete&id=<?php echo $r['id_pelanggan']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH DATA pelanggan //
      case 'add':
//proses
    if(isset($_POST['add'])) {
    $id_sales=$_POST['id_sales'];
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $telepon=$_POST['telepon'];
    $tglmasuk=$_POST['tglmasuk'];
   
//script validasi data
 
    $cek = mysql_num_rows(mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama pelanggan yang anda masukan sudah ada')
    window.location='?pg=pelanggan&act=view'</script>";
    }else {
    $query = mysql_query("INSERT INTO pelanggan VALUES ('','$_POST[id_sales]','$_POST[nama]','$_POST[alamat]','$_POST[telepon]','$_POST[tglmasuk]')");
                
    echo "<script>window.alert('Data Berhasil DI Simpan')
    window.location='?pg=pelanggan&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data pelanggan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pelanggan&act=view">Data pelanggan</a></li>
            <li class="active"><a href="#">Tambah Data pelanggan</a></li>
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
                      <label for="exampleInputEmail1">Nama Pelanggan</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pelanggan" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Sales</label>
                      <select name="id_sales" class="form-control">
                        <option value="">- Pilih Nama Sales -</option>
                        <?php
                          $qsls = mysql_query("SELECT * FROM users WHERE level_user = 'sales' ORDER BY nama ASC");
                          while ($dsls = mysql_fetch_array($qsls)) {
                        ?>
                        <option value="<?php echo $dsls['id_user']; ?>"><?php echo $dsls['nama']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telepon</label>
                      <input type="number" class="form-control" id="telepon" name="telepon" placeholder="No Telepon" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
					          <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Masuk</label>
                      <input class="form-control" id="date" name="tglmasuk" placeholder="MM/DD/YYY" type="text" required data-fv-notempty-message="Tidak boleh kosong" />
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
      // PROSES EDIT DATA pelanggan //
      case 'edit':
      $d = mysql_fetch_array(mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysql_query("UPDATE pelanggan SET id_sales='$_POST[id_sales]', nama='$_POST[nama]',alamat='$_POST[alamat]',telepon='$_POST[telepon]',tglmasuk='$_POST[tglmasuk]' 
                WHERE id_pelanggan='$_POST[id_pelanggan]'");
                echo "<script>window.location='?pg=pelanggan&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data pelanggan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pelanggan&act=view">Data pelanggan</a></li>
            <li class="active">Update Data pelanggan</li>
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
                      <label for="exampleInputEmail1">Nama pelanggan</label>
                      <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan" value= "<?php echo $d['id_pelanggan'];?>">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pelanggan" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nama'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Sales</label>
                      <select name="id_sales" class="form-control">
                        <option value="">- Pilih Nama Sales -</option>
                        <?php
                          $qsls = mysql_query("SELECT * FROM users WHERE level_user = 'sales' ORDER BY nama ASC");
                          while ($dsls = mysql_fetch_array($qsls)) {
                        ?>
                        <option value="<?php echo $dsls['id_user']; ?>"><?php echo $dsls['nama']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat pelanggan" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['alamat'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">No Telepon</label>
                      <input type="number" class="form-control" id="telepon" name="telepon" placeholder="No Telepon" value= "<?php echo $d['telepon'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Masuk</label>
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

    // PROSES HAPUS DATA pelanggan //
      case 'delete':
      mysql_query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
      echo "<script>window.location='?pg=pelanggan&act=view'</script>";
      break;

    }
    ?>