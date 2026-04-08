<div class="row">
	<div class="col-md-12 text-right">
		<a href="index.php?controller=apuntes&action=editar" class="btn btn-outline-primary">Crear Apunte</a>
		<hr/>
	</div>
	<?php
	if(count($dataToView["data"])>0){
		foreach($dataToView["data"] as $apuntes){
			?>
			<div class="col-md-3">
				<div class="card-body border border-secondary rounded">
					<h5 class="card-title"><?php echo $apuntes['titulo']; ?></h5>
					<div class="card-text"><?php echo nl2br($apuntes['contenido']); ?></div>
					<hr class="mt-1"/>
					<a href="index.php?controller=apuntes&action=editar&id=<?php echo $apuntes['id']; ?>" class="btn btn-primary">Editar</a>
					<a href="index.php?controller=apuntes&action=confirmarBorrado&id=<?php echo $apuntes['id']; ?>" class="btn btn-danger">Eliminar</a>
				</div>
			</div>
			<?php
		}
	}else{
		?>
		<div class="alert alert-info">
			Actualmente no existen Apuntes.
		</div>
		<?php
	}
	?>
</div>