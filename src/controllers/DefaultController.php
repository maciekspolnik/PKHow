<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index()
    {
        $this->render('login');
    }
    public function videos()
    {
        $this->render('videos');
    }
}