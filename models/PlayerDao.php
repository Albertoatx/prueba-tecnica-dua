<?php

class PlayerDao {

    const PLAYER_TABLE = "player";

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function getPlayers() {

        $sql = 'SELECT id, name, number, team_id, created_at, edited_at FROM ' . self::PLAYER_TABLE  . ' ORDER BY created_at';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPlayersByTeam($teamId) {

        $sql = 'SELECT id, name, number, team_id, created_at, edited_at FROM ' . self::PLAYER_TABLE  . ' WHERE team_id = ? ORDER BY created_at';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teamId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}