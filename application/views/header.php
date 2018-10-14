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
		<link href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/front.css') ?>" rel="stylesheet">
	</head>
<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
	<header class="navbar navbar-expand-lg navbar-dark flex-column flex-md-row bd-navbar">
		<div class="container">
			<a class="navbar-brand mr-0 mr-md-4" href="/" aria-label="Bootstrap">
				<img src="<?= base_url('assets/img/logo.png') ?>" alt=""> Happy Elder
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="navbar-nav-scroll">
					<ul class="navbar-nav bd-navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/servicios") ?>">Servicios</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/eventos") ?>">Eventos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/ubicaciones") ?>" >Ubicaciones</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/informacion") ?>" >Información</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/calificaciones_beneficiarios") ?>" >Nuestros cuidadores</a>
						</li>
					</ul>
				</div>
				<ul class="navbar-nav ml-md-auto d-md-flex">
					
					<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
						<?php if ( $this->session->userdata['rol'] == 3 || $this->session->userdata['rol'] == 4 ): ?>
							<li class="nav-item">
								<a class="nav-link" href="<?= base_url("/cuenta/servicios") ?>" >Mis servicios</a>
							</li>
						<?php endif ?>
						<?php if ( $this->session->userdata['rol'] == 3 ): ?>
							<li class="nav-item">
								<a class="nav-link" href="<?= base_url("/cuenta/eventos") ?>" >Mis eventos</a>
							</li>
						<?php endif ?>
						
						<?php if ( $this->session->userdata['rol'] == 4 ): ?>
							<li class="nav-item">
								<a class="nav-link" href="<?= base_url("/cuenta/beneficiarios") ?>" >Mis asignaciones</a>
							</li>
						<?php endif ?>
						<li class="dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hola <?= $this->session->userdata['firstName'] ?> </a>
							<div class="dropdown-menu">
								<?php if ( $this->session->userdata['rol'] == 1 ): ?>
									<a class="dropdown-item" href="<?= base_url("/admin/dashboard") ?>" >Dashboard</a>
								<?php endif ?>
								<a class="dropdown-item" href="<?= base_url("/cuenta") ?>" >Perfil</a>
								<a class="dropdown-item" href="<?= base_url("/cuenta/logout") ?>" >Cerrar sesión</a>
							</div>
						</li>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/cuenta/login") ?>" >Iniciar sesión</a>
						</li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</header>
	<main class="main py-5">
		<div class="container shadow-sm bg-white">
			<div class="py-4">
				<?php if ( isset( $title ) && $title ): //titulo ?> 
					<h1><?= $title ?></h1>
				<?php endif ?>
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