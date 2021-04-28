<?php

class MembershipStatus
{
    public $id;
    public $title;
    public $extraDays;
    public $pdo;

    public function __construct($title = null, $extraDays = null)
    {
        $this->pdo = db();
        $this->title = $title;
        $this->extraDays = $extraDays;
    }

    public function getById($id){
        $this->id = $id;
        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM `membership-status` WHERE id = :id');
        $statement->bindParam(':id', $this->id);
        $statement->execute();
        $result = $statement->fetch();
        $this->title = $result['title'];
        $this->extraDays = $result['extra_days'];
    }
}
