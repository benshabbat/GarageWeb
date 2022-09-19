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


$valid_pass = false;
$valid_name = false;
$valid_email = false;
$valid_phone = false;

if (isset($_POST['update'])) { // update user account
    if ($valid_name) {
        if ($_POST['username'] != "admin") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $phone = addstrPhone($phone);
            $password_1 = $_POST['password_1'];
            $password_2 = $_POST['password_2'];
            if ($password_1 == $password_2) {
                $password = md5($password_2);
            }
            $update_sql = "UPDATE users SET email = ' $email',phone = ' $phone',password = '$password' WHERE username = '$username'";
            $query_update = mysqli_query($con, $update_sql);
        } else {
            echo '<script>alert("update not working on admin")</script>';
        }
    } else {
        echo '<script>alert("update not working on username dont in DB")</script>';
    }
}
if (isset($_POST['register'])) { // create web account
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $newphone = addstrPhone($phone);
    $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);
    $query_name = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    $query_email = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
    $query_phone = mysqli_query($con, "SELECT phone FROM users WHERE username='$username'");

    $rows_phone = mysqli_num_rows($query_phone);
    $rows_name = mysqli_num_rows($query_name);
    $rows_email = mysqli_num_rows($query_email);
    if ($rows_email > 0) { // if The email already exist in the DB
        $valid_email = true;
    }
    if ($rows_phone > 0) { // if The phone already exist in the DB
        $valid_phone = true;
    }
    if ($rows_name > 0) { // if The username already exist in the DB
        $valid_name = true;
    }
    if ($password_1 != $password_2) { // if passwords not match
        $valid_pass = true;
    }
    if ($valid_email == false and $valid_name == false and $valid_pass == false and $valid_phone == false) {
        $password = md5($password_1);
        $sql = "insert into users(username,email,phone,password) values ('$username', '$email', '$newphone' ,'$password');";
        if ($con->query($sql) === TRUE) {
            echo '<script>alert("User Create Successfully")</script>';
            $query_id = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
            $rows_id = mysqli_fetch_array($query_id);

            header("Refresh:1; url=new_car.php");
            mysqli_close($con);
            exit();
        } else {
            echo '<script>alert("Unsuccessfully")</script>';
        }
    }
}

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.jpg">
    <title>מוסך נגיש</title>
</head>

<body>
    <header><?php nav(); ?></header>

    <form class="res_form" method="post" action="new_user.php">
        <h2>הוספת לקוח חדש</h2>
        <div class="input-group">
            <label>שם משתמש:</label>
            <?php if ($valid_name) echo '<label class="error">Name Already Exist.</label><br>'; ?>
            <input type="text" name="username" placeholder=" שם משתמש" value="<?php if (isset($username)) echo $username; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>טלפון:</label>
            <?php if ($valid_phone) echo '<label class="error">Phone Already Exist.</label>'; ?>
            <input type="text" name="phone" placeholder=" טלפון" value="<?php if (isset($phone)) echo $phone; ?>" pattern="[0-9]{3}-[0-9]{7}|[0-9]{10}" title="מספר טלפון חייב להיות עם הסימן (-) לדוגמא(050-1234567)" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>אימייל:</label>
            <?php if ($valid_email) echo '<label class="error">Email Already Exist.</label>'; ?>
            <input type="text" name="email" placeholder="אימייל" value="<?php if (isset($email)) echo $email; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z0-9._%+-]{2,}$" title="Email must contain @ in email address, example(user@gmail.com)" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>סיסמא:</label>
            <input type="password" name="password_1" placeholder="סיסמא" pattern=".{5,}" title="Six or more characters" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>אימות סיסמא:</label>
            <input type="password" name="password_2" placeholder="אימות סיסמא"  autocomplete="off" required>
        </div>
        <?php if ($valid_pass) echo '<label class="error">Password not match.</label><br>'; ?>
        <div class="input-group">
            <button type="submit" name="register" class="btn">הוסף לקוח</button>
            <button type="submit" name="update" class="update-btn">עדכון</button>
        </div>
    </form>


</body>

</html>