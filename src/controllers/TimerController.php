<?php

namespace App\Controllers;

use App\Models\Log;

class TimerController
{
    private $timerStart;
    private $timerEnd;

    public function startTimer()
    {
        $this->timerStart = time();
    }

    public function stopTimer()
    {
        $this->timerEnd = time();
    }

    public function submitUsedTime($userId, $taskId)
    {
        if (!isset($this->timerStart) || !isset($this->timerEnd)) {
            throw new \Exception("Timer has not been started or stopped.");
        }

        $usedTime = $this->timerEnd - $this->timerStart;

        // Create a new log entry
        $log = new Log();
        $log->userId = $userId;
        $log->taskId = $taskId;
        $log->usedTime = $usedTime;
        $log->timestamp = date('Y-m-d H:i:s');

        // Save the log entry (assuming a save method exists)
        $log->save();

        // Reset timer
        $this->timerStart = null;
        $this->timerEnd = null;

        return $usedTime;
    }
}