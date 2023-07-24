<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style5.css">
    <title>Table</title>
</head>
<body>
<table>
    <thead>
    <th class="th1">ID</th>
    <th class="th1">Name</th>
    <th class="th1">Email</th>
    <th class="th1">Password</th>
    <th class="th1">Room</th>
    <th class="th1">Profile Photo</th>
    <th class="th1">Delete</th>
    <th class="th1">Edit</th>
    </thead>
    <tbody id="tbody">
    <?php
        $ID = 0;
        require_once('connect.php');
        $query = "SELECT ID, Name, Email, Password, Room, img FROM users;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $old_data = array();

            echo "<tr>";
            foreach($data as $row)
            {
                foreach($row as $name => $value)
                {
                    $old_data[$name] = $value;
                    if ($name === 'ID')
                    {
                        $ID = $value;
                    }
                    else if ($name === 'img')
                    {
                        echo "<td><img src='$value' alt='profile photo'></td>";
                        continue;
                    }
                    echo "<td>$value</td>";
                }
                $old_form = json_encode($old_data);
                echo "<td><button class='button1'><a href='delete.php?ID={$ID}'>Delete</a></button></td>
                          <td><button class='button1 button2'><a href='edit.php?oldData={$old_form}&ID={$ID}'>Edit</a></button></td>";
                echo "</tr>";
            }
    ?>
    </tbody>
</table>
</body>
</html>