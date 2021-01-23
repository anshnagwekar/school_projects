<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Display Info and Pet Vault home page -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Pet Vault</title>
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
        p.error
        {
            font-weight: bold;
            color: #4b389e;
        }
        b {
            color: #4b389e;  
        }
        img {
            height: 100px;
            width: 100px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
            margin: 5px;
        }
        fieldset
        {
            border: 1px solid rgb(123, 117, 199);
        }
        .row {
            display: inline-block;
        }
        span {
            color: gray;
        }
    </style>
</head>
<body>
<?php
    /* Start the PHP Session */
    session_start();

    /* Include the database connection file */
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

    if (! $login)
    {
        echo "<div class='center'>
            <h1>Pet Vault</h1>
            <p>You are not logged in. <a href='../login.php'>Click here</a> to log in.</p>
            </div>";
    }

    if ($login) {
        // get account details

        $username = $account->getName();
        $id = $account->getId();

        /* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
        $sql = 'SELECT * FROM accounts WHERE (username = :name) AND (account_enabled = 1)';
        
        /* Values array for PDO */
        $values = array(':name' => $username);

        try
        {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            $name = $rows['name'];
            $dog_layer = strrev($rows['dog_layer']);
            $dog_layer_code = array();
            for ($i = 0; $i < strlen($dog_layer); $i++){
                if($dog_layer[$i] == "1"){
                    array_push($dog_layer_code, $i);
                }
            }
            $cat_layer = strrev($rows['cat_layer']);
            $cat_layer_code = array();
            for ($i = 0; $i < strlen($cat_layer); $i++){
                if($cat_layer[$i] == "1"){
                    array_push($cat_layer_code, $i);
                }
            }
            $fish_layer = strrev($rows['fish_layer']);
            $fish_layer_code = array();
            for ($i = 0; $i < strlen($fish_layer); $i++){
                if($fish_layer[$i] == "1"){
                    array_push($fish_layer_code, $i);
                }
            }
        }
        catch (PDOException $e)
        {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }


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
    } 

    if ($login)
    {
       ?>
    <ul>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="add.php">Add Password</a></li>
        <li><a href="passwords.php">Passwords</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
    </ul>
    <div class='center'>
        <h1>Pet Vault Home</h1>
        <p class='error'><?php if (! empty($alert)) { echo $alert; } ?></p>
        <p class='content'><?php echo '<b>Account Username:</b> ' . $username; ?></p>
        <p class='content'><?php echo '<b>Account ID:</b> ' . $id; ?></p>
        <p class='content'><?php echo '<b>Account Name:</b> ' . $name; ?></p>
        <form method="post" id='logout'> 
            <input type="hidden" name="logout" value="true">
        </form>
        <?php
        echo("<div class='row'><fieldset><legend>Dog images:</legend>");
        foreach($dog_layer_code as $img) {
            $path = "../img/dog/" . $img . ".jpg";
            echo("<img src='$path'>");
        }
        echo("</fieldset></div><br>");
        echo("<div class='row'><fieldset><legend>Cat images:</legend>");
        foreach($cat_layer_code as $img) {
            $path = "../img/cat/" . $img . ".jpg";
            echo("<img src='$path'>");
        }
        echo("</fieldset></div><br>");
        echo("<div class='row'><fieldset><legend>Fish images:</legend>");
        foreach($fish_layer_code as $img) {
            $path = "../img/fish/" . $img . ".jpg";
            echo("<img src='$path'>");
        }
        echo("</fieldset></div><br></br>");
        echo("<span>Note: Please look over these pictures frequently! If you forget your pets, you won't be able to access the vault.</span>");
    }    

?>
    </div>
</body>
</html>