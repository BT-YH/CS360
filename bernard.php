

<?php
session_start(); 
include_once("db_connect.php");

// Generate code to compose a messaging form to to send to another user
//the message does not update the messages table, but 
// it select a user to send to, but we have a helper method called send message which updates the messaging table 

// function genComposeForm($db, $sender) {
//     echo "<form name='compose' action='ndashboard.php?menu=send' method='post'>";
    
//     echo "<select name='rec_username'>";
//     $sql = "SELECT username, fname, lname FROM USER WHERE username != '$sender'";
//     $res = $db->query($sql);
    
//     if ($res != FALSE) {
//         while ($row = $res->fetch()) {
//             $recUsername = $row['username'];
//             $recFullName = $row['fname'] . ' ' . $row['lname'];
//             echo "<option value='$recUsername'>$recFullName</option>";
//         }
//     }
//     echo "</select><br>";
    
//     echo "<input type='hidden' name='sender' value='$sender'>";
//     echo "Subject: <input type='text' name='subject' placeholder='type subject here'><br>";
//     echo "Message: <textarea rows='5' cols='30' name='content'></textarea><br>";
//     echo "<input type='submit' value='Send!'>";
    
//     echo "</form>";
// }


// Generate code to compose a messaging form to to send to another user
//the message does not update the messages table, but 
// it select a user to send to, but we have a helper method called send message which updates the messaging table 

function genComposeForm($db, $sender) {
    echo "<form name='compose' action='message.php?menu=send' method='post'>";
    
   

    echo "<SELECT name ='rid'>"; 
    echo "test";
    $sql = "SELECT * FROM USER"; 
    echo "test";
    $res = $db->query($sql);
    echo "test";


    if ($res != FALSE) {
        echo"hello"; 
        while ($row = $res->fetch()) {
            $recUsername = $row['username'];
            $recFullName = $row['fname']; 
            echo "<option value='$recUsername'>$recFullName</option>";
        }
    }
    else{
        echo"The was an error in you query"; 
    }
    echo "</select><br>";
    
    echo "<input type='hidden' name='sender' value='$sender'>";
    echo "Subject: <input type='text' name='subject' placeholder='type subject here'><br>";
    echo "Message: <textarea rows='5' cols='30' name='content'></textarea><br>";

    echo "<input type='submit' value='Send!'>";
    
    echo "</form>";
}




// Sends a message to a user based on the geCompose form 
//the menu is changed to send from GenCompose form and the informatio from the compose form is but into the $mailData portion
// the messaging table is then adjusted based on what the compose form provideds 
// function sendMessage($db, $mailData) {
//     $sender = $mailData['sender'];
//     $receiver = $mailData['rec_username'];
//     $subject = $mailData['subject'];
//     $content = $mailData['content'];

//     $sql = "INSERT INTO MESSAGES (msg_date, msg_subject, msg_content, sender_username, rec_username) " 
//          . "VALUES (NOW(), '$subject', '$content', '$sender', '$receiver')";
    
//     $res = $db->query($sql);

//     if ($res != FALSE) {
//         echo "<h3>Successfully sent message to $receiver</h3>";
//     } else {
//         echo "<h3>Failed to send message to $receiver</h3>";
//     }
// }

// function sendMessage($db, $mailData){
//     $sender = $mailData['sender']; 
//     $reciever = $mailData['recUsername']; 
//     $subject = $mailData['subject']; 
//     $content = $mailData['content']; 
//     $currentdate = date('Y-m-d'); 
    

//     $sql = "INSERT INTO MESSAGES (msg_content, msg_date, msg_subject, rec_username, sender_username)".
//     "VALUES($content,$currentdate, $subject, $reciever,$sender )"; 
//     $res = $db->query($sql); 

//     if($res!=false){
//         echo "<h3>Successfully sent message to send</h3>";

//     }
//     else{

//         echo "<h3>Failed to send message to send</h3>";    
//     }
// }

function sendMessage($db, $mailData){
    $sender = $mailData['sender']; 
    $receiver = $mailData['rid']; 
    $subject = $mailData['subject']; 
    $content = $mailData['content']; 
    $currentdate = date('Y-m-d'); 

    $user= $_SESSION['username']; 
    echo "<p>user: $user</p>"; 

    // Corrected SQL query with single quotes around string values
    $sql = "INSERT INTO MESSAGES (msg_content, msg_date, msg_subject, rec_username, sender_username) " .
           "VALUES ('$content', '$currentdate', '$subject', '$receiver', '$sender')";
           echo "<p>sql: $sql</p>"; 

    $res = $db->query($sql); 

    if($res !== false){
        echo "<h3>Successfully sent message </h3>";
    }
    else{
        echo "<h3>Failed to send message </h3>";    
    }
}




// Show inbox of the given user

function showInbox($db, $username) {
    $sql = "SELECT msg_date, msg_subject, sender_username 
            FROM MESSAGES 
            WHERE rec_username='$username'";

    echo "<P>$sql</P>"; 

    $res = $db->query($sql);

    echo "<table>"; 
    echo "<tr><th>From</th><th>Received</th><th>Subject</th></tr>";

    if ($res != FALSE) {
        while ($row = $res->fetch()) {
            $sender = $row['sender_username'];
            $subject = $row['msg_subject'];
            $date = $row['msg_date'];
            
            echo "<tr><td>$sender</td><td>$date</td><td>$subject</td></tr>";
        }
    }
    echo "</table>";
}

// Show drop-down list of users for history
function showHistoryForm($db, $username) {
    echo "<form name='fmHistory' action='message.php?menu=showHistory' method='POST'>";
    
    echo "<select name='fid'>";
    $sql = "SELECT username, fname, lname FROM USER WHERE username != '$username'";
    $res = $db->query($sql);

    if ($res != FALSE) {
        while ($row = $res->fetch()) {
            $recUsername = $row['username'];
            $recFullName = $row['fname'] . ' ' . $row['lname'];
            echo "<option value='$recUsername'>$recFullName</option>";
        }
    }
    echo "</select>";
    
    echo "<input type='submit' value='Show History'>";
    echo "</form>";
}

function showHistory($db,$historydata, $sender){
    $recipent = $historydata['fid']; 
    $sql = "SELECT * FROM MESSAGES join USER on username = sender_username
            WHERE (rec_username='$recipent' AND sender_username= '$sender') OR  
                  (rec_username='$sender' AND sender_username= '$recipent') ";
    //echo "<P>$sql</P>"; 

    $sql1 = "SELECT USER1.fname AS fname, USER1.lname AS lname, USER2.fname AS sender_fname, USER2.lname AS sender_lname, MESSAGES.msg_subject, MESSAGES.msg_content
    FROM MESSAGES JOIN USER AS USER1 ON MESSAGES.sender_username = USER1.username
    JOIN USER AS USER2 ON MESSAGES.rec_username = USER2.username
    WHERE (rec_username='$recipent' AND sender_username= '$sender')
    OR (rec_username='$sender' AND sender_username= '$recipent')";

    echo"<p>$sql1</p>"; 
    $res = $db->query($sql1); 

    while($row = $res->fetch()){
        $reciever = $row['fname'] . " " . $row['lname']; 
        $sender = $row['sender_fname']. " " .$row['sender_lname']; 
        $subject = $row['msg_subject']; 
        $content = $row['msg_content']; 

        echo"<p>$reciever to $sender</p>"; 
        echo"<p>$subject</p>";
        echo"<p>$content</p>";   
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