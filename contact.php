<!DOCTYPE html>
<html lang="en">

<?php
include('function.php'); 
session_start(); 
logout();

// connect to database
$con = ConnectToDB();

if (isset($_POST['btn_sendMessage']))// send message from guset to admin
 { 
    $fromU = mysqli_real_escape_string($con,$_POST['fromU']);
    $toU= ("admin");
    $typeservice = ("אורח");
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $newphone=addstrPhone($phone);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $date=date("l jS \of F Y h:i:s A");
    $text = mysqli_real_escape_string($con,$_POST['text']);
    $sql = "insert into _message( fromU,toU,typeservice,phone,email,date,text) values ('$fromU','$toU','$typeservice','$newphone','$email','$date','$text');";
    if($con->query($sql) === TRUE)
        { 
        echo '<script>alert("sent message")</script>';
        $query_id = mysqli_query($con, "SELECT id FROM _message WHERE toU='$toU'");
        $rows_id=mysqli_fetch_array($query_id);
         
        header("Refresh:1; url=login.php");
        mysqli_close($con);
        exit();
        }
    } 
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.jpg">
    <title>מוסך נגיש</title>
</head>


<body>
    <header><?php nav();?></header>


    <form class="res_form" method="POST" action="contact.php">
        <!-- הכנסת נתונים לשדה -->
        <h2>יצירת קשר</h2>
        <div class="input-group">
            <label>שם:</label>
            <input type="text" name="fromU" placeholder="שם" required>
        </div>
        <div class="input-group">
            <label>מספר טלפון:</label>
            <input type="text" name="phone" placeholder="מספר טלפון" pattern="[0-9]{3}-[0-9]{7}|[0-9]{10}"
                title="מספר טלפון חייב להיות עם הסימן (-) לדוגמא(050-1234567)" required>
        </div>
        <div class="input-group">
            <label>אימייל</label>
            <input type="text" name="email" placeholder="אימייל" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="Email must contain @ in email address, example(user@gmail.com)" required>
        </div>
        <div class="input-group">
            <label>הודעה:</label>
            <textarea type="text" name="text" placeholder="הודעה" rows="8"></textarea>
        </div>
        <div class="input-group">
            <button type="submit" name="btn_sendMessage" class="btn">שלח הודעה</button>
        </div>
    </form>
    <!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>