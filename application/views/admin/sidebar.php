<nav class="col-md-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>" href="<?= base_url("/admin/dashboard") ?>">
					Dashboard <span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'usuarios' ? 'active' : '' ?>" href="<?= base_url("/admin/usuarios") ?>">
					Usuarios
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'servicios' ? 'active' : '' ?>" href="<?= base_url("/admin/servicios") ?>">
					Servicios
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'eventos' ? 'active' : '' ?>" href="<?= base_url("/admin/eventos") ?>">
					Eventos
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'donaciones' ? 'active' : '' ?>" href="<?= base_url("/admin/donaciones") ?>">
					Donaciones
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(2) == 'ubicaciones' ? 'active' : '' ?>" href="<?= base_url("/admin/ubicaciones") ?>">
					Ubicaciones
				</a>
			</li>
		</ul>
	</div>	
</nav>