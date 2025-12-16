<?php
session_start();
require_once __DIR__ . '/../database/db.php';

if (isset($_COOKIE['remember'])) {
   $hash = hash('sha256', $_COOKIE['remember']);
   $stmt = $conn -> prepare("DELETE FROM remember_tokens WHERE token_hash = ?");
   $stmt -> bind_param("s", $hash);
   $stmt -> execute();
   setcookie("remember", "", time() - 3600, "/");
}

session_destroy();
header("Location: login.php");
exit;