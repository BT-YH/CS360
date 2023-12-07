<?php

		session_start();
include_once("db_connect.php");

// shows the username and password text boxes and the submit button to log in
function showLoginForm($db) {
	?>
<FORM name='fmLogin' method='POST' action='?menu=login'>
	<INPUT type='text' name='username' size='15' placeholder='Username' style="margin-right: 10px" />
	<br/>
	<INPUT type='password' name='password' size='15' placeholder='Password' style="margin-right: 10px" />
	<br/>
	<INPUT type='submit' name = 'button' value='Submit' style="margin-right: 10px"/>
	</FORM>

	<?php
}

// shows the logout button to log out
function showLogoutForm() {
	?>
	<FORM name='fmLogout' method='POST' action='?menu=logout'>
	<INPUT type='submit' value='Logout' style="margin-right: 10px" />
	</FORM>
	<?php
}

// for admins only
// lists all of the end users with a button next to them that allows the admin to ban them
// shows all of the users on the website 
function showBanForm($db){ ?>
	<FORM name = 'fmBan' method = 'POST' action = '?menu=ban'>
</table> <?php
		$sql = "SELECT end_username
				FROM END_USER";
				$res = $db->query($sql);
				if ($res != FALSE){
					?>
<TABLE> 
					<tr><th style = "padding-left: 15px; padding-right: 10px; padding-top :10px; padding-bottom: 10px">End Users</th></tr>
					<?php
							while($row=$res->fetch()){ ?>
					<tr> <td style = "padding-left: 15px; padding-right: 10px; padding-top :10px; padding-bottom: 10px"> <?php
							$enduser = $row['end_username']; print($enduser);?> </td><td> <?php
									$entry = "<INPUT type='submit' value = 'Ban' name = $enduser size='20'/>";
							printf($entry); ?>
							</td></tr> <?php
							} ?>
							</TABLE>
							<?php
				} ?>
							</FORM> <?php
}

// shows both a log in and create account button that lets the user choose which to do
function logOrCreate(){
	?>
				<FORM name='fmLogOrCreate' method='POST' action='?menu=logOrCreate'>
	<INPUT type='submit' name = 'option' value='Log In' />
	<?php print("&nbsp&nbspOr&nbsp&nbsp" );?> 
	<INPUT type='submit' name = 'option' value='Create Account' style="margin-right: 10px" />
	</FORM>
	<?php
}

// takes the data from the login form and logs the user into the website
function login($db, $data){
	$inUser = $data['username'];
	$sql1 = "SELECT password
			FROM USER
			WHERE username='$inUser'";
					$res1 = $db->query($sql1);
	$row = $res1->fetch();
	$md5pass = $row['password']; 
	if($res1 != FALSE){
		if(is_null($md5pass)){
			echo '<script>alert("This username does not exist")</script>';
		}
		else {
			if(md5($data['password']) == $md5pass){
				$_SESSION['username']=$inUser;
				$sql2 = "SELECT *
						FROM ADMIN
						WHERE admin_username = '$inUser'";
								$res2 = $db->query($sql2);

				$sql3 = "SELECT *
						FROM END_USER
						WHERE end_username = '$inUser'";
								$res3 = $db->query($sql3);


				if($res2->rowCount() > 0){
					$_SESSION['userType'] = 'Admin';
				}
				else if ($res3->rowCount() > 0){
					$_SESSION['userType'] = 'endUser';
				}
				else {
					$_SESSION['userType'] = 'Banned';
				}

			}
			else {
				echo '<script>alert("Incorrect Password")</script>';
			}
		}
	}
}

// shows all of the text boxes and buttons for the user to create an account
function showCreateForm($db){
	?>
			<FORM name='fmLogin' method='POST' action='?menu=create'>
	<INPUT type='text' name='username' size='15' placeholder='Username' style="margin-right: 10px" />
	<br/>
	<INPUT type='password' name='password' size='15' placeholder='Password' style="margin-right: 10px" />
	<br/>
	<INPUT type='text' name='fname' size='15' placeholder='First Name' style="margin-right: 10px" />
	<br/>
	<INPUT type='text' name='lname' size='15' placeholder='Last Name' style="margin-right: 10px" />
	<br/>
	<INPUT type='text' name='address' size='15' placeholder='Address' style="margin-right: 10px" />
	<br/>
	<INPUT type='submit' name = 'button' value='Submit' style="margin-right: 10px"/>
	</FORM>

	<?php
}

// takes the data from the create account form and creates a user and end user in the db
function createAccount($db, $data){
	$inUser = $data['username'];
	$md5pass = md5($data['password']);
	$inFname = $data['fname'];
	$inLname = $data['lname'];
	$inAddress = $data['address'];
	$sql1 = "INSERT INTO USER
			VALUES ('$inUser', '$inFname', '$inLname', '$md5pass')";
			$sql2 = "INSERT INTO END_USER
					VALUES ('$inUser', '$inAddress')";
					$res1 = $db->query($sql1);
	$res2 = $db->query($sql2);
	if($res1 != FALSE && $res2 != FALSE){
		echo '<script>alert("Account has been created. Please log in")</script>';
	}
	else {
		echo '<script>alert("Account could not be created. Your username may already be linked to an account")</script>';
	}
}

// gets the first name of the user entered in the parameter
function getName($db, $username) {
	$sql = "SELECT fname
			FROM   USER
			WHERE  username='$username'";

					$res = $db->query($sql);

	if ($res != FALSE && $res->rowCount() == 1) {
		$nameRow = $res->fetch();
		return $nameRow['fname'];
	}
	else {
		return "Unknown";
	}
}

// for admins only
// when the ban button is clicked, banned user is added to bans table and removed from end user
function banUser($db){
	$username = $_SESSION['username'];
	$sql = "SELECT end_username
			FROM END_USER";
			$res = $db->query($sql);
			if ($res != FALSE){
				while($row=$res->fetch()){ 
					$enduser = $row['end_username'];
					if(isset($_POST[$enduser])){
						$sql1 = "INSERT INTO BANS
								VALUES ('$username', '$enduser')";
								$res1 = $db->query($sql1);
						$sql2 = "DELETE FROM END_USER
								WHERE end_username = '$enduser'";
										$res2 = $db->query($sql2);
						print($username);
						return;
					}
				}
			}

}

// displays all of the products
function display_products($db) {

	$sql = "SELECT * FROM ITEM";
	$res = $db->query($sql);

	if ($res != FALSE) {
		while ($row = $res->fetch()) {
			display_product($row);
		}
	}
}

// displays the product and product info in a box
function display_product($row) {
	$iid      = $row['iid'];
	$image    = $row['picture'];
	$price    = $row['price'];
	$name  	  = $row['item_name'];
	$category = $row['category']; 

	print <<< HTML
			<DIV class="product" data-price="$price" data-category="$category">
	<FORM method="POST" action="?op=addingToCart">
	<INPUT type=hidden name="iid" value="$iid">
	<A href="product.php?iid=$iid">
	<IMG src="$image" /> </A>
	<DIV class="product-info">
	<A href="product.php?iid=$iid">
	<H3> $name </H3>
	</A>
	<P>$$price </P>
	<P>Category: $category </P>
	<BUTTON type="submit">Add to Cart</BUTTON>
	</DIV>
	</FORM>
	</DIV>
	HTML;
}

// shows search bar and a drop down to choose the category for the search
function showSearchForm($db){ ?>
	<FORM name='fmSearch' method='POST' action='?menu=search'>
<INPUT type='text' name='search' required="required" size='20' placeholder='Search for anything' />
<select id="categories" name="categories" style ="padding = 10px">
<option value="All Categories">All Categories</option>
<option value="Course Materials">Course Materials</option>
<option value="Technology">Technology</option>
<option value="Fashion">Fashion</option>
<option value="Student Essentials">Student Essentials</option>
</select>
<INPUT type='submit' value='Search' style="margin-right: 10px" />
</FORM> <?php
}

// takes data from search form and looks for all products that contain the words
// entered in the search bar and displays them
function search($db, $data){
	$search = $data['search'];
	$cat = $data['categories'];
	if ($cat == "All Categories") {
		$sql = "SELECT *
				FROM ITEM
				WHERE item_name like '%$search%'";
	}
	else {
		$sql = "SELECT *
				FROM ITEM
				WHERE item_name like '%$search%' AND category = '$cat'";
	}

	$res = $db->query($sql);
	if ($res->rowCount() == 0){ ?>
<DIV style = "font-size: 40px; text-align: center; padding-top: 10px"> 
	There are no items listed with that name
	</DIV> <?php
	}
	else{
		if ($res != FALSE){ ?>
	<DIV class = "product-container"> <?php
			while($row = $res->fetch()){ 
				display_product($row);
			}
		}
	}

	?> </DIV> <?php
}

// shows all of the reviews of the product
function showReviews($db, $iid){
	$sql = "SELECT *
			FROM REVIEWS
			WHERE item_id = '$iid'";
					$res = $db->query($sql);
	if($res != FALSE){ ?>
	<DIV> <?php
			while($row = $res->fetch()){
				$content = $row['rev_content'];
				$buyer = $row['buyer_username'];
				$date = $row['rev_date'];
				print("$buyer: $content ($date)"); ?>
	<br/> <?php
			}
	?> </DIV> <?php
	}
}
?>