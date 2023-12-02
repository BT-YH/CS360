<?php
// Generate code to compose a messaging form to to send to another user
//the message does not update the messages table, but 
// it select a user to send to, but we have a helper method called send message which updates the messaging table 

function genComposeForm($db, $sender) {
    echo "<form name='compose' action='ndashboard.php?menu=send' method='post'>";
    
    echo "<select name='rec_username'>";
    $sql = "SELECT username, fname, lname FROM USER WHERE username != '$sender'";
    $res = $db->query($sql);
    
    if ($res != FALSE) {
        while ($row = $res->fetch()) {
            $recUsername = $row['username'];
            $recFullName = $row['fname'] . ' ' . $row['lname'];
            echo "<option value='$recUsername'>$recFullName</option>";
        }
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
function sendMessage($db, $mailData) {
    $sender = $mailData['sender'];
    $receiver = $mailData['rec_username'];
    $subject = $mailData['subject'];
    $content = $mailData['content'];

    $sql = "INSERT INTO MESSAGES (msg_date, msg_subject, msg_content, sender_username, rec_username) " 
         . "VALUES (NOW(), '$subject', '$content', '$sender', '$receiver')";
    
    $res = $db->query($sql);

    if ($res != FALSE) {
        echo "<h3>Successfully sent message to $receiver</h3>";
    } else {
        echo "<h3>Failed to send message to $receiver</h3>";
    }
}

// Show inbox of the given user
function showInbox($db, $username) {
    $sql = "SELECT msg_date, msg_subject, sender_username FROM MESSAGES WHERE rec_username='$username'";
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
    echo "<form name='fmHistory' action='dashboard.php?menu=showHistory' method='POST'>";
    
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


?>