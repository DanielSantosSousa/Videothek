<?php

class Movie
{
    public $id;
    public $title;
    public $pdo;

    public function __construct($title = null, $extraDays = null)
    {
        $this->pdo = db();
        $this->title = $title;
    }

    public function getById($id){
        $this->id = $id;
        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM `movies` WHERE id = :id');
        $statement->bindParam(':id', $this->id);
        $statement->execute();
        $result = $statement->fetch();
        $this->title = $result['title'];
    }

    public static function getAllOrderedByTitle(){
        global $pdo;
        if(!isset($pdo)){
            $pdo = db();
        }
        $statement = $pdo->prepare('SELECT * FROM movies ORDER BY title');
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}
