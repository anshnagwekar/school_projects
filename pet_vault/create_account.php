<!DOCTYPE html>
<html lang='en'>
<head>
<!-- Create an account for Pet Vault.  -->
	<meta charset="utf-8">
    <title>Create Account</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
        * {
        box-sizing: border-box;
        font-family: Raleway;
        }

        body {
            background-color: #f1f1f1;
        }
        .center {
        background-color: #ffffff;
        margin: 100px auto;
        padding: 40px;
        width: 70%;
        min-width: 300px;
        }
        .error {
            color: #FF0000;
        }

        span {
            color: gray;
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
            border: 1px solid #4b389e;
        }
        h1 {
            text-align: center;  
            color: #4b389e;
        }

        .row {
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php

        /* Start the PHP Session */
        session_start();

        /* Include the database connection file (remember to change the connection parameters) */
        require 'config.php';

        /* Include the Account class file */
        require 'account_class.php';

        /* Create a new Account object */
        $account = new Account();

        $password = $username = $name = "";
        $error = "";
        $show_images = false;

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["password"])) {
                $error = "Password is required";
                $password = "EMPTY";
            } else if (preg_match('/\s/', test_input($_POST["password"]))) {
                $error = "Invalid password entry.";
                $password = 'INVALID';
            } else {
                $password = test_input($_POST["password"]);
            }

            if (empty($_POST["username"])) {
                $error = "Username is required";
                $username = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-']*$/", test_input($_POST["username"]))) {
                $error = "Invalid username value.";
                $username = 'INVALID';
            } else {
                $username = test_input($_POST["username"]);
            }

            if (empty($_POST["name"])) {
                $error = "Name is required";
                $name = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["name"]))) {
                $error = "Invalid Name value.";
                $name = 'INVALID';
            } else {
                $name = test_input($_POST["name"]);
            }
            
        }

        if (empty($error) && !(empty($username)) && !(empty($password))) {
            try
            {

                $newId = $account->addAccount($username, $password, $name);
                $codes = $account->getLayerCodes();
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                die();
            }

            $success = 'The new account ID is ' . $newId;
            $dog_layer_code = $codes[0];
            $cat_layer_code = $codes[1];
            $fish_layer_code = $codes[2];
            $show_images = true;
        }
        else {
            $success = "Not accepted. $error";
        }
    
    if (empty($_POST)) {

    ?>
    <div class='center'>
        <h1>Pet Vault</h1>
        <h3>Create a Pet Vault Account to keep your passwords safe!</h3>
        <form method="post" action="create_account.php">  
            Username: <input type="text" name="username">
            <span>Hint: must be 4-16 chars, only letters and numbers allowed.</span>
            <br><br>

            Password: <input type="password" name="password">
            <span>Hint: must be 8-32 chars, no whitespace allowed.</span>
            <br><br>

            Name: <input type="text" name="name">
            <br><br>

            <input type="submit" name="submit" value="Submit">  
        </form>
    </div>
    <?php
        }
        else {
            echo "<div class='center'><h1>Pet Vault</h1><h3>Form Responses</h3>";
            echo "<b><em>Form Result:</em></b> $success";
            echo "<br><b>Username</b>: $username";
            echo "<br>";
            echo "<b>Password</b>: $password<br>";
            if ($show_images){
                echo("<div class='row'><fieldset><legend>Dog images:</legend>");
                foreach($dog_layer_code as $img) {
                    $path = "img/dog/" . $img . ".jpg";
                    echo("<img src='$path'>");
                }
                echo("</fieldset></div><br>");
                echo("<div class='row'><fieldset><legend>Cat images:</legend>");
                foreach($cat_layer_code as $img) {
                    $path = "img/cat/" . $img . ".jpg";
                    echo("<img src='$path'>");
                }
                echo("</fieldset></div><br>");
                echo("<div class='row'><fieldset><legend>Fish images:</legend>");
                foreach($fish_layer_code as $img) {
                    $path = "img/fish/" . $img . ".jpg";
                    echo("<img src='$path'>");
                }
                echo("</fieldset></div><br>");
                echo "<br><p>Please take a picture of these images for security. You will not be able to log into your account without them.</p><a href='login.php'>Log into your account.</a>";
            }
        }
        
        ?>
    </div>

</body>
</html>
