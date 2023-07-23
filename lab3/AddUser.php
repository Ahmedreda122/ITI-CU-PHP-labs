<?php
if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true);
}

if (isset($_GET['oldValues']))
{
    $old = json_decode($_GET['oldValues'],true);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style5.css">
    <title>Form</title>
</head>
<body>
<form method="POST" action="validate.php" enctype="multipart/form-data">
    <label for="usrname">Name</label>
    <input type="text" name="usrname" id="usrname" <?php if (isset($old['usrname'])) echo "value=\"{$old['usrname']}\""?>>
    <?php
    if (isset($errors['usrname']) && $errors['usrname'] === true)
        echo '<div class="err">Username is Required</div>';
    ?>
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" <?php if (isset($old['password'])) echo "value=\"{$old['password']}\""?>>
    <?php
    if (isset($errors['password']) && $errors['password'] === true)
        echo '<div class="err">Password Should be 8 letters or numbers or _</div>';
    ?>
    <br>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" <?php if (isset($old['email'])) echo "value=\"{$old['email']}\""?>>
    <?php
    if (isset($errors['email']) && $errors['email'] === true)
        echo '<div class="err">Email should be like: example123@gmail.com</div>';
    ?>

    <br>
    <label for="room">Room No.</label>
    <select name="room" id="room">
        <option value="207">207</option>
        <option value="208">208</option>
        <option value="209">209</option>
        <option value="210">210</option>
        <option value="211">211</option>
    </select>
    <?php
    if (isset($old['room'])) :
        ?>
        <script>
            document.querySelector("[value='<?="{$old['room']}"?>']").selected = true;
        </script>
    <?php
    endif;
    ?>
    <br>
    <label for="img">Profile Picture</label>
    <input type="file" name="img" id="img">
    <?php
    if (isset($errors['img']))
        echo "<div class='err'>{$errors['img']}</div>";
    ?>
    <br>
    <input type="submit" value="Send">
    <input type="reset" value="Reset">
</form>

