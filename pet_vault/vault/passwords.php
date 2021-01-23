<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Displays all stored passwords for your Pet Vault account. -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Passwords</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
    * {
        font-family: Raleway;
    }
        body {
        margin: 0;
        }

        ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 10%;
        background-color: #f1f1f1;
        position: fixed;
        height: 100%;
        overflow: auto;
        }

        li a {
        display: block;
        color: #000;
        padding: 16px 16px;
        text-decoration: none;
        }

        li a.active {
        background-color: #4b389e;
        color: white;
        }

        li a:hover:not(.active) {
        background-color: #555;
        color: white;
        }
        h1 {
            color: #4b389e;
        }
        .center {
            margin-left:10%;
            padding:1px 16px;
            height:1000px;
        }
        td {
            padding:10px;
            border:1px solid #4b389e;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
    /* Start the PHP Session */
    session_start();

    /* Include the database connection file  */
    require '../config.php';
    global $pdo;

    /* Include the Account class file */
    require '../account_class.php';

    /* Create a new Account object */
    $account = new Account();

    $login = FALSE;

    try
    {
        $login = $account->sessionLogin();
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        die();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if (! $login)
    {
        echo "<div class='center'>
            <h1>Pet Vault</h1>
            <p>You are not logged in. <a href='../login.php'>Click here</a> to log in.</p>
            </div>";
    }

    if ($login) {
    ?>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="add.php">Add Password</a></li>
        <li><a class="active" href="#">Passwords</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
        <form method="post" id='logout'> 
            <input type="hidden" name="logout" value="true">
        </form>
    </ul>
    <?php
        if (! empty($_POST)){

            if (! empty($_POST['logout'])) {
                if ($_POST['logout'] == 'true') {
                    $login = false;
                    $username = $account->getName();
                    try {
                        $account->logout();
                    } catch (Exception $e)
                    {
                        echo $e->getMessage();
                        die();
                    }    
                    header('Location: ../login.php');
                }
            }   

            
            $acc_name = $account->getName();
            $sql = "INSERT INTO passwords (account, link, host, username, password)
                    VALUES (:acc_name, :link, :host, :username, :password)";   

            $values = array(':acc_name' => $acc_name, ':link' => $_POST['link'], ':host' => $_POST['host'], ':username' => $_POST['username'], ':password' => $_POST['password']);
            
            // echo var_dump($values);
            try
            {
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);

            }
            catch (PDOException $e)
            {
                /* If there is a PDO exception, throw a standard exception */
                throw new Exception('Database query error');
            }
        }

        echo "<div class='center'><table style='border: solid 1px #4b389e;'>
        <h1>Pet Vault Stored Passwords</h1><tr>";
        echo "
            <th>Host</th>
            <th>Username</th>
            <th>Password</th>
            <th>Link</th>
            <th>Edit</th></tr>";
        try {
            $acc_name = $account->getName();
            $sql = 'SELECT * FROM passwords WHERE (account = :name)';
            $values = array(':name' => $acc_name);

            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt->fetchAll();

            foreach ($rows as $r){
                echo "<tr>";
                $link = $r['link'];
                $host = $r['host'];
                $username = $r['username'];
                $password = $r['password'];
                echo "<td>" . $host . "</td>";
                echo "<td>" . $username . "</td>";
                echo "<td>" . $password . "</td>"; 
                echo "<td><a href=$link>Login</a></td>";
                ?>  
        <td> 
        <form method='post' action='edit.php'> 
            <input type='hidden' name='id' value="<?php echo $r['id']; ?>">
            <button name='submit' value='submit'>Edit</button> 
        </form></td></tr> 
        <?php     
                echo "\n";
            }
        } catch (PDOException $e)
        {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }
    }    

?>
</body>
</html>