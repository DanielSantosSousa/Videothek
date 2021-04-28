<?php

class loan
{
	public $id;
	public $name;
	public $email;
	public $telephone;
	public $date;
	public $movie;
	public $membership;
    public $pdo;

    public function __construct($name = null, $email = null, $telephone = null, $date = null, $movie = null, $membership = null)
    {
        $this->pdo = db();
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->date = $date;
        $this->movie = $movie;
        $this->membership = $membership;
    }

    public static function getAllOrderedByDate(){
        global $pdo;
        if(!isset($pdo)){
            $pdo = db();
        }
        $statement = $pdo->prepare('SELECT * FROM loans ORDER BY date');
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function create() {
        $statement = $this->pdo->prepare('INSERT INTO loans (name, email, telephone, date, movie, membership) VALUES (:name, :email, :date, :movie, :membership)');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telephone', $this->telephone);
        $statement->bindParam(':date', $this->date);
        $statement->bindParam(':movie', $this->movie);
        $statement->bindParam(':membership', $this->membership);
        $statement->execute();
    }
}
