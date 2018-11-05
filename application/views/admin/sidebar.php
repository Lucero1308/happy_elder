<nav class="col-md-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>" href="<?= base_url("/admin/dashboard") ?>"><i class="fa fa-desktop  fa-fw"></i>
					Dashboard <span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'usuarios' ? 'active' : '' ?>" href="<?= base_url("/admin/usuarios") ?>"><i class="fa fa-users fa-fw"></i>
					Usuarios
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'servicios' ? 'active' : '' ?>" href="<?= base_url("/admin/servicios") ?>"><i class="fa fa-user-md fa-fw"></i>
					Servicios
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'eventos' ? 'active' : '' ?>" href="<?= base_url("/admin/eventos") ?>"><i class="fa fa-edit fa-fw"></i>
					Eventos
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'ubicaciones' ? 'active' : '' ?>" href="<?= base_url("/admin/ubicaciones") ?>"><i class="fa fa-car fa-fw"></i>
					Ubicaciones
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'reportes' ? 'active' : '' ?>" href="<?= base_url("/admin/reportes") ?>"><i class="fa fa-bar-chart-o fa-fw"></i>
					Reportes
				</a>
			</li>
		</ul>
	</div>	
</nav>