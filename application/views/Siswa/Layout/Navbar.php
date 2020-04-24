	<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo2.png') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Layout_admin/Navbar.css') ?>">
</head>
<body>
    <nav id="nama-web" class="navbar navbar-expand-lg navbar-light bg-light">
  <a href="#" style="text-decoration: none; color: #fff;"><img width="100px" height="100px" src="<?php echo base_url('assets/img/logo.png') ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     <center>
    	<li class="nav-item">
        	<a class="nav-link" href="<?php echo site_url('Siswa/Data_Pembayaran') ?>">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;Data Pembayaran&nbsp;&nbsp;</a>
        </li>
      </center>
    </ul>
    <a href="<?php echo site_url('Siswa/Profile') ?>" id="profile" class="btn btn-sm btn-dark"><i class="fa fa-user-circle" ></i>&nbsp;&nbsp;<?php echo $this->session->userdata('nama'); ?></a>
  </div>
</nav>

</body>
</html>