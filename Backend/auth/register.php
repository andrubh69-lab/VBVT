<?php
require_once '../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validaciones
    if (strlen($username) < 3 || strlen($password) < 8) {
        die("Username mínimo 3 caracteres, contraseña mínimo 8");
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido");
    }
    
    // Hash seguro de contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password_hash]);
        echo "¡Registro exitoso!";
    } catch(PDOException $e) {
        echo "Error: " . ($e->getCode() == 23000 ? "Usuario o email ya existe" : $e->getMessage());
    }
}
?>