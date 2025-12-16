<?php
session_start();
require_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember'])) {
   $hash = hash('sha256', $_COOKIE['remember']);

   $stmt = $conn -> prepare("SELECT u.id, u.role FROM remember_tokens r JOIN Accounts u ON u.id = r.user_id WHERE r.token_hash = ? AND r.expires_at > NOW()");
   $stmt -> bind_param("s", $hash);
   $stmt -> execute();
   $res = $stmt -> get_result();

   if ($user = $res -> fetch_assoc()) {
      $_SESSION['user_id'] = $user['id'];
   }
}