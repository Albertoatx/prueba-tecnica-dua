<?php

class TeamDao {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getTeams() {

        $sql = 'SELECT id, name, city, sport, created_at FROM team ORDER BY created_at';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTeamById($teamId) {

        $sql = 'SELECT id, name, city, sport, created_at FROM team WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([htmlspecialchars($teamId)]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}