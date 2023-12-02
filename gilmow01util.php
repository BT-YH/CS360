<?php
session_start();

include_once("db_connect.php");

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
function showLogoutForm() {
?>
    <FORM name='fmLogout' method='POST' action='?menu=logout'>
    <INPUT type='submit' value='Logout' style="margin-right: 10px" />
    </FORM>
<?php
}

function showBanForm($db){ ?>
    <FORM name = 'fmBan' method = 'POST' action = '?menu=ban'>
    </table> <?php
        $sql = "SELECT end_username
                FROM END_USER";
        $res = $db->query($sql);
        if ($res != FALSE){
        ?>
        <TABLE> 
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
?>
