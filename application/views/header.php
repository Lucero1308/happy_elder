<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" context="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<meta name="description" content="">

		<title>HAPPY ELDER</title>

		<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/front.css') ?>" rel="stylesheet">
</head>
<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
	<header class="navbar navbar-expand-lg navbar-dark flex-column flex-md-row bd-navbar">
		<div class="container">
			<a class="navbar-brand mr-0 mr-md-2" href="/" aria-label="Bootstrap">
				<img src="<?= base_url('assets/img/logo.png') ?>" alt="">
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
							<a class="nav-link" href="<?= base_url("/donaciones") ?>">Donaciones</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/ubicaciones") ?>" >Ubicaciones</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/informacion") ?>" >Información</a>
						</li>
					</ul>
				</div>
				<ul class="navbar-nav ml-md-auto d-md-flex">
					<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/admin/dashboard") ?>" >Hola <?= $this->session->userdata['fullName'] ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/login/logout") ?>" >Cerrar sesión</a>
						</li>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url("/login") ?>" >Iniciar sesión</a>
						</li>
					<?php endif ?>
					<li class="nav-item">
						<a class="nav-item nav-link" href="#" id="bd-versions">
						</a>
					</li>
				</ul>
			</div>
		</div>
	</header>
	<main class="main pb-5">
		<div class="container">
