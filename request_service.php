<!DOCTYPE html>
<html lang="en">

<?php
include('function.php');
session_start();
//if user is not logged in, they cant access this page
checkSESSION();
logout();
// connect to database
$con = ConnectToDB();

$query=" select * from users "; 
$result=mysqli_query($con, $query); 
while($rows=mysqli_fetch_array($result)) // למלא נתונים אוטמטיים על המשתמש שמחובר לאתר 
 {
    if($rows['username']==$_SESSION['username']) 
    {
        $fromU =$rows['username'];
        $phone =$rows['phone']; 
        $email =$rows['email'];
        $date=date("l jS \of F Y h:i:s A");
        if($_SESSION['username']!= "admin")
        {
            $toU="admin";
        }
    }
        
 }

 
if (isset($_POST['btn_create'])) // to sent request for service
 { 
    $typeservice= mysqli_real_escape_string($con,$_POST['typeservice']);   
    $text = mysqli_real_escape_string($con,$_POST['text']);
    $sql = "insert into _message( fromU,toU,typeservice,phone,email,date,text) values ('$fromU','$toU','$typeservice','$phone','$email','$date','$text');";
    if($con->query($sql) === TRUE){ 
        echo '<script>alert("sent request")</script>';
        $query_id = mysqli_query($con, "SELECT id FROM _message WHERE toU='$toU'");
        $rows_id=mysqli_fetch_array($query_id);
        header("Refresh:1; url=message_DB.php");
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

    <form class="res_form" method="post" action="request_service.php">
        <h2>הודעה חדשה</h2>

        <div class="input-group">
            <label>סוג שירות:</label>
        </div>
        <div>
            טיפול
            <input type="radio" name="typeservice" value="טיפול" required>
            תקלה
            <input type="radio" name="typeservice" value="תקלה" required>
            בדיקה
            <input type="radio" name="typeservice" value="בדיקה" required>
            הודעה
            <input type="radio" name="typeservice" value="הודעה" required>
        </div>
        <div class="input-group">
            <label>הודעה:</label>
            <textarea type="text" name="text" placeholder="הודעה" rows="8" required></textarea>
        </div>
        <div class="input-group">
            <button type="submit" name="btn_create" class="btn">שלח</button>
        </div>
    </form>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>