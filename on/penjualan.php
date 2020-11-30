<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA Penjualan //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan&act=view">Data Penjualan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=penjualan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
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
                    $tgl_skrg = date("Ymd");
                    $tampil=mysql_query("SELECT
penjualan.tglpenjualan,
produk.nama_produk,
pelanggan.nama,
produk.harga,
penjualan_detail.itemterjual,
penjualan_detail.total_penjualan
FROM
penjualan_detail
INNER JOIN penjualan ON penjualan_detail.nopenjualan = penjualan.nopenjualan
INNER JOIN produk ON penjualan_detail.id_produk = produk.id_produk
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
WHERE penjualan.tglpenjualan = '$tgl_skrg'
ORDER BY penjualan_detail.nopenjualan ASC");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                        $sub_total = $r[harga]*$r[itemterjual];
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                        
                        <td><?php echo "$tglpenjualan"?></td>
                        <td><?php echo ucwords("$r[nama_produk]") ?></td>
                        <td><?php echo ucwords("$r[nama]") ?></td>
                        <!-- <td><?php echo "$r[stokproduk]"?></td> -->
                        <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                        <td><?php echo "$r[itemterjual]"?></td>
                        <td><?php echo "Rp.". number_format("$sub_total",'0','.','.')?></td>
                       <!--  <td><a href="?pg=penjualan&act=delete&id=<?php echo $r['nopenjualan']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td> -->
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
  // break;
  // PROSES TAMBAH DATA REALISASI //
  // case 'add':
  // if (isset($_POST['add'])) {
  //   $ambilProduk = mysql_fetch_array(mysql_query("select * from produk where id_produk = '$_POST[id_produk]'"));
  //   $total_penjualan = $_POST[itemterjual] * $ambilProduk[harga];
  //   $sisaStok = $ambilProduk[stokproduk] - $_POST[itemterjual];

  //   if ($_POST[itemterjual] > $ambilProduk[stokproduk]){
  //     echo "<SCRIPT language=Javascript>
  //             alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan')
  //           </script>
  //           <script>window.location='?pg=penjualan&act=add'</script>";
  //   } else {
  //     $query = mysql_query("INSERT INTO penjualan VALUES ('$_POST[nopenjualan]',
  //     '$_POST[tglpenjualan]','$_POST[id_produk]',
  //     '$_POST[itemterjual]','$total_penjualan','$_POST[id_pelanggan]')");

  //     mysql_query("update produk set stokproduk = '$sisaStok'
  //                  where id_produk = '$_POST[id_produk]'");
  //     echo "<script>window.alert('Data Berhasil DI Simpan') window.location='?pg=penjualan&act=view'</script>";
  //   }
  // }
  break;
  case 'add':
  if (isset($_POST['addtmp'])) {
    if (!$_POST['id_produk'] || !$_POST['itemterjual']) {
      echo "<SCRIPT language=Javascript>
              alert('Data Tidak Boleh Kosong')
            </script>
            <script>window.location='?pg=penjualan&act=add'</script>";
    } else {
      $ambilProduk = mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk = '$_POST[id_produk]'"));
      $total_penjualan = $_POST[itemterjual] * $ambilProduk[harga];
      $sisaStok = $ambilProduk[stokproduk] - $_POST[itemterjual];

      if ($_POST[itemterjual] > $ambilProduk[stokproduk]){
        echo "<SCRIPT language=Javascript>
                alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan')
              </script>
              <script>window.location='?pg=penjualan&act=add'</script>";
      } else {
        $tambahtemp = mysql_query("INSERT INTO tmp_penjualan (nopenjualan, id_produk, itemterjual, total_penjualan) VALUES ('$_POST[nopenjualan]', '$_POST[id_produk]', '$_POST[itemterjual]','$total_penjualan')") or die(mysql_error());
      }
    }
  } else if (isset($_POST['simpan'])) {
    if (!$_POST['tglpenjualan']) {
      echo "<SCRIPT language=Javascript>
              alert('Tanggal Penjualan Belum Diinput')
            </script>
            <script>window.location='?pg=penjualan&act=add'</script>";
    } else if (!$_POST['id_pelanggan']) {
      echo "<SCRIPT language=Javascript>
              alert('Nama Pelanggan Belum Diinput')
            </script>
            <script>window.location='?pg=penjualan&act=add'</script>";
    } else {
      mysql_query("INSERT INTO penjualan (nopenjualan, no_invoice, tglpenjualan, grand_total_penjualan, id_pelanggan, metode_penjualan, tgl_jatuh_tempo) VALUES ('$_POST[nopenjualan]', '$_POST[no_invoice]', '$_POST[tglpenjualan]', '$_POST[grand_total]', '$_POST[id_pelanggan]', '$_POST[customRadio]', '$_POST[tgl_jatuh_tempo]')") or die(mysql_error());
      
      $qry_brg = mysql_query("SELECT * FROM tmp_penjualan");
      while ($dt_brg = mysql_fetch_array($qry_brg)){
        mysql_query("INSERT INTO penjualan_detail (nopenjualan, id_produk, itemterjual, total_penjualan) VALUES ('$_POST[nopenjualan]', '$dt_brg[id_produk]', '$dt_brg[itemterjual]', '$dt_brg[total_penjualan]')") or die(mysql_error());

        $ambilProduk = mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk = '$dt_brg[id_produk]'"));
        $total_penjualan = $_POST[itemterjual] * $ambilProduk[harga];
        $sisaStok = $ambilProduk[stokproduk] - $dt_brg[itemterjual];

        if ($ambilProduk['stokproduk'] !== '0') {
          mysql_query("UPDATE produk SET stokproduk = '$sisaStok' WHERE id_produk = '$dt_brg[id_produk]'") or die(mysql_error());
        }
      }

      mysql_query("DELETE FROM tmp_penjualan WHERE nopenjualan = '$_POST[nopenjualan]'");

      echo "<SCRIPT language=Javascript>
              alert('Data Berhasil Disimpan')
            </script>
            <script>window.location='?pg=penjualan&act=kwitansi&id=$_POST[nopenjualan]'</script>";
    }
  }
?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1> Data Penjualan </h1>
        <ol class="breadcrumb">
          <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
          <li class="active"><a href="?pg=penjualan&act=view">Data Penjualan</a></li>
          <li class="active"><a href="#">Tambah Data Penjualan</a></li>
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
                          $sql = mysql_query("select * from penjualan");
                          
                          $num = mysql_num_rows($sql);
                          
                          if ($num <> 0) {
                            $kode = $num + 1;
                          } else {
                            $kode = 1;
                          }
                          
                          //mulai bikin kode
                          $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);
                          $tahun = date('Ym');
                          $kode_jadi = "PJLN$tahun$bikin_kode";
                        ?>
                        <label for="exampleInputEmail1">Nomor Penjualan</label>
                        <input type="text" class="form-control" id="nopenj" name="nopenj" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" disabled>
                        <input type="hidden" class="form-control" id="nopenjualan" name="nopenjualan" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Produk</label>
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
                        <input type="number" class="form-control" id="itemterjual" name="itemterjual" placeholder="Jumlah Pembelian">
                      </div>
                      <div class="panel-footer">
                        <button class="btn btn-info" type="submit" name="addtmp">Add</button>
                      </div>
                    </div>
                    <table class="table-form" width="98%" border="0" align="center">
                      <tr>
                        <td colspan="6">
                          <table class="table table-condensed" cellspacing="0" border="0" width="100%">
                            <thead>
                              <tr>
                                <th width='5px'>No</th>
                                <th width='30%'>Nama Produk</th>
                                <th width='20%'>Harga Produk</th>
                                <th width='18%'>Jumlah Pembelian (Item)</th>
                                <th>Total Penjualan</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $NO = 1;
                                $sqlv = mysql_query("SELECT
tmp_penjualan.idtmp,
tmp_penjualan.id_produk,
produk.nama_produk,
produk.harga,
tmp_penjualan.itemterjual,
tmp_penjualan.total_penjualan
FROM
tmp_penjualan
INNER JOIN produk ON tmp_penjualan.id_produk = produk.id_produk") or die(mysql_error());
                                while($datav = mysql_fetch_array($sqlv)) {
                              ?>
                              <tr align="right">
                                <td><?php echo $NO ?></td>
                                <td><?=$datav[nama_produk]; ?></td>
                                <td>Rp. <?php $hrg=number_format($datav[harga],2,",","."); echo $hrg; ?></td>
                                <td><?=$datav[itemterjual]; ?></td>
                                <td>Rp. <?php $sub_total=number_format($datav[total_penjualan],2,",","."); echo $sub_total; ?></td>
                                <td class="ctr">
                                  <div class="btn-group">
                                    <a href="?pg=penjualan&act=deltmp&id=<?php echo $datav['idtmp']; ?>" class="btn btn-warning btn-sm" title="Hapus Data"><i class="icon-remove icon-white"> </i> Delete</a>
                                  </div>  
                                </td>
                              </tr>
                              <? $NO++; } ?>
                              <tr>
                                <?php
                                  $sql_total  = mysql_query("SELECT SUM(total_penjualan) AS total FROM tmp_penjualan") or die(mysql_error());
                                  $total = mysql_fetch_array($sql_total);
                                ?> 
                                  <input type="hidden" name="grand_total" class="form-control" value="<?php $gtotal=$total['total']; echo $gtotal; ?>" readonly> 
                                  <td colspan="4" bgcolor="" style="font-size:14px; text-align: right;"><font color="#FF0000"><b>Grand Total :</b></font></td>
                                  <td align="right" bgcolor="#FFFF00" style="font-size:14px"><font color="#FF0000"><b>Rp. <?php $total=number_format($total['total'],2,",","."); echo $total; ?></b></font></td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="col-md-12">
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-3">
                                  <input type="radio" id="cCash" name="customRadio" value="1" checked>
                                  <label for="cCash">Cash</label>
                                </div>
                                <div class="col-md-3">
                                  <input type="radio" id="cKredit" name="customRadio" value="2">
                                  <label for="cKredit">Kredit</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="cRadioCash Container"></div>
                            <div class="cRadioKredit Container" style="display: none;">
                              <div class="form-group">
                                <?php
                                  //memulai mengambil datanya
                                  $sql_i = mysql_query("SELECT * FROM penjualan");
                                  $num_i = mysql_num_rows($sql_i);
                                  
                                  if ($num_i <> 0) {
                                    $kode_i = $num_i + 1;
                                  } else {
                                    $kode_i = 1;
                                  }
                                  
                                  //mulai bikin kode
                                  $bikin_kode_i = str_pad($kode_i, 4, "0", STR_PAD_LEFT);
                                  $tahun_i = date('Ym');
                                  $kode_jadi_i = "INV$tahun_i$bikin_kode_i";
                                ?>
                                <label for="example-text-input" class="col-form-label">No. Invoice</label>
                                <input class="form-control" type="text" id="no_invoice" name="no_invoice" readonly id="example-text-input">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Jatuh Tempo</label>
                                <input class="form-control" id="date" name="tgl_jatuh_tempo" value="<?php echo date('Y-m-d', strtotime("+32 day"));?>" type="text"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="row">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Penjualan</label>
                                <input class="form-control" id="date" name="tglpenjualan" value="<?php echo date('Y-m-d');?>" type="text"/>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pelanggan</label> <br>
                                <select class="form-control select2" name="id_pelanggan" style="width: 100%;">
                                  <option value="">--- Silahkan Pilih ---</option>
                                  <optgroup label="--- Nama Pelanggan ---">
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
ORDER BY id_pelanggan ASC");
                                      while($r=mysql_fetch_array($tampil)){
                                    ?>
                                    <option value="<?php echo $r['id_pelanggan']?>"><?php echo $r['nama'] ?> - <?php echo $r['nama_sales']; ?></option>
                                    <?php } ?>
                                  </optgroup>
                                </select>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <div class="panel-footer">
                      <button class="btn btn-info" type="submit" name="simpan">Simpan</button>
                      <button type="reset" class="btn btn-success">Reset</button>
                    </div>
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
  // break;
  // PROSES HAPUS DATA REALISASI //
  // case 'delete':
  //   $ambilProduk = mysql_fetch_array(mysql_query("select * from penjualan r join produk p on (r.id_produk=p.id_produk) where nopenjualan='$_GET[id]'"));
  //   $stokproduk = $ambilProduk[itemterjual] + $ambilProduk[stokproduk];
    
  //   mysql_query("update produk set stokproduk = '$stokproduk' where id_produk = '$ambilProduk[id_produk]'");

  //   mysql_query("DELETE FROM penjualan WHERE nopenjualan='$_GET[id]'");
  //   echo "<script>window.location='?pg=penjualan&act=view'</script>";
  // break;
    
  
    break;

    case 'kwitansi':
?>
<?php 
  $sql = "SELECT
penjualan.nopenjualan,
penjualan.no_invoice,
penjualan.tglpenjualan,
penjualan.tgl_jatuh_tempo,
pelanggan.nama,
pelanggan.id_pelanggan,
pelanggan.id_sales,
users.nama AS sisales
FROM
penjualan
INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN users ON pelanggan.id_sales = users.id_user 
WHERE penjualan.nopenjualan = '$_GET[id]'";
  $dsql = mysql_query($sql);
  $dsta = mysql_fetch_assoc($dsql);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1> Kwitansi Penjualan </h1>
    <ol class="breadcrumb">
      <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active"><a href="#">Kwitansi Penjualan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-info">
            <div class="box-body">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
                <tr>
                  <td><b><h1>PT. Satria Karya Adiyhuda</h1></b></td>
                  <td valign="bottom"><b>Cirebon, <?php echo tgl_indo($dsta['tglpenjualan']); ?></b></td>
                </tr>
                <tr>
                  <td><b>Jl. Kisabalanang Bodesari No. 82 , Cirebon - Telepon : (0231) 322043</b></td>
                  <td><b><u>Toko/Tuan</u> : <?php echo ucwords($dsta['nama']); ?> - <?php echo $dsta['sisales']; ?></b>
                  </td>
                </tr>
                <tr>
                  <td><b>Nota No. <?php echo $dsta['nopenjualan']; ?></b></td>
                  <td><b>Invoice No: <?php echo $dsta['no_invoice']; ?></b></td>
                </tr>
              </table>
              <hr>
              <table width="100%" border="1" cellpadding="2" cellspacing="0" class="table table-bordered table-striped">
                  <tr>
                                <th width='30%'>Nama Produk</th>
                                <th width='18%'>Jumlah Pembelian (Item)</th>
                                <th width='20%'>Harga Produk</th>
                                <th>Sub Total</th>th>
                                
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
                              $print_kwitansi="kwitansi.php?id=$data[nopenjualan]";
                          ?>
                    <tr>
                        <td><?php echo ucwords($data['nama_produk']); ?></td>
                        <td align="right"><?php echo $data['itemterjual']; ?></td>
                        <td align="right">Rp.<?php echo number_format($data['harga']).",-" ?></td>
                        <td align="right">Rp.<?php echo number_format($sub_total).",-" ?></td>
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
                      <td align="right"><b>Rp. <?php echo number_format($gtotal_all).",-"; ?></b></td>
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
            <div class="panel-footer">
              <a href="#" onclick="window.open('<?=$print_kwitansi;?>','Print','width=600,height=600')" class="btn btn-info">Print</a>
              <a href="?pg=penjualan&act=view" class="btn btn-success">Back</a>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
    break;

    case 'deltmp':
      mysql_query("DELETE FROM tmp_penjualan WHERE idtmp = '$_GET[id]'");
      echo "<script>window.location='?pg=penjualan&act=add'</script>";
    break;
  }
?>

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('input[type="radio"]').click(function(){
      if($(this).attr('value')=='1'){
        $('.Container').not('.cRadioCash').hide();
        $('.cRadioCash').show();
        $('#no_invoice').val();
      }
      if($(this).attr('value')=='2'){
        $('.Container').not('.cRadioKredit').hide();
        $('.cRadioKredit').show();
        $('#no_invoice').val("<?php echo $kode_jadi_i; ?>");
      }
    });
  });
</script>