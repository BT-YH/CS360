<?php
session_start();

include_once("db_connect.php");

function showLoginForm($db) {
?>
    <FORM name='fmLogin' method='POST' action='?menu=login'>
    <INPUT type='text' name='username' size='15' placeholder='username' style="margin-right: 10px" />
    <br/>
    <INPUT type='password' name='password' size='15' placeholder='password' style="margin-right: 10px" />
    <br/>
    <INPUT type='submit' name = 'button' value='Log in' style="margin-right: 10px"/>
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
?>
