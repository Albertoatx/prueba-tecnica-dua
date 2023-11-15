
<?php include('templates/header.php'); ?>


<section>
    <h4 class="center">Editar un jugador</h4>

    <form class="white" action="index.php?route=update-player&id=<?php echo $player->getId(); ?>" method="POST">

        <label for="name">Jugador</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($player->getName()) ?>">
        <div class="red-text"><?php echo $errors['name']; ?></div>

        <label for="number">Número del jugador</label>
        <input type="number" name="number" min="0" max="999999" value="<?php echo htmlspecialchars($player->getNumber()) ?>">
        <div class="red-text"><?php echo $errors['number']; ?></div>

        <label>
            <input type="checkbox" name="isCaptain" id="isCaptain" <?php if($player->getIsCaptain()) : ?> checked <?php endif ?>  />
            <span>Es cápitan</span>
        </label>
        <div class="red-text"><?php echo $errors['captain']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="Editar jugador" class="btn brand z-depth-0">
        </div>

        <div class="red-text"><?php echo $errors['others']; ?></div>
    </form>
</section>