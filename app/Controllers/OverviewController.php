<?php

class OverviewController{
    public function view(){
        $result = Loan::getAllOrderedByDate();
        require 'app/Views/overview.view.php';
    }
}