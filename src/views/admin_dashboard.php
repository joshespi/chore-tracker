<?php

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: index.php?view=login');
    exit;
}

$title = 'Admin Dashboard';
$header = 'Welcome, Admin!';
ob_start();
?>
<section>
    <h2>User Management</h2>
    <p>Here you can add, edit, or remove users.</p>
    <!-- Add user management features here -->
</section>
<section>
    <h2>Task Overview</h2>
    <p>View and manage all chores and assignments.</p>
    <!-- Add task management features here -->
</section>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/templates/base-layout.php';
