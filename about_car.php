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

$query = "select * from cars";
$result = mysqli_query($con, $query);
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

    <form method="post" action="about_car.php">
        <h2>הרכבים שלי</h2>


        <table class="table">
            <thead>
                <tr>
                    <th>שם משתמש</th>
                    <th>מספר רכב</th>
                    <th>סוג רכב</th>
                    <th>שמן מנוע</th>
                    <th>סוג דלק</th>
                    <th>שנת יצור</th>
                    <th>לחץ אוויר</th>
                    <th>נוזל קירור</th>
                    <th>גודל צמיג</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rows = mysqli_fetch_array($result)) : ?>
                    <?php if ($rows['username'] == $_SESSION['username']) : ?>
                        <!-- data car only on username logged-->
                        <tr>
                            <td data-label="שם משתמש"><?php echo $rows['username']; ?></td>
                            <td data-label="מספר רכב"><?php echo $rows['idcar']; ?></td>
                            <td data-label="סוג רכב"><?php echo $rows['typecar']; ?></td>
                            <td data-label="שמן מנוע"><?php echo $rows['engineoil']; ?></td>
                            <td data-label="סוג דלק"><?php echo $rows['typefuel']; ?></td>
                            <td data-label="שנת יצור"><?php echo $rows['year']; ?></td>
                            <td data-label="לחץ אוויר"><?php echo $rows['airpressure']; ?></td>
                            <td data-label="נוזל קירור"><?php echo $rows['coolant']; ?></td>
                            <td data-label="גודל צמיג"><?php echo $rows['tiresize']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>

</body>

</html>