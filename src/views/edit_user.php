<?php
// filepath: src/views/edit_user.php
?>
<h2>Edit User</h2>
<form method="post" action="index.php?view=edit_user&id=<?= $user['id'] ?>">
    Username: <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br>
    Role:
    <select name="role">
        <option value="kid" <?= $user['role'] === 'kid' ? 'selected' : '' ?>>Kid</option>
        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Adult</option>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br>
    <button type="submit">Save</button>
</form>