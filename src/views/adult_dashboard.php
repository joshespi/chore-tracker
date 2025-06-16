<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'user')) {
    header('Location: index.php?view=login');
    exit;
}

$logs = []; // This should be fetched from the database
$totalEarned = 0; // This should be calculated based on the user's earnings
$totalApprovedTime = 0; // This should be calculated based on the user's approved time

$title = 'Adult Dashboard';
$header = 'Welcome, Adult!';

ob_start();
?>

<main>
    <section>
        <h2>Create a New Task</h2>
        <form action="controllers/TaskController.php" method="POST">
            <label for="task_name">Task Name:</label>
            <input type="text" id="task_name" name="task_name" required>

            <label for="reward">Reward (Time/Money):</label>
            <input type="number" id="reward" name="reward" required>

            <button type="submit">Create Task</button>
        </form>
    </section>
    <section>
        <h2>Approve Submitted Time</h2>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Task</th>
                    <th>Submitted Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display submitted time logs -->
                <?php
                // Assuming $logs is an array of log entries fetched from the database
                foreach ($logs as $log) {
                ?>
                    <tr>
                        <td>{$log['user']}</td>
                        <td>{$log['task']}</td>
                        <td>{$log['submitted_time']}</td>
                        <td>{$log['status']}</td>
                        <td>
                            <form action='controllers/LogController.php' method='POST'>
                                <input type='hidden' name='log_id' value='{$log[' id']}'>
                                <button type='submit' name='approve'>Approve</button>
                                <button type='submit' name='deny'>Deny</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Earned Time/Money Overview</h2>
        <p>Total Earned: <?php echo $totalEarned; ?></p>
        <p>Total Approved Time: <?php echo $totalApprovedTime; ?></p>
    </section>
</main>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/templates/base-layout.php';
