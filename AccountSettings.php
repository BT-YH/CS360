<?php
session_start(); 
include('bernard.php');  


$menu = "inbox";
$name = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Settings</title>
</head>
<body>
    <h1>Update Account Information</h1>
    <?php genUpdateForm(); ?>
</body>
</html>
