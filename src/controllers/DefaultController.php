<?php
require_once 'AppController.php';
class DefaultController extends AppController{
    public function index(){
        $this->render('login');
       
        //display login.html
    }
    public function videos(){
        $this->render('videos');
        //display videos.html
    }
}