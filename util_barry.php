<?php
session_start();
include_once("db_connect.php");



	function display_products($db) {

	    $sql = "SELECT * FROM ITEM";
	    $res = $db->query($sql);
	    
	    if ($res != FALSE) {
			while ($row = $res->fetch()) {
				display_product($row);
			}
	    }
	}


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

	function display_cart_item($row) {
		$iid      = $row['iid'];
		$image    = $row['picture'];
		$price    = $row['price'];
		$name  	  = $row['item_name'];
		$category = $row['category']; 

		print <<< HTML
		<DIV class="product" style="height: auto"; data-price="$price" data-category="$category">
		<A href="product.php?iid=$iid">
		<IMG src="$image" /> </A>
		<P> $name </P>
		<P>$$price </P>
		</DIV>
		HTML;
	}

	function display_cart($db, $iids) {
		
		foreach($iids as $iid ) {
			$sql = "SELECT * FROM ITEM
					 WHERE iid='$iid'";
			$res = $db->query($sql);
			if ($res != FALSE) {
				$row = $res->fetch(); 
				display_cart_item($row);

			} else {
				echo "failed!";
			}
		}
	}

	function checkStatus($db, $iid) {
		if (isset($_SESSION['username'])) {
			$uid = $_SESSION['username']; 
			addToCart($db, $iid, $uid);
		} else {
			echo '<script>alert("Please log in :)")</script>';
			header("refresh:0.1; url=landingpage.php \n");
		}
	}

	function addToCart($db, $iid, $uid) {
		$sql = "INSERT INTO CART VALUES('$iid', '$uid')";
		$res = $db->query($sql);
		if ($res != FALSE) {
			echo '<script>alert("Added to Cart")</script>';
		} else {
			echo '<script>alert("Failed to add to Cart")</script>';
		}
	}

	function retrieveCart($db, $uid) {
		$sql = "SELECT item_id 
				FROM CART
				WHERE buyer_username='$uid'";
		$res = $db->query($sql);
		$iids = array();
		if ($res != FALSE) {
			while ($row = $res->fetch()) {
				$iid = $row['item_id'];
				$iids[] = $iid;
			}
		}
		return $iids;
	}


	function getTotalPrice($db, $uid) {
		$sql = "SELECT SUM(price) AS SUM
			FROM CART JOIN ITEM ON item_id=iid
			GROUP BY buyer_username
			HAVING buyer_username='$uid'";
		$res = $db->query($sql);
		if ($res != FALSE) {
			$row = $res->fetch();
			$sum = $row['SUM'];
		} else {
			echo "failure!";
		}
		return $sum;
	}

//OWEN

	function showLoginForm($db) {
	?>
		<FORM name='fmLogin' method='POST' action='?menu=login'>
		<INPUT type='text' name='username' size='15' placeholder='Username' style="margin-right: 10px" required>
	<br/>
		<INPUT type='password' name='password' size='15' placeholder='Password' style="margin-right: 10px" required>
		<br/>
		<INPUT type='submit' name = 'button' value='Submit' style="margin-right: 10px"/>
		</FORM>
	
	<?php
	}
	function showLogoutForm() {
	?>
		<FORM name='fmLogout' method='POST' action='?menu=logout'>
		<INPUT type='submit' value='Logout' style="margin-right: 10px" />
		</FORM>
	<?php
	}
	
	function logOrCreate(){
	?>
		<FORM name='fmLogOrCreate' method='POST' action='?menu=logOrCreate'>
		<INPUT type='submit' name = 'option' value='Log In' />
		<?php print("&nbsp&nbspOr&nbsp&nbsp" );?> 
		<INPUT type='submit' name = 'option' value='Create Account' style="margin-right: 10px" />
		</FORM>
	<?php
	}
	
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
			   }
					else {
						 echo '<script>alert("Incorrect Password")</script>';
					}
		   }
		}
	}
	
	function showCreateForm($db){
		?>
		<FORM name='fmLogin' method='POST' action='?menu=create'>
			<INPUT type='text' name='username' size='15' placeholder='Username' style="margin-right: 10px" required>
		<br/>
			<INPUT type='password' name='password' size='15' placeholder='Password' style="margin-right: 10px" required>
			<br/>
			<INPUT type='text' name='fname' size='15' placeholder='First Name' style="margin-right: 10px" required>
			<br/>
			<INPUT type='text' name='lname' size='15' placeholder='Last Name' style="margin-right: 10px" required>
			<br/>
			<INPUT type='text' name='address' size='15' placeholder='Address' style="margin-right: 10px" required>
			<br/>
			<INPUT type='submit' name = 'button' value='Submit' style="margin-right: 10px">
		</FORM>
	
	<?php
	}
	
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
			echo '<script>alert("Account could not be created. Please try again")</script>';
		}
	}
	
	
	function getName($db, $username) {
		$sql = "SELECT fname, lname
				FROM   USER
				WHERE  username='$username'";
	
		$res = $db->query($sql);
	
		if ($res != FALSE && $res->rowCount() == 1) {
			$nameRow = $res->fetch();
			return $nameRow;
		}
		else {
			return "Unknown";
		}
	}


/*
    function applyFilters() {
		// Get selected filter options
		const priceFilter = document.getElementById('priceFilter').checked;
		const ratingFilter = document.getElementById('ratingFilter').checked;
		const categoryFilter = document.getElementById('categoryFilter').checked;

		// Get all product elements
		const products = document.querySelectorAll('.product');

		// Apply filters
		products.forEach(product => {
			if (priceFilter && parseInt(product.getAttribute('data-price')) > 20) {
				product.style.display = 'none';
			} else if (ratingFilter && parseInt(product.getAttribute('data-rating')) < 5) {
				product.style.display = 'none';
			} else if (categoryFilter && product.getAttribute('data-brand') !== 'BrandA') {
				product.style.display = 'none';
			} else {
				product.style.display = 'flex';
			}
		});
    }
    </script>
*/

	?>
