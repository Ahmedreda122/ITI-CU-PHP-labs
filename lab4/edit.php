<?php
if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true);
}
$ID = $_GET['ID'];
$old = json_decode($_GET['oldData'], true);


$keys = array(
        'Name',
        'Password',
        'Email',
        'Room'
  );

$arr_keys = array_keys($old);

if (isset($old['usrname']))
{
    $arr_values = array_values($old);
    $old = array_combine($keys, $arr_values);
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
    <title>Edit</title>
</head>
<body>
<h1 style='font-family: cursive; box-sizing: border-box; width: 100%; margin:10px 0px; text-align: center;'>Edit User No. <?=$ID?></h1>;
<form method="POST" action="validate.php?edit=true&ID=<?=$ID?>" enctype="multipart/form-data">
    <label for="usrname">Name</label>
    <input type="text" name="usrname" id="usrname" <?php if (isset($old['Name'])) echo "value=\"{$old['Name']}\""?>>
    <?php
    if (isset($errors['usrname']) && $errors['usrname'] === true)
        echo '<div class="err">Username is Required</div>';
    ?>
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" <?php if (isset($old['Password'])) echo "value=\"{$old['Password']}\""?>>
    <?php
    if (isset($errors['password']) && $errors['password'] === true)
        echo '<div class="err">Password Should be 8 letters or numbers or _</div>';
    ?>
    <br>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" <?php if (isset($old['Email'])) echo "value=\"{$old['Email']}\""?>>
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
    if (isset($old['Room'])) :
        ?>
        <script>
            document.querySelector("[value='<?="{$old['Room']}"?>']").selected = true;
        </script>
    <?php
    endif;
    ?>
    <br>
    <label for="img">Profile Picture</label>
    <input type="file" name="img" id="img" <?php if (isset($old['img'])) echo "value=\"{$old['img']}\""?>>
    <?php
    if (isset($errors['img']))
        echo "<div class='err'>{$errors['img']}</div>";
    ?>
    <br>
    <input type="submit" value="Send">
    <input type="reset" value="Reset">
</form>
</body>
</html>
