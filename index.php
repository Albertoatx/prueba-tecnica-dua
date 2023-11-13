<?php 

    // Option mysqli 
    // --------------------------------------------------------------
	// include('config/db_connect_mysqli.php');

	//
	// $sql = 'SELECT id, name, city, sport FROM team ORDER BY created_at';

	// // get the result set (set of rows)
	// $result = mysqli_query($conn, $sql);
    // print_r($result);

	// // fetch the resulting rows as an array
	// $teams = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// // free the $result from memory (good practise)
	// mysqli_free_result($result);

	// // close connection
	// mysqli_close($conn);


    // Option PDO 
    // --------------------------------------------------------------
	include('config/db_connect_pdo.php');

    // Positional Params
    $sql = 'SELECT id, name, city, sport FROM team ORDER BY created_at';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">EQUIPOS</h4>

	<div class="container">
		<div class="row">
            
			<!-- <?php foreach($teams as $team): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h5><?php echo htmlspecialchars($team['name']); ?></h5>
                            <p><?php echo htmlspecialchars($team['city']); ?></p>
                            <p><?php echo htmlspecialchars($team['sport']); ?></p>
						</div>
						<div class="card-action right-align">
						</div>
					</div>
				</div>

			<?php endforeach; ?> -->


            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Equipo</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Deporte</th>
                    </tr>
                </thead>
                <tbody class="row-clickable">

                    <?php foreach($teams as $team): ?>
                        <tr class="">
                            <td><h6><?php echo htmlspecialchars($team['name']); ?></h6></td>
                            <td><?php echo htmlspecialchars($team['city']); ?></td>
                            <td><?php echo htmlspecialchars($team['sport']); ?></td>
                        </tr>    
                    <?php endforeach; ?>
                </tbody>
           </table>

		</div>
	</div>

</html>