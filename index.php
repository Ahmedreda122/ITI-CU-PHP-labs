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
    <input type="text" name="fname" id="fname">
    <br>
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname">
    <br>
    <label for="address">Address</label>
    <br>
    <textarea name="address" id="address"></textarea>
    <br>
    <label for="country">Country</label>
    <select name="country" id="country">
        <option value="EG">EG</option>
        <option value="US">US</option>
        <option value="UK">UK</option>
        <option value="GR">GR</option>
        <option value="ES">ES</option>
    </select>
    <br>
    <label>Gender</label>
    <br>
    <div class="radio">
        <input type="radio" name="gender" id="male" value="male">
        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="female">
        <label for="female">Female</label>
    </div>
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
    <br>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <br>
    <label for="pass">Password:   </label>
    <input type="password" name="pass" id="pass">
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
</body>
</html>

