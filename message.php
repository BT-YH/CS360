<?php 
session_start();
include("bernard.php"); 
include_once("db_connect.php");
include("bootstrap.php")
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
    flex: 1;
    margin: 0; 
}

.menu-row{
    display: flex;
    justify-content: center;
    gap: 10px; 
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
$name = $_SESSION['username']; 
$person = getName($db, $name); 

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
}
?>

</HEAD>

<BODY>

<DIV class="container">

<?php


?>

<!-- banner -->
<DIV class="row">
<DIV class="col-8" style="font-size: 40px">Hello  <?php echo $person; ?>!</DIV>
<DIV class="col-4 "> 

</DIV>
</DIV>

<!-- navbar: menu -->
<DIV class="row">

<!-- href="?menu=inbox" access current file -->

<DIV class="menu-row"> <!-- Changed class here -->
    <DIV class="menuItem"><A href="?menu=inbox">Inbox</A></DIV>
    <DIV class="menuItem"><A href="?menu=compose">Compose</A></DIV>
    <DIV class="menuItem"><A href="?menu=history">History</A></DIV>
</DIV>

</DIV>

<!-- actual content for each menu item -->
<DIV class="row main">

<DIV class="col-12">

<?php 

if ($menu == "compose") {
    genComposeForm($db, $name);
     
}
else if ($menu == "send") {
    sendMessage($db, $_POST);
}
else if($menu =="history"){
    showHistoryForm($db, $name); 
}
else if($menu == "inbox"){
    showInbox($db, $name); 
}
else if($menu == "showHistory"){
    showHistory($db, $_POST, $name); 
}




?>

</DIV> <!-- col-12-->

</DIV> <!-- row-->
</DIV>


</BODY>
</HTML>