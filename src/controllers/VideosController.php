<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Video.php';
require_once __DIR__.'/../repository/VideoRepository.php';

class VideosController extends AppController
{
    const MAX_SIZE = 1024*1024;
    const TYPES_ALLOWED = ['image/png','image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/img';

    private $message = [];
    private $videoRepository;

    public function __construct()
    {
        parent::__construct();
        $this->videoRepository = new VideoRepository();
    }

    public function addFile()

    {
        if($this->cookieCheck()!=0 &&  $this->videoRepository->getRole($this->getCurrentUserID())=='admin')
        {
            if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
            {
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

                $video = new Video($_POST['title'],$_POST['description'],$_POST['url'],$_FILES['file']['name']);
                $this->videoRepository->addVideo($video);

            }
            return $this->render('addfiles',['messages'=>$this->message]);
        } else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/videos");
        }

    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): '';
        if($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type:application/json');
            http_response_code(200);
            echo json_encode($this->videoRepository->getVideoByTitle($decoded['search']));
        }
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


