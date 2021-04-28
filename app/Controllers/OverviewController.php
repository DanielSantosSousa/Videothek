<?php

class OverviewController{
    public function view(){
        $now = new DateTime();
        $result = Loan::getNotReturnedOrderedByDate();
        require 'app/Views/overview.view.php';
    }
}