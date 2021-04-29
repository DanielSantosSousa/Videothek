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
	public $returned;
    public $pdo;

    public function __construct($name = null, $email = null, $telephone = null, $movie = null, $membership = null, $date = null, $returned = false)
    {
        $this->pdo = db();
        $this->name = $name;
        $this->email = $email;
        $this->date = $date;
        $this->telephone = $telephone;
        $this->movie = $movie;
        $this->membership = $membership;
        $this->returned = $returned;
    }

    public static function getNotReturnedOrderedByDate(){
        global $pdo;
        if(!isset($pdo)){
            $pdo = db();
        }
        $statement = $pdo->prepare('SELECT * FROM loans WHERE returned = 0 ORDER BY date ');
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

    public static function calcReturnDate($date, MembershipStatus $membership) {
        return date_add(date_create($date), date_interval_create_from_date_string($membership->extraDays + 30 . ' days'));
    }

    public function getById($id) {
        global $pdo;
        if(!isset($pdo)){
            $pdo = db();
        }
        $this->id = $id;
        $statement = $pdo->prepare('SELECT * FROM `loans` WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch();

        $this->returned = $result['returned'];
        $this->name = $result['name'];
        $this->email = $result['email'];
        $this->phone = $result['telephone'];
        $membershipstatus = new MembershipStatus();
        $membershipstatus->getById($result['fk_membershipstatusid']);
        $this->membership = $membershipstatus->title;
        $movieObject = new Movie();
        $movieObject->getById($result['fk_movieid']);
        $this->movie = $movieObject->title;
    }

    public function create() {
        $statement = $this->pdo->prepare('INSERT INTO loans (name, email, telephone, fk_movieid, fk_membershipstatusid, date) VALUES (:name, :email, :telephone, :movie, :membership, :date)');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telephone', $this->telephone);
        $statement->bindParam(':movie', $this->movie);
        $statement->bindParam(':membership', $this->membership);
        $statement->bindParam(':date', $this->date);
        $statement->execute();
    }

    public function update($id) {
        $statement = $this->pdo->prepare('UPDATE loans SET `name` = :name, `email` = :email, `telephone` = :telephone, `fk_movieid` = :movie, `returned` = :returned WHERE `id` = :id');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telephone', $this->telephone);
        $statement->bindParam(':movie', $this->movie);
        $statement->bindParam(':returned', $this->returned);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public static function updateStatusToReturned($id) {
        global $pdo;
        if(!isset($pdo)){
            $pdo = db();
        }
        $statement = $pdo->prepare('UPDATE loans SET `returned` = 1 WHERE `id` = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
}
