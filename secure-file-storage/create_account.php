<!DOCTYPE html>
<html lang='en'>
<head>
<!-- Name: Ansh Nagwekar -->
<!-- Assignment: DB-A5 Mini-Proj -->
<!-- This file creates an account and adds its credentials to the database. -->
	<meta charset="utf-8">
    <title>Create Account</title>
    <style>
        .center {
            margin: auto;
            width: 70%;
            border: 3px solid #4b389e;
            padding: 15px;
        }
        .error {
            color: #FF0000;
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

        /* Include the database connection file (remember to change the connection parameters) */
        require './db_inc.php';

        /* Include the Account class file */
        require './account_class.php';

        /* Require settings file */
        require_once("settings.php");

        /* Create a new Account object */
        $account = new Account();

        $password = $username = $newId = "";
        $error = "";

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
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["username"]))) {
                $error = "Invalid username valuee.";
                $username = 'INVALID';
            } else {
                $username = test_input($_POST["username"]);
            }
        }

        if (empty($error) && !(empty($username)) && !(empty($password))) {
            try
            {
                $newId = $account->addAccount($username, $password);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                die();
            }

            $success = 'The new account ID is ' . $newId;
            $new_dir = Settings::$uploadFolder . "u" . $newId . "/";
            mkdir($new_dir);
        }
        else {
            $success = "Not accepted. $error";
        }

    ?>
    <div class='center'>
        <h3>Create an ASFS (Ansh's Spectacular File Storage) Account</h3>
        <form method="post" action="create_account.php">  
            Username: <input type="text" name="username">
            <span>Hint: must be 4-16 chars, only letters and numbers allowed.</span>
            <br><br>

            Password: <input type="password" name="password">
            <span>Hint: must be 8-32 chars, no whitespace allowed.</span>
            <br><br>

            <input type="submit" name="submit" value="Submit">  
        </form>
    </div>
    <br></br>
    <div class='center'>
        <?php
            echo "<h3>Form Responses:</h3>";
            echo "<b>Username</b>: $username";
            echo "<br>";
            echo "<b>Password</b>: $password";
            echo "<br><br>";
            echo "<b><em>Form Result</em></b>: $success";
            echo "<br><a href='login.php'>Log into your account.</a>"
        ?>
    </div>

</body>
</html>
