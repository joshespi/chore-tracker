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
    <h2>Your Earned Time/Money</h2>
    <p>Total Earned: <?php echo $totalEarned; ?> points</p>
    <h2>Your Tasks</h2>
    <!-- TODO: Display tasks available to the child -->
    <h2>Submit Used Screen Time</h2>
    <!-- TODO: Submit used screen time form -->

    <h2>Time Log</h2>
    <!-- TODO: Log of changes to screen time -->
</main>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/templates/base-layout.php';
