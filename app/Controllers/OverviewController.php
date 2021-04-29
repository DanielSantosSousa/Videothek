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
        $telephone = $loan->telephone ?? '';
        $membership = $loan->membership;
        $movie = $loan->movie;
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

            $returned     = trim($returned);
            $id           = trim($id);

            $errors = validateInput($name, $email, $telephone, $movie);

            if(!($returned == '0' || $returned == '1')){
                $errors[] = 'Bitte auswählen ob video zurückgebracht wurde';
            }

            if(count($errors) !== 0){
                $movies = Movie::getAllOrderedByTitle();
                $membership   = $_POST['membership'] ?? '';
                require 'app/Views/edit.view.php';
            } elseif(count($errors) === 0) {
                try {
                    $loan = new Loan($name, $email, $telephone, $movie, '', '', $returned);
                    $loan->update($id);
                }  catch (PDOException $e){
                    $errors[] = "Fehler beim speichern in die Datenbank, versuchen sie es erneut";
                    $movies = Movie::getAllOrderedByTitle();
                    $membership = $_POST['membership'] ?? '';
                    require 'app/Views/edit.view.php';
                }
                header('Location: /m307_2/01_videothek/uebersicht');
            }
        } else {
            require 'app/Views/overview.view.php';
        }
    }

    public function statuschange(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loans         = $_POST['loans'] ?? '  ';
            $errors = [];
            if( $loans === '  '){
                $errors[] = "Bitte ausgeliehene Videos vor Status Änderung auswählen";
                $now = new DateTime();
                $result = Loan::getNotReturnedOrderedByDate();
                require('app/Views/overview.view.php');
            } else {
                foreach ($loans as $loan) {
                    Loan::updateStatusToReturned($loan);
                }
                header('Location: /m307_2/01_videothek/uebersicht');
            }
        } else {
            header('Location: /m307_2/01_videothek/uebersicht');
        }
    }
}