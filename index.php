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
    <link rel="stylesheet" href="style.css">
    <title>Form</title>
</head>
<body>
    <form method="POST" action="done.php">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" <?php if (isset($old['fname'])) echo "value=\"{$old['fname']}\""?>>
        <?php
        if (isset($errors['fname']) && $errors['fname'] === true)
            echo '<div class="err">First Name is Required</div>';
        ?>
        <br>
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" <?php if (isset($old['lname'])) echo "value=\"{$old['lname']}\""?>>
        <?php
        if (isset($errors['lname']) && $errors['lname'] === true)
            echo '<div class="err">Last Name is Required</div>';
        ?>
        <br>
        <label for="address">Address</label>
        <br>
        <textarea name="address" id="address"><?php if (isset($old['address'])) echo "{$old['address']}"?></textarea>
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
        if (isset($old['country'])) :
            ?>
            <script>
                document.querySelector("[value='<?="{$old['country']}"?>']").selected = true;
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

        if (isset($old['gender'])):
        ?>
            <script>
                document.querySelector("[value='<?="{$old['gender']}"?>']").checked = true;s
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
        if (isset($old['skills'])):
            foreach ($old['skills'] as $skill):
    ?>
            <script>
                document.querySelector("[value='<?="$skill"?>']").checked = true;
            </script>
    <?php
            endforeach;
        endif;
    ?>
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" <?php if (isset($old['username'])) echo "value=\"{$old['username']}\""?>>
        <br>
        <label for="pass">Password:   </label>
        <input type="password" name="pass" id="pass" <?php if (isset($old['pass'])) echo "value=\"{$old['pass']}\""?>>
        <br>
        <label for="department">Department:</label>
        <input type="text" name="department" id="department" value="OpenSource" readonly>
        <br>
        <div class="codeContainer">
            <div>
                <p>Ar122#</p>
                <input type="text"  name="code">
            </div>
            <div>
                <p class="instrac">Please Insert the<br> code in the below<br>box</p>
            </div>
        </div>
        <input type="submit" value="Send">
        <input type="reset" value="Reset">
    </form>
    <table>
        <thead>
        <th class="th1">First Name</th>
        <th class="th1">Last Name</th>
        <th class="th1">Address</th>
        <th class="th1">Country</th>
        <th class="th1">Gender</th>
        <th class="th1">Skills</th>
        <th class="th1">Username</th>
        <th class="th1">Department</th>
        <th class="th1">Delete</th>
        <th class="th1">Edit</th>
        </thead>
        <tbody id="tbody">
        <?php
        $username = "";
        $file = fopen("table.csv", "r");
        fgetcsv($file);
        while(!feof($file))
        {
            $line = fgetcsv($file);
            $old_data = array();
            if (gettype($line) === 'array')
            {
                echo "<tr>";
                foreach($line as $key => $data)
                {
                    $old_data[] = $data;
                    if ($key === 6)
                    {
                        $username = $data;
                    }
                    echo "<td>$data</td>";
                }
                $old_form = json_encode($old_data);
                echo "<td><button class='button1'><a href='delete.php?username={$username}'>Delete</a></button></td>
                      <td><button class='button1 button2'><a href='edit.php?oldData={$old_form}&username={$username}'>Edit</a></button></td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</body>
</html>