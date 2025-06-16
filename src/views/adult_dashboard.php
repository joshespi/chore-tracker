<?php
if (!isset($_SESSION['user_id']) && ($authController->getUserRole($_SESSION['user_id'] === 'adult'))) {
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
        <!-- TODO: create a form to add a new task -->

        <h2>Earned Time/Money Overview</h2>
        <p>Total Earned: <?php echo $totalEarned; ?></p>
        <p>Total Approved Time: <?php echo $totalApprovedTime; ?></p>
    </section>
</main>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/templates/base-layout.php';
