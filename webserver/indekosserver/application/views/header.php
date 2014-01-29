<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sistem Indekos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/docs.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'/assets/img/icons/96/aplikasi.png';?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'/assets/img/icons/72/aplikasi.png';?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'/assets/img/icons/48/aplikasi.png';?>">
	<link rel="shortcut icon" href="<?php echo base_url().'/assets/img/icons/36/aplikasi.png';?>">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

</head>
<body data-twttr-rendered="true" data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
			<?php if($this->session->userdata('admin_login')){?>
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php // } ?>
          <a class="brand" href="<?php echo base_url().'admin/home';?>">SISTEM INDEKOS</a>
			<div class="nav-collapse collapse">
				<?php // if($this->session->userdata('admin_login')){?>
				<ul class="nav">
					<li class=""> <a href="<?php echo base_url().'admin/home';?>">Home</a> </li>
					<li class=""><a href="<?php echo base_url().'admin/provinsi';?>">Provinsi</a></li>
					<li class=""><a href="<?php echo base_url().'admin/fasilitas_master';?>">Fasilitas Master</a></li>
					<li class=""><a href="<?php echo base_url().'admin/logout';?>">Logout</a></li>
				</ul>
				<?php }else{ ?>
			<a class="brand" href="<?php echo base_url();?>">SISTEM INDEKOS</a>
			<div class="nav-collapse collapse">
				<?php } ?>
			</div>
        </div>
      </div>
    </div>
	
	<div class="container">
		<div class="row">