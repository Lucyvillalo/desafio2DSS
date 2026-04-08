<?php

$id = $titulo = $contenido = "";
//var_dump($dataToView);
if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["titulo"])) $titulo = $dataToView["data"]["titulo"];
if(isset($dataToView["data"]["contenido"])) $contenido = $dataToView["data"]["contenido"];

?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Operación realizada correctamente. <a href="index.php?controller=apuntes&action=listar">Volver al listado</a>
		</div>
		<?php
	}
	?>
	<form class="form" action="index.php?controller=apuntes&action=guardar" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label>Título</label>
			<input class="form-control" type="text" name="titulo" value="<?php echo $titulo; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Contenido</label>
			<textarea class="form-control" style="white-space: pre-wrap;" name="contenido"><?php echo $contenido; ?></textarea>
		</div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="index.php?controller=apuntes&action=listar">Cancelar</a>
	</form>
</div>