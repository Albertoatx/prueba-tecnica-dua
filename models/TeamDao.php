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


    public function addTeam($teamName, $city, $sport) {
        
        $sql = "INSERT INTO team(name, city, sport) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$teamName, $city, $sport]); // returns boolean
    }


    public function getTeamByUnique($teamName, $city, $sport) {
        
        $sql = 'SELECT name, city, sport FROM team WHERE name = ? && city = ? &&  sport = ? ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teamName, $city, $sport]);

        return $stmt->fetch(PDO::FETCH_ASSOC);      // returns one team if exists
    }


    public function getColumnMetadata($fieldName) {
        
        $sql = 'SHOW COLUMNS FROM team WHERE field = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$fieldName]);
        
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);  // returns the column metadata
    }

}