<link rel="stylesheet" href="plugins/autocomplete/jquery-ui.css">
<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW Data Pembayaran //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pembayaran </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pembayaran&act=view">Data Pembayaran</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=pembayaran&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal pembayaran</th>
                        <th>No Invoice</th>
                        <th>Jumlah Bayar</th>
                        <th>Sisa Kredit</th>
                        <th>Status pembayaran</th>
                        <!-- <th>Delete</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM pembayaran r  order by nopembayaran asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                        if ($r[status_pembayaran] == 0) {
                          $status = "Belum Lunas";
                        } else {
                          $status = "Lunas";
                        }
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tglpembayaran=tgl_indo($r['tglpembayaran']);?>
                        
                        <td><?php echo "$tglpembayaran"?></td>
                        <td><?php echo "$r[no_invoice]"?></td>
                        <td><?php echo "Rp.". number_format("$r[jumlah_bayar]",'0','.','.')?></td>
                        <td><?php echo "Rp.". number_format("$r[sisa_kredit]",'0','.','.')?></td>
                        <td><?php echo "$status"?></td>
                        <!-- <td><a href="?pg=pembayaran&act=delete&id=<?php echo $r['nopembayaran']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td> -->
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
        $id_pembayaran     = $_POST['id_pembayaran'];
        $id_pelanggan      = $_POST['id_pelanggan'];
        $tglpembayaran     = $_POST['tglpembayaran'];
        $no_invoice        = $_POST['no_invoice'];
        $jumlah_bayar      = $_POST['jumlah_bayar'];
        $sisa_kredit       = $_POST['sisa_kredit'];
        $status_pembayaran = $_POST['status_pembayaran'];

        //Total Kredit
        $CEK = mysql_query("SELECT SUM(total_penjualan) AS total FROM penjualan_detail INNER JOIN penjualan ON penjualan_detail.nopenjualan = penjualan.nopenjualan WHERE penjualan.no_invoice = '$no_invoice'");
        $DCK = mysql_fetch_array($CEK);
        $TOTAL_KREDIT = $DCK['total'] - $jumlah_bayar;

        //Pembayaran
        $SQL_K = mysql_query("SELECT sisa_kredit FROM pembayaran WHERE no_invoice = '$no_invoice' ORDER BY nopembayaran DESC LIMIT 1");
        $KRD_D = mysql_fetch_array($SQL_K);
        if ($KRD_D['sisa_kredit'] == "") {
          $IURAN = $TOTAL_KREDIT;
        } else {
          $IURAN = $KRD_D['sisa_kredit'] - $jumlah_bayar;      
        }

        if ($DCK['total'] >= $jumlah_bayar AND $jumlah_bayar > 0) {
          if ($sisa_kredit == $jumlah_bayar) {
            mysql_query("INSERT INTO pembayaran (tglpembayaran, no_invoice, id_pelanggan, jumlah_bayar, sisa_kredit, status_pembayaran) VALUES ('$tglpembayaran', '$no_invoice', '$id_pelanggan', '$jumlah_bayar', '$IURAN', '1')");
            echo "<SCRIPT language=Javascript>alert('Data Pembayaran Berhasil')</script>
              <script>window.location='?pg=pembayaran&act=view'</script>";
          } else if ($jumlah_bayar >= $sisa_kredit) {
            echo "<SCRIPT language=Javascript>alert('Jumlah Yang Di Input Melebihi Total Kredit !')</script>
                  <script>window.location='?pg=pembayaran&act=add'</script>";
          } else {
            mysql_query("INSERT INTO pembayaran (tglpembayaran, no_invoice, id_pelanggan, jumlah_bayar, sisa_kredit) VALUES ('$tglpembayaran', '$no_invoice', '$id_pelanggan', '$jumlah_bayar', '$IURAN')");
            echo "<SCRIPT language=Javascript>alert('Data Pembayaran Berhasil')</script>
              <script>window.location='?pg=pembayaran&act=view'</script>";
          }
        } else {
          if ($jumlah_bayar < 1) {
            echo "<SCRIPT language=Javascript>alert('Maaf Terjadi Kesalahan')</script>
                  <script>window.location='?pg=pembayaran&act=add'</script>";
          } else {
            echo "<SCRIPT language=Javascript>alert('Jumlah Yang Di Input Melebihi Total Kredit !')</script>
                  <script>window.location='?pg=pembayaran&act=add'</script>";
          }
        }

      }
    ?>



<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pembayaran </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pembayaran&act=view">Data Pembayaran</a></li>
            <li class="active"><a href="#">Tambah Data Pembayaran</a></li>
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
                      $sql = mysql_query("select * from pembayaran");
                      
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
                      $kode_jadi = "PJLN$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">Nomor pembayaran</label>
                      <input type="text" class="form-control" id="nopenj" name="nopenj" placeholder="Nomor pembayaran" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="nopembayaran" name="nopembayaran" placeholder="Nomor pembayaran" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal pembayaran</label>
                      <input class="form-control" id="date" name="tglpembayaran" placeholder="MM/DD/YYY" type="text"/>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">No Invoice</label>
                      <input class="form-control" id="no_invoice" name="no_invoice" placeholder="No Invoice" type="text"/>
                      <input class="form-control" id="id_pelanggan" name="id_pelanggan" type="hidden"/>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Bayar</label>
                      <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    

                    <div class="form-group">
                      <label for="exampleInputEmail1">Sisa Kredit</label>
                      <input type="number" class="form-control" id="sisa_kredit" name="sisa_kredit" placeholder="Sisa Kredit" readonly>
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
      $ambilProduk = mysql_fetch_array(mysql_query("select * from pembayaran r
        join produk p on (r.id_produk=p.id_produk) where nopembayaran='$_GET[id]'"));

      $stokproduk = $ambilProduk[itemterjual] + $ambilProduk[stokproduk];

      mysql_query("update produk set stokproduk = '$stokproduk'
                    where id_produk = '$ambilProduk[id_produk]'");

      mysql_query("DELETE FROM pembayaran WHERE nopembayaran='$_GET[id]'");
      echo "<script>window.location='?pg=pembayaran&act=view'</script>";
      break;

    }
    ?>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/autocomplete/jquery-ui.js"></script>
<script type="text/javascript">
  $(function(){
        $('#no_invoice').autocomplete({
            source: function(request, response) {
                $.ajax({ 
                    url: "cari_invoice.php",
                    data: { no_invoice: $("#no_invoice").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data){
                        response(data);
                    }    
                });
            },
        });

        $('#no_invoice').blur(function() {
        var no_invoice = $('#no_invoice').val();
        $.ajax({
            type : "POST",
            data : "no_invoice="+no_invoice,
            url  : "cari_sisa_kredit.php",
            dataType: "json",
            success: function(data){
              $("#sisa_kredit").val(data.sisa_kredit);
              $("#id_pelanggan").val(data.id_pelanggan);
            }
        });
    });
    });
</script>
    