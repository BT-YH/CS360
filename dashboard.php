<?php 
session_start();
include("util.php"); 
?>

<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE> ... </TITLE>

<?php include("bootstrap.php"); ?>

<STYLE>
.menuItem {
    border: solid 3px grey; 
    border-radius: 8px;
    text-align: center;
    font-size: 20px;
    background-color: orange; 
    color: ivory;
}

.menuItem:hover {
    background-color: skyblue; 
    color: orange
}

.main {
    margin-top: 20px;
    border: solid 2px grey;
    padding: 10px;
}

</STYLE>


<?php

$menu = "inbox";

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];

    if ($menu == 'login') {
        $_SESSION['uid'] = $_POST['uid'];
    }
    else if ($menu == 'logout') {
        unset($_SESSION['uid']);
    }
}

$uid = $_SESSION['uid'];  // assume Robin is logged in
$uname = getName($db, $uid);
?>

</HEAD>

<BODY>

<DIV class="container">



<!-- banner -->
<DIV class="row">
<DIV class="col-8" style="font-size: 40px">Welcome <?php echo $uname; ?>!</DIV>
<DIV class="col-4 "> 


<?php
    if (isset($_SESSION['uid'])) {
        showLogoutForm();
    }
    else {
        showLoginForm($db);
    }
?>

</DIV>
</DIV>

<!-- navbar: menu -->
<DIV class="row">

<!-- href="?menu=inbox" access current file -->
<DIV class="col-4 menuItem"><A href="?menu=inbox">Inbox</A></DIV>
<DIV class="col-4 menuItem"><A href="dashboard.php?menu=compose">Compose</A></DIV>
<DIV class="col-4 menuItem"><A href="?menu=history">history</A></DIV>

</DIV>

<!-- actual content for each menu item -->
<DIV class="row main">

<DIV class="col-12">

<?php 

if ($menu == "compose") {
    genComposeForm($db, $uid);
}
else if ($menu == "send") {
    sendMsg($db, $_POST);
}
else if ($menu == "inbox") {
    showInbox($db, $uid);
}
else if ($menu == "history") {
    showHistoryForm($db, $uid);
}
else if ($menu == "showHistory") {
    showHistory($db, $uid, $_POST['fid']);
}
else if ($menu == "showMessage") {
    showMessage($db, $_POST['mid']);
}

?>

</DIV> <!-- col-12-->

</DIV> <!-- row-->
</DIV>


</BODY>
</HTML>
