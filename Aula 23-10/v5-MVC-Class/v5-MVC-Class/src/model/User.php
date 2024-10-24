<?php

class User
{
  private int $id;
  private string $name;
  private string $lastName;
  private string $username;
  private string $email;

  public function __construct () {}

  public function getId () : string
  {
    return $this->id;
  }

  public function getName () : string
  {
    return $this->name;
  }

  public function getLastName () : string
  {
    return $this->lastName;
  }

  public function getUsername () : string
  {
    return $this->username;
  }

  public function getEmail () : string
  {
    return $this->email;
  }

  public function setId (string $id)
  {
    $this->id = $id;
  }

  public function setName (string $name)
  {
    $this->name = $name;
  }

  public function setLastName (string $lastName)
  {
    $this->lastName = $lastName;
  }

  public function setUsername (string $username)
  {
    $this->username = $username;
  }

  public function setEmail (string $email)
  {
    $this->email = $email;
  }
}
