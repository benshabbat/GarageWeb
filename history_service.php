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


if (isset($_POST['search'])) // search cars
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = " SELECT * FROM `service` WHERE CONCAT (`idcar`, `username`, `date`, `typeservice`, `phone`, `km`, `text`) 
    LIKE '%" . $valueToSearch . "%'";
    $search_result = filterTable($query);
} else {
    $query = "SELECT * FROM `service` ORDER BY `service`.`id` DESC";
    $search_result = filterTable($query);
}

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.jpg">
    <title>מוסך נגיש מנהל</title>
</head>

<body>
    <header><?php nav(); ?></header>
    <form method="post" action="history_service.php">
        <h2>היסטוריית טיפולים </h2>
        <div class="search-filter">
            <div class="input-search">
                <input type="text" name="valueToSearch" placeholder="Value To Search" autocomplete="off">
                <button type="submit" name="search" class="btn" value="Filter">חפש</button>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th>שם משתמש</th>
                    <th>מספר רכב</th>
                    <th>מספר טלפון</th>
                    <th>ק"מ</th>
                    <th>תאריך</th>
                    <th>סוג שירות</th>
                    <th>הערה</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rows = mysqli_fetch_array($search_result)) : ?>
                    <?php if ($rows['username'] == $_SESSION['username'] or "admin" == $_SESSION['username']) : ?>
                        <tr>
                            <td data-label="שם משתמש"><?php echo $rows['username']; ?></td>
                            <td data-label="מספר רכב"><?php echo $rows['idcar']; ?></td>
                            <td data-label="מספר טלפון"><?php echo $rows['phone']; ?></td>
                            <td data-label='ק"מ'><?php echo $rows['km']; ?></td>
                            <td data-label="תאריך"><?php echo $rows['date']; ?></td>
                            <td data-label="סוג שירות"><?php echo $rows['typeservice']; ?></td>
                            <td data-label="הערה"><?php echo $rows['text']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>
</body>

</html>