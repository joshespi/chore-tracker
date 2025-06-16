<?php
if (!isset($_SESSION['user_id']) && ($authController->getUserRole($_SESSION['user_id'] === 'admin'))) {

    header('Location: index.php?view=login');
    exit;
}

$title = 'Admin Dashboard';
$header = 'Welcome, Admin!';
$users = $authController->getAllUsers();

ob_start();
?>
<section>
    <h2>User Management</h2>
    <p>Here you can add, edit, or remove users.</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="index.php?view=edit_user&id=<?= $user['id'] ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/templates/base-layout.php';
