<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style5.css">
    <title>login</title>
</head>
<body>
<h1>Login</h1>
<form method="POST" action="welcome.php">
    <label for="usrname">Name</label>
    <input type="text" name="usrname" id="usrname" <?php if (isset($old['usrname'])) echo "value=\"{$old['usrname']}\""?>>
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" <?php if (isset($old['password'])) echo "value=\"{$old['password']}\""?>>
    <?php
    if (isset($_GET['error']))
        echo "<div class='err'>{$_GET['error']}</div>";
    ?>
    <br>
    <input class='login' type="submit" value = "Login">
</form>
</body>
</html>
