<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event = trim($_POST['event']);
    $event = preg_replace('/[^a-zA-Z0-9_-]/', '_', $event);

    if ($event !== '') {
        $_SESSION['event_name'] = $event;
        header('Location: /control.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Start Event</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background:#111;color:#fff;font-family:system-ui;text-align:center;padding-top:20vh">
<h2>🎉 Enter Event Name</h2>
<form method="POST">
<input name="event" required placeholder="MyEventName"
       style="padding:10px;font-size:18px">
<br><br>
<button style="padding:10px 20px;font-size:18px">Start Event</button>
</form>
</body>
</html>
