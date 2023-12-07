

<?php
session_start(); 
include_once("db_connect.php");

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





function showInbox($db, $username) {
    $sql = "SELECT U2.fname AS senderfname, U2.lname AS senderlname, MESSAGES.msg_date, MESSAGES.msg_subject 
            FROM MESSAGES 
            JOIN USER AS U1 ON MESSAGES.rec_username = U1.username
            JOIN USER AS U2 ON MESSAGES.sender_username = U2.username
            WHERE MESSAGES.rec_username = '$username'
            "; 
            

     

    $res = $db->query($sql);

    // CSS styles
    echo "<style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:hover {background-color: #f5f5f5;}
          </style>";

    echo "<table>"; 
    echo "<tr><th>From</th><th>Received</th><th>Subject</th></tr>";

    if ($res != FALSE) {
        while ($row = $res->fetch()) {
            $sender = $row['senderfname'];
            $subject = $row['msg_subject'];
            $date = $row['msg_date'];
            
            echo "<tr><td>$sender</td><td>$date</td><td>$subject</td></tr>";
        }
    } else {
        echo"<h3>Failed to execute</h3>"; 
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

function showHistory($db, $historydata, $sender){
    $recipient = $historydata['fid']; 

    
    $sql1 = "SELECT USER1.fname AS fname, USER1.lname AS lname, USER2.fname AS sender_fname, USER2.lname AS sender_lname, MESSAGES.msg_subject, MESSAGES.msg_content, MESSAGES.msg_date, MESSAGES.msg_date
    FROM MESSAGES JOIN USER AS USER1 ON MESSAGES.sender_username = USER1.username
    JOIN USER AS USER2 ON MESSAGES.rec_username = USER2.username
    WHERE (rec_username='$recipient' AND sender_username= '$sender')
    OR (rec_username='$sender' AND sender_username= '$recipient')";

    

    
    ?>
    <STYLE>
        .message-table {
            width: 100%;
            border-collapse: collapse;
        }

        .message-table th, .message-table td {
            border: 1px solid #DDD;
            padding: 8px;
            text-align: left;
        }
        .message-table th {
            background-color: #6495FD;
            color: white;
        }
        
        .message-table tr:nth-child(even) {
            background-color: #A0C0F0;
        }

        .message-table tr:nth-child(odd) {
            background-color: #A0F0C0;
        }
    </STYLE>
    <?php

    $res = $db->query($sql1);

    echo "<table class='message-table'>";
    echo "<tr><th>Recipient</th><th>Sender</th><th>Subject</th><th>Message</th><th>Date</th></tr>";

    while($row = $res->fetch()){
        $receiver = $row['sender_fname'] . " " . $row['sender_lname']; 
        $senderName = $row['fname']. " " .$row['lname']; 
        $subject = $row['msg_subject']; 
        $content = $row['msg_content'];
        $date = $row['msg_date'];

        echo "<tr>";
        echo "<td>$receiver</td>"; 
        echo "<td>$senderName</td>";
        echo "<td>$subject</td>";
        echo "<td>$content</td>";
        echo "<td>$date</td>";
        echo "</tr>";   
    }

    echo "</table>";
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


function genUpdateForm() {
    echo "<form name='updateInfo' action='AccountSettings.php' method='post'>";

    echo "First Name: <input type='text' name='firstname' placeholder='New First Name'><br>";
    echo "Last Name: <input type='text' name='lastname' placeholder='New Last Name'><br>";
    echo "Password: <input type='text' name='password' placeholder='New Password'><br>";  
    echo "<input type='submit' value='Update Info'>";
    echo "</form>";
}

function updateUserInfo($db) {
    session_start();
    $username = $_SESSION['username'];

    // Assign default values if POST variables are not set
    $firstname = '';
    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }

    $lastname = '';
    if (isset($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
    }

    $password = '';
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    $updates = [];
    if (!empty($firstname)) {
        $updates[] = "fname = '$firstname'";
    }
    if (!empty($lastname)) {
        $updates[] = "lname = '$lastname'";
    }
    if (!empty($password)) {
        $updates[] = "password = '" . md5($password) . "'";
    }

    if (count($updates) > 0) {
        $sql = "UPDATE USER SET " . implode(', ', $updates) . " WHERE username = '$username'";
        $res = $db->query($sql);

        if ($res !== false) {
            echo "<h3>Successfully updated user information</h3>";
        } else {
            echo "<h3>Failed to update user information</h3>";
        }
    } else {
        echo "<h3>No information to update</h3>";
    }
}


function genUpdatePaymentInfo(){
    echo '<form action="PaymentInfo.php" method="post">';
    echo '<label for="address">Enter new Address:</label>';
    echo ' <input type="text" name="address" placeholder="Enter new Address">';
    echo '<input type="submit" value="Update">';
    echo '</form>';
}


function userPaymentInfo($db){

    print_r($_POST); 

    session_start(); 
    $username = $_SESSION['username']; 

    $address = ''; 

    if(isset($_POST['address'])){
        $address = $_POST['address']; 
    }

    echo"address: 
    $address"; 
    $updates = []; 
    if(!empty($address)){
        $updates[] = "end_address = '$address'";
        }

    if(isset($_POST['address'])){
        // $sql = "UPDATE END_USER SET " . implode(', ', $updates) . " WHERE end_username = '$username'";
        $sql = "UPDATE END_USER SET end_address = '$address' WHERE end_username = '$username'"; 
        echo"$sql"; 
        $res = $db->query($sql); 

        if($res!==false){
            echo "<h3>Successfully updated user information</h3>";
        }
        else{
            echo "<h3>Failed to update user information</h3>";
        }
    }else{
        echo "<h3>No information to update</h3>";
    } 
}
