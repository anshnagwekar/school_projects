<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Display Info and myStatus Home page -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>myPortal</title>
    <style>
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
        padding: 8px 16px;
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
    </style>
</head>
<body>
<?php
    /* Start the PHP Session */
    session_start();

    /* Include the database connection file (remember to change the connection parameters) */
    require '../db_inc.php';
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
            <h1>myPortal</h1>
            <p>You are not logged in. <a href='../login.php'>Click here</a> to log in.</p>
            </div>";
    }

    if ($login) {
        // get account details

        $username = $account->getName();

        if ($username == 'admin') {
            header('Location: ../admin/index.php');
        }
        /* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
        $sql = 'SELECT * FROM university_of_ansh.accounts WHERE (username = :name) AND (account_enabled = 1)';
        
        /* Values array for PDO */
        $values = array(':name' => $username);

        try
        {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            $fname = $rows['first_name'];
            $lname = $rows['last_name'];
            $school = $rows['school'];
            $city = $rows['city'];
            $state = $rows['state'];
            $gradYear = $rows['gradYear'];
            $email = $rows['email'];
            $phone = $rows['phone'];   
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
        <li><a href="apply/submitted.php">Submitted Applications</a></li>
        <li><a href="apply/index.php">New Application</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
    </ul>
    <div style="margin-left:10%;padding:1px 16px;height:1000px;">
        <h1>University of Ansh myPortal Home</h1>
        <p class='error'><?php if (! empty($alert)) { echo $alert; } ?></p>
        <p class='content'><?php echo '<b>Account Username:</b> ' . $username; ?></p>
        <p class='content'><?php echo '<b>First Name:</b> ' . $fname; ?></p>
        <p class='content'><?php echo '<b>Last Name:</b> ' . $lname; ?></p>
        <p class='content'><?php echo '<b>School:</b> ' . $school; ?></p>
        <p class='content'><?php echo '<b>City:</b> ' . $city; ?></p>
        <p class='content'><?php echo '<b>State:</b> ' . $state; ?></p>
        <p class='content'><?php echo '<b>Graduation Year:</b> ' . $gradYear; ?></p>
        <p class='content'><?php echo '<b>Email:</b> ' . $email; ?></p>
        <p class='content'><?php echo '<b>Phone:</b> ' . $phone; ?></p>
        <form method="post" id='logout'> 
            <input type="hidden" name="logout" value="true">
        </form>
    </div>
        <?php
    }    

?>
</body>
</html>