<?php
include_once __DIR__ . '/../database/db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    if ($username && $password && $email) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn -> prepare("INSERT INTO Accounts (username, password, email) VALUES (?, ?, ?)");
        $stmt -> bind_param("sss", $username, $hash, $email);
        
        try {
            $stmt -> execute();
            $msg = "You have succesfully registered!";
        } catch (mysqli_sql_exception $e) {
            $msg = "Username or email already is registered!";
        }
    } else {
        $msg = "All fields are required!";
    }
            
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
    <h1>&nbsp&nbspCreate an Account</h1>
    <br>
    <div class="login">
	<form action="" method="POST">
       <label>Username:</label><br>
	   <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"><br>
       <label>Password:</label><br>
	   <input type="password" name="password" placeholder="Password"><br>
       <label>Email:</label><br>
       <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"><br><br>
	 <input type="submit" name="submit" value="Sign Up">
	</form>
    </div>
    <span class="notice"><?= htmlspecialchars($msg) ?></span>
</body>
</html>
