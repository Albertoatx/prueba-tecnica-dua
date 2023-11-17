<?php

class TeamController {

    private $teamDao;
    private $playerDao;


    public function __construct(TeamDao $teamDao, PlayerDao $playerDao) {
        $this->teamDao      = $teamDao;
        $this->playerDao    = $playerDao;
    }


    private function mapDaoResultsTeams($daoRows){
        $teams = array();
        
        if ($daoRows != null && sizeof($daoRows) > 0) {
            foreach ($daoRows as $row) {     
                $playerCaptain = $this->playerDao->getTeamCaptain($row[Team::TEAM_ID]);

                $captain = $playerCaptain 
                    ? new Player(
                        $playerCaptain[Player::PLAYER_ID],
                        $playerCaptain[Player::PLAYER_NAME],
                        $playerCaptain[Player::PLAYER_NUMBER],
                        $playerCaptain[Player::PLAYER_TEAM_ID],
                        $playerCaptain[Player::PLAYER_CREATED_AT],
                        $playerCaptain[Player::PLAYER_EDITED_AT],
                        $playerCaptain[Player::PLAYER_IS_CAPTAIN]
                    ) : null;

                $teams[] = new Team(
                    $row[Team::TEAM_ID],
                    $row[Team::TEAM_NAME],
                    $row[Team::TEAM_CITY],
                    $row[Team::TEAM_SPORT],
                    $row[Team::TEAM_CREATED_AT],
                    $captain
                );
            }
        }

        return $teams;
    }


    public function mapDaoResultsPlayers($daoRows){
        $players = array();
        
        if ($daoRows != null && sizeof($daoRows) > 0) {
            foreach ($daoRows as $row) {                
                $players[] = new Player(
                    $row[Player::PLAYER_ID],
                    $row[Player::PLAYER_NAME],
                    $row[Player::PLAYER_NUMBER],
                    $row[Player::PLAYER_TEAM_ID],
                    $row[Player::PLAYER_CREATED_AT],
                    $row[Player::PLAYER_EDITED_AT],
                    $row[Player::PLAYER_IS_CAPTAIN]
                );
            }
        }

        return $players;
    }


    public function listTeams() {
        $teamsRows = $this->teamDao->getTeams();
    
        $teams = $this->mapDaoResultsTeams($teamsRows);

        include_once('templates/team/list.php');
    }


    public function detailTeam($teamId) {
        $row = $this->teamDao->getTeamById($teamId);
        $team = new Team(
            $row[Team::TEAM_ID],
            $row[Team::TEAM_NAME],
            $row[Team::TEAM_CITY],
            $row[Team::TEAM_SPORT],
            $row[Team::TEAM_CREATED_AT],
            NULL
        ); 
        
        $rowPlayers = $this->playerDao->getPlayersByTeam($teamId);
        $players = $this->mapDaoResultsPlayers($rowPlayers);
        include_once('templates/team/detail.php');
    }


    private function getEnumValuesAsArray($enumColumnData) {

        $enumCleaned = substr($enumColumnData[0]['Type'], 5); 
        $enumCleaned = substr($enumCleaned, 0, -1);

        return explode(',', $enumCleaned);
    }


    public function addTeam() {

        // error_log("Script 'addTeam' started");

        $teamName = $city = $sport = '';
        $errors = array('name' => '', 'city' => '', 'sport' => '', 'others' => '');

        $sportOptions = array();
        $sportColumnData = $this->teamDao->getColumnMetadata('sport');
        if ($sportColumnData) {
            $sportOptions = $this->getEnumValuesAsArray($sportColumnData);
        } 
        
        $isAjaxCall = false;

        // if(isset($_POST['submit'])){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // This code only executes when user clicks "submit" button
            
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $isAjaxCall = true;
            }

            // check name
            if(empty($_POST['tname'])){
                // $errors['name'] = 'Nombre del equipo requerido';
            } else{
                $teamName = htmlspecialchars($_POST['tname']);
                if(!preg_match('/^[a-zA-Z0-9áéíóúüÁÉÍÓÚÜñÑ\s]+$/', $teamName)){
                    $errors['name'] = 'El nombre del equipo debe contener solo letras, números y espacios.';
                }
            }
    
            // check city
            if(empty($_POST['city'])){
                // $errors['city'] = 'Ciudad requerida';
            } else{
                $city = htmlspecialchars($_POST['city']);
                if(!preg_match('/^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]+$/', $city)){
                    $errors['city'] = 'La ciudad debe contener solo letras y espacios.';
                }
            }
    
            // check sport
            if(empty($_POST['sport'])){
                $errors['sport'] = 'Deporte requido';
            } else{
                $sport = htmlspecialchars($_POST['sport']);
            }
    
            if ( empty($_POST['tname']) && empty($_POST['city']) ){
                $errors['others'] = 'Debes introducir datos en al menos uno de los dos campos de texto.';
            } 
    
            if ( !array_filter($errors) ){
                
                // Validate if team already exists
                $team = $this->teamDao->getTeamByUnique($teamName, $city, $sport);
                
                if ( !$team ){
                    // data not exists -> insert and redirect if insertion ok
                    if ($this->teamDao->addTeam($teamName, $city, $sport)){

                        if ($isAjaxCall){
                            header('Content-Type: application/json');                            
                            echo JsonUtils::prepareResponseDataAsJson('success', 'El equipo se ha creado correctamente', 'index.php');
                            exit();
                        } else {
                            header('Location: index.php');
                            exit();
                        }
                    }
                } else {
                    $errors['others'] = 'Ya existe un equipo con esos mismos datos.';
                }
            }
            
            if ($isAjaxCall){
                header('Content-Type: application/json');
                echo JsonUtils::prepareResponseDataAsJson('error', 'Error al intentar crear el equipo. ' . ($errors['others']) ? $errors['others'] : '', null);
                exit();
            }
    
        } // end POST check

        include_once 'templates/team/add.php';
    }

}