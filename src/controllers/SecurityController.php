<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/VideoRepository.php';


class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if($this->getCurrentUserID()==0) {
            $userRepository = new UserRepository();

            if (!$this->isPost())
            {
                return $this->render('login');
            }

            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $user = $userRepository->getUser($email);
            $videoRepository = new VideoRepository();

            if (!$user)
            {
                return $this->render('login', ['messages' => ['User not found!']]);
            }

            if ($user->getEmail() !== $email)
            {
                return $this->render('login', ['messages' => ['User with this email not exist!']]);
            }

            if ($user->getPassword() == $password)
            {
                $this->setCookie($user->getId(), uniqid());
                return $this->render('videos', ['videos'=>$videoRepository->getVideos()]);
            }
            else return $this->render('login', ['messages' => ['Wrong password!']]);
        }
    }

    public function register()
    {
        if (!$this->isPost())
        {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];

        if ($password !== $confirmedPassword)
        {
            return $this->render('register', ['messages' => ['Podane hasła nie są zgodne']]);
        }
        if (strlen($password) < 8)
        {
            return $this->render('register', ['messages' => ['Podane hasło jest za krótkie']]);
        }

        $this->userRepository->newUser($email, md5($password), $name, $surname, $phone);

        return $this->render('login', ['messages' => ['Rejestracja przebiegła pomyślnie']]);
    }

    public function logout()
    {
        $currentID=$this->getCurrentUserID();
        if($currentID==0)
        {
            return $this->render('login', ['messages' => ["Sesja wygasła"]]);
        }
        return $this->render('login', ['messages' => [$this->unsetCookie($_COOKIE['user_token'])]]);
    }
}