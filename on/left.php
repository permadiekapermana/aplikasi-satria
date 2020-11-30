<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Menu Utama</li>
      <li class="<?php if ($_GET[pg] == 'dashboard') { echo 'active'; } ?>">
        <a href="?pg=dashboard">
          <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
      </li>
      <?php
        if ($_SESSION['user_login'] == 'admin') {
      ?>
      <li class="treeview <?php if ($_GET[pg] == 'admin' || $_GET[pg] == 'supplier' || $_GET[pg] == 'pelanggan' || $_GET[pg] == 'produk') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-database"></i> <span>Master Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'admin') { echo 'class="active"';} ?> ><a href="?pg=admin&act=view"><i class="fa fa-circle-o"></i> Data Pengguna</a></li>
          <li <?php if ($_GET[pg] == 'supplier') { echo 'class="active"';} ?>><a href="?pg=supplier&act=view"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
          <li <?php if ($_GET[pg] == 'pelanggan') { echo 'class="active"';} ?>><a href="?pg=pelanggan&act=view"><i class="fa fa-circle-o"></i> Data Pelanggan</a></li>
          <li <?php if ($_GET[pg] == 'produk') { echo 'class="active"';} ?>><a href="?pg=produk&act=view"><i class="fa fa-circle-o"></i> Data Produk</a></li>
        </ul>
      </li>
      <li class="treeview <?php if ($_GET[pg] == 'penjualan' || $_GET[pg] == 'penjualan_kredit' || $_GET[pg] == 'pembayaran') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-tasks"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'penjualan') { echo 'class="active"';} ?> ><a href="?pg=penjualan&act=view"><i class="fa fa-circle-o"></i> Penjualan</a></li>
          <!-- <li <?php if ($_GET[pg] == 'penjualan_kredit') { echo 'class="active"';} ?>><a href="?pg=penjualan_kredit&act=view"><i class="fa fa-circle-o"></i> Penjualan Kredit</a></li> -->
          <li <?php if ($_GET[pg] == 'pembayaran') { echo 'class="active"';} ?>><a href="?pg=pembayaran&act=view"><i class="fa fa-circle-o"></i> Pembayaran</a></li>
          <li <?php if ($_GET[pg] == 'retur') { echo 'class="active"';} ?> ><a href="?pg=retur&act=view"><i class="fa fa-circle-o"></i> Retur Barang</a></li>
        </ul>
      </li>
       <li class="treeview <?php if ($_GET[pg] == 'lapbrg' || $_GET[pg] == 'lappj' || $_GET[pg] == 'lapkr' || $_GET[pg] == 'lapbyr') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-book"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'lapbrg') { echo 'class="active"';} ?> ><a href="?pg=lapbrg&act=view"><i class="fa fa-circle-o"></i> Stok Barang</a></li>
          <li <?php if ($_GET[pg] == 'lapbrgupdate') { echo 'class="active"';} ?> ><a href="?pg=lapbrgupdate&act=view"><i class="fa fa-circle-o"></i> Stok Barang Update</a></li>
          <li <?php if ($_GET[pg] == 'lappj') { echo 'class="active"';} ?>><a href="?pg=lappj&act=view"><i class="fa fa-circle-o"></i> Penjualan</a></li>
          <!-- <li <?php if ($_GET[pg] == 'lapkr') { echo 'class="active"';} ?>><a href="?pg=lapkr&act=view"><i class="fa fa-circle-o"></i> Penjualan Kredit</a></li> -->
          <li <?php if ($_GET[pg] == 'lapbyr') { echo 'class="active"';} ?>><a href="?pg=lapbyr&act=view"><i class="fa fa-circle-o"></i> Pembayaran Kredit</a></li>
        </ul>
      </li>
      <?php } else if ($_SESSION['user_login'] == 'pimpinan') { ?>
      <li class="treeview <?php if ($_GET[pg] == 'lapbrg' || $_GET[pg] == 'lappj' || $_GET[pg] == 'lapkr' || $_GET[pg] == 'lapbyr' || $_GET[pg] == 'laptempo') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-book"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'lapbrg') { echo 'class="active"';} ?> ><a href="?pg=lapbrg&act=view"><i class="fa fa-circle-o"></i> Stok Barang</a></li>
          <li <?php if ($_GET[pg] == 'lappj') { echo 'class="active"';} ?>><a href="?pg=lappj&act=view"><i class="fa fa-circle-o"></i> Penjualan</a></li>
          <!-- <li <?php if ($_GET[pg] == 'lapkr') { echo 'class="active"';} ?>><a href="?pg=lapkr&act=view"><i class="fa fa-circle-o"></i> Penjualan Kredit</a></li> -->
          <li <?php if ($_GET[pg] == 'lapbyr') { echo 'class="active"';} ?>><a href="?pg=lapbyr&act=view"><i class="fa fa-circle-o"></i> Pembayaran Kredit</a></li>
          <li <?php if ($_GET[pg] == 'laptempo') { echo 'class="active"';} ?>><a href="?pg=laptempo&act=view"><i class="fa fa-circle-o"></i> Jatuh Tempo</a></li>
        </ul>
      </li>

      <?php } else if ($_SESSION['user_login'] == 'sales') { ?>
        <!-- <li class="treeview <?php if ($_GET[pg] == 'retur') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-tasks"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'retur') { echo 'class="active"';} ?> ><a href="?pg=retur&act=view"><i class="fa fa-circle-o"></i> Retur Barang</a></li> -->
          <!-- <li <?php if ($_GET[pg] == 'penjualan_kredit') { echo 'class="active"';} ?>><a href="?pg=penjualan_kredit&act=view"><i class="fa fa-circle-o"></i> Penjualan Kredit</a></li> -->
        <!-- </ul>
      </li> -->
      <li class="treeview <?php if ($_GET[pg] == 'lapbrg' || $_GET[pg] == 'lappj' || $_GET[pg] == 'lapkr' || $_GET[pg] == 'lapbyr') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-book"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'lapbrgupdate') { echo 'class="active"';} ?> ><a href="?pg=lapbrgupdate&act=view"><i class="fa fa-circle-o"></i> Stok Barang Update</a></li>
          <li <?php if ($_GET[pg] == 'lappjsales') { echo 'class="active"';} ?>><a href="?pg=lappjsales&act=view"><i class="fa fa-circle-o"></i> Penjualan</a></li>
        </ul>
      </li>
      <?php } else if ($_SESSION['user_login'] == 'gudang') { ?>
      <li class="treeview <?php if ($_GET[pg] == 'admin' || $_GET[pg] == 'supplier' || $_GET[pg] == 'pelanggan' || $_GET[pg] == 'produk') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-database"></i> <span>Master Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'produk') { echo 'class="active"';} ?>><a href="?pg=produk&act=view"><i class="fa fa-circle-o"></i> Data Produk</a></li>
        </ul>
      </li>
      <li class="treeview <?php if ($_GET[pg] == 'retur') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-tasks"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'retur') { echo 'class="active"';} ?> ><a href="?pg=retur&act=view"><i class="fa fa-circle-o"></i> Retur Barang</a></li>
          <!-- <li <?php if ($_GET[pg] == 'penjualan_kredit') { echo 'class="active"';} ?>><a href="?pg=penjualan_kredit&act=view"><i class="fa fa-circle-o"></i> Penjualan Kredit</a></li> -->
        </ul>
      </li>
      <li class="treeview <?php if ($_GET[pg] == 'lapbrg' || $_GET[pg] == 'lappj' || $_GET[pg] == 'lapkr' || $_GET[pg] == 'lapbyr') { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-book"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($_GET[pg] == 'lapbrg') { echo 'class="active"';} ?> ><a href="?pg=lapbrg&act=view"><i class="fa fa-circle-o"></i> Stok Barang</a></li>
        </ul>
      </li>
      <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>