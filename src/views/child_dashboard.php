<?php
if (!isset($_SESSION['user_id']) && ($authController->getUserRole($_SESSION['user_id'] === 'kid'))) {
    header('Location: index.php?view=login');
    exit;
}
$totalEarned = 0;

$title = 'Child Dashboard';
$header = 'Welcome, Child!';
ob_start();
?>
<main>
    <section>
        <h2>Your Tasks</h2>
        <ul id="task-list">
            <?php
            // Fetch tasks from the database
            require_once dirname(__DIR__) . '/controllers/TaskController.php';

            use App\Controllers\TaskController;

            $pdo = require dirname(__DIR__) . '/config/database.php';
            $taskController = new TaskController($pdo);
            $tasks = $taskController->getTasks($_SESSION['user_id']); // Assuming user_id is stored in session

            foreach ($tasks as $task) {
                echo "<li>";
                echo "<span>{$task['name']} - Earn: {$task['reward']} points</span>";
                echo "<form method='POST' action='../controllers/TaskController.php'>";
                echo "<input type='hidden' name='task_id' value='{$task['id']}'>";
                echo "<button type='submit' name='complete_task'>Complete Task</button>";
                echo "</form>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>
    <section>
        <h2>Your Earned Time/Money</h2>
        <p>Total Earned: <?php echo $totalEarned; ?> points</p>
    </section>
    <section>
        <h2>Submit Used Screen Time</h2>
        <form method="POST" action="../controllers/TimerController.php">
            <label for="used_time">Used Time (in minutes):</label>
            <input type="number" id="used_time" name="used_time" required>
            <button type="submit" name="submit_time">Submit</button>
        </form>
    </section>
    <section>
        <h2>Time Log</h2>
        <ul id="time-log">
            <?php
            require_once dirname(__DIR__) . '/controllers/LogController.php';

            use App\Controllers\LogController;

            $logController = new LogController($pdo);
            $logs = $logController->getLogs($_SESSION['user_id']);

            foreach ($logs as $log) {
                echo "<li>{$log['description']} - {$log['time_used']} minutes</li>";
            }
            ?>
        </ul>
    </section>
</main>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/templates/base-layout.php';
