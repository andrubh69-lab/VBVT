<?php
session_start();
require_once '../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $stmt = $conn->prepare("SELECT id, password_hash FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        
        // Actualizar último acceso
        $conn->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = ?")->execute([$user['id']]);
        
        header("Location: /index.html");
        exit;
    } else {
        echo "Usuario o contraseña inválidos";
    }
}
?>