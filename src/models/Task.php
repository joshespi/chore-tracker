<?php

namespace App\Models;

class Task
{
    private $id;
    private $title;
    private $description;
    private $reward;
    private $isCompleted;
    private $createdBy;
    private $approvedBy;

    public function __construct($id, $title, $description, $reward, $createdBy)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->reward = $reward;
        $this->isCompleted = false;
        $this->createdBy = $createdBy;
        $this->approvedBy = null;
    }

    public function completeTask()
    {
        $this->isCompleted = true;
    }

    public function approveTask($approvedBy)
    {
        $this->approvedBy = $approvedBy;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getReward()
    {
        return $this->reward;
    }

    public function isTaskCompleted()
    {
        return $this->isCompleted;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getApprovedBy()
    {
        return $this->approvedBy;
    }
}
