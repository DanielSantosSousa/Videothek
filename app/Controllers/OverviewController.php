<?php

class OverviewController{
    public function view(){
        $result = Loan::getAllOrderedByDate();
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
            $loan += ['expectedReturn' => date_add(date_create($loan['date']), date_interval_create_from_date_string($membership->extraDays + 30 . ' days'))];
            $editedResult[] = $loan;
        }
        require 'app/Views/overview.view.php';
    }
}