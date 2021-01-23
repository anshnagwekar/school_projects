<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Enrolled Applicants</title>
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
        p.error
        {
            font-weight: bold;
            color: #4b389e;
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
            width:150px;
            border:1px solid #4b389e;
            text-align: center;
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
    $admin_check = FALSE;

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

        if ($username == 'admin'){
            if (! empty($_POST)) {
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
        else {
            $login = FALSE;
            echo "<div class='center'>
            <h1>myPortal Admin</h1>
            <p>You are not the admin!</p>
            </div>";
        } 
    } 


    if ($login)
    {
       ?>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="waitlist.php">Waitlisted Applicants</a></li>
        <li><a href="accepted.php">Accepted Applicants</a></li>
        <li><a class="active" href="enrolled.php">Enrolled Applicants</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
    </ul>
    <form id='logout' method='post' action='index.php'>
        <input type='hidden' name='logout' value='true'>
    </form>
    <div style="margin-left:10%;padding:1px 16px;height:1000px;">
        <h1>University of Ansh Enrolled Applicants</h1> 
        <?php
            echo "<table style='border: solid 1px #4b389e;'><tr>";
            echo "<th>App Id</th>
                <th>Name</th>
                <th>Class</th>
                <th>Major</th>
                <th>Financial Aid Offer<th></tr>";
            try {
                $sql = 'SELECT * FROM university_of_ansh.accepted_applications WHERE (enrolled = :enrolled)';
                $values = array(':enrolled' => 1);
    
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);
    
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rows = $stmt->fetchAll();
    
                foreach ($rows as $r){
                    echo "<tr>";
                    $app_id = intval($r['app_id']);
                    $fin_aid_offer = $r['fin_aid_offer'];
                    $major = $r['major'];
                    $class = $r['class'];
   
                    try {
                        $sql = 'SELECT * FROM university_of_ansh.application_responses INNER JOIN university_of_ansh.accounts ON (university_of_ansh.application_responses.username = university_of_ansh.accounts.username) WHERE (app_id = :app_id)';
                        $values = array(':app_id' => $app_id);

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($values);

                        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $val = $stmt->fetchAll();

                        $name = $val[0]['first_name'] . " " . $val[0]['last_name'];
                    }
                    catch (PDOException $e)
                    {
                        /* If there is a PDO exception, throw a standard exception */
                        throw new Exception('Database query error');
                    } 
    
                    echo "<td>" . $app_id . "</td>";
                    echo "<td>" . $name . "</td>";
                    echo "<td>" . $class . "</td>";
                    echo "<td>" . $major . "</td>";
                    echo "<td>" . $fin_aid_offer . "</td></tr>";  
                    
                    echo "\n";
                }
            } catch (PDOException $e)
            {
                /* If there is a PDO exception, throw a standard exception */
                throw new Exception('Database query error');
            }
        ?>

    </div>

        <?php
    }    

?>
</body>
</html>