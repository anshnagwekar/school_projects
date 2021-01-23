<!DOCTYPE html>
<html lang='en'>
<head>
<!-- Create an account for UOA. -->
	<meta charset="utf-8">
    <title>Create Account</title>
    <style>
        h1 {
            color: #4b389e;
        }
        .center {
			margin-left:10%;
			margin-right:10%;
            padding:1px 16px;
			border: 1px solid #4b389e;
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

        /* Create a new Account object */
        $account = new Account();

        $password = $username = $fname = $lname = $school = $city = $state = $gradYear = $email = $phone = $newId = "";
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
            } else if (!preg_match("/^[a-zA-Z-,0-9-']*$/", test_input($_POST["username"]))) {
                $error = "Invalid username value.";
                $username = 'INVALID';
            } else {
                $username = test_input($_POST["username"]);
            }

            if (empty($_POST["fname"])) {
                $error = "First Name is required";
                $fname = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["fname"]))) {
                $error = "Invalid First Name value.";
                $fname = 'INVALID';
            } else {
                $fname = test_input($_POST["fname"]);
            }

            if (empty($_POST["lname"])) {
                $error = "Last Name is required";
                $lname = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["lname"]))) {
                $error = "Invalid Last Name value.";
                $lname = 'INVALID';
            } else {
                $lname = test_input($_POST["lname"]);
            }

            if (empty($_POST["city"])) {
                $error = "City is required";
                $city = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["city"]))) {
                $error = "Invalid City value.";
                $city = 'INVALID';
            } else {
                $city= test_input($_POST["city"]);
            }

            if (empty($_POST["state"])) {
                $error = "State is required";
                $state = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["state"]))) {
                $error = "Invalid State value.";
                $state = 'INVALID';
            } else {
                $state = test_input($_POST["state"]);
            }

            if (empty($_POST["school"])) {
                $error = "School is required";
                $school = "EMPTY";
            } else if (!preg_match("/^[a-zA-Z-,0-9-' ]*$/", test_input($_POST["school"]))) {
                $error = "Invalid School value.";
                $school = 'INVALID';
            } else {
                $school = test_input($_POST["school"]);
            }

            if (empty($_POST["email"])) {
                $error = "Email is required";
                $email = "EMPTY";
            } else {
                $email = $_POST["email"];
            }

            if (empty($_POST["gradYear"])) {
                $error = "Graduation Year is required";
                $gradYear = "EMPTY";
            } else if (! preg_match('/^\d+$/', test_input($_POST["gradYear"]))) {
                $error = "Invalid Graduation Year value.";
                $gradYear = 'INVALID';
            } else {
                $gradYear = test_input($_POST["gradYear"]);
            }

            if (empty($_POST["phone"])) {
                $phone = 0; //phone is not required
            } else if (! preg_match('/^\d+$/', test_input($_POST["phone"]))) {
                $error = "Invalid Phone value.";
                $phone = 'INVALID';
            } else {
                $phone = test_input($_POST["phone"]);
            }
            
        }

        if (empty($error) && !(empty($username)) && !(empty($password))) {
            try
            {
                $newId = $account->addAccount($username, $password, $fname, $lname, $school, $city, $state, $gradYear, $email, $phone);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                die();
            }

            $success = 'The new account ID is ' . $newId;
        }
        else {
            $success = "Not accepted. $error";
        }

    ?>
    <div class='center'>
        <h1>University of Ansh</h1>
        <h3>Create a myPortal Account for the University of Ansh</h3>
        <form method="post" action="create_account.php">  
            Username: <input type="text" name="username">
            <span>Hint: must be 4-16 chars, only letters and numbers allowed.</span>
            <br><br>

            Password: <input type="password" name="password">
            <span>Hint: must be 8-32 chars, no whitespace allowed.</span>
            <br><br>

            First Name: <input type="text" name="fname">
            <br><br>

            Last Name: <input type="text" name="lname">
            <br><br>

            School: <input type="text" name="school">
            <br><br>

            City: <input type="text" name="city">
            <br><br>

            State: <input type="text" name="state">
            <br><br>

            Graudation Year: <input type="text" name="gradYear">
            <span>Hint: only use numbers.</span>
            <br><br>

            Email: <input type="email" name="email">
            <br><br>

            Phone: <input type="text" name="phone">
            <span>Hint: only use numbers.</span>
            <br><br>

            <input type="submit" name="submit" value="Submit">  
        </form>
        <?php
            echo "<h3>Form Responses:</h3>";
            echo "<b>Username</b>: $username";
            echo "<br>";
            echo "<b>Password</b>: $password";
            echo "<br><br>";
            echo "<b><em>Form Result</em></b>: $success";
            echo "<br><a href='login.php'>Log into your account.</a>";
        ?>
        <br></br>
    </div>


</body>
</html>
