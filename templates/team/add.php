
<?php include('templates/header.php'); ?>


<section class="container grey-text">
    <h4 class="center">Añade un equipo</h4>
    

    <!-- <form class="white" action="add_team.php" method="POST"> -->
    <!-- <form class="white" action="index.php?route=add-team" method="POST"> -->
    <form class="white" action="index.php?route=add-team" method="POST" id="addTeamForm">
        <label>Equipo</label>
        <input type="text" name="tname" value="<?php echo htmlspecialchars($teamName) ?>" id="tname">
        <div class="red-text"><?php echo $errors['name']; ?></div>

        <label>Ciudad</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>" id="city">
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
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0" id="btn-submit">
        </div>

        <div class="red-text"><?php echo $errors['others']; ?></div>
    </form>
</section>


<script>
    $(document).ready(function(){
        $('#addTeamForm').submit(function(e){

            e.preventDefault(); // Prevents the form from being submitted

            let button = $("#btn-submit");
            button.prop('disabled', true); 

            let teamName = $('#tname').val();
            let city     = $('#city').val();

            let validationError = false;
            let validTeamName   = /^[a-zA-Z0-9áéíóúüÁÉÍÓÚÜñÑ\s]+$/;
            let validCity       = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]+$/;

            if (teamName === '' && city === '') {
                validationError = true;
                alert('Debes introducir datos en al menos uno de los dos campos de texto.');
            } else {
                if (teamName !== '' && !validTeamName.test(teamName)) {
                    validationError = true;
                    alert('El nombre del equipo debe contener solo letras, números y espacios.');
                }

                if (city !== '' && !validCity.test(city)) {
                    validationError = true;
                    alert('La ciudad debe contener solo letras y espacios.');
                }
            }

            if (validationError){
                button.attr("disabled", false);
                return;
            }

            $.ajax({
                type: 'POST',
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response){
                    if (response.status === "success") {
                        alert(response.message);
                        window.location = response.redirect;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error){
                    console.error('Error: ', error);
                },
                complete: function() {
                    button.attr("disabled", false);
                }
            });

        });
    });
</script>


<?php include('templates/footer.php'); ?>