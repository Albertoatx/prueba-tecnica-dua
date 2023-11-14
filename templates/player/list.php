

<?php if($players): ?>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Numero</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <td><?php echo $player->getName(); ?></td>
                    <td><?php echo $player->getNumber(); ?></td>
                    <td>
                        <a href="index.php?route=update-player&id=<?php echo $player->getId(); ?>">Editar</a>
                    </td>
                    <td>
                        <a href="index.php?route=delete-player&id=<?php echo $player->getId(); ?>&teamid=<?php echo $team->getId() ?> ">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h5>No hay jugadores dados de alta en este equipo.</h5>
<?php endif ?>

