<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User('maciekspolnik@gmail.com','12345','Halyna','Nowak');

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        if ($user->getEmail() !== $email){
            return $this->render('login',['messages'=>['User not found']]);
        }
        if($user->getPassword() !== $password){
            return $this->render('login',['messages'=>['Password incorrect']]);
        }
//        return $this->render('videos');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/videos");
    }
}