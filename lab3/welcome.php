<?php

// found in file
$loggedIn = false;
//found in session
$logged = false;
if (!(session_status() === PHP_SESSION_ACTIVE))
{
    session_start();
    if (isset($_SESSION['logged']) && $_SESSION['logged'])
    {
        $logged = true;
    }
    session_abort();
}

@$username = $_POST['usrname'] or $username = $_SESSION['username']  or $username = null;
@$password = $_POST['password'] or $password = null;
@$img = $_SESSION['img'] or $img = null;
try {
    $file = fopen('data.csv', 'r');
    while(!feof($file) && !$logged && isset($username) && isset($password))
    {
        $line = fgetcsv($file);

        if ($line[0] === $username && $line[1] === $password)
        {
            $img = $line[4];
            $loggedIn = true;
            break;
        }
    }
    fclose($file);
}
catch (Exception $e)
{
    echo $e->getMessage();
}


if ($loggedIn)
{
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['img'] = $img;
    $_SESSION['logged'] = true;
}


if ($loggedIn || $logged)
{
    echo "<h1 style='font-family: cursive; box-sizing: border-box; width: 100%; text-align: center;'>Welcome, $username</h1>";
    if (isset($img))
    {

        echo "<div style='margin: 10px; margin-left: 50px;'><p style='font-size : 20px; font-family: cursive'>Profile Photo</p> 
            <br>
            <img style='border: 5px solid black;' src='$img' alt='profile photo' height='200px'></div><br><br>";
        echo "<style>
                a{
                font-family: cursive;
                text-decoration: none;
                font-size: 15px;
                font-weight: 600;
                padding: 12px;
                margin: 10px;
                outline: none;
                border-radius: 9px;
                transition: all 0.7s;
                color: white;
                background-color: black;
                border: black 2.5px solid;
                cursor: pointer;
                }
                a:hover
                {
                    color: black;
                    background-color: white;
                }
              </style>";
        echo '<a href="logout.php">Log-out</a>';
    }
}
else {
    header('Location: login.php?error=invalidCardinalities');
    die();
}