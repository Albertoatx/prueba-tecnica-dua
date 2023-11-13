<?php

	include('config/db_connect_pdo.php');

	$teamName = $city = $sport = '';
	$errors = array('name' => '', 'city' => '', 'sport' => '', 'others' => '');

    // get sport enum vallues
    $sqlColumnSportData = 'SHOW COLUMNS FROM team WHERE field = "Sport"';
    $stmt = $pdo->prepare($sqlColumnSportData);
    $stmt->execute();
    $sportColumnData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sportOptions = array();
    if ($sportColumnData) {
        $sportCleaned = substr($sportColumnData[0]['Type'], 5);
        $sportCleaned = substr($sportCleaned, 0, -1);

        $sportOptions = explode(',', $sportCleaned);
    } 

	if(isset($_POST['submit'])){
		
		// check name
		if(empty($_POST['tname'])){
			$errors['name'] = 'Nombre del equipo requerido';
		} else{
			$teamName = htmlspecialchars($_POST['tname']);
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $teamName)){
				$errors['name'] = 'El nombre del equipo debe contener solo letras, números y espacios.';
			}
		}

		// check city
		if(empty($_POST['city'])){
			$errors['city'] = 'Ciudad requerida';
		} else{
			$city = htmlspecialchars($_POST['city']);
			if(!preg_match('/^[a-zA-Z\s]+$/', $city)){
				$errors['city'] = 'La ciudad debe contener solo letras y espacios.';
			}
		}

		// check sport
		if(empty($_POST['sport'])){
			$errors['sport'] = 'Deporte requido';
		} else{
			$sport = htmlspecialchars($_POST['sport']);
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $sport)){
				$errors['sport'] = 'El deporte debe contener solo letras, números y espacios.';
			}
		}

        if ( empty($_POST['tname']) || empty($_POST['city']) || empty($_POST['sport']) ){
            // TODO
        } 

		if ( !array_filter($errors) ){
            
            // Validate if data already exists
            $sqlExists = 'SELECT name, city, sport FROM team WHERE name = ? && city = ? &&  sport = ? ';
            $stmt = $pdo->prepare($sqlExists);
            $stmt->execute([$teamName, $city, $sport]);
            $team = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ( !$team ){
                // data not exists -> insert
                $sql = "INSERT INTO team(name, city, sport) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                
                if ( $stmt->execute([$teamName, $city, $sport]) ){
                    // inserted ok -> redirect
                    header('Location: index.php');
                }
            } else {
                $errors['others'] = 'Ya existe un equipo con esos mismos datos. Introduzca otros.';
            }
        
		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Añade un equipo</h4>

		<form class="white" action="add_team.php" method="POST">
			<label>Equipo</label>
			<input type="text" name="tname" value="<?php echo htmlspecialchars($teamName) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>

			<label>Ciudad</label>
			<input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>">
			<div class="red-text"><?php echo $errors['city']; ?></div>

			<label>Deporte</label>
            <?php if($sportOptions): ?>
                <select name="sport" id="sport">
                    <?php foreach($sportOptions as $option): ?>
                        <option value="<?php echo str_replace("'", "", $option); ?>" > 
                            <?php echo str_replace("'", "", $option); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <div class="red-text"><?php echo $errors['sport']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>

            <div class="red-text"><?php echo $errors['others']; ?></div>
		</form>
	</section>

</html>