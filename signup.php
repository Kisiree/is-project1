<?php
include 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username']; $e = $_POST['email']; $n = $_POST['full_name'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username,email,full_name,password) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $u, $e, $n, $p);
    $msg = $stmt->execute() ? "<span class='ok'>Registered successfully!</span>" : "Error: username may already exist.";
}
?>
<!DOCTYPE html><html><head><title>Sign up</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card"><h2>Sign Up</h2>
<form method="POST">
  <input name="full_name" placeholder="Full name" required>
  <input name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Create account</button>
</form>
<p class="msg"><?= $msg ?></p>
<p style="text-align:center">Have an account? <a href="login.php">Login</a></p>
</div></body></html>
