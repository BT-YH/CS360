<?php
session_start();
include("util.php");
?>

<!DOCTYPE HTML>
<HTML lang="en">
<head>
    <title>Product Page</title>
    <STYLE> 
	header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .product-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        h1, p {
            margin-bottom: 10px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        h2 {
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            margin-top: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .details-section,
        .reviews-section {
            margin-top: 20px;
        }
	</STYLE>

</head>
<body>

<?php

	$iid = $_GET["iid"];
	$sql = "SELECT * FROM ITEM WHERE iid='$iid'";
    	$res = $db->query($sql);
    	$productInfo = array();
    	if ($res != FALSE) {
		$row = $res->fetch();
		$productInfo["iid"]	    = $row["iid"];
	        $productInfo["condition"]   = $row["item_condition"];
		$productInfo["size"]	    = $row["item_size"];
		$productInfo["category"]    = $row["category"];
		$productInfo["postdate"]    = $row["post_date"];
		$productInfo["description"] = $row["description"];
		$productInfo["picture"]     = $row["picture"];
		$productInfo["seller"] 	    = $row["seller_username"];
		$productInfo["price"] 	    = $row["price"];
		$productInfo["name"] 	    = $row["item_name"];
    		
	}
?>

     
    <header>
        <h1>Product Page</h1>
    </header>

    <div class="product-container">

        <img src=<?php echo $productInfo['picture']; ?>>

        <h1><?php echo  $productInfo['name']; ?></h1>
        <p>$<?php echo $productInfo['price']; ?></p>
        <br>
        <p>seller: <?php echo $productInfo['seller']; ?></p>
        <br>
        <button>Add to Cart</button>

        <div class="details-section">
            <h4> <?php echo $productInfo['category']; ?> </h4>
            <p>Description: <?php echo $productInfo['description']; ?></p>
            <p>Post Date: <?php echo $productInfo['postdate']; ?> </p>
            <p>Condition: <?php echo $productInfo['condition']; ?></p>
            <h2>Product Details</h2>
            <p>Dimensions:<?php echo $productinfo['size']; ?></p>
        </div>

        <div class="reviews-section">
            <h2>Customer Reviews</h2>
            <!-- Add dynamic content using JavaScript for reviews -->
        </div>

        <!-- Related Products section? -->

    </div>

