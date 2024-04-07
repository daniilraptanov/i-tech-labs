<?php
$dsn = file_get_contents("./db-config/dsn.txt");
$user = file_get_contents("./db-config/user.txt");
$pass = file_get_contents("./db-config/password.txt");

try {
    $dbh = new PDO($dsn, $user, $pass);
}
catch(PDOException $ex) {
    echo $ex->getMessage();
}