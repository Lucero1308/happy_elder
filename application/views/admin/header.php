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
		<link href="<?php echo base_url('assets/css/admin.css') ?>" rel="stylesheet">
</head>
<body class="admin <?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
	<div class="container-fluid">
		<div class="row">
			<?php $this->view('admin/sidebar'); ?>
			<main class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
				<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
					<ul class="ml-auto navbar-nav px-3">
						<li class="nav-item text-nowrap">
							<a class="nav-link" href="<?= base_url("/login/logout") ?>">Cerrar sesión</a>
						</li>
					</ul>
				</nav>
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2"><?= $title ?></h1>
					<!--<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<button class="btn btn-sm btn-outline-secondary">Share</button>
							<button class="btn btn-sm btn-outline-secondary">Export</button>
						</div>
						<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
							This week
						</button>
					</div>-->
				</div>
