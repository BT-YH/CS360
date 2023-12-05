<?php
session_start();
include("util.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Portal</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: georgia;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            background-color: #f0f0f0;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .marketplace-icon {
            max-width: 150px;
            max-height: 150px;
            test-align: left;
	}

        .user-info {
            text-align: right;
        }
	
	.nav-bar {
	    height: 1%;
            background-color: white;
            padding: .5%;
            font-size 27px;
            color: black;
	}

        .user-portal {
            flex: 1;
            display: flex;
        }

        .cart {
            display: flex;
	    flex: 0 0 30%;
            background-color: #e0e0e0;
            overflow-y: auto;
            padding: 10px;
	    flex-direction: column;
	}


        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .orders,
        .listings {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            flex-direction: row;
        }
	

        /* Add any additional styling or media queries as needed */
    </style>
<?php 

$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];
$fname = $fullname['fname'];
$lname = $fullname['lname'];

?>
</head>

<body>
    <div class="header">
        <div class="marketplace-icon">
            <!-- Your marketplace icon image goes here -->
       	    <table style="width:100%" > 
	    <tr>
	    <td align = "left" style="width:10%">
	    <a href="landingpage.php">
        <img src = "https://www.gettysburg.edu/main/images/apple-touch-icon-152x152.png"></img>
        </a>
	    </td>
	    <td align = "right" style="width:10%">
	    <H1><i><span style="color: #002F6c";>Gettysburg</span><br/>
	    <span style="color:#E87722";> College </span><br/>
	    <span style="color: #002F6c";>Marketplace</span></i></H1>
	    </td> 
	    </tr>
	    </table>
	 </div>
	

        <div class="user-info">
            <!-- Display username and id dynamically here --> 
            <p> <?php echo $fname . " " . $lname;  ?></p>
            <p>Username: <?php echo $username;  ?></p>
        </div>
    </div>

    <div class="nav-bar">
                <a href="landingpage.php" style="text-decoration: none; color: black;">Account Settings</a> &nbsp;
                <a href="landingpage.php" style="text-decoration: none; color: black;">Payment Info</a>
    </div>

    <div class="user-portal">

        <div class="content">
            <div class="orders">
                <!-- Display user's orders here -->
                <h2>User's Orders</h2>
                <!-- Sample order -->
                <div>Order 1</div>
                <div>Order 2</div>
                <!-- Add more orders dynamically -->
            </div>

            <div class="listings">
                <!-- Display user's listings for sale here -->
                <h2>User's Listings</h2>
                <!-- Sample listing -->
                <div>Listing 1</div>
                <div>Listing 2</div>
                <!-- Add more listings dynamically -->
            </div>
        </div>
    	
        <div class="cart" style=" justify-content: flex-end;"> 
	<h2>Shopping Cart</h2>
	<FORM action="?op=purchase">
	<?php
	    $item_ids = retrieveCart($db, $username);
	    display_cart($db, $item_ids);
	    $price = getTotalPrice($db, $username);
        echo "<br>";
	    echo "<H3>Total price $$price</H3>";
        echo "<br>";
	?>
	
	<BUTTON type="submit" style="padding: 5%; font-size: 16px; cursor: pointer;">Purchase</BUTTON>
	</FORM>
        </div>
    </div>
</body>

</html>
