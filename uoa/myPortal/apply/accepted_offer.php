<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Offer to UOA Accepted Page -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Offer Accepted!</title>
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
    </style>
</head>
<body>
<?php
    if (! empty($_GET)) {
        /* Start the PHP Session */
        session_start();

        /* Include the database connection file (remember to change the connection parameters) */
        require '../../db_inc.php';
        global $pdo;

        /* Include the Account class file */
        require '../../account_class.php';

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
                <p>You are not logged in. <a href='../../login.php'>Click here</a> to log in.</p>
                </div>";
        }

        if ($login) {
            $app_id = intval($_GET['app_id']);
            
            $sql = "UPDATE university_of_ansh.accepted_applications SET enrolled = :enrolled WHERE (app_id = :app_id);";
            $values = array(':enrolled' => intval(1), 'app_id' => $app_id);
            
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

            $sql = "UPDATE university_of_ansh.application_responses SET offer = :offer WHERE (app_id = :app_id);";
            $values = array(':offer' => 'enrolled', 'app_id' => $app_id);
            
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


            echo "<div class='center'>
                <h1>Congratulations!</h1>
                <p>You have been successfully enrolled in the University of Ansh! <a href='../index.php'>Click here</a> to return to myPortal.</p>
                </div>";
        }
    }

?>
</body>
</html>