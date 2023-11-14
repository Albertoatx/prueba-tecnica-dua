
<?php


// autoloads
include 'config/db_connect_pdo.php';
include 'models/Team.php';
include 'models/TeamDao.php';
include 'controllers/TeamCtrl.php';

include 'models/Player.php';
include 'models/PlayerDao.php';


$teamDao        = new TeamDao($pdo);
$playerDao      = new PlayerDao($pdo);
$teamController = new TeamController($teamDao, $playerDao);


// receives route "index.php?route=list-teams"
$route = isset($_GET['route']) ? $_GET['route'] : 'list-teams';

switch ($route) {
    // default
    case 'list-teams':
        $teamController->listTeams();
        break;

    case 'get-team':
        $teamId = isset($_GET['id']) ? $_GET['id'] : null;
        $teamController->detailTeam($teamId);
        break;

    case 'add-team':
        $teamController->addTeam();
        break;
    
    default:
        echo 'Route not Found';
}

