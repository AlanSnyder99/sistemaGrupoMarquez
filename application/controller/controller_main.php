<?php

class Controller_Main extends Controller{
    function index(){
        $this->view->generateSt('login_view.php');
    }
}