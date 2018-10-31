<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/front.css') ?>" rel="stylesheet">
<div class="text-center">
<img height="60" src="<?= base_url('assets/img/logo.png') ?>" alt=""> Happy Elder
</div>
<?php if ( isset( $title ) && $title ): //titulo ?> 
<h1 style="color:#3E2C56;"><?= $title ?></h1>
<?php endif ?>