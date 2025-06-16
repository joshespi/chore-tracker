<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <form method="POST" action="register.php">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>

    <?php
    $db = require_once __DIR__ . '/config/database.php';
    require_once __DIR__ . '/controllers/AuthController.php';

    use App\Controllers\AuthController;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if ($username && $password) {
            $auth = new AuthController($db);
            try {
                $success = $auth->register($username, $password);
                if ($success) {
                    echo "Registration successful!";
                } else {
                    echo "Registration failed.";
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) { // Unique constraint violation
                    echo "Username already exists.";
                } else {
                    echo "Error: " . $e->getMessage();
                }
            }
        } else {
            echo "Please fill in all fields.";
        }
    }
    ?>
</body>

</html>