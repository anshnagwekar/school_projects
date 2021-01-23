
<!DOCTYPE html>
<!-- Official Application page -->
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Official Application</title>
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

        .required_field {
            color:#d41e1e; 
            margin:5px 0 0 0; 
        }
        .required_asterisk{
            display: inline;
            color:#d41e1e; 
        }

        input[id='SAT'] {
            visibility:hidden;
        }

        input[id='ACT'] {
            visibility:hidden;
        }

        input[id='yesACT']:checked + input[id='ACT'] {
            visibility:visible;
        }

        input[id='yesSAT']:checked + input[id='SAT'] {
            visibility:visible;
        }
        h1 {
            color: #4b389e;
        }
        .center {
            margin-left:10%;
            padding:1px 16px;
            height:1000px;
        }
        h4 {
            color: #4b389e;  
        }
    </style>
</head>

<body>
    <?php
      /* Start the PHP Session */
    session_start();

    /* Include the database connection file (remember to change the connection parameters) */
    require '../../db_inc.php';

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
        
    ?>
    <ul class='nav'>
        <li><a href="../index.php">Home</a></li>
        <li><a href="submitted.php">Submitted Applications</a></li>
        <li><a class="active" href="#apply">New Application</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
        <form method="post" id='logout'> 
            <input type="hidden" name="logout" value="true">
        </form>
    </ul>
    <div class='center'>
        <h1>University of Ansh Official Application</h1>
        <h3>Once you fill out the following form, you will receieve an app id, which you can use to monitor the status of your application in myPortal.</h3>
        <span class="required_field">* Denotes Required Field</span>
        <form method="post" action="<?php echo htmlspecialchars('submitted.php');?>" id = "application" name='application' class='application' onsubmit='return valid()'>
            <ul>
                <h4>Application Info</h4>    
                <li class="first_item">
                    <p class='required_asterisk'>*</p> 
                    <label for="expectedGradYear"> Application for the Class of:</label>
                    <select name="expectedGradYear" id="expectedGradYear">
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                </li> 
                <li class="last_item">
                    <p class='required_asterisk'>*</p> 
                    <label for="ready"> Are you ready???:</label>
                    <input type="text" name="ready" id="ready" placeholder="Bring it on!" required/>
                </li>
            </ul>
            <br></br>
            <ul>
                <h4>Parent Info</h4>  
                <li class="first_item">
                    <p class='required_asterisk'>*</p>
                    <label for="parent_first_name"> Parent's First Name:</label>
                    <input type="text" name="parent_first_name" id="parent_first_name" placeholder="John" required/>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="parent_last_name"> Parent's Last Name:</label>
                    <input type="text" name="parent_last_name" id="parent_last_name" placeholder="Doe" required/>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="parent_email"> Parent Email:</label>
                    <input type="email" name="parent_email" id='parent_email' placeholder="john.doe21@bcp.org" required/>
                    <span class="hint">Hint: "username@account.org"</span>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="parent_job"> Parent's Job and Employer:</label>
                    <input type="text" name="parent_job" id="parent_job" placeholder="Engineer at Apple" required/>
                    <span class="hint">Hint: "Job" at "Employer"</span>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="parent_income"> Parents' Combined Income:</label>
                    <input type="number" name="parent_income" id="parent_income" placeholder="0" required/>
                </li>
                <li class="last_item">
                    <p class='required_asterisk'>*</p> 
                    <label for="financial_aid"> Interested in Financial Aid?</label>
                    <select name="financial_aid" id="financial_aid">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </li> 
            </ul>
            <br></br>
            <ul>
                <h4>Academics</h4>
                <li class="first_item">
                    <p class='required_asterisk'>*</p> 
                    <label for="major_interest1"> 1st Major Choice:</label>
                    <select name="major_interest1" id="major_interest1">
                        <option value="undecided">undecided</option>
                        <option value="Aerospace Engineering">Aerospace Engineering</option>
                        <option value="Environmental Engineering">Environmental Engineering</option>
                        <option value="Biomedical Engineering">Biomedical Engineering</option>
                        <option value="Civil Engineering">Civil Engineering</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Computer Engineering">Computer Engineering</option>
                        <option value="Data and Information Sciences">Data and Information Science</option>
                        <option value="Electrical Engineering">Electrical Engineering</option>
                        <option value="Industrial Engineering">Industrial Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                    </select>
                </li> 
                <li class="option_in_form">
                    <label for="major_interest2"> 2nd Major Choice:</label>
                    <select name="major_interest2" id="major_interest2">
                        <option value="undecided">undecided</option>
                        <option value="Aerospace Engineering">Aerospace Engineering</option>
                        <option value="Environmental Engineering">Environmental Engineering</option>
                        <option value="Biomedical Engineering">Biomedical Engineering</option>
                        <option value="Civil Engineering">Civil Engineering</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Computer Engineering">Computer Engineering</option>
                        <option value="Data and Information Sciences">Data and Information Science</option>
                        <option value="Electrical Engineering">Electrical Engineering</option>
                        <option value="Industrial Engineering">Industrial Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                    </select>
                </li> 
                <li class="option_in_form">
                    <label for="major_interest3"> 3rd Major Choice:</label>
                    <select name="major_interest3" id="major_interest3">
                        <option value="undecided">undecided</option>
                        <option value="Aerospace Engineering">Aerospace Engineering</option>
                        <option value="Environmental Engineering">Environmental Engineering</option>
                        <option value="Biomedical Engineering">Biomedical Engineering</option>
                        <option value="Civil Engineering">Civil Engineering</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Computer Engineering">Computer Engineering</option>
                        <option value="Data and Information Sciences">Data and Information Science</option>
                        <option value="Electrical Engineering">Electrical Engineering</option>
                        <option value="Industrial Engineering">Industrial Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                    </select>
                </li> 
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="gpa"> GPA:</label>
                    <input type="text" name="gpa" id="gpa" placeholder="0.0" required/>
                    <span class="hint">Hint: Enter in GPA on 4.0 scale.</span>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="AP_classes"> Number of AP Classes:</label>
                    <input type="number" min='0' max='30' name="AP_classes" id="AP_classes" placeholder="0" required/>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="Honors_classes"> Number of Honors Classes:</label>
                    <input type="number" min='0' max='30' name="Honors_classes" id="Honors_classes" placeholder="0" required/>
                </li>
                <li class="last_item">
                    <p> Check all scores you would like to report:</p>
                    <ul class='no_show'>
                        <li>
                            ACT Scores? <input type="checkbox" name="yesACT" id="yesACT" value="yesACT" />
                            <input type="number" min='1' max='36' id='ACT' name='ACT'> <br />
                        </li>   
                        <li>
                            SAT Scores? <input type="checkbox" name="yesSAT" id="yesSAT" value="yesSAT" />
                            <input type="number" min='400' max='1600' id='SAT' name='SAT'> <br />
                        </li> 
                    </ul>
                </li>
            </ul>
            <br></br>
            <ul>
                <h4>Essay Questions</h4>
                <li class="first_item">
                    <p class='required_asterisk'>*</p>
                    <label for="why_major">Why are you interested in pursuing your first choice major? (150-250 words)</label>
                    <br></br>
                    <textarea form='application' name='why_major' rows="5" cols="75" id="why_major"></textarea>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="why_uoa">Why are you interested in attending the University of Ansh? (150-250 words)</label>
                    <br></br>
                    <textarea form='application' name='why_uoa' rows="5" cols="75" id="why_uoa"></textarea>
                </li>
                <li class="last_item">
                    <label for="additional_info">Please enter in any additional info not found elsewhere in your application. (max: 250 words)</label>
                    <br></br>
                    <textarea form='application' name='additional_info' rows="5" cols="75" id="additional_info"></textarea>
                </li>
                <li class="option_in_form"> 
                    <input id='submit_button' type="submit" name="Submit" value="Enter" />
                </li>
            </ul>
        </form>
    </div>
    
    <?php
    }
    ?>
    <script>
        function valid() 
        {
            vals = document.forms['application']['parent_job'].value;
            if (vals.includes(" at ") == false) {
                alert("Please enter in a valid expression for Parent Job");
                return false;
            }


            // AP and honor classes value must be an integer
            vals = parseFloat(document.forms['application']['gpa'].value);
            if (Number.isNaN(vals)){
                alert("Please enter in a valid expression for GPA");
                return false;
            } else if (vals > 4.000) {
                alert('GPA is not on the right 4.0 scale.');
                return false;
            }

            vals = document.forms['application']['why_major'].value;
            nums = vals.split(" ");
            if (nums.length < 150 || nums.length > 250){
                alert("Word count is not in the range of Why Major prompt. Current word count: " + nums.length);
                return false;
            }

            vals = document.forms['application']['why_uoa'].value;
            nums = vals.split(" ");
            if (nums.length < 150 || nums.length > 250){
                alert("Word count is not in the range of Why UOA prompt. Current word count: " + nums.length);
                return false;
            }

            vals = document.forms['application']['additional_info'].value;
            nums = vals.split(" ");
            if (nums.length > 250){
                alert("Word count is over on Additional Info prompt. Current word count: " + nums.length);
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
