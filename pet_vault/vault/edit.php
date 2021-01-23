
<!DOCTYPE html>
<!-- Edit passwords for your Pet vault account. -->
<html lang="en">
<?php
      /* Start the PHP Session */
    session_start();

    /* Include the database connection file (remember to change the connection parameters) */
    require '../config.php';

    /* Include the Account class file */
    require '../account_class.php';

    /* Create a new Account object */
    $account = new Account();


    $login = FALSE;

    try
    {
        $login = $account->sessionLogin();
        $username = $account->getName();
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

        if (! empty($_POST['username'])){
            $link = $_POST['link'];
            $user_name = $_POST['username'];
            $host = $_POST['host'];
            $password = $_POST['password'];
            $id = $_POST['id'];

            $sql = "UPDATE `passwords` SET `username` = '$user_name', `password` = '$password', `host` = '$host', `link` = '$link' WHERE `id` = '$id'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            header('Location: passwords.php');
                
        }

        if (! empty($_POST['logout'])) {
            if ($_POST['logout'] == 'true') {
                $login = false;
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


        if (! empty($_POST['id']) && empty($_POST['username'])) { 
                $id = $_POST['id'];

                $sql = 'SELECT * FROM passwords WHERE (id = :id)';
                $values = array(':id' => $id);

                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rows = $stmt->fetchAll();

                $link = $rows[0]['link'];
                $host = $rows[0]['host'];
                $password = $rows[0]['password'];
                $user_name = $rows[0]['username'];
    ?>
<head>
    <meta charset="UTF-8">
	<title>Edit Password</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
    * {
        font-family: Raleway;
    }
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

        .center {
            margin-left:10%;
            padding:1px 16px;
            height:1000px;
        }
        .no_show{
            list-style-type: none;
        }
        .password_enter ul {
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

<body onload='prepareQuery()'>
<script>

    function prepareQuery(){
        document.getElementById('username').value = document.getElementById('user_name_value').value;
        document.getElementById('password').value = document.getElementById('password_value').value;
        document.getElementById('link').value = document.getElementById('link_value').value;
        document.getElementById('host').value = document.getElementById('host_value').value;
    }        

    function getDefault() {
        document.getElementById('username').value = document.getElementById('username_value').value;
    }

    function generatePassword() {
        var length = 13,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById('password').value = retVal;
    }

    function isValidHttpUrl(string) {
        let url;
        try {
            url = new URL(string);
        } catch (_) {
            return false;  
        }
        return url.protocol === "http:" || url.protocol === "https:";
    }

    function valid() 
    {
        vals = document.forms['password_enter']['link'].value;
        if (vals != ""){
            if (! isValidHttpUrl(vals)){
                alert("Invalid URL!");
                return false;
            }
        }
        return true;
    }
</script>
    <ul class='nav'>
        <li><a href="index.php">Home</a></li>
        <li><a href="add.php">Add Password</a></li>
        <li><a href="passwords.php">Passwords</a></li>
        <li><a onclick="document.getElementById('logout').submit();">Logout</a></li>
        <form method="post" id='logout'> 
            <input type="hidden" name="logout" value="true">
        </form>
    </ul>
    <div class='center'>
        <h1>Pet Vault Edit Password</h1>
        <h3>Once you fill out the following form, the changes to your entry will be saved.</h3>
        <span class="required_field">* Denotes Required Field</span>
        <form method="post" action="<?php echo htmlspecialchars('edit.php');?>" id = "password_enter" name='password_enter' class='password_enter' onsubmit='return valid()'>
            <input type='hidden' name='user_name_value' id='user_name_value' value="<?php echo $user_name; ?>"/>
            <input type='hidden' name='password_value' id='password_value' value="<?php echo $password; ?>"/>
            <input type='hidden' name='host_value' id='host_value' value="<?php echo $host; ?>"/>
            <input type='hidden' name='link_value' id='link_value' value="<?php echo $link; ?>"/>
            <input type='hidden' name='id' id='id' value="<?php echo $id; ?>"/>
            <ul>
                <li class="first_item">
                    <label for="link"> Link to Website:</label>
                    <input type="text" name="link" id="link" placeholder="https://pet_vault.com"/>
                    <span class="hint">Hint: Enter the link to the webpage that you use to log in.</span>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="host"> Account Host:</label>
                    <input type="text" name="host" id="host" placeholder="Google" required/>
                    <span class="hint">Hint: Enter the account host.</span>
                </li>
                <li class="option_in_form">
                    <p class='required_asterisk'>*</p>
                    <label for="username"> Account Username:</label>
                    <input type="text" name="username" id="username" placeholder="myUsername" required/>
                    <button type='button' onclick="getDefault()">Use Default</button>
                    <input type='hidden' id='username_value' value="<?php echo $username; ?>"/>
                </li>
                <li class="last_item">
                    <p class='required_asterisk'>*</p>
                    <label for="password"> Account Password:</label>
                    <input type="text" name="password" id='password' placeholder="Password123!" required/>
                    <button type='button' onclick="generatePassword()">Generate Password</button>
                </li>
                <li class="option_in_form"> 
                    <input id='submit_button' type="submit" name="Submit" value="Enter" />
                </li>
            </ul>
        </form>
    </div>
    
    <?php
       }
    }
    if (empty($_POST)) {
        header('Location: passwords.php');
     }
    ?>
</body>
</html>
