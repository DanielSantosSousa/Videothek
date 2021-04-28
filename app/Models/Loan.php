<?php

class loan
{
	public $id;
	public $name;
	public $email;
	public $telephone;
	public $date;
	public $fk_movieId;
	public $fk_membershipStatusId;
    public $pdo;

    public function __construct($name = null, $email = null, $telephone = null, $date = null, $fk_movieId = null, $fk_membershipStatusId = null)
    {
        $this->pdo = db();
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->date = $date;
        $this->fk_movieId = $fk_movieId;
        $this->fk_membershipStatusId = $fk_membershipStatusId;
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
}
