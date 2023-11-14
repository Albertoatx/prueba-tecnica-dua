
<?php


// autoloads
include 'config/db_connect_pdo.php';
include 'models/Team.php';
include 'models/TeamDao.php';
include 'controllers/TeamCtrl.php';


$teamDao        = new TeamDao($pdo);
$teamController = new TeamController($teamDao);


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
    
    default:
        echo 'Route not Found';
}

