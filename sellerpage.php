<?php include_once("gilmow01util.php"); ?>
<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE> Seller </TITLE>
<?php include("bootstrap.php"); ?>
<STYLE>
BODY{
font-family: georgia;
}
</STYLE>
</HEAD>
<BODY>
<table style="width:100%"> 
		<tr>
		<td style="width:10%">
		<a href="landingpage.php"><img src = "https://www.gettysburg.edu/main/images/apple-touch-icon-152x152.png"></img></a>
		</td>
		<td style="width:15%"; align = "right">
		<a href="landingpage.php" style = "text-decoration:none"><H1><i><b><span style="color: #002F6c";>Gettysburg</span><br/>
		<span style="color:#E87722";> College </span><br/>
		<span style="color: #002F6c";>Marketplace</span></b></i></H1></a>
		</td>
		<td align = "right">
		<?php
		if (isset($_SESSION['username'])) {?>
		<H4 style="margin-right: 10px">Welcome, <a href="ndashboard.php"><?php echo $fname?></a> <?php
			if ($userType == 'endUser'){ ?>
			&nbsp&nbsp&nbsp&nbsp&nbspCart|? items <img src ="https://www.clker.com/cliparts/z/Y/x/l/A/c/shopping-cart-navy-hi.png" width = "20" height = "20"></img></H4>
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
	    }?>

</table> 


<?php
showReviews($db, 'myervi01');
    
                
                
?>
</BODY>
</HTML>