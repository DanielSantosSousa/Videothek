<?php

class RentController {

    public function rent() {
        $movies = Movie::getAllOrderedByTitle();
        $memberships = MembershipStatus::getAll();
        require 'app/Views/rent.view.php';
    }

    public function validate() {
        
        $movies = Movie::getAllOrderedByTitle();
        $memberships = MembershipStatus::getAll();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $date                 = date("Y.m.d");
            $selectedMembership   = $_POST['membership']    ?? '';

            $selectedMovie        = $_POST['movie']    ?? '';
            $date         = date("Y.m.d");
            $name                 = $_POST['name']     ?? '';
            $email                = $_POST['email']    ?? '';
            $telephone            = $_POST['telephone']    ?? '';
            $errors               = validateInput($name,$email,$telephone,$movie);

            $selectedMembership = trim($selectedMembership);

            if($selectedMembership === ''){
                $errors[] = 'Bitte wählen Sie einen Mitgliedschaftsstatus aus';
            }

            if(count($errors) !== 0){
                require 'app/Views/rent.view.php';
            } elseif(count($errors) === 0) {
                try {
                    $loan = new Loan($name, $email, $telephone, $selectedMovie, $selectedMembership, $date);
                    $loan->create();
                } catch (PDOException $e){
                    $errors[] = "Fehler beim speichern in die Datenbank, versuchen sie es erneut";
                    $movies = Movie::getAllOrderedByTitle();
                    $membership = $_POST['membership'] ?? '';
                    require 'app/Views/edit.view.php';
                }
            }
        } else{
            require 'app/Views/rent.view.php';
        }


    }

}
