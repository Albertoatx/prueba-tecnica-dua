

<?php if($players): ?>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Numero</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <td><?php echo $player->getName(); ?></td>
                    <td><?php echo $player->getNumber(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h5>No hay jugadores dados de alta en este equipo.</h5>
<?php endif ?>

