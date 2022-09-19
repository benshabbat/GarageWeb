<!DOCTYPE html>
<html lang="en">

<?php
include('function.php'); 
session_start();
checkSESSION();  
logout();

// connect to database 
$con = ConnectToDB();

$valid_name=false;
   //if user is not logged in, they cant access this page
$query=" select * from users "; 
$result=mysqli_query($con, $query);
   
while($rows=mysqli_fetch_array($result)) // מכניס נתנונים אוטמטיים לדאטה בייס לפי היוסר שמחובר לאתר
 {
    if($rows['username']==$_SESSION['username']) 
    {
        $fromU = $rows['username'];
        $phone = $rows['phone']; 
        $email = $rows['email'];
        $typeservice = ("הודעה");
        $date=date("l jS \of F Y h:i:s A");
        if($_SESSION['username']!= "admin"){$toU="admin";}

    }   
}

if (isset($_POST['sendMessage'])) { // create web account        
    $toU = isset($_POST['taskOption']) ? $_POST['taskOption'] : false;
    $text = mysqli_real_escape_string($con,$_POST['text']);
    $query_name = mysqli_query($con, " select * from users where username like '%$toU%' ");
    $rows_name = mysqli_num_rows($query_name);
    if($rows_name > 0) {// if The username already exist in the DB
        $valid_name=true;
    }
    if($valid_name == true) {
        $sql = "insert into message( fromU,toU,phone,typeservice,email,date,text) 
        values ('$fromU','$toU','$phone','$typeservice','$email','$date','$text');";
            if($con->query($sql) === TRUE){ 
            echo '<script>alert("message sent")</script>';
            $query_id = mysqli_query($con, "SELECT id FROM message WHERE toU='$toU'");
            $rows_id=mysqli_fetch_array($query_id);
         
            header("Refresh:1; url=new_message.php");
            mysqli_close($con);
            exit();
        }}
        else
        {
            echo '<script>alert("Unsuccessfully")</script>';
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
    <header><?php nav(); ?></header>
    <form class="res_form" method="post" action="new_message.php">
        <h2>הודעה חדשה</h2>
        <div class="input-group">
            <label>למי</label>
            <?php $search_result=mysqli_query($con,"select * from users")?>
            <select name="taskOption">
                <?php while($row=mysqli_fetch_array($search_result)):?>
                <?php if($row['username']!=$_SESSION['username']):?>
                <option>
                    <?php echo $row['username'];?>
                </option>
                <?php endif;?>
                <?php endwhile;?>
            </select>
        </div>
        <div class="input-group">
            <label>הודעה:</label>
            <textarea type="text" name="text" placeholder="הודעה" rows="8"  autocomplete="off" required></textarea>
        </div>

        <div class="input-group">
            <button type="submit" name="sendMessage" class="btn">שלח</button>
        </div>
    </form>


</body>

</html>