<?php

try {
  $moviesDbConnection = new PDO (
    'mysql:host=localhost; dbname=movies_db; port=3306; charset=utf8mb4',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
 );
}
catch(PDOException $error) {
  echo "el error fue $error";
}
