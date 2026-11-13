<?php
session_start();
include 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT password, full_name FROM users WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && password_verify($_POST['password'], $row['password'])) {
        $_SESSION['user'] = $_POST['username'];
        $msg = "<span class='ok'>Login successful. Welcome, " . htmlspecialchars($row['full_name']) . " (" . htmlspecialchars($_SESSION['user']) . ")!</span>";
    } else { $msg = "Invalid username or password."; }
}
?>
<!DOCTYPE html><html><head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card"><h2>Login</h2>
<form method="POST">
  <input name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
<p class="msg"><?= $msg ?></p>
<p style="text-align:center">New here? <a href="signup.php">Sign up</a></p>
</div></body></html>
