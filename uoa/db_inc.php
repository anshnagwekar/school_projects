<?php
/*
   Name: Ansh Nagwekar -->
   This file manages the connection to the database and settings.
*/

/* Host name of the MySQL server */
$host = 'localhost';

/* MySQL account username */
$user = 'admin';

/* MySQL account password */
$passwd = '*********';

/* The schema you want to use */
$schema = 'university_of_ansh';

/* The PDO object */
$pdo = NULL;

/* Connection string, or "data source name" */
$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

/* Connection inside a try/catch block */
try
{  
   /* PDO object creation */
   $pdo = new PDO($dsn, $user,  $passwd);
   
   /* Enable exceptions on errors */
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
   /* If there is an error an exception is thrown */
   echo 'Database connection failed.';
   die();
}

class Settings
{
    static $uploadFolder = "C:/tools/uploads/uoa/";
}

?>