<?php

class User
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phone;

    public function __construct(string $id, string $email, string $password, string $name,string  $surname)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
    }
    public function getId(): string{ return $this->id;}
    public function getEmail(): string{ return $this->email;}
    public function getPassword(): string{ return $this->password;}
    public function getName(): string{ return $this->name;}
    public function getSurname(): string{ return $this->surname;}
    public function getPhone(){ return $this->phone;}

    public function setId(string $id): void{ $this->id = $id;}
    public function setEmail(string $email){ $this->email = $email;}
    public function setPassword(string $password){ $this->password = $password;}
    public function setName(string $name){ $this->name = $name;}
    public function setSurname(string $surname){ $this->surname = $surname;}
    public function setPhone($phone): void{ $this->phone = $phone;}
}