
<?php
session_start();
include("util.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    </style>

<?php
$op = "main";

if (isset($_GET['op'])) {
    $op = $_GET['op'];

    if ($op == 'addingToCart') {
        $iid = $_POST["iid"];
	    checkStatus($db, $iid);
	    header("refresh:0.1; url=products.php?op=main \n");
    }
}
?>

</head>



<body>
    <header>
        <h1>College Marketplace</h1>
    </header>
    <p> 
    
    <a href="landingpage.php" style="text-decoration: none; color: black; 
        background-color: #e0e0e0; margin-left: 20px; padding: 10px 20px; 
        border-radius: 5px; font-weight: bold; display: inline-block; text-align: center;">Main Page</a>

    
    </p>
    <div class="container">

        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Filters</h2>
            <label for="lowerPrice">
                <input type="number" min='0' id="lowerPrice" placeholder='lower bound'> 
            </label>
            <label for="upperPrice">
                <input type="number" min='0' id="upperPrice" placeholder='upper bound'> 
            </label>
            <label for="priceFilter">
                <input type="checkbox" id="priceFilter"> Price
            </label>

            <br>
            <br>
            <label>
                <input type="number" min='0' max='5' id="lowerRate" placeholder='lower bound'> 
                <input type="number" min='0' max='5' id="upperRate" placeholder='upper bound'> 
                <input type="checkbox" id="ratingFilter"> Ratings
            </label>
            <br>
            <br>
            <label for="category">
                <input type="text"  id="category" placeholder='category'> 
	    </label>
	    <label for="categoryFilter">
                <input type="checkbox" id="categoryFilter"> Category
            </label>
            <br>
            <br>
            <!-- Add more filter options as needed -->

            <button onclick="applyFilters()">Apply Filters</button>
        </div>

        <!-- Product Container -->
        <div class="product-container">
	
	<?php 
	display_products($db);
	?>

    </div>





    <script>
        function applyFilters() {
            // Get selected filter options
            const priceFilter = document.getElementById('priceFilter').checked;
            const ratingFilter = document.getElementById('ratingFilter').checked;
            const categoryFilter = document.getElementById('categoryFilter').checked;

            // Get all product elements
            const products = document.querySelectorAll('.product');

            // Apply filters
            products.forEach(product => {
            if (priceFilter) {
                    productPrice = parseInt(product.getAttribute('data-price'));
                    lower = parseInt(document.getElementById("lowerPrice").value);
                    upper = parseInt(document.getElementById("upperPrice").value);

                    if (lower > upper) {
                        [lower, upper] = [upper, lower];
                    }

                    if ((productPrice < lower) || (productPrice > upper)) {

                        product.style.display = 'none';
                    }
            } else if (ratingFilter) {
                    productPrice = parseInt(product.getAttribute('data-rating'));
	 	            lower = parseInt(document.getElementById("lowerRate").value);
                    upper = parseInt(document.getElementById("upperRate").value);
		            if (lower > upper) {
                        [lower, upper] = [upper, lower];
                    }

                    if ((productPrice < lower) || (productPrice > upper)) {
                        product.style.display = 'none';
                    }
		    } else if (categoryFilter) {
		            productCategory = product.getAttribute('data-category');
                    category = document.getElementById("category").value;
                    console.log("Input Value: ", category);
		            if (category != productCategory) {
			            product.style.display = 'none';
                    }
		    } else {
                    product.style.display = 'flex';
                }
                });
            }
    </script>

</body>
</html>
