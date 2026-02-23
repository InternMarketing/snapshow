<?php
// Start session to store event name
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["event_name"])) {
        // Sanitize event name
        $eventName = trim($_POST["event_name"]);
        $eventName = preg_replace('/[^a-zA-Z0-9_-]/', '', $eventName);

        // Store event name in session
        $_SESSION["event_name"] = $eventName;

        // ✅ CORRECT REDIRECT (Option A)
        header("Location: control/");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow — Enter Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0b1c2d;
            font-family: Arial, sans-serif;
        }
        .box {
            background: #122a44;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 10px 30px rgba(0,0,0,.4);
            text-align: center;
        }
        h1 {
            color: #8fd3ff;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            outline: none;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            background: #1ea7ff;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #4dbbff;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Enter Event Name</h1>
    <form method="post">
        <input
            type="text"
            name="event_name"
            placeholder="Event name"
            required
            autocomplete="off"
        >
        <button type="submit">Continue</button>
    </form>
</div>

</body>
</html>
