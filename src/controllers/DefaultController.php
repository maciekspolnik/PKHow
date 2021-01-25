<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/VideoRepository.php';
require_once __DIR__.'/../repository/FaqRepository.php';

class DefaultController extends AppController {


    public function index()
    {
        if ($this->cookieCheck() != 0) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/videos");
        }
        else {
            $this->render('login');
        }
    }
    public function videos()
    {
        if ($this->cookieCheck() != 0) {
            $videoRepository = new VideoRepository();
            $this->render('videos',['videos'=>$videoRepository->getVideos()]);
        }
        else
            {
                $this->render('login');
            }
    }


}