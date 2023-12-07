<?php

$server="cray.cs.gettysburg.edu";
$dbase="f23_4";   // your database
$user="cummbe01";    // your college username
$pass="cummbe01";    // your password for MySQL database

try {
    $db = new PDO("mysql:host=$server;dbname=$dbase", $user, $pass);
    //print "<H1>Successfully connected to database</H1>\n";
}
catch(PDOException $e) {
    die("<H1>ERROR connecting to database " . $e->getMessage() . "</H1>");
}

?>