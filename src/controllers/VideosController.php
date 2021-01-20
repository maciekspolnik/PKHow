<?php

require_once 'AppController.php';

require_once __DIR__.'/../models/Video.php';
require_once __DIR__.'/../repository/VideoRepository.php';


class VideosController extends AppController
{
    const MAX_SIZE = 1024*1024;
    const TYPES_ALLOWED = ['image/png','image/jpeg'];
    const UPLOAD_DIR = '/../public/uploads/';

    private $message = [];
    private $videoRepository;

    public function __construct()
    {
        parent::__construct();
        $this->videoRepository = new VideoRepository();
    }

    public function videos()
    {
        $videos = $this->videoRepository->getVideos();
        $this->render('videos',['videos'=>$videos]);
    }

    public function addFile()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIR.$_FILES['file']['name']);

            $video = new Video($_POST['title'],$_POST['description'],$_POST['url'],$_FILES['file']['name']);
            $this->videoRepository->addVideo($video);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/videos");

        }
        return $this->render('addfiles',['messages'=>$this->message]);
    }

    private function validate(array $file):bool
    {
       if($file['size'] > self::MAX_SIZE)
       {
           $this->messages[] ='Maximum file size has been reached';
           return false;
       }
       if(!isset($file['type']) && !in_array($file['type'],self::TYPES_ALLOWED))
       {
           $this->messages[] ='File type unknown';
           return false;
       }
       return true;
    }
}
