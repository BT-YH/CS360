<?php
session_start();

include_once("db_connect.php");

// special hashmap variable: $_POST

if (isset($_POST['recipient'])) {
    echo "<PRE>\n";
    // $uname = getName($db, $uid);
    print_r($_POST);
    echo "</PRE>\n";

    // process mail

}

/*
INSERT INTO titan1 VALUE(10, 'Robin');
INSERT INTO titan1 VALUE(20, 'Starfire');
INSERT INTO titan1 VALUE(30, 'Raven');
INSERT INTO titan1 VALUE(40, 'Beast Boy');
INSERT INTO titan1 VALUE(50, 'Cyborg');
*/


function addTitans($db, $data) {
    echo "<PRE>\n";
    print_r($data); // recursive print
    echo "</PRE>\n";

    $id     = $data['id'];
    $name   = $data['name'];
    $planet   = $data['planet'];
    $power   = $data['power'];

    $sql1 = "INSERT INTO titan1 VALUE($id, '$name')";
    $sql2 = "INSERT INTO titan2 VALUE($id, '$planet', '$power')";

    $res1 = $db->query($sql1);
    $res2 = $db->query($sql2);

    header("refresh:5;url=test.php");
    if ($res1 != FALSE && $res2 != FALSE) {
        echo "<He>Successfully added $name ($id) to Teen Titans</H3>\n";
    } 
    else {
        echo "<He>Failed to add $name ($id) to Teen Titans</H3>\n";
    }
}


function deleteTitans($db, $data) {
    echo "<PRE>\n";
    print_r($data); // recursive print
    echo "</PRE>\n";

    // handle radio button
    if (isset($data['rb'])) {
        $rid = $data['rb'];
        $sql = "DELETE FROM titan1 WHERE id=$rid";
        $res = $db->query($sql);

        if ($res == FALSE) {
            header("refresh:1;url=test.php");
            echo "<H3>Error deleting $rid form titan1</H3>\n";
        } 
        else {
            header("refresh:1;url=test.php");
            echo "<He>Successfully deleted $rid from titan1</H3>\n";
        }
    }

    // handle checkbox
    if (isset($data['cb'])) {
        $ids = $data['cb'];
        $count = 0;

        // if in Java
        // for ($rid : $ids) {}

        foreach ($ids as $rid) {

        // for ($i = 0; $i < count($ids); ++$i) {
            // $rid = $ids[$i];
            $sql = "DELETE FROM titan1 WHERE id=$rid";
            $res = $db->query($sql);

            if ($res != FALSE) {
                ++$count;
            } 
        }

        header("refresh:2;url=test.php");
        echo "<H3>Successfully deleted $count out of " . count($ids) . "</H3>\n";
    }

}


function showLoginForm($db) {
?>
    <FORM name='fmLogin' method='POST' action='dashboard.php?menu=login'>
    <INPUT type='text' name='uid' size='4' placeholder='user id' />
    <INPUT type='submit' value='Log in' />
    </FORM>
<?php
}

function showLogoutForm() {
?>
    <FORM name='fmLogout' method='POST' action='dashboard.php?menu=logout'>
    <INPUT type='submit' value='Logout' />
    </FORM>
<?php
}

// geneartes an HTML form for sending a message
function genComposeForm($db, $sid) {
    

    // start a form 
    echo "<FORM name='compose' action='dashboard.php?menu=send' method='POST'>\n";
        // method='get' exposes all user data

    // access database to find all users
    // create a combo box (drop-down-list)
    echo "<SELECT name='rid'>\n";

    $sql = "SELECT * FROM titan1";
    $res = $db->query($sql);

    if ($res != FALSE) {
        while ($row = $res->fetch()) {
            $id = $row['id'];
            $name = $row['name'];

            echo "<OPTION value='$id'>$name</OPTION>\n";
        }
    }  

    echo "</SELECT\n>";

    // sender id hidden field
    echo "<P><INPUT type='hidden' name='sid' value='$id' /></P>\n";

    // subject field
    echo "<P><INPUT type='text' name='subject' placeholder='type subject here' /></P>\n";

    // content field
    echo "<TEXTAREA rows='5' cols='30' name='content'></TEXTAREA>\n";

    // submit button
    echo "<P><INPUT type='submit' value='Send!' /> </P>";

    // finish the form

    echo "</FORM>\n";
}

// send a message
// insert a new row to message table
// $mailData is $_POST (hashmap)
function sendMsg($db, $mailData) {

    $sid     = $mailData['sid'];
    $rid     = $mailData['rid'];
    $subject = $mailData['subject'];
    $content = $mailData['content'];

    $sql     = "INSERT INTO message(sid, rid, subject, content, sdate) "
               . "VALUE($sid, $rid, '$subject', '$content', NOW())";

    $res = $db->query($sql);

    if ($res != FALSE) {
        header("refresh:2;url=dashboard.php?menu=inbox");
        printf("<H3>Message sent to $rid</H3>\n");
    }
    else {
        header("refresh:2;url=dashboard.php?menu=inbox");
        printf("<H3>Failed to send message to $rid</H3>\n");
    }
}   


// show inbox of the given user
function showInbox($db, $uid) {
    $sql = "SELECT * 
        FROM message JOIN titan1 ON sid=id 
        WHERE rid=$uid";

    $res = $db->query($sql);

?>

<!-- add html in the middle of php code 
1. <TH> table heading
2. <TR> row
3. <TD> col
-->

<TABLE border='1' cellpadding='16' cellspacing='50' style='padding: 5px; margin: 10px'>


<TR><TH>From</TH><TH>Received</TH><TH>Subject</TH></TH>

<?php

    if ($res != False) {
        while ($row = $res->fetch()) { // fetching each tuple
            $sid     = $row["sid"];
            $subject = $row["subject"];
            $date    = $row["sdate"];
            $sender  = $row["name"];

            echo  "<TR><TD>$sender</TD><TD>$date</TD><TD>$subject</TD></TR>\n";
        }
    } 
    else {
        // header("refresh:2;url=dashboard.php?menu=inbox");
        // printf("<H3>Failed to send message to $rid</H3>\n");
    }

    echo "</TABLE>\n";
}


//  show drop down list of users for history
function showHistoryForm($db, $uid) {
    // start a form 
    echo "<FORM name='fmHistory' action='dashboard.php?menu=showHistory' method='POST'>\n";
        // method='get' exposes all user data

    // access database to find all users
    // create a combo box (drop-down-list)
    echo "<SELECT name='fid'>\n";

    $sql = "SELECT * FROM titan1";
    $res = $db->query($sql);

    if ($res != FALSE) {
        while ($row = $res->fetch()) {
            $id = $row['id'];
            $name = $row['name'];

            echo "<OPTION value='$id'>$name</OPTION>\n";
        }
    }  

    echo "</SELECT>\n";
    echo "<INPUT type='submit' value='Show History'/>\n";
    echo "</FORM>\n";
}


// retrieve user;s name given user's id
function getName($db, $uid) {
    $sql = "SELECT name
            FROM titan1
            WHERE id=$uid";

    $res = $db->query($sql);

    if ($res != FALSE && $res->rowCount() == 1) {
        $nameRow = $res->fetch();
        return $nameRow['name'];
    } else {
        return "Unknown";
    }
}


// show history with selected user (friend)
// get all messages between $uid and $fid
// order by sdate
// display them

function showHistory($db, $uid, $fid) {

    // TODO
    $sql     = "SELECT sid, T1.name sname, rid, T2.name rname, sdate, subject, content
                FROM message JOIN titan1 T1 ON sid=T1.id
                             JOIN titan1 T2 ON rid=T2.id
                WHERE (sid=$uid AND rid=$fid) OR (sid=$fid AND rid=$uid) 
                ORDER BY sdate";

    $res = $db->query($sql);

    if ($res != FALSE) {
         
        while ($row = $res->fetch()) {
            $sid     = $row['sid'];
            $rid     = $row['rid'];
            $sname   = $row['sname'];
            $rname   = $row['rname'];
            $date    = $row['sdate'];
            $subject = $row['subject'];
            $content = $row['content'];
            
            $ustyle = 'border: 1px dashed orange; color: black; padding: 10px';
            $fstyle = 'border: 1px dotted blue;  color: black; padding: 10px';

            if ($sid == $uid) {
                echo "<P style='$ustyle'>\n";   
            } 
            else {
                echo "<P style='$fstyle'>\n";   
            }

            echo "$sname to $rname on $date <BR /><BR />\n";
            echo "$subject<BR /><BR />\n";
            echo $content;

            echo "</P>\n";
        }
    }
    else {
        echo 'error';
    }
}   
?>
