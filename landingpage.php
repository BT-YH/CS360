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
    }
}

$username = $_SESSION['username'];
$fname = getName($db, $username);
     ?>

</HEAD>
<BODY>
    <table style="width:100%"> 
  <tr>
  <td style="width:10%">
    <img src = "https://www.gettysburg.edu/main/images/apple-touch-icon-152x152.png"></img>
    </td>
   <td style="width:20%">
   <H1><i><span style="color: #002F6c";>Gettysburg</span><br/>
   <span style="color:#E87722";> College </span><br/>
   <span style="color: #002F6c";>Marketplace</span></i></H1>
    </td>
    <td align = "right">
    <?php
    if (isset($_SESSION['username'])) {?>
        <H4 style="margin-right: 10px">Welcome, <a href="ndashboard.php"><?php echo $fname?></a> &nbsp&nbsp&nbsp&nbsp&nbspCart|? items <img src ="https://www.clker.com/cliparts/z/Y/x/l/A/c/shopping-cart-navy-hi.png" width = "20" height = "20"</img></H4>
        <?php showLogoutForm();
    }
    else {
        showLoginForm($db);
    }
?>
    <br/>
    <br/>
    <br/>
    <FORM name='fmSearch' method='POST' action='op=search'>
    <INPUT type='text' name='search' size='20' placeholder='Search for anything' />
   <select id="categories" name="categories" style ="padding = 10px">
    <option value="AllCategories">All Categories</option>
    <option value="CourseMaterials">Course Materials</option>
    <option value="Technology">Technology</option>
    <option value="Fashion">Fashion</option>
    <option value="StudentEssentials">Student Essentials</option>
  </select>
   <INPUT type='submit' value='Search' style="margin-right: 10px" />
    </FORM>
    </td>
    </tr>
   </table>
<nav class="nav nav-pills nav-fill border-top 2px border-bottom 2px">
  <a class="nav-item nav-link" href="#">Course Materials</a>
  <a class="nav-item nav-link" href="#">Technology</a>
  <a class="nav-item nav-link" href="#">Fashion</a>
  <a class="nav-item nav-link" href="#">Student Essentials</a>
  <a class="nav-item nav-link" href="#">Entertainment</a>  
</nav>

<DIV class="row">
<H2><b>Featured Products</b></H2>
</DIV>
<DIV class="row">
<img src = "https://gettysburg.bncollege.com/medias/must-haves-school-color.png?context=bWFzdGVyfHJvb3R8NTI2ODkwfGltYWdlL3BuZ3xhR1l6TDJoaFlpOHlOamt4TURBMk1UZzFORGMxTUM5dGRYTjBYMmhoZG1WelgzTmphRzl2YkY5amIyeHZjaTV3Ym1jfDFjY2FhNTFkYmViMjg3YjgzMjAzNGI2YTg5YmMyMDI0YzgzZGRiZGIyMGE0Y2ZhZjk1ZWJlNDcyZmRiMWQ2N2I"
height="300" width="auto"></img>
</DIV>
<DIV class="row">
<H2><b>Recommended Products</b></H2>
</DIV>
<DIV class = "container" style = "text-align: center">
<DIV class="row">
<DIV class = "col-2">
<img src ="https://ih1.redbubble.net/image.1196636959.2471/st,small,507x507-pad,600x600,f8f8f8.jpg" height ="200" width = "150"></img>
</DIV>
<DIV class = "col-2">
<img src ="https://images.footballfanatics.com/gettysburg-bullets/gettysburg-college-champion-jersey-short-sleeve-t-shirt-navy_ss10_p-100797648+u-tvvzialj6ngp73mi6qel+v-3ha6ijmm8mcg7ipnk28s.jpg?_hv=2&w=600" height ="200" width = "150"></img>
</DIV>
<DIV class = "col-2">
<img src ="https://m.media-amazon.com/images/I/71kBRLo8ZtL._AC_UF1000,1000_QL80_.jpg" height ="200" width = "150"></img>
</DIV>
<DIV class = "col-2">
<img src ="https://m.media-amazon.com/images/I/71OL7PXfOeL.jpg" height ="200" width = "150"></img>
</DIV>
<DIV class = "col-2">
<img src ="https://m.media-amazon.com/images/I/81+lwBghWBL._AC_UF1000,1000_QL80_.jpg" height ="200" width = "150"></img>
</DIV>
<DIV class = "col-2">
<img src ="https://static.helixbeta.com/prod/8308/0268/8308_643120268.JPG" height ="200" width = "150"></img>
</DIV>
</DIV>
</DIV>
</BODY>
</HTML>
