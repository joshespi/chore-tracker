<?php
session_start();
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/TaskController.php';
require_once __DIR__ . '/controllers/TimerController.php';
require_once __DIR__ . '/controllers/LogController.php';

use App\Controllers\TaskController;
use App\Controllers\AuthController;
use App\Controllers\TimerController;
use App\Controllers\LogController;



$authController = new AuthController($pdo);
$taskController = new TaskController($pdo);
$timerController = new TimerController();
$logController = new LogController($pdo);

$action = $_GET['view'] ?? 'login';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if (!$authController->login($username, $password)) {
                $error = "Invalid username or password.";
                include 'views/login.php';
            }
        } else {
            include 'views/login.php';
        }
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
        $role = $authController->getUserRole($_SESSION['user_id']);
        if ($role === 'kid') {
            include 'views/child_dashboard.php';
        } elseif ($role === 'user') {
            include 'views/adult_dashboard.php';
        } elseif ($role === 'admin') {
            include 'views/admin_dashboard.php';
        } else {
            include 'views/login.php';
        }
        break;
    case 'tasks':
        $taskController->listTasks();
        break;
    case 'submit_time':
        $timerController->submitTime();
        break;
    case 'approve_task':
        $taskController->approveTask();
        break;
    case 'edit_user':
        if (!isset($_SESSION['user_id']) || $authController->getUserRole($_SESSION['user_id']) !== 'admin') {
            header('Location: index.php?view=login');
            exit;
        }
        if (!isset($_GET['id'])) {
            header('Location: index.php?view=dasboard');
            exit;
        }
        $user = $authController->getUserById($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->updateUser($_GET['id'], $_POST['username'], $_POST['role']);
            header('Location: index.php?view=dashboard');
            exit;
        }
        include 'views/edit_user.php';
        break;
    default:
        include 'views/login.php';
        break;
}

print_r($_SESSION); // Debugging line to check session contents