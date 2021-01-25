<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/FAQ.php';
require_once __DIR__.'/../repository/FaqRepository.php';

class FaqController extends AppController
{
    private $message = [];
    private $faqRepository;

    public function __construct()
    {
        parent::__construct();
        $this->faqRepository = new FaqRepository();
    }

    public function searchfaq()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type:application/json');
            http_response_code(200);
            echo json_encode($this->faqRepository->getFaqByData($decoded['search']));
        }
    }
}