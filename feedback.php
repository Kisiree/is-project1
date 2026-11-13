<?php
include 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (name,email,message) VALUES (?,?,?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    $msg = $stmt->execute() ? "<span class='ok'>Feedback submitted!</span>" : "Error saving feedback.";
}
$result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html><html><head><title>Feedback</title><link rel="stylesheet" href="style.css">
<style>.wide{width:640px} table{width:100%;border-collapse:collapse;margin-top:15px} th,td{border:1px solid #ccc;padding:6px;text-align:left}</style></head>
<body><div class="card wide"><h2>Feedback Form</h2>
<form method="POST">
  <input name="name" placeholder="Your name" required>
  <input type="email" name="email" placeholder="Your email" required>
  <textarea name="message" placeholder="Your feedback" rows="4" required></textarea>
  <button type="submit">Submit</button>
</form>
<p class="msg"><?= $msg ?></p>
<h3>Submitted feedback</h3>
<table>
  <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Time</th></tr>
  <?php while ($r = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= htmlspecialchars($r['name']) ?></td>
    <td><?= htmlspecialchars($r['email']) ?></td>
    <td><?= htmlspecialchars($r['message']) ?></td>
    <td><?= $r['submitted_at'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>
<p style="text-align:center"><a href="login.php">Login</a> | <a href="signup.php">Sign up</a></p>
</div></body></html>
