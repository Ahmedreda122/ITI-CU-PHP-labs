<?php
if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true);
}
$username = $_GET['username'];
$old = json_decode($_GET['oldData'], true);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Edit</title>
</head>
<body>
<form method="POST" action="done.php">
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" <?php if (isset($old[0])) echo "value=\"{$old[0]}\""?>>
    <?php
    if (isset($errors['fname']) && $errors['fname'] === true)
        echo '<div class="err">First Name is Required</div>';
    ?>
    <br>
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" <?php if (isset($old[1])) echo "value=\"{$old[1]}\""?>>
    <?php
    if (isset($errors['lname']) && $errors['lname'] === true)
        echo '<div class="err">Last Name is Required</div>';
    ?>
    <br>
    <label for="address">Address</label>
    <br>
    <textarea name="address" id="address"><?php if (isset($old[2])) echo "{$old[2]}"?></textarea>
    <br>
    <label for="country">Country</label>
    <select name="country" id="country">
        <option value="EG">EG</option>
        <option value="US">US</option>
        <option value="UK">UK</option>
        <option value="GR">GR</option>
        <option value="ES">ES</option>
    </select>
    <?php
    if (isset($old[3])) :
        ?>
        <script>
            document.querySelector("[value='<?="{$old[3]}"?>']").selected = true;
        </script>
    <?php
    endif;
    ?>
    <br>
    <label>Gender</label>
    <br>
    <div class="radio">
        <input type="radio" name="gender" id="male" value="male">
        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="female">
        <label for="female">Female</label>
    </div>
    <?php
    if (isset($errors['gender']) && $errors['gender'] === true)
        echo '<div class="err">Gender is Required</div>';
    if (isset($old[4])):
        ?>
        <script>
            document.querySelector("[value='<?="{$old[4]}"?>']").checked = true;
        </script>
    <?php
    endif;
    ?>
    <br>
    <label>Skills: </label>
    <br>
    <div>
        <input type="checkbox" name="skills[]" value="PHP" id="php">
        <label for="php">PHP<label>
    </div>
    <div>
        <input type="checkbox" name="skills[]" value="J2SE" id="JS">
        <label for="JS">J2SE<label>
    </div>
    <div>
        <input type="checkbox" name="skills[]" value="MySQL" id="mysql">
        <label for="mysql">MySQL<label>
    </div>
    <div>
        <input type="checkbox" name="skills[]" value="PostgreeSQL" id="PostgreeSQL">
        <label for="PostgreeSQL">PostgreeSQL<label>
    </div>
    <?php
    if (isset($old[5])):
        $arr = explode('|',$old[5]);
        foreach ($arr as $skill):
            ?>
            <script>
                document.querySelector("[value='<?=trim($skill)?>']").checked = true;
            </script>
        <?php
        endforeach;
    endif;
    ?>
    <br>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" <?php if (isset($username)) echo "value=\"{$username}\""?>>
    <br>
    <label for="pass">Password:   </label>
    <input type="password" name="pass" id="pass" <?php if (isset($old['pass'])) echo "value=\"{$old['pass']}\""?>>
    <br>
    <label for="department">Department:</label>
    <input type="text" name="department" id="department" value="OpenSource" readonly>
    <input type="text" name="edit" value="true" hidden readonly>
    <input type="text" name="username" value='<?= $username ?>' hidden readonly>
    <br>
    <button class="button1" type="submit" >Send</button>
    <input type="reset" value="Reset">
</body>
</html>
