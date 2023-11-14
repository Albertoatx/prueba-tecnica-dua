

<?php include('templates/header.php'); ?>

<div class="container center">
    <h2 class="center grey-text">Información del Equipo</h2>

    <?php if($team): ?>
        <h4><?php echo htmlspecialchars($team->getName()); ?></h4>

        <p>Ciudad de <?php echo htmlspecialchars($team->getCity()); ?></p>
        <p>Deporte <?php echo htmlspecialchars($team->getSport()); ?></p>
        <p>Creado el <?php echo date($team->getCreatedAt()); ?></p>

    <?php else: ?>
        <h5>El equipo no existe.</h5>
    <?php endif ?>


    <br>
    <hr>
    <br>
    
    <h4>Jugadores</h4>
    <?php include('templates/player/list.php'); ?>

</div>