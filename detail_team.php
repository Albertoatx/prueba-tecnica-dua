<?php 

	include('config/db_connect_pdo.php');

	// check GET request id param
	if(isset($_GET['id'])){

        $sql = 'SELECT name, city, sport, created_at FROM team WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([htmlspecialchars($_GET['id'])]);
        $team = $stmt->fetch(PDO::FETCH_ASSOC);

	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if($team): ?>
			<h4><?php echo htmlspecialchars($team['name']); ?></h4>

			<p>Ciudad de <?php echo htmlspecialchars($team['city']); ?></p>
			<p>Deporte <?php echo htmlspecialchars($team['sport']); ?></p>
			<p>Creado el <?php echo date($team['created_at']); ?></p>

		<?php else: ?>
			<h5>El equipo no existe.</h5>
		<?php endif ?>
	</div>

</html>