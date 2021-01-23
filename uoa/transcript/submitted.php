<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- The transcript will be processed and uploaded to a folder with the student's app id. -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Recommendation Form Submitted!</title>
    <style>
        body {
        margin: 0;
        }
        .center {
			margin-left:10%;
			margin-right:10%;
            padding:1px 16px;
			border: 1px solid #4b389e;
        }
        h1 {
            color: #4b389e;
        }
    </style>
</head>
<body>
<?php

    /* Include the database connection file (remember to change the connection parameters) */
    require '../db_inc.php';
    global $pdo;
    $message = "";
            
    if (! empty($_POST) && ! empty($_FILES)){

        try {
            $sql = "UPDATE university_of_ansh.application_responses SET transcript = 1 WHERE (app_id = :app_id);";
            $values = array(':app_id' => intval($_POST['app_id'])); 

            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            $uploadFolder = Settings::$uploadFolder . $_POST['app_id'] . "/";
            //Has the user uploaded something?
            if(isset($_FILES['file'])) {
                $target_path = $uploadFolder;
                $target_path = $target_path . basename( $_FILES['file']['name']);

                //Try to move the uploaded file into the designated folder
                if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                    $message = "The file ".  basename( $_FILES['file']['name']). 
                    " has been uploaded. Thanks for submitting the transcipt!";
                } else {
                    $message = "There was an error uploading the file, please try again!";
                }

            }
        }
        catch (PDOException $e)
        {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }       

        echo "<div class='center'>
            <h1>University of Ansh</h1>
            <p>$message</p>
            <br>
            </div>";
    }
    else {
        echo "<div class='center'>
            <h1>University of Ansh</h1>
            <p>Please head over to our <a href='index.php'>official transcript upload</a> to submit a transcript!</p>
            <br>
            </div>";
    }

?>
</body>
</html>