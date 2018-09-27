<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" context="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<title>HAPPY ELDER</title>
	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/admin.css') ?>" rel="stylesheet"> <!-- Aqui se llama a los css -->

</head>
<body class="admin <?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
	<div class="container-fluid">
		<div class="row">
			<?php $this->view('admin/sidebar'); ?>
			<main class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
				<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow py-1">
					<ul class="ml-auto navbar-nav px-3">
						<li class="nav-item text-nowrap">
							<a class="nav-link" href="<?= base_url("/cuenta/logout") ?>">Cerrar sesión</a>
						</li>
					</ul>
				</nav>
				<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2"><?= $title ?></h1>
					<?php if($this->session->flashdata('log_success')){?>
						<div class="alert alert-success">
							<?php echo $this->session->flashdata('log_success');?>
						</div>
					<?php }?>
					<?php if($this->session->flashdata('log_error')){?>
						<div class="alert alert-danger">
							<?php echo $this->session->flashdata('log_error');?>
						</div>
					<?php }?>
				</div>
