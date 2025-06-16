<?php

namespace App\Models;

class Log
{
    private $id;
    private $userId;
    private $taskId;
    private $timeSubmitted;
    private $description;
    private $pdo;

    public function __construct($pdo = null, $userId = null, $taskId = null, $timeSubmitted = null, $description = null)
    {
        $this->pdo = $pdo;
        $this->userId = $userId;
        $this->taskId = $taskId;
        $this->timeSubmitted = $timeSubmitted;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function getTimeSubmitted()
    {
        return $this->timeSubmitted;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTimeSubmitted($timeSubmitted)
    {
        $this->timeSubmitted = $timeSubmitted;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getLogsByUserId($userId)
    {
        if (!$this->pdo) {
            throw new \Exception("PDO connection not set in Log model.");
        }
        $stmt = $this->pdo->prepare("SELECT * FROM logs WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
