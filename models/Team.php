<?php

class Team {

    const TEAM_ID       = "id";
    const TEAM_NAME     = "name";
    const TEAM_CITY     = "city";
    const TEAM_SPORT    = "sport";
    const TEAM_CREATED_AT = "created_at";

    
    private $id;
    private $name;
    private $city;
    private $sport;
    private $created_at;
    private $captain;


    public function __construct($id, $name, $city, $sport, $created_at, $captain) {
        $this->id         = $id;
        $this->name       = $name;
        $this->city       = $city;
        $this->sport      = $sport;
        $this->created_at = $created_at;
        $this->created_at = $created_at;
        $this->captain    = $captain;
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

    public function getCity()
    {
        return $this->city;
    }
    
    public function getSport()
    {
        return $this->sport;
    }
    
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    public function getCaptain()
    {
        return $this->captain;
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

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setSport($sport)
    {
        $this->sport = $sport;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setCaptain($captain)
    {
        $this->captain = $captain;
    }

}