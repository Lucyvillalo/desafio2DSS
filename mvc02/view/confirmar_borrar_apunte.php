<div class="row">
	<form class="form" action="index.php?controller=apuntes&action=borrar" method="POST">
		<input type="hidden" name="id" value="<?php echo $dataToView["data"]["id"]; ?>" />
		<div class="alert alert-warning">
			<b>¿Confirma que desea eliminar esta nota?:</b>
			<i><?php echo $dataToView["data"]["titulo"]; ?></i>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger"/>
		<a class="btn btn-outline-success" href="index.php?controller=apuntes&action=listar">Cancelar</a>
	</form>
</div>