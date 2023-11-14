
<?php include('templates/header.php'); ?>


<section class="container grey-text">
    <h4 class="center">Añade un equipo</h4>
    

    <!-- <form class="white" action="add_team.php" method="POST"> -->
    <form class="white" action="index.php?route=add-team" method="POST">
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