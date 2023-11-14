<?php

class PlayerController {

    private $playerDao;


    public function __construct(PlayerDao $playerDao) {
        $this->playerDao    = $playerDao;
    }


    public function deletePlayer($playerId, $teamId) {

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['teamid'])) {

            // Delete
            if ($this->playerDao->deletePlayer($playerId)) {
                header('Location: index.php?route=get-team&id=' . $teamId);   // Redirect to team info page
            }

        }           
    }


    public function addPlayer($teamId) {

        // Server-side validation
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $pName   = '';
            $pNumber = null;
            $errors  = array('name' => '', 'number' => '', 'teamId' => '', 'others' => '');

            // check name
            if(empty($_POST['name'])){
                $errors['name'] = 'Nombre del jugador requerido';
            } else{
                $pName = htmlspecialchars($_POST['name']);
                if(!preg_match('/^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]+$/', $pName)){
                    $errors['name'] = 'El nombre del jugador debe contener solo letras y espacios.';
                } else if (strlen($pName) > GeneralConfig::MAX_VARCHAR){
                    $errors['name'] = 'Se ha superado la máxima longitud permitida para el nombre.';
                }
            }
    
            // check number
            if(empty($_POST['number'])){
                $errors['number'] = 'Número del jugador requerido';
            } else{
                $pNumber = htmlspecialchars($_POST['number']);
                if(!preg_match('/^[0-9\s]+$/', $pNumber)){
                    $errors['number'] = 'Este campo sólo puede contener números.';
                } else if ($pNumber > GeneralConfig::MAX_INT_VALUE){
                    $errors['number'] = 'Se ha superado el número máximo admitido.';
                }
            }
    
            // check team id
            if(empty($teamId)){
                $errors['others'] = 'No se ejecuta el proceso por desconocerse el equipo';
            } else{
                if(!preg_match('/^[0-9\s]+$/', $teamId)){
                    $errors['others'] = 'Tipo de dato invalido para el equipo.';
                } else if ($teamId > GeneralConfig::MAX_INT_VALUE){
                    $errors['others'] = 'Valor inválido para un equipo.';
                }
            }
            
            if ( !array_filter($errors) ){
                
                // Validate if player already exists
                $player = $this->playerDao->getPlayerByUnique($pName, $pNumber, $teamId);
                
                if ( !$player ){
                    // data not exists -> Insert the player and redirect to team info page f insertion ok
                    if ($this->playerDao->addPlayer($pName, $pNumber, $teamId)) {
                        header('Location: index.php?route=get-team&id=' . $teamId);
                    }
                } else {
                    $errors['others'] = 'Ya existe un jugador con estos mismos datos.';
                }
            }

        }
        
        include_once('templates/player/add.php');
    }

}