<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Review Application</title>
    <style>
        body {
        margin: 0;
        }

        ul.nav {
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
        b {
            color: #4b389e;  
        }
        p.error
        {
            font-weight: bold;
            color: #4b389e;
        }
        .center {
            margin-left:10%;
            padding:1px 16px;
            height:1000px;
        }
        .no_show{
            list-style-type: none;
        }
        .application ul {
            list-style-position:outside;
            list-style-type: none;
            margin:5px;
            padding:5px;
        }
        .option_in_form {
            padding:12px; 
            border-top:1px solid lightgray;
            position:relative;
        }
        .first_item {
            padding:12px; 
            border-top:2px solid black;
            position:relative;
        }
        .last_item{
            padding:12px; 
            border-top:1px solid lightgray;
            border-bottom:2px solid black;
            position:relative;
        }
        span {
            color:gray;
        }
        #submit_button {
            background-color: #4b389e;
            border: 1px solid gray;
            border-bottom: 1px solid #4b389e;;
            color: white;
            font-weight: bold;
            padding: 6px 20px;
            text-align: center;
            text-shadow: 0 -1px 0 #4b389e;
        }
        #submit_button:hover {
            opacity:.85;
            cursor: pointer; 
        }
        #submit_button:active {
            border: 1px solid #4b389e;
            box-shadow: 0 0 10px 5px #4b389e inset;
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

        if ($username == 'admin'){
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
    <ul class='nav'>
        <li><a href="index.php">Home</a></li>
        <li><a href="waitlist.php">Waitlisted Applicants</a></li>
        <li><a href="accepted.php">Accepted Applicants</a></li>
        <li><a href="enrolled.php">Enrolled Applicants</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
    </ul>
    <form id='logout' method='post' action='index.php'>
        <input type='hidden' name='logout' value='true'>
    </form>
    <div class='center'>
        <h1>University of Ansh myPortal Administrator</h1> 
        <?php
            if (! empty($_POST['app_id'])) {
                $app_id = intval($_POST['app_id']);

                #app info
                try {
                    $sql = 'SELECT * FROM university_of_ansh.application_responses WHERE (app_id = :app_id)';
                    $values = array(':app_id' => $app_id);
        
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($values);
        
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $app = $stmt->fetchAll();

                    $username = $app[0]['username'];
                    $expectedGradYear = $app[0]['expectedGradYear'];
                    $financial_aid = intval($app[0]['financial_aid']);
                    $major_interest1 = $app[0]['major_interest1'];
                    $major_interest2 = $app[0]['major_interest2'];
                    $major_interest3 = $app[0]['major_interest3'];
                    $gpa = $app[0]['gpa'];
                    $SAT = $app[0]['SAT'];
                    if (empty($SAT)) {
                        $SAT = 'not submitted';
                    }
                    $ACT = $app[0]['ACT'];
                    if (empty($ACT)) {
                        $ACT = 'not submitted';
                    }
                    $AP_classes = $app[0]['AP_classes'];
                    $Honors_classes = $app[0]['Honors_classes'];
                    $why_major = $app[0]['why_major'];
                    $why_uoa = $app[0]['why_uoa'];
                    $additional_info = $app[0]['additional_info'];
                    $parent_name = $app[0]['parent_first_name'] . " " . $app[0]['parent_last_name'];
                    $parent_email = $app[0]['parent_email'];
                    $parent_job = $app[0]['parent_job'];
                    $parent_income = $app[0]['parent_income'];
                }
                catch (PDOException $e)
                {
                    /* If there is a PDO exception, throw a standard exception */
                    throw new Exception('Database query error');
                }

                #account info
                try {
                    $sql = 'SELECT * FROM university_of_ansh.accounts WHERE (username = :username)';
                    $values = array(':username' => $username);

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($values);

                    $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $acc = $stmt->fetchAll();

                    $name = $acc[0]['first_name'] . " " . $acc[0]['last_name'];
                    $school = $acc[0]['school'];
                    $location = $acc[0]['city'] . ", " . $acc[0]['state'];
                    $gradYear = $acc[0]['gradYear'];
                    $email = $acc[0]['email'];
                    $phone = $acc[0]['phone'];
                }
                catch (PDOException $e)
                {
                    /* If there is a PDO exception, throw a standard exception */
                    throw new Exception('Database query error');
                }

                #reccomendation info
                try {
                    $sql = 'SELECT * FROM university_of_ansh.recommendations WHERE (app_id = :app_id)';
                    $values = array(':app_id' => $app_id);
        
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($values);
        
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $rec = $stmt->fetchAll();

                    $rec_person = $rec[0]['title'] . " " . $rec[0]['name'];
                    $rec_email = $rec[0]['email'];
                    $rec_position = $rec[0]['position'];
                    $perform_text = $rec[0]['perform_text'];
                    $perform_percentile = $rec[0]['perform_percentile'];
                    $collab_text = $rec[0]['collab_text'];
                    $collab_percentile = $rec[0]['collab_percentile'];
                    $potential_text = $rec[0]['potential_text'];
                    $potential_percentile = $rec[0]['potential_percentile'];
                    $final_words = $rec[0]['final_words'];
                }
                catch (PDOException $e)
                {
                    /* If there is a PDO exception, throw a standard exception */
                    throw new Exception('Database query error');
                }

            ?>

                <form method="post" action='accepted.php' id="application" name='application' class='application'>
                    <ul>
                        <h3>Applicant Info</h3>    
                        <li class="first_item">
                            <p><b>Name:</b> <?php echo $name; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>School:</b> <?php echo $school; ?></p>
                        </li>
                        <li class="option_in_form">
                            <p><b>Location:</b> <?php echo $location; ?></p>
                        </li>
                        <li class="option_in_form">
                            <p><b>Graduation Year:</b> <?php echo $gradYear; ?></p>
                        </li>
                        <li class="option_in_form">
                            <p><b>Email:</b> <?php echo $email; ?></p>
                        </li>
                        <li class="last_item">
                            <p><b>Phone:</b> <?php echo $phone; ?></p>
                        </li>
                    </ul>
                    <br></br>
                    <ul>
                        <h3>Application</h3> 
                        <li class="first_item">
                            <p><b>Application ID</b> <?php echo $app_id; ?></p>
                        </li>  
                        <li class="option_in_form">
                            <p><b>Expected Graduation Class:</b> <?php echo $expectedGradYear; ?></p>
                        </li>  
                        <li class="option_in_form">
                            <p><b>Major Interest 1:</b> <?php echo $major_interest1; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Major Interest 2:</b> <?php echo $major_interest2; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Major Interest 3:</b> <?php echo $major_interest3; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Graduation Year:</b> <?php echo $gradYear; ?></p>
                        </li>
                        <li class="option_in_form">
                            <p><b>GPA:</b> <?php echo $gpa; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Number of AP Classes:</b> <?php echo $AP_classes; ?></p>
                        </li>
                        <li class="option_in_form">
                            <p><b>Number of Honors Classes:</b> <?php echo $Honors_classes; ?></p>
                        </li>  
                        <li class="option_in_form">
                            <p><b>SAT:</b> <?php echo $SAT; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>ACT:</b> <?php echo $ACT; ?></p>
                        </li> 
                        <li class="last_item">
                            <p><b>Interested in Financial Aid:</b> <?php if ($financial_aid == 1) echo "yes"; else echo "no"; ?></p>
                        </li> 
                    </ul>
                    <br></br>
                    <ul>
                        <h3>Writing Supplement</h3>
                        <li class="first_item">
                            <p><b>Why Major Response:</b> <?php echo "\n" . $why_major; ?></p>
                        </li>  
                        <li class="option_in_form">
                            <p><b>Why UOA Response:</b> <?php echo "\n" . $why_uoa; ?></p>
                        </li>  
                        <li class="last_item">
                            <p><b>Additional Information:</b> <?php echo "\n" . $additional_info; ?></p>
                        </li>  
                    </ul>
                    <br></br>
                    <ul>
                        <h3>Recommendation</h3>
                        <li class="first_item">
                            <p><b>Recommender:</b> <?php echo $rec_person; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Recommender Position:</b> <?php echo $rec_position; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Recommender Email:</b> <?php echo $rec_email; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Performance Response:</b> <?php echo "\n" . $perform_text; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Performance Percentile:</b> <?php echo $perform_percentile . "%"; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Collaboration Response:</b> <?php echo "\n" . $collab_text; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Collaboration Percentile:</b> <?php echo $collab_percentile . "%"; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Potential Response:</b> <?php echo "\n" . $potential_text; ?></p>
                        </li> 
                        <li class="option_in_form">
                            <p><b>Potential Percentile:</b> <?php echo $potential_percentile . "%"; ?></p>
                        </li> 
                        <li class="last_item">
                            <p><b>Final Words:</b> <?php echo "\n" . $final_words; ?></p>
                        </li> 
                    </ul>
                    <br></br>
                    <?php
                    if ($financial_aid == 1)
                    {
                       ?>
                            <ul>
                                <h3>Financial Aid Information</h3>    
                                <li class="first_item">
                                    <p><b>Parent Name:</b> <?php echo $parent_name; ?></p>
                                </li> 
                                <li class="option_in_form">
                                    <p><b>Parent Email:</b> <?php echo $parent_email; ?></p>
                                </li>
                                <li class="option_in_form">
                                    <p><b>Parent Job:</b> <?php echo $parent_job; ?></p>
                                </li>
                                <li class="last_item">
                                    <p><b>Parent Combined Income:</b> <?php echo $parent_income; ?></p>
                                </li>
                            </ul>
                            <br></br>
                       <?php
                    }
                    ?>
                    <ul>
                        <h3>Decision</h3>
                        <li class="first_item">
                            <label for="offer"> Offer:</label>
                            <select name="offer" id="offer">
                                <option value="denied">Denied</option>
                                <option value="accepted">Accepted</option>
                                <option value="waitlisted">Waitlisted</option>
                            </select>
                        </li> 
                        <li class="option_in_form">
                            <label for="major"> Major:</label>
                            <select name="major" id="major">
                                <option value="<?php echo $major_interest1; ?>"><?php echo $major_interest1; ?></option>
                                <option value="<?php echo $major_interest2; ?>"><?php echo $major_interest2; ?></option>
                                <option value="<?php echo $major_interest3; ?>"><?php echo $major_interest3; ?></option>
                            </select>
                        </li> 
                        <li class="option_in_form">
                            <label for="fin_aid_offer"> Financial Aid Offer/Scholarship:</label>
                            <input type="number" name="fin_aid_offer" id="fin_aid_offer" placeholder="0"/>
                        </li>
                        <input type='hidden' name='app_id' value="<?php echo $app_id; ?>"/>
                        <input type='hidden' name='class' value="<?php echo $expectedGradYear; ?>"/>
                        <li class="last_item"> 
                            <input id='submit_button' type="submit" name="Submit" value="Enter" />
                        </li>
                    </ul>
                </form>
                <?php
            } 
            else {
                echo "
                <p>You must be sent here through index page. Please navigate to <a href='index.php'>index page</a></p>
                </div>";
            }      
        ?>
    </div>
    <?php
        }  
    ?>
</body>
</html>