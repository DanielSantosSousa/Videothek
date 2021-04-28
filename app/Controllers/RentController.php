<?php

class RentController {

    public function rent() {
        $videos = Movie::getAllOrderedByTitle();
        $memberships = MembershipStatus::getAll();
        require 'app/Views/rent.view.php';
    }

    public function validate() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name         = $_POST['name']     ?? '';
            $email        = $_POST['email']    ?? '';
            $phone        = $_POST['phone']    ?? '';
            $membership   = $_POST['membership']    ?? '';
            $video        = $_POST['video']    ?? '';
            $date         = date("Y.m.d");

            $name         = trim($name);
            $email        = trim($email);
            $phone        = trim($phone);
            $membership   = trim($membership);
            $video        = trim($video);

            $errors = [];

            if($name === ''){
                $errors[] = 'Bitte geben Sie einen Namen an';
            }

            if($email === ''){
                $errors[] = 'Bitte geben Sie eine Email an.';
            } elseif (preg_match("/[^@]+@[^.]+\..+$/i", $email) == false) {
                $errors[] = 'Bitte geben Sie eine gültige Email-Adress ein';
            }

            if ($phone !== '') {
                if(! preg_match('/^[\+ 0-9]+$/', $phone)){
                    $errors[] = 'Bitte geben Sie eine gültige Telefonnummer ein';
                }
            }

            if($membership === ''){
                $errors[] = 'Bitte wählen Sie einen Mitgliedschaftsstatus aus';
            }

            if($video === ''){
                $errors[] = 'Bitte wählen Sie ein Video aus';
            }

            if(count($errors) !== 0){
                require 'app/Views/rent.view.php';
            } elseif(count($errors) === 0) {
                $loan = new Loan($name, $email, $phone, $membership, $video, $date);
                $loan->create();
                header('Location: /');
            }


        } else{
            require 'app/Views/rent.view.php';
        }


    }

    public function new() {

        $name = $_GET['name'];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $membership = $_GET['membership'];
        //$video = $_GET['video'];

        $loan = new Loan($name, $email, $phone, $membership, $date);
        $loan->create();
        header('Location: /');

    }

}
