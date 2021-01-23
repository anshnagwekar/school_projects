<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Submission Status for Reccomendation -->
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



    if (! empty($_POST)){

        try
        {
            $sql = "INSERT INTO university_of_ansh.recommendations (app_id, title, name, email, position, perform_text, perform_percentile, collab_text, collab_percentile, potential_text, potential_percentile, final_words)
                                                                    VALUES (:app_id, :title, :name, :email, :position, :perform_text, :perform_percentile, :collab_text, :collab_percentile, :potential_text, :potential_percentile, :final_words)";

            $values = array(':app_id' => intval($_POST['app_id']), ':title' => $_POST['title'], ':name' => $_POST['name'], ':email' => $_POST['email'], ':position' => $_POST['position'], ':perform_percentile' => intval($_POST['perform_percentile']), ':collab_percentile' => intval($_POST['collab_percentile']), ':potential_percentile' => intval($_POST['potential_percentile']), ':perform_text' => $_POST['perform_text'], ':collab_text' => $_POST['collab_text'], ':potential_text' => $_POST['potential_text'], ':final_words' => $_POST['final_words']);
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            $sql = "UPDATE university_of_ansh.application_responses SET recommendation = 1 WHERE (app_id = :app_id);";
            $values = array(':app_id' => intval($_POST['app_id']));

            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            echo "<div class='center'>
            <h1>University of Ansh</h1>
            <p>Your recommendation has been submitted. Thanks!</p>
            </div>";

        }
        catch (PDOException $e)
        {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }
    }
    else {
        echo "<div class='center'>
            <h1>University of Ansh</h1>
            <p>Please head over to our <a href='index.php'>official recommendation form</a> to submit a recommendation!</p>
            </div>";
    }

?>
</body>
</html>