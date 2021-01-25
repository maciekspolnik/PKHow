<?php


class FAQ
{
    private $question;
    private $answer;

    public function __construct($question, $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }
    public function getQuestion(){ return $this->question;}
    public function getAnswer(){return $this->answer;}

    public function setQuestion($question): void { $this->question = $question;}
    public function setAnswer($answer): void{$this->answer = $answer;}
}