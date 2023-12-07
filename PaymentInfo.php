<?php
include("bernard.php"); 
include("db_connect.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Information</title>
</head>
<body>
    <h1>Update Account Information</h1>
    <?php genUpdatePaymentInfo(); ?>
    <?php userPaymentInfo($db); ?>
    
</body>
</html>