<!DOCTYPE html>
<html>

<head>
    <title><?= htmlspecialchars($title ?? 'Chore Tracker') ?></title>
</head>

<body>
    <header>
        <h1><?= htmlspecialchars($header ?? 'Chore Tracker') ?></h1>
        <nav>
            <a href="index.php?view=dashboard">Dashboard</a> |
            <?php
            if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
            } elseif (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            } else if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'kid') {
            }
            ?>
            <a href="index.php?view=logout">Logout</a>
        </nav>
    </header>
    <main>
        <?php if (!empty($content)) echo $content; ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Chore Tracker</p>
    </footer>
</body>

</html>