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

}