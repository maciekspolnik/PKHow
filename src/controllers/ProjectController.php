<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Video.php';

class ProjectController extends AppController
{
    const MAX_SIZE = 1024*1024;
    const TYPES_ALLOWED = ['image/png','image/jpeg'];
    const UPLOAD_DIR = '/../public/uploads/';
    private $message = [];

    public function addFile()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIR.$_FILES['file']['name']);

            $video = new Video($_POST['title'],$_POST['description'],$_FILES['file']['name']);

            return $this->render('videos',['messages'=>$this->message,'video'=>$video]);

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