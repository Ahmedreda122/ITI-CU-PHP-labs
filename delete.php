<?php
$username = $_GET['username'];

$file = fopen("table.csv", 'r');


$newFile = array();
$flag = false;
while(!feof($file))
{
    $line = fgetcsv($file);
    if (gettype($line) === 'array')
    {
        if ($line[6] === $username && $flag === false)
        {
            $flag = true;
        }
        else
        {
            $newFile[] = $line;
        }
    }
}
fclose($file);
if ($flag)
{
    $file = fopen("table.csv", 'w');
    foreach ($newFile as $line)
    {
        foreach ($line as $data)
        {
            fwrite($file, "$data,");
        }
        $stat = fstat($file);
        ftruncate($file, $stat['size']-1);
        fwrite($file, "\n");
    }
}
fclose($file);
header("Location: index.php");