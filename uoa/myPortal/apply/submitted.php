<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Submitted Applications to UOA -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Submitted!</title>
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

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if (! $login)
    {
        echo "<div class='center'>
            <h1>myPortal</h1>
            <p>You are not logged in. <a href='../../login.php'>Click here</a> to log in.</p>
            </div>";
    }

    if ($login) {
    ?>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a class="active" href="#submitted">Submitted Applications</a></li>
        <li><a href="index.php">New Application</a></li>
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
                    header('Location: ../../login.php');
                }
            }   
            
            // foreach ($_POST as $key => $val) {
            //     $_POST[$key] = test_input($val);  
            // }
            
            $username = $account->getName();
            $sql = "INSERT INTO university_of_ansh.application_responses (username, expectedGradYear, parent_first_name, parent_last_name, parent_email, parent_job, parent_income, financial_aid, major_interest1, major_interest2, major_interest3, gpa, AP_classes, Honors_classes, why_major, why_uoa, additional_info, offer)
                                                                    VALUES (:username, :expectedGradYear, :parent_first_name, :parent_last_name, :parent_email, :parent_job, :parent_income, :financial_aid, :major_interest1, :major_interest2, :major_interest3, :gpa, :AP_classes, :Honors_classes, :why_major, :why_uoa, :additional_info, :offer)";   

            $values = array(':username' => $username, ':expectedGradYear' => intval($_POST['expectedGradYear']), ':parent_first_name' => $_POST['parent_first_name'], ':parent_last_name' => $_POST['parent_last_name'], ':parent_email' => $_POST['parent_email'], ':parent_job' => $_POST['parent_job'], ':parent_income' => intval($_POST['parent_income']), ':financial_aid' => intval($_POST['financial_aid']), ':major_interest1' => $_POST['major_interest1'], ':major_interest2' => $_POST['major_interest2'], ':major_interest3' => $_POST['major_interest3'], ':gpa' => floatval($_POST['gpa']), ':AP_classes' => intval($_POST['AP_classes']), ':Honors_classes' => intval($_POST['Honors_classes']), ':why_major' => $_POST['why_major'], ':why_uoa' => $_POST['why_uoa'], ':additional_info' => $_POST['additional_info'], ':offer' => 'under review');
            
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

            try {
                $sql = "SELECT * FROM university_of_ansh.application_responses WHERE (username = '$username');";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rows = $stmt->fetchAll();

                $id = $rows[count($rows)-1]['id'];
                $app_id = strval($_POST['expectedGradYear']) . strval($id);

                $sql = "UPDATE university_of_ansh.application_responses SET app_id = :app_id WHERE (id = :id);";
                $values = array(':id' => intval($id), 'app_id' => intval($app_id));
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);
            }
            catch (PDOException $e)
            {
                /* If there is a PDO exception, throw a standard exception */
                throw new Exception('Database query error');
            }

            try {
                if (! empty($_POST['ACT'])) {
                    $sql = "UPDATE university_of_ansh.application_responses SET ACT = :ACT WHERE (app_id = :app_id);";
                    $values = array(':ACT' => intval($_POST['ACT']), 'app_id' => intval($app_id));
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($values);
                }

                if (! empty($_POST['SAT'])) {
                    $sql = "UPDATE university_of_ansh.application_responses SET SAT = :SAT WHERE (app_id = :app_id);";
                    $values = array(':SAT' => intval($_POST['SAT']), 'app_id' => intval($app_id));
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($values);
                }

            }
            catch (PDOException $e)
            {
                /* If there is a PDO exception, throw a standard exception */
                throw new Exception('Database query error');
            }

            $new_dir = Settings::$uploadFolder . $app_id . "/";
            mkdir($new_dir);
        }

        echo "<div class='center'><table style='border: solid 1px #4b389e;'>
        <h1>University of Ansh Submitted Applications</h1><tr>";
        echo "<th>App Id</th>
            <th>Status</th>
            <th>Recommendation Submitted?</th>
            <th>Transcript Submitted?</th>
            <th>Offered Major</th>
            <th>Financial Aid Offer</th>
            <th>Class</th></tr>";
        try {
            $username = $account->getName();
            $sql = 'SELECT * FROM university_of_ansh.application_responses WHERE (username = :name)';
            $values = array(':name' => $username);

            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt->fetchAll();

            foreach ($rows as $r){
                echo "<tr>";
                $app_id = $r['app_id'];
                $offer = $r['offer'];
                $rec = $r['recommendation'];
                $trs = $r['transcript'];

                if ($rec == 1){
                    $rec = 'yes';
                }
                else {
                    $rec = 'no';
                }
                if ($trs == 1){
                    $trs = 'yes';
                }
                else {
                    $trs = 'no';
                }

                echo "<td>" . $app_id . "</td>";
                echo "<td>" . $offer . "</td>";
                echo "<td>" . $rec . "</td>";
                echo "<td>" . $trs . "</td>";

                if ($r['offer'] == 'accepted' || $r['offer'] == 'enrolled') { 
                    try {
                        $sql = 'SELECT * FROM university_of_ansh.accepted_applications WHERE (app_id = :app_id)';
                        $values = array(':app_id' => $app_id);
            
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($values);

                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $rows = $stmt->fetchAll();

                        $major = $rows[0]['major'];
                        $fin_aid_offer = $rows[0]['fin_aid_offer'];
                        $class = $rows[0]['class'];

                        echo "<td>" . $major . "</td>";
                        echo "<td>" . $fin_aid_offer . "</td>";
                        echo "<td>" . $class . "</td>";
                        
                    } catch (PDOException $e)
                    {
                        /* If there is a PDO exception, throw a standard exception */
                        throw new Exception('Database query error');
                    }  
                    if ($r['offer'] == 'accepted'){      
                        ?>  
                        <td> 
                        <form method='get' action='accepted_offer.php'> 
                            <input type='hidden' name='app_id' value="<?php echo $app_id; ?>">
                            <button style='display:block;width: 100%;height: 100%;' name='submit' value='accepted'>Accept</button> 
                        </form></td></tr> 
                        <?php 
                    }              
                } else {
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    $year = $r['expectedGradYear'];
                    echo "<td>$year</td>";
                }
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