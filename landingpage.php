<?php include_once("gilmow01util.php"); ?>
<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE> Landing </TITLE>
<?php include("bootstrap.php"); ?>
<STYLE>
BODY{
font-family: georgia;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1em;
    width: 100%;
}

.container {
    width: 100%;
    display: flex;
    margin: auto;
    flex-grow: 1;
    overflow: hidden;
    justify-content: flex-start; 
}

.sidebar {
    width: 20%;
    background: #ddd;
    padding: 1em;
    margin: 1em;
    box-sizing: border-box;
    border-radius: 5px;
}

.product-container {
    flex-grow: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    padding: 1em;
}

.product-container-landing {
    flex-grow: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 1em;
}

.product {
    box-sizing: border-box;
    margin: 1.5%;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 10em;
    height: 25em;
    display: flex;
    flex-direction: column;
    position: relative; 
    overflow: hidden; 
}


.product img {
    display: block;
    margin: 0 auto;
    width: 70%;
    height: auto; 
    padding: 1em;

}

.product-info {
    padding: 1em;
    flex-grow: 1;
    position: absolute;
    bottom: 0;
}

.product h3 {
    margin-top: 0;
}

.product p {
    color: #888;
}



.nav-link {
color:black;
font-size:20px;
}
.nav-link:hover {
    color: #E87722;
}

nav {
margin-top: 10px;
}
img{
padding-bottom:10px;
}
.product-container-landing {
    flex-grow: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 1em;
}

</STYLE>


    <?php
    $menu = "main";
    if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
    if ($menu == 'login') {
        login($db, $_POST);
}
    else if ($menu == 'logout') {
        unset($_SESSION['username']);
        unset($_SESSION['userType']);
    }
    else if ($menu == 'create'){
	createAccount($db, $_POST);
    }
    else if ($menu == 'ban'){
        banUser($db, $username);
    }
}

$username = $_SESSION['username'];
$fname = getName($db, $username);
$userType = $_SESSION['userType'];
     ?>

</HEAD>
<BODY> <?php
if ($userType == 'Banned'){ ?>
    </table>
    <DIV style = "text-align: center; font-size: 40px; color: red; padding-top: 30px;">
    Your account has been banned </DIV>

    <?php
}
else { ?>
    <table style="width:100%"> 
  <tr>
  <td style="width:10%">
    <img src = "https://www.gettysburg.edu/main/images/apple-touch-icon-152x152.png"></img>
    </td>
   <td style="width:15%"; align = "right">
   <H1><i><b><span style="color: #002F6c";>Gettysburg</span><br/>
   <span style="color:#E87722";> College </span><br/>
   <span style="color: #002F6c";>Marketplace</span></b></i></H1>
    </td>
    <td align = "right">
    <?php
    if (isset($_SESSION['username'])) {?>
        <H4 style="margin-right: 10px">Welcome, <a href="ndashboard.php"><?php echo $fname?></a> <?php
        if ($userType == 'endUser'){ ?>
            &nbsp&nbsp&nbsp&nbsp&nbspCart|? items <img src ="https://www.clker.com/cliparts/z/Y/x/l/A/c/shopping-cart-navy-hi.png" width = "20" height = "20"</img></H4>
        <?php }
        showLogoutForm();
    }
    else {
        logOrCreate();
        if($_POST['option'] == 'Log In'){
           showLoginForm($db);
        }
        else if($_POST['option'] == 'Create Account'){
           showCreateForm($db);

        }
    }
if ($userType == 'Admin') {
    showBanForm($db);
}
else {
?>
    <br/>
    <br/>
    <br/> <?php
    showSearchForm($db); ?>
    </td>
    </tr>
   </table>
<nav class="nav nav-pills nav-fill border-top 2px border-bottom 2px">
  <a class="nav-item nav-link" href="#">Course Materials</a>
  <a class="nav-item nav-link" href="#">Technology</a>
  <a class="nav-item nav-link" href="#">Fashion</a>
  <a class="nav-item nav-link" href="#">Student Essentials</a>
  <a class="nav-item nav-link" href="#">Entertainment</a>  
</nav> <?php
if ($menu == 'search'){
search($db, $_POST);
}
else{ ?>
<DIV class="row">
<H2 style = "padding-top: 10px"><b>Featured Products</b></H2>
</DIV> 
<DIV class = "product-container-landing"> <?php
$sql = "SELECT *
        FROM ITEM
        LIMIT 5";
$res = $db->query($sql);
display_product($res->fetch());
display_product($res->fetch());
display_product($res->fetch());
display_product($res->fetch());
display_product($res->fetch());
?>
<?php  } } }
 ?>
</BODY>
</HTML>

