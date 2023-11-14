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

}