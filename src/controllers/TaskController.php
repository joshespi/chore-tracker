<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

// $pdo = require_once dirname(__DIR__) . '/config/database.php';

class TaskController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTask($data)
    {
        // Logic to create a new task
        $task = new Task();
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setReward($data['reward']);
        $task->save();
    }

    public function updateTask($id, $data)
    {
        // Logic to update an existing task
        $task = Task::find($id);
        if ($task) {
            $task->setTitle($data['title']);
            $task->setDescription($data['description']);
            $task->setReward($data['reward']);
            $task->save();
        }
    }

    public function getTasks($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function completeTask($id, $userId)
    {
        // Logic for a kid to mark a task as complete
        $task = Task::find($id);
        if ($task) {
            $task->markAsComplete($userId);
        }
    }

    public function approveTaskCompletion($taskId)
    {
        // Logic for an adult to approve a completed task
        $task = Task::find($taskId);
        if ($task) {
            $task->approve();
        }
    }
}
