<?php
error_reporting
?>

<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA satuan //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data satuan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pggna&act=view">Data Satuan   
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=satuan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama satuan</th>
                        <th>Tgl Pemasukan</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
					
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM satuan order by id_satuan asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[tglmasuk]"?></td>
                        <td><a href="?pg=satuan&act=edit&id=<?php echo $r['id_satuan']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=satuan&act=delete&id=<?php echo $r['id_satuan']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH DATA satuan //
      case 'add':
//proses
    if(isset($_POST['add'])) {
    $nama=$_POST['nama'];
    $tglmasuk=$_POST['tglmasuk'];
   
//script validasi data
 
    $cek = mysql_num_rows(mysql_query("SELECT * FROM satuan WHERE 
	kode_satuan='$kode_satuan'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama Satuan yang anda masukan sudah ada')
    window.location='?pg=satuan&act=view'</script>";
    }else {
    $query = mysql_query("INSERT INTO satuan VALUES ('','$_POST[nama]','$_POST[tglmasuk]')");
                
    echo "<script>window.alert('Data Berhasil DI Simpan')
    window.location='?pg=satuan&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data satuan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=satuan&act=view">Data satuan</a></li>
            <li class="active"><a href="#">Tambah Data satuan</a></li>
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
                      <label for="exampleInputEmail1">Nama satuan</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama satuan" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
					        <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pemasukan</label>
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
      // PROSES EDIT DATA satuan //
      case 'edit':
      $d = mysql_fetch_array(mysql_query("SELECT * FROM satuan WHERE id_satuan='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysql_query("UPDATE satuan SET nama='$_POST[nama]',
                  tglmasuk='$_POST[tglmasuk]' WHERE id_satuan='$_POST[id]'");
                echo "<script>window.location='?pg=satuan&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=satuan&act=view">Data satuan</a></li>
            <li class="active">Update Data satuan</li>
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
                      <label for="exampleInputEmail1">Nama satuan</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama satuan" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nama'];?>">
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

    // PROSES HAPUS DATA SATUAN //
      case 'delete':
      mysql_query("DELETE FROM satuan WHERE id_satuan='$_GET[id]'");
      echo "<script>window.location='?pg=satuan&act=view'</script>";
      break;

    }
    ?>