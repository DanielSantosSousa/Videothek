<?php

class OverviewController{
    public function view(){
        $now = new DateTime();
        $result = Loan::getNotReturnedOrderedByDate();
        require 'app/Views/overview.view.php';
    }

    public function edit(){
        $id = $_GET['id'];
        $loan = new Loan();
        $loan->getById($id);
        $returned = $loan->returned;
        $name = $loan->name;
        $email = $loan->email;
        $phone = $loan->phone;
        $membership = $loan->membership;
        $video = $loan->movie;
        $movies = Movie::getAllOrderedByTitle();
        require 'app/Views/edit.view.php';
    }

    public function validate() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name         = $_POST['name']     ?? '';
            $email        = $_POST['email']    ?? '';
            $telephone        = $_POST['telephone']    ?? '';
            $movie        = $_POST['movie']    ?? '';
            $returned     = $_POST['returned']    ?? '';
            $id           = $_POST['id']    ?? '';

            $name         = trim($name);
            $email        = trim($email);
            $telephone        = trim($telephone);
            $movie        = trim($movie);
            $returned     = trim($returned);
            $id           = trim($id);

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

            if($movie === ''){
                $errors[] = 'Bitte wählen Sie ein Video aus';
            }

            if(!($returned == '0' || $returned == '1')){
                $errors[] = 'Bitte auswählen ob video zurückgebracht wurde';
            }

            if(count($errors) !== 0){
                $movies = Movie::getAllOrderedByTitle();
                $membership   = $_POST['membership'] ?? '';
                require 'app/Views/edit.view.php';
            } elseif(count($errors) === 0) {
                $loan = new Loan($name, $email, $telephone, $movie, '' , '', $returned);
                $loan->update($id);
                header('Location: /m307_2/01_videothek/uebersicht');
            }

        } else {
            require 'app/Views/overview.view.php';
        }

    }
}