<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// If it's desired to kill the session, also session_destroy().
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the login page or home
header('Location: /login.php');
exit();
?>