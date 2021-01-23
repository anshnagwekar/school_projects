<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Name: Ansh Nagwekar -->
<!-- Assignment: DB-A5 Mini-Proj -->
<!-- This is the main file. If you are logged in, it will let you upload files, close other sessions, and logout. If you are not logged in, it will give you directions to the login page.-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>ASFS File Storage</title>
    <style type="text/css" media="all"> 
        @import url("file-storage-app.css");
    </style>
    <script src="http://code.jquery.com/jquery-latest.js"></script> 
</head>
<body>
<?php

    function getFileType($extension) {
        $images = array('jpg', 'gif', 'png', 'bmp');
        $docs   = array('txt', 'rtf', 'doc', 'docx', 'pdf');
        $java = array('java', 'class');
        $python = array('py', 'ipynb');
        $webdev = array('html', 'js', 'css', 'php');
        
        if(in_array($extension, $images)) return "Images";
        if(in_array($extension, $docs)) return "Documents";
        if(in_array($extension, $java)) return "Java";
        if(in_array($extension, $python)) return "Python";
        if(in_array($extension, $webdev)) return "Web-Development";       
        return "";
    }

    function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
        
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        
        $bytes /= pow(1024, $pow); 
        
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }

    /* Start the PHP Session */
    session_start();

    /* Include the database connection file (remember to change the connection parameters) */
    require './db_inc.php';

    /* Include the Account class file */
    require './account_class.php';

    /* Create a new Account object */
    $account = new Account();

    /* Require settings file */
    require_once("settings.php");

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
        echo "<div id='container'>
            <h1>ASFS (Ansh's Spectacular File Storage)</h1>
            <p>You are not logged in. <a href='login.php'>Click here</a> to log in.</p>
            </div>";
    }

    if ($login)
    {
        $uploadFolder = Settings::$uploadFolder . "u" . $account->getId() . "/";

        $alert = 'Revew account details below.';
        $message = "";

        //Has the user uploaded something?
        if(isset($_FILES['file'])) {
            $target_path = $uploadFolder;
            $target_path = $target_path . time() . '__' . basename( $_FILES['file']['name']);

            //Try to move the uploaded file into the designated folder
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $message = "The file ".  basename( $_FILES['file']['name']). 
                " has been uploaded";
            } else {
                $message = "There was an error uploading the file, please try again!";
            }

        }
        else 
        {
            $message = "Please select a file!";
        }

        if(strlen($message) > 0) {
            $message = '<p class="error">' . $message . '</p>';
        }

        /** LIST UPLOADED FILES **/
        $uploaded_files = "";
        
        //Open directory for reading
        $dh = opendir($uploadFolder);

        //LOOP through the files
        while (($file = readdir($dh)) !== false) {
            if($file != '.' && $file != '..') {
                $filename = $uploadFolder . $file;
                $parts = explode("__", $file);

                $size = formatBytes(filesize($filename));
                $added = date("m/d/Y", $parts[0]);
                $origName = $parts[1];

                $dotloc = strpos($file, '.' )+ 1;
                $filetype = getFileType(substr($file, $dotloc));
                $uploaded_files .= "<li class=\"$filetype\"><a href=\"$filename\">$origName</a> $size - $added</li>\n";
            }
        }
        closedir($dh);

        if(strlen($uploaded_files) == 0) {
            $uploaded_files = "<li><em>No files found</em></li>";
        }

        if (! empty($_POST)) {
            if ($_POST['submit'] == 'logout') {
                $login = false;
                $username = $account->getName();
                try {
                    $account->logout();
                } catch (Exception $e)
                {
                    echo $e->getMessage();
                    die();
                }
                
                echo "<div id='container'>
                    <h1>ASFS (Ansh's Spectacular File Storage)</h1>
                    <p>Logout for $username was successful!</p>
                    <p><a href='login.php'>Click here</a> to log in again.</p>
                    </div>";
            }

            if ($_POST['submit'] == 'closeSessions') {
                $username = $account->getName();
                try {
                    $account->closeOtherSessions();
                } catch (Exception $e)
                {
                    echo $e->getMessage();
                    die();
                } 
                $alert = "All other sessions for $username have been closed.";
            }
        }
  
    }
    
    if ($login) {
        ?>

        <div id="container">
            <h1>ASFS (Ansh's Spectacular File Storage)</h1>
            <fieldset>
                <legend>Account Details</legend>
                <p class='error'><?php if (! empty($alert)) { echo $alert; } ?></p>
                <?php
                    echo 'Account ID: ' . $account->getId() . '<br>';
                    echo 'Account username: ' . $account->getName() . '<br>';
                ?>
                <br>
                <form method="post"> 
                    <button name="submit" value="logout">Logout</button><br></br>
                    <button name="submit" value="closeSessions">Close Other Sessions</button>
                </form>
                
            </fieldset>
            <fieldset>
                <legend>Add a new file to your folder</legend>
                <p><?php echo $message; ?></p>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" />
                    <p><label for="name">Select file</label><br />
                    <input type="file" name="file" /></p>
                    <p><input type="submit" name="submit" value="Start upload" /></p>
                </form>   
            </fieldset>
            <fieldset>
                <legend>Previousely uploaded files</legend>
                <ul id="menu">
                    <li><a href="">All files</a></li>
                    <li><a href="">Documents</a></li>
                    <li><a href="">Images</a></li>
                    <li><a href="">Python</a></li>
                    <li><a href="">Java</a></li>
                    <li><a href="">Web-Development</a></li>
                </ul>
                
                <ul id="files"> <?php echo $uploaded_files; ?> </ul>
            </fieldset>
        </div>

        <?php
    }    

?>
</body>
<script src="file-storage-app.js"></script>
</html>