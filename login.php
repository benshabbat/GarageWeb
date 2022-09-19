<!DOCTYPE html>
<html lang="en">

<?php 
include('function.php'); 
session_start(); 
logout();

$con = ConnectToDB();// connect to database
$valid=false;



if(isset($_POST['btn_login']))// connect to username
    {
        $username = mysqli_real_escape_string($con,$_POST['username']); 
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $password = md5($password);
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        $rows = mysqli_num_rows($query);
        $row=mysqli_fetch_array($query);
    
        if($rows > 0)//check if account exist
            {  
                $_SESSION['ID'] = $row[0];
                $_SESSION['username'] = $username;
                if(check_admin()) // check if admin
                {
                    header("Refresh:1; url=admin.php");
                    mysqli_close($con);
                    exit();
                }
                else
                {
                    header("Refresh:1; url=profile.php");
                    mysqli_close($con);
                    exit();
                }
            }

        else
            {
            $valid=true;
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
    <header> <?php nav(); ?> </header>
    <form method="post" action="login.php">
        <!-- הכנסת נתונים לשדה -->
        <h2>התחברות</h2>
        <?php if($valid)echo '<label class="error">username or password is incorrect.</label>';?>
        <div class="input-group">
            <label>שם משתמש</label>
            <input type="text" name="username" placeholder="שם משתמש" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>סיסמא</label>
            <input type="password" name="password" placeholder="סיסמא" autocomplete="off" required>
        </div>
        <div class="input-group">
            <button type="submit" name="btn_login" class="btn">התחברות</button>
        </div>
    </form>

</body>

</html>