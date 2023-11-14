<?php

class TeamController {

    private $teamDao;


    public function __construct(TeamDao $teamDao) {
        $this->teamDao = $teamDao;
    }


    private function mapDaoResults($daoRows){
        $teams = array();
        
        if ($daoRows != null && sizeof($daoRows) > 0) {
            foreach ($daoRows as $row) {                
                $teams[] = new Team(
                    $row[Team::TEAM_ID],
                    $row[Team::TEAM_NAME],
                    $row[Team::TEAM_CITY],
                    $row[Team::TEAM_SPORT],
                    $row[Team::TEAM_CREATED_AT]
                );
            }
        }

        return $teams;
    }


    public function listTeams() {
        $teamsRows = $this->teamDao->getTeams();
    
        $teams = $this->mapDaoResults($teamsRows);

        include_once('templates/team/list.php');
    }


    public function detailTeam($teamId) {
        $row = $this->teamDao->getTeamById($teamId);
        $team = new Team(
            $row[Team::TEAM_ID],
            $row[Team::TEAM_NAME],
            $row[Team::TEAM_CITY],
            $row[Team::TEAM_SPORT],
            $row[Team::TEAM_CREATED_AT]
        );    
        include_once('templates/team/detail.php');
    }


    private function getEnumValuesAsArray($enumColumnData) {

        $enumCleaned = substr($enumColumnData[0]['Type'], 5); 
        $enumCleaned = substr($enumCleaned, 0, -1);

        return explode(',', $enumCleaned);
    }


    public function addTeam() {

        $teamName = $city = $sport = '';
        $errors = array('name' => '', 'city' => '', 'sport' => '', 'others' => '');

        $sportOptions = array();
        $sportColumnData = $this->teamDao->getColumnMetadata('sport');
        if ($sportColumnData) {
            $sportOptions = $this->getEnumValuesAsArray($sportColumnData);
        } 

        if(isset($_POST['submit'])){
            // This code only executes when user clicks "submit" button 
		
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
                        header('Location: index.php');
                    }
                } else {
                    $errors['others'] = 'Ya existe un equipo con esos mismos datos.';
                }
            
            }
    
        } // end POST check

        include_once 'templates/team/add.php';
    }

}