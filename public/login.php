<?php
include_once __DIR__ . '/../database/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn -> prepare("SELECT id, password FROM Accounts WHERE username = ?");
    $stmt -> bind_param("s", $username);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if ($user = $result -> fetch_assoc()) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];

	    if (!empty($_POST['remember'])) {
	       $token = bin2hex(random_bytes(32));
	       $hash = hash('sha256', $token);
	       $expires = date('Y-m-d H:i:s', strtotime('+30 days'));

	       $stmt = $conn -> prepare("INSERT INTO remember_tokens (user_id, token_hash, expires_at) VALUES (?, ?, ?)");
	       $stmt -> bind_param("iss", $user['id'], $hash, $expires);
	       $stmt -> execute();

	       setcookie('remember', $token, time() + 60 * 60 * 24 * 30, '/', '', false, true);
	    }


            header("Location: session.php");
            exit;
        }
    }

    echo '<span class="notice">Invalid username or password!</span>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verty | Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br>
    <h1>&nbsp&nbspLogin to Verty</h1>
    <br>
    <hr>
    <br>
    <div class="login">
    <form action="" method="POST">
       <label>Username:</label><br>
	   <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"><br>
       <label>Password:</label><br>
	   <input type="password" name="password" placeholder="Password"><br>
       <br><br>
	   <input type="submit" name="submit" value="Login"><br>
	   <label id="remember-tag">
		<input type="checkbox" name="remember"> Remember me
	   </label>
       <br><br>
       <p>Don't have an account? <a href="register.php">Create one today</a></p>
    </form>
    </div>
</body>
</html>
