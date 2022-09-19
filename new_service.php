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
$valid_name=true;
$valid_car=true;
$valid_phone=false;

if (isset($_POST['submitusers'])){ // חיפוש לפי שם משתמש
    if(isset($_POST['username'])){    
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $idcar = mysqli_real_escape_string($con,$_POST['idcar']);
        $car_sql=" select * from cars where username like '%$username%' ";
        $user_sql=" select * from users where username like '%$username%' ";
        $query_car=mysqli_query($con,$car_sql);
        $query_user=mysqli_query($con,$user_sql);
        $rowcars=mysqli_fetch_assoc($query_car);
        $rowusers=mysqli_fetch_assoc($query_user);
        $valid_name=false;
        if($rowusers > 0){
            $valid_name=true;
            $valid_car=true;
            $phone = $rowusers['phone']; 
            $newPhone=addstrPhone($phone);
            $idcar = $rowcars['idcar'];
            $newidcar=addstrCar($idcar);
            $username = $rowusers['username'];
            $date=date("l jS \of F Y h:i:s A");
         } 
       
    
    }
}
if (isset($_POST['submitcars']))
{ // חיפוש לפי רכב
    if(isset($_POST['idcar']))
    { 
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $idcar = mysqli_real_escape_string($con,$_POST['idcar']);
    $newidcar=addstrCar($idcar);
    $car_sql=" select * from cars where idcar like '%$newidcar%' ";
    $query_car=mysqli_query($con,$car_sql);
    $rowcars=mysqli_fetch_assoc($query_car);
    $valid_car=false;
    if($rowcars > 0)
        {    
        $valid_car=true;
        $idcar = $rowcars['idcar'];
        $username = $rowcars['username'];
        $user_sql=" select * from users where username like '%$username%' ";     
        $query_user=mysqli_query($con,$user_sql);
        $rowusers=mysqli_fetch_assoc($query_user);
        $phone = $rowusers['phone']; 
        $newPhone=addstrPhone($phone);
        $date=date("l jS \of F Y h:i:s A");
        }

    }


}
if (isset($_POST['create'])) { // יוצר טיפול
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $idcar = mysqli_real_escape_string($con,$_POST['idcar']);
    $newidcar=addstrCar($idcar);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $newPhone=addstrPhone($phone);
    $km = mysqli_real_escape_string($con,$_POST['km']);
    $date=date("l jS \of F Y h:i:s A");
    $typeservice = mysqli_real_escape_string($con,$_POST['typeservice']);
    $text = mysqli_real_escape_string($con,$_POST['text']);
    $query_car = mysqli_query($con, "SELECT * FROM cars WHERE idcar='$idcar'");
    $rows_car = mysqli_num_rows($query_car);
    $valid_car=false;
    if($rows_car > 0) {// if The car already exist in the DB
        $valid_car=true;  
    }
    $query_name = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $rows_name = mysqli_num_rows($query_name);
    
    
    $valid_name=false;
    if($rows_name > 0) {// if The username already exist in the DB
        $valid_name=true;
    }
       

  



    

  //מכניס נתנוים לדאטה בייס
  if($valid_name == true and $valid_car==true) {
        $sql = "insert into service(username,phone,idcar,km,date,typeservice,text) values ('$username','$newPhone','$newidcar','$km','$date','$typeservice','$text');";
            if($con->query($sql) === TRUE){ 
            echo '<script>alert("Service Create Successfully")</script>';
            $query_id = mysqli_query($con, "SELECT id FROM service WHERE 'username'='$username'");
            $rows_id=mysqli_fetch_array($query_id);
            header('Refresh:1; url=admin.php');
            mysqli_close($con);
            exit();
        }
        else
        {
            echo '<script>alert("ID Number Already Exist")</script>';
        }
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
    
    <form method="post" action="new_service.php">
        <h2>טיפול חדש</h2>
        <div class="input-search">
            <label>מספר רכב:</label>
            <?php if(!$valid_car)echo '<label class="error">dont have this car</label><br>';?>
            <input type="text" name="idcar" placeholder="מספר רכב" value="<?php if(isset($idcar)) echo $idcar; ?>" autocomplete="off">
            <button type="submit" name="submitcars" class="btn">חפש</button>
        </div>

        <div class="input-search">
            <label>שם משתמש:</label>
            <?php if(!$valid_name)echo '<label class="error">dont have this username.</label><br>';?>
            <input type="text" name="username" placeholder=" שם משתמש"
                value="<?php if(isset($username)) echo $username; ?>" autocomplete="off">
            <button type="submit" name="submitusers" class="btn">חפש</button>
        </div>

        <div class="input-group">
            <label>מספר טלפון:</label>
            <?php if($valid_phone)echo '<label class="error">this number not same username number phone.</label><br>';?>
            <input type="text" name="phone" placeholder="מספר טלפון" pattern="[0-9]{3}-[0-9]{7}|[0-9]{10}"
                title="מספר טלפון חייב להיות עם הסימן (-) לדוגמא(050-1234567)" value="<?php if(isset($phone)) echo $phone; ?>" autocomplete="off">
        </div>
        <div class="input-group">
            <label>מונה ק"מ:</label>
            <input type="text" name="km" placeholder="מונה ק'מ" pattern="[0-9]{1-11}"
                title="הקילומטרים חייבים להיות מספר" value="<?php if(isset($km)) echo $km; ?>" autocomplete="off">
        </div>
        <div class="input-group">
            <label>סוג שירות:</label>
        </div>
        <div>
            <input type="radio" name="typeservice" value="טיפול">
            טיפול
            <input type="radio" name="typeservice" value="תקלה">
            תקלה
            <input type="radio" name="typeservice" value="בדיקה">
            בדיקה
            <input type="radio" name="typeservice" value="הודעה">
            הודעה
        </div>
        <div class="input-group">
            <label>הערה:</label>
            <textarea type="text" name="text" placeholder="הערה" rows="8" autocomplete="off"></textarea>
        </div>
        <div class="input-group">
            <button type="submit" name="create" class="btn">צור טיפול</button>
        </div>
    </form>


</body>

</html>