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

        $editedResult = [];
        foreach ($result as $loan){
            $movieArrayLocation = 'fk_movieid';
            $membershipArrayLocation = 'fk_membershipstatusid';
            $movie = new Movie();
            $movie->getById($loan[$movieArrayLocation]);
            $membership = new MembershipStatus();
            $membership->getById($loan[$membershipArrayLocation]);
            $loan[$movieArrayLocation] = $movie->title;
            $loan[$membershipArrayLocation] = $membership->title;
            $loan += ['expectedReturn' => self::calcReturnDate($loan['date'], $membership)];
            $editedResult[] = $loan;
        }
        return $editedResult;
    }

    public static function calcReturnDate($date, MembershipStatus $membership)
    {
        return date_add(date_create($date), date_interval_create_from_date_string($membership->extraDays + 30 . ' days'));
    }

    public function membershipTitleToId($membership) {
        if($membership->title === 'keine'){
            $membership->id = 1;
        }
        elseif($membership->title === 'Bronze'){
            $membership->id = 2;
        }
        elseif($membership->title === 'Silber'){
            $membership->id = 3;
        }
        elseif($membership->title === 'Gold'){
            $membership->id = 4;
        }
        return $membership->id;        
    }

    public function create() {
        $statement = $this->pdo->prepare('INSERT INTO loans (name, email, telephone, date, fk_membershipstastusid) VALUES (:name, :email, :phone, :fk_membershipid, :date)');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telephone', $this->phone);
        $statement->bindParam(':date', $this->date);
        //$statement->bindParam(':fk_movieid', $this->movie;
        $statement->bindParam('fk_membershipid', $this->membership::membershipTitleToId($membership));
        $statement->execute();
    }
}
