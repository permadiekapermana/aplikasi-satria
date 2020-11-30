<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

       <br/>
       <br/>
       <br/>
   
<section class="content">
         <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
		<div class="callout callout-danger">
                <h4>Selamat Datang "<?php echo strtoupper($_SESSION['nama']);?>" di Sistem Informasi PT. Satria Karya Adiyhuda</h4>
                </p>
              </div>
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Info User <?php if ($_SESSION['user_login'] == 'admin') { echo 'Admin'; } else if ($_SESSION['user_login'] == 'pimpinan') { echo 'Pimpinan'; } else if ($_SESSION['user_login'] == 'sales') { echo 'Sales'; } else if ($_SESSION['user_login'] == 'gudang') { echo 'Gudang'; } ?></h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">

                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Username</th>
                                <th>:</th>
                                <td><?php echo ucwords($_SESSION["nama"]); ?></td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <th>:</th>
                                <td><?php date_default_timezone_set("Asia/Jakarta"); echo $date = date(' H:i:s'); ?></td>
                            </tr>
                            <tr>
                                <th>Last Login</th>
                                <th>:</th>
                                <td><?php echo date('d-m-Y'); ?></td>
                            </tr>
                            
                            </tbody>
                        </table>

                    </div>
                    <!-- <div class="col-md-6">


                        <table class="table">
                            <tbody>

                            <tr>
                                <th>IP Address</th>
                                <th>:</th>
                                <td><?php echo $_SERVER["REMOTE_ADDR"]; ?></td>
                            </tr>
                            <tr>
                                <th>Server</th>
                                <th>:</th>
                                <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
                            </tr>
                            <tr>
                                <th>Browser</th>
                                <th>:</th>
                                <td><?php echo $_SERVER["HTTP_USER_AGENT"]; ?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div> -->
                </div>

            </div>
        </div>
    </div>
				
			
		</div>
      </div>
</section>
	 