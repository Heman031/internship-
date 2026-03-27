<?php
session_start();

// Unset all session variables
session_unset();

// Destroy session
session_destroy();

// Force remove session cookie (VERY IMPORTANT)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page
header("Location:index.php");
exit;