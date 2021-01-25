<?php


class Panel
{
    private $title;
    private $url;

    public function __construct($title, $url)
    {
        $this->title = $title;
        $this->url = $url;
    }
    public function getTitle(){ return $this->title;}
    public function getUrl(){ return $this->url;}

    public function setTitle($title): void{ $this->title = $title;}
    public function setUrl($url): void{ $this->url = $url;}
}