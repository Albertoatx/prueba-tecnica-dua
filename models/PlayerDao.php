<?php

class PlayerDao {

    const PLAYER_TABLE = "player";

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function getPlayers() {

        $sql = 'SELECT id, name, number, team_id, created_at, edited_at, is_captain FROM ' . self::PLAYER_TABLE  . ' ORDER BY name';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPlayersByTeam($teamId) {

        $sql = 'SELECT id, name, number, team_id, created_at, edited_at, is_captain FROM ' . self::PLAYER_TABLE  . ' WHERE team_id = ? ORDER BY name';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teamId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPlayerById($playerId) {

        $sql = 'SELECT id, name, number, team_id, created_at, edited_at, is_captain FROM ' . self::PLAYER_TABLE  . ' WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$playerId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function deletePlayer($playerId) {

        $sql = 'DELETE FROM ' . self::PLAYER_TABLE  . ' WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([$playerId]);  // returns a boolean
    }


    public function addPlayer($name, $number, $teamId, $isCaptain) {

        $sql = 'INSERT INTO ' . self::PLAYER_TABLE . ' (name, number, team_id, created_at, is_captain)  VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$name, $number, $teamId, gmdate("Y-m-d H:i:s", time()), $isCaptain]);
    }


    public function getPlayerByUnique($name, $number, $teamId, $isCaptain) {
        
        $sql = 'SELECT name, number, team_id FROM ' . self::PLAYER_TABLE . ' WHERE name = ? && number = ? && team_id = ? && is_captain = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $number, $teamId, $isCaptain]);

        return $stmt->fetch(PDO::FETCH_ASSOC);      // returns one player if exists
    }


    public function updatePlayer($name, $number, $playerId, $isCaptain) {

        $sql = 'UPDATE ' . self::PLAYER_TABLE . ' SET name = ?, number = ?, is_captain = ?  WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$name, $number, $isCaptain, $playerId]);  // returns a boolean
    }


    public function getTeamCaptain($teamId) {

        $sql = 'SELECT id, name, number, team_id, created_at, edited_at, is_captain FROM ' . self::PLAYER_TABLE . ' WHERE team_id = ? AND is_captain = 1 ';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teamId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}