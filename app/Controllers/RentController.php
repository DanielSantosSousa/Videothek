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

            $name         = $_POST['name']     ?? '';
            $email        = $_POST['email']    ?? '';
            $telephone    = $_POST['telephone']    ?? '';
            $membership   = $_POST['membership']    ?? '';
            $movie        = $_POST['movie']    ?? '';
            $date         = date("Y.m.d");

            $name         = trim($name);
            $email        = trim($email);
            $telephone    = trim($telephone);
            $membership   = trim($membership);
            $movie        = trim($movie);
            $date         = trim($date);

            $errors = [];

            if($name === ''){
                $errors[] = 'Bitte geben Sie einen Namen an';
            }

            if($email === ''){
                $errors[] = 'Bitte geben Sie eine Email an.';
            } elseif (preg_match("/[^@]+@[^.]+\..+$/i", $email) == false) {
                $errors[] = 'Bitte geben Sie eine gültige Email-Adress ein';
            }

            if ($telephone !== '') {
                if(! preg_match("/^[0-9\-\(\)\/\+\s]+$/", $telephone)){
                    $errors[] = 'Bitte geben Sie eine gültige Telefonnummer ein';
                }
            }


           if($membership === ''){
                $errors[] = 'Bitte wählen Sie einen Mitgliedschaftsstatus aus';
            }

            if($movie === ''){
                $errors[] = 'Bitte wählen Sie ein Video aus';
            }

            if(count($errors) !== 0){
                require 'app/Views/rent.view.php';
            } elseif(count($errors) === 0) {
                $loan = new Loan($name, $email, $telephone, $movie, $membership, $date);
                $loan->create();
            }


        } else{
            require 'app/Views/rent.view.php';
        }


    }

}
