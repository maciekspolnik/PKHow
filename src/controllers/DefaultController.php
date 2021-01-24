<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/VideoRepository.php';

class DefaultController extends AppController {


    public function index()
    {
        $this->render('login');
    }
    public function videos()
    {
        if ($this->cookieCheck() != 0) {
            $videoRepository = new VideoRepository();
            $this->render('videos',['videos'=>$videoRepository->getVideos()]);
        }
        else
            {
                return $this->render('login');
            }
    }

}