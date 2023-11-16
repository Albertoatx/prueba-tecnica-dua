
	<?php include('templates/header.php'); ?>

    <h2 class="center grey-text">Listado de Equipos</h2>

    <div class="container">
        <div class="row">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Equipo</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Deporte</th>
                        <th scope="col">Capitán</th>
                        <th scope="col">Ver detalle</th>
                    </tr>
                </thead>
                <tbody class="row-clickable">

                    <?php foreach($teams as $team): ?>
                        <tr class="">
                            <td><h6><?php echo htmlspecialchars($team->getName()); ?></h6></td>
                            <td><?php echo htmlspecialchars($team->getCity()); ?></td>
                            <td><?php echo htmlspecialchars($team->getSport()); ?></td>
                            <td><?php echo $team->getCaptain() ? htmlspecialchars($team->getCaptain()->getName()) : ""; ?></td>
                            <!-- <td><a class="brand-text" href="detail_team.php?id=<?php echo $team->getId() ?>">Más info</a></td> -->
                            <td><a class="brand-text" href="index.php?route=get-team&id=<?php echo $team->getId() ?>">Más info</a></td>
                        </tr>    
                    <?php endforeach; ?>

                </tbody>
        </table>
        </div>
    </div>
<!-- </html> -->