<?php

namespace App\Controllers;

class AuthController
{
    private $pdo;

    public function __construct($database)
    {
        $this->pdo = $database;
    }

    public function login($username, $password)
    {
        // Logic for user authentication
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Redirect to dashboard after successful login
            header('Location: index.php?view=dashboard');
            // Set session or token for authenticated user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function register($username, $password, $role = 'user')
    {
        // Logic for user registration
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: index.php?view=login');
        exit;
    }
    public function getUserRole($userId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT role FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($row && isset($row['role'])) {
                return $row['role'];
            }
        } catch (\Exception $e) {
            // TODO log the error
        }
        // Fallback to session variable
        return $_SESSION['role'] ?? null;
    }
    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT id, username, role FROM users");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
        $stmt = $this->pdo->prepare("SELECT id, username, role FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $username, $role)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        return $stmt->execute([$username, $role, $userId]);
    }
}
