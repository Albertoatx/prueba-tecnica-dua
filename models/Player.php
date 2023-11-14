<?php

class Player {

    
    const PLAYER_ID       = "id";
    const PLAYER_NAME     = "name";
    const PLAYER_NUMBER   = "number";
    const PLAYER_TEAM_ID  = "team_id";
    const PLAYER_CREATED_AT = "created_at";
    const PLAYER_EDITED_AT = "edited_at";

    
    private $id;
    private $name;
    private $number;
    private $teamId;
    private $createdAt;
    private $editedAt;


    public function __construct($id, $name, $number, $teamId, $createdAt, $editedAt) {
        $this->id         = $id;
        $this->name       = $name;
        $this->number     = $number;
        $this->teamId     = $teamId;
        $this->createdAt  = $createdAt;
        $this->editedAt   = $editedAt;
    }


    // GETTERS
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getNumber()
    {
        return $this->number;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
        
    public function getEditedAt()
    {
        return $this->editedAt;
    }


    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setEditedAt($editedAt)
    {
        $this->editedAt = $editedAt;
    }

}