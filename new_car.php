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



$valid_name = true;
$valid_car = false;


if (isset($_POST['btn_update'])) //update or changes on data cars
{
    $username = $_POST['username'];
    $idcar = $_POST['idcar'];
    $idcar = addstrCar($idcar);
    $year = $_POST['year'];
    $typecar = $_POST['typecar'];
    $engineoil = $_POST['engineoil'];
    $typefuel = $_POST['typefuel'];
    $coolant = $_POST['coolant'];
    $airpressure = $_POST['airpressure'];
    $tiresize = $_POST['tiresize'];

    if ($valid_name) {
        $update_sql = "UPDATE cars SET 
        idcar = '$idcar', 
        year ='$year',
        typecar ='$typecar',
        engineoil ='$engineoil',
        typefuel ='$typefuel',
        coolant = '$coolant',
        airpressure ='$airpressure',
        tiresize ='$tiresize'
        WHERE username = '$username'";


        $query_update = mysqli_query($con, $update_sql);
    } else {
        echo '<script>alert("update not working on username dont in DB")</script>';
    }
}

if (isset($_POST['btn_addCar'])) { // adding car to user
    //$username= mysqli_real_escape_string($con,$_POST['username']);
    $username = isset($_POST['taskOption']) ? $_POST['taskOption'] : false;
    $idcar = mysqli_real_escape_string($con, $_POST['idcar']);
    $newidcar = addstrCar($idcar);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $typecar = mysqli_real_escape_string($con, $_POST['typecar']);
    $engineoil = mysqli_real_escape_string($con, $_POST['engineoil']);
    $typefuel = mysqli_real_escape_string($con, $_POST['typefuel']);
    $coolant = mysqli_real_escape_string($con, $_POST['coolant']);
    $airpressure = mysqli_real_escape_string($con, $_POST['airpressure']);
    $tiresize = mysqli_real_escape_string($con, $_POST['tiresize']);
    //$query_name = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    // $rows_name = mysqli_num_rows($query_name);
    $query_car = mysqli_query($con, "SELECT idcar FROM cars WHERE idcar='$newidcar'");
    $rows_car = mysqli_num_rows($query_car);
    $valid_name = false;

    // if($rows_name > 0) {// if The username already exist in the DB
    //         $valid_name=true;
    // }
    if ($rows_car > 0) { // if The car already exist in the DB
        $valid_car = true;
    }
    //$valid_name == true and 
    if ($valid_car == false) {
        $sql = "insert into cars(username,idcar,year,typecar,engineoil,typefuel,coolant,airpressure,tiresize)
        values ('$username','$newidcar', '$year', '$typecar', '$engineoil','$typefuel','$coolant','$airpressure','$tiresize');";
        if ($con->query($sql) === TRUE) {
            echo '<script>alert("Car Create Successfully")</script>';
            $query_id = mysqli_query($con, "SELECT id FROM cars WHERE idcar='$idcar'");
            $rows_id = mysqli_fetch_array($query_id);
            header('Refresh:1; url=admin.php');
            mysqli_close($con);
            exit();
        }
    } else {
        echo '<script>alert("Unsuccessfully")</script>';
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
    <form class="res_form" method="post" action="new_car.php">
        <h2>רישום רכב חדש</h2>
        <div class="input-group">
            <label>שם משתמש:</label>
            <?php if (!($valid_name)) echo '<label class="error">username incorrect.</label><br>'; ?>
            <?php $search_result = mysqli_query($con, "select * from users") ?>
            <select name="taskOption">
                <?php while ($row = mysqli_fetch_array($search_result)) : ?>
                    <?php if ($row['username'] != $_SESSION['username']) : ?>
                        <option>
                            <?php echo $row['username']; ?>
                        </option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="input-group">
            <label>מספר רכב:</label>
            <?php if ($valid_car) echo '<label class="error">Car Already Exist.</label><br>'; ?>
            <input type="text" name="idcar" placeholder="מספר רכב" value="<?php if (isset($idcar)) echo $idcar; ?>" pattern="[0-9]{3}[-][0-9]{2}[-][0-9]{3}|[0-9]{2}[-][0-9]{3}[-][0-9]{2}|[0-9]{7,8}" title="Number of car must 00-000-00 OR 000-00-000" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>שנת יצור:</label>
            <input type="number" name="year" placeholder="שנת יצור" value="<?php if (isset($year)) echo $year; ?>" min="1900" max="2022" pattern="19+[0-9]{2}|20+[0-1]{1}[0-9]{1}|202+[0-2]{1}" title="the year must to be 1900-2022" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>סוג רכב:</label>
            <input type="text" name="typecar" placeholder="סוג רכב" value="<?php if (isset($typecar)) echo $typecar; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>שמן מנוע:</label>
            <input type="text" name="engineoil" placeholder="שמן מנוע" value="<?php if (isset($engineoil)) echo $engineoil; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>סוג דלק:</label>
            <input type="text" name="typefuel" placeholder="סוג דלק" value="<?php if (isset($typefuel)) echo $typefuel; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>נוזל קירור:</label>
            <input type="text" name="coolant" placeholder="נוזל קירור" value="<?php if (isset($coolant)) echo $coolant; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>לחץ אוויר:</label>
            <input type="text" name="airpressure" placeholder="לחץ אוויר" value="<?php if (isset($airpressure)) echo $airpressure; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <label>מידת צמיגים:</label>
            <input type="text" name="tiresize" placeholder="מידת צמיגים" value="<?php if (isset($tiresize)) echo $tiresize; ?>" autocomplete="off" required>
        </div>
        <div class="input-group">
            <button type="submit" name="btn_addCar" class="btn">יצירת רכב חדש</button>
            <button type="submit" name="btn_update" class="update-btn">עדכון</button>
        </div>
    </form>

</body>

</html>