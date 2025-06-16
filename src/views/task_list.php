<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h1>Predefined Tasks</h1>
    <table>
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Reward</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $tasks is an array of task objects passed to this view
            foreach ($tasks as $task) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($task->name) . "</td>";
                echo "<td>" . htmlspecialchars($task->description) . "</td>";
                echo "<td>" . htmlspecialchars($task->reward) . "</td>";
                echo "<td><a href='complete_task.php?id=" . htmlspecialchars($task->id) . "'>Complete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>