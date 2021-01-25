<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/PanelRepository.php';
require_once __DIR__.'/../repository/FaqRepository.php';
require_once __DIR__.'/../repository/VideoRepository.php';

class DefaultController extends AppController {

    public function index()
    {
        if ($this->cookieCheck() != 0) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/videos");
        }
        else {
            return $this->render('login');
        }
    }

    public function videos()
    {
        if ($this->cookieCheck() != 0)
        {
            $videoRepository = new VideoRepository();
            return $this->render('videos',['videos'=>$videoRepository->getVideos()]);
        } else return  $this->render('login');
    }

    public function faq()
    {
        if ($this->cookieCheck() != 0)
        {
            $faqRepository = new FaqRepository();
            return $this->render('faq',['allFaq'=>$faqRepository->getAllFAQ()]);
        } else return $this->render('login');
    }


    public function panel()
    {
        if ($this->cookieCheck() != 0) {
            $panelRepository = new PanelRepository();
            return $this->render('panel', ['panels' => $panelRepository->getAllPanels()]);
        } else return  $this->render('login');
    }

}