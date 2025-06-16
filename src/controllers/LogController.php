<?php

namespace App\Controllers;

use App\Models\Log;

class LogController
{
    private $logModel;

    public function __construct($pdo)
    {
        $this->logModel = new Log($pdo);
    }

    public function submitLog($userId, $taskId, $timeUsed)
    {
        // Validate input
        if ($this->validateLogInput($userId, $taskId, $timeUsed)) {
            // Create a new log entry
            $logEntry = $this->logModel->createLog($userId, $taskId, $timeUsed);
            return $logEntry;
        }
        return false;
    }
    // public function getLogsByUserId($userId)
    // {
    //     // Make sure you have a PDO connection in this model, e.g., $this->pdo
    //     $stmt = $this->pdo->prepare("SELECT * FROM logs WHERE user_id = ?");
    //     $stmt->execute([$userId]);
    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }
    public function getLogs($userId)
    {
        // Retrieve logs for the specified user
        return $this->logModel->getLogsByUserId($userId);
    }

    private function validateLogInput($userId, $taskId, $timeUsed)
    {
        // Basic validation logic
        return is_numeric($userId) && is_numeric($taskId) && is_numeric($timeUsed) && $timeUsed > 0;
    }
}
