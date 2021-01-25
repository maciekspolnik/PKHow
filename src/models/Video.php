<?php

class Video
{
    private $title;
    private $description;
    private $image;
    private $url;

    public function __construct($title, $description,$url, $image)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
    }
    public function getUrl(){return $this->url;}
    public function getTitle(){return $this->title;}
    public function getDescription(){return $this->description;}
    public function getImage(){return $this->image;}

    public function setUrl($url): void{$this->url = $url;}
    public function setTitle($title){$this->title = $title;}
    public function setDescription($description){$this->description = $description;}
    public function setImage($image){$this->image = $image;}
}