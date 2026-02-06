<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['event_name'] = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_POST['event']);
  header('Location: /control.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<body style="background:#111;color:#fff;font-family:system-ui;text-align:center;padding-top:20vh">
  <h2>🎉 Enter Event Name</h2>
  <form method="POST">
    <input name="event" required placeholder="MyEventName" style="padding:10px;font-size:18px">
    <br><br>
    <button style="padding:10px 20px;font-size:18px">Start</button>
  </form>
</body>
</html>
