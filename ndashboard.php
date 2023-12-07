
<!DOCTYPE html>
<html>

<head>
    <title>Your Page Title</title>
    <style>
        .topbanner {
            height: 20%;
            width: 90%;
            background-color: white;
            padding-left: 20px;
            padding-right: 30px;
            padding-top: 20px;
        }
        .topnav {
            height: 10%;
            width: 90%;
            background-color: white;
            padding-left: 20px;
            padding-right: 30px;
            padding-top: 20px;
        }
        .user-icon {
            width: 40px; /* Adjust the width as needed */
            height: 40px; /* Adjust the height as needed */
        }

        .cartItems{
            height: 60%;
            width: 20%;
            background-color: white;
            padding-right: 10px;
            padding-right: 10px;
            padding-top: 10px; 
            padding-bottom: 10px; 
        }
        .right-content {
            padding-top: 60px; 
            text-align: right;
            padding-right: 5px; 
        }

        .centerleft{
        }


 
    </style>
    <?php
    $menu = "inbox"; 

    if(isset($_GET['menu'])){
        $menu = $GET['menu']; 
    }

    $username = "cummbe01"; 

    ?> 
</head>

<body>
    <div class="container">
        <div class="row topbanner">
            <div class="col-4" style="font-size: 30px; color: blue;">Gettysburg College Marketplace</div>
        </div>

        <div class="row topnav">
            <div class="col-8" style="font-size: 17px; color: black;">
                <a href="AccountSettings.php" style="text-decoration: none; color: black;">Account Settings</a> &nbsp;
                <a href="landingpage.php" style="text-decoration: none; color: black;">Payment Info</a>
                <a href= "message.php"style="text-decoration: none; color: black;">Send Message</a>
            </div>
            <div class="col-4" style="text-align: right">
                Clark Ken &nbsp;
                UID: *****_****
                <br>
                <img src="data:image/png;base64,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" name="image" alt="user "> </img>
            </div>
        </div>

        <div class="row right-content" style ="width:30%; float: right;  ">
        

            <div style ="width:100%; float:center; margin-bottom:10px;  " > 
                Cart | 2 Items 
                <img class= "right-cart" src="data:image/png;base64,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" alt="carticon" height ="45" width = "100">
                <br>
                
            </div>
            <div style ="width:50%; float:left;  ">
            <img  src="https://m.media-amazon.com/images/I/71HdgTLGUSL._AC_UF1000,1000_QL80_.jpg" alt="physics textbook" height="100" width = "100"> <br>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSp06jA9Fgd-QT5KtO-OjwKq16MnQxPOqEHhkbVg_i-ljoAtDlQSFW-MKoWHpQKDgqAJqg&usqp=CAU" alt="ti-84 calculator" height="100" width = "100">    


  
            </div>
            <div style="width: 45%; float:right;"> 
            Fundmentals of Physics <br>
            Condtion lightly Used 
            Price 29:99
            Seller: ___________
            </div>
            
            <br>
            <br> 

            <div style= "width: 45%; float:right; margin-top: 20px">
            TI-84 black <br> 
            calculator <br>
            Condtion:Used <br>
            Price: 59.99
            Seller _______________
            </div>

            <div style= "width: 45%; float:right; margin-top: 20px">
            Total: 85.98
            </div>
        </div>

        <div class="row centerleft" style="width: 70%; height: 20%; float: center; border: 1px solid black;">
            <div style = "float: right; width: 10%; height: 10%; font-size:20px;  border: 1px solid black">
            Your orders
            </div>
            <br>
            <img src="" alt="">
            <a href="landingpage.php">

            <img src="https://i5.walmartimages.com/seo/Fender-CD-60S-LH-Left-handed-Acoustic-Guitar_4c4709f3-6dd7-4107-a3f2-c9e2fe4121a8.86d9bd6bba4567a72159766bc4260f19.jpeg?odnHeight=640&odnWidth=640&odnBg=FFFFFF" alt="guiatar" height="200" width="250">
             </a>

             <a href="landingpage.php">
             <img src="https://images.hometownapparel.com/images/644/A15-NVY-D1-WT-LT9233.jpg" alt="gettysburg hoodie" height ="200" width ="250">
            </a>

            <a href="landingpage.php">

            <img src="https://m.media-amazon.com/images/I/61JGJcZJfDL._AC_UF1000,1000_QL80_.jpg" alt="computer scinece textbook" height= "200" width = "250">
    </a>
        </div>

        <div class="row" style = "width:70%; height:20% float:center; border: 1px solid black">
             <div style="float: right; width: 10%; height: 10%; font-size:20px;  border: 1px solid black">
             Your listings
            </div>

            <a href="landingpage.php">
            <img src="data:image/jpeg;base64,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" alt="laptop">
            </a>

            <a href="landingpage.php">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShRYvUNniLH3FFjOPKYIlnXv_8WiNxJbsK631wFmchKNGYk2-Y9e_BRtECeQOiDZ0qQXE&usqp=CAU" alt="calculus textbook">
            </a>
        </div>




    </div>
</body>

</html>
