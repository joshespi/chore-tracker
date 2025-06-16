<?php

namespace App\Models;

class User
{
    private $id;
    private $username;
    private $password;
    private $role;
    private $earnedTime;
    private $earnedMoney;

    public function __construct($id, $username, $password, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->earnedTime = 0;
        $this->earnedMoney = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getEarnedTime()
    {
        return $this->earnedTime;
    }

    public function getEarnedMoney()
    {
        return $this->earnedMoney;
    }

    public function addEarnedTime($time)
    {
        $this->earnedTime += $time;
    }

    public function addEarnedMoney($amount)
    {
        $this->earnedMoney += $amount;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
}
