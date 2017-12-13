<?php

declare(strict_types=1);

// Start the session engines.
session_start();

// Set the default timezone to coordinated universal time.
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
mb_internal_encoding('UTF-8');


// Fetch the global configuration array.
$config = require __DIR__.'/config.php';

// Include the helper functions.
require __DIR__.'/functions.php';


// Setup the database connection.
$pdo = new PDO($config['database_path']);

// function userInfo($pdo){
//   $id = $_SESSION['user']['ID'];
//   $statement = $pdo->prepare('SELECT * FROM USERS WHERE ID = :id');
//   $statement->bindParam(':id', $id, PDO::PARAM_STR);
//   $statement->execute();
//   $user = $statement->fetch(PDO::FETCH_ASSOC);
//
//   echo $user;
//
// };
