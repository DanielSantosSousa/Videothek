<?php

class loan
{
	public $id;
	public $name;
	public $email;
	public $phone;
	public $date;
	public $movie;
	public $membership;
    public $pdo;

    public function __construct($name = null, $email = null, $phone = null, $movie = null, $membership = null, $date = null)
    {
        $this->pdo = db();
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $phone;
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
        $statement = $this->pdo->prepare('INSERT INTO loans (name, email, telephone, date, fk_movieid, fk_membershipstastusid) VALUES (:name, :email, :phone, :fk_movieid, :fk_membershipid, :date)');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telephone', $this->phone);
        $statement->bindParam(':date', $this->date);
        $statement->bindParam(':fk_movieid', $this->movie);
        $statement->bindParam('fk_membershipid', $this->membership);
        $statement->execute();
    }
}
