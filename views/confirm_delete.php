<div class="container">
    <div class="row">
	<form class="form" action="index.php?controller=tarea&action=delete" method="POST">
		<input type="hidden" name="id" value="<?php echo $dataView["data"]["id"]; ?>" />
		<div class="alert alert-info">
			<b>¿Seguro que desea eliminar esta tarea?:</b>
			<i><?php echo $dataView["data"]["titulo"]; ?></i>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger"/>
		<a class="btn btn-outline-success" href="index.php?controller=tarea&action=listTareas">Cancelar</a>
	</form>
</div>
</div>