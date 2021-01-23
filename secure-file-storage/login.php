<!DOCTYPE html>
<html lang='en'>
<head>
<!-- Name: Ansh Nagwekar -->
<!-- Assignment: DB-A5 Mini-Proj -->
<!-- This file allows the user to login or create an account. -->
	<meta charset="utf-8">
    <title>Login</title>
    <style>
        .center {
            margin: auto;
            width: 70%;
            border: 3px solid #4b389e;
            padding: 15px;
        }
        .error {
            color: #FF0000;
        }

        span {
            color: gray;
		}
		
		p.error
		{
			background-color: rgb(123, 117, 199);
			border-bottom: 1px solid #efefef;
			font-weight: bold;
			color: white;
			padding: 6px;
		}

    </style>
</head>
<body>
	<?php
		$error = "";
		if (! empty($_POST)) {
			/* Start the PHP Session */
			session_start();

			/* Include the database connection file (remember to change the connection parameters) */
			require './db_inc.php';

			/* Include the Account class file */
			require './account_class.php';

			/* Create a new Account object */
			$account = new Account();

			$login = FALSE;

			try
			{
				$login = $account->login($_POST['user'], $_POST['pass']);
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
				die();
			}

			if ($login)
			{
				header('Location: index.php');
			}
			else
			{
				$error = "<p class='error'>Incorrect username or password. Please try again!</p>";
			}
		}
	?>
		<div class='center'>
			<form method="POST">
			<h3>Login to ASFS (Ansh's Spectacular File Storage)</h3>
			Username: <input name="user" type="text"><br><br>
			Password: <input name="pass" type="password"><br><br>
			<input type="submit" name="submit" value="Submit"> 
			</form>
			<h4>Don't have an account? <a href='create_account.php'>Click here</a> to create an account.</h4>
			<?php echo $error; ?>
		</div>
</body>
</html>