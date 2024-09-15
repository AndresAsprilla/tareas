<div class="container">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="index.php?controller=tarea&action=editTarea" class="btn btn-primary">Crear Tarea</a>
            <hr />
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (count($dataView["data"]) > 0) {
                    foreach ($dataView["data"] as $tarea) {
                ?>

                        <tr>
                            <th scope="row"><?php echo $tarea['titulo']; ?></th>
                            <td><?php echo nl2br($tarea['descripcion']); ?></td>
                            <td><?php if ($tarea['estado'] == "1") {
                                    echo nl2br("Pendiente");
                                } elseif ($tarea['estado'] == "2") {
                                    echo nl2br("Completada");
                                } ?></td>
                            <td><a href="index.php?controller=tarea&action=editTarea&id=<?php echo $tarea['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="index.php?controller=tarea&action=confirmDelete&id=<?php echo $tarea['id']; ?>" class="btn btn-danger">Eliminar</a>
                                <?php if ($tarea['estado'] == "1") {   ?>
                                    <a href="index.php?controller=tarea&action=complete&id=<?php echo $tarea['id']; ?>" class="btn btn-success">Completar</a>
                            </td>
                        <?php } ?>
                        </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>
    <?php
                } else {
    ?>
        <div class="alert alert-info">
            Actualmente no existen tareas.
        </div>
    <?php
                }
    ?>
    </div>
</div>