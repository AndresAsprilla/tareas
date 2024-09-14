<?php
$id = $titulo = $descripcion = $estado= "";

if(isset($dataView["data"]["id"])) $id = $dataView["data"]["id"];
if(isset($dataView["data"]["titulo"])) $titulo = $dataView["data"]["titulo"];
if(isset($dataView["data"]["descripcion"])) $descripcion = $dataView["data"]["descripcion"];
if(isset($dataView["data"]["estado"])) $estado = $dataView["data"]["estado"];

?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Tarea editada/creada correctamente. <a href="index.php?controller=tarea&action=listTareas">Volver al listado</a>
		</div>
		<?php
	}
	?>
	<form class="form" action="index.php?controller=tarea&action=createTarea" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label>Título</label>
			<input class="form-control" type="text" name="titulo" value="<?php echo $titulo; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Descripción</label>
			<textarea class="form-control" style="white-space: pre-wrap;" name="descripcion"><?php echo $descripcion; ?></textarea>
		</div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="index.php?controller=tarea&action=listTareas">Cancelar</a>
	</form>
</div>