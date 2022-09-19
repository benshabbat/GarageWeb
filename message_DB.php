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
    $query = " SELECT * FROM `message` WHERE CONCAT (`fromU`, `toU`, `phone`, `typeservice`, `email`, `date`, `text`) LIKE '%" . $valueToSearch . "%' ORDER BY `id` DESC";
    $search_result = filterTable($query);
} else {
    $query = " SELECT * FROM `message` ORDER BY `message`.`id` DESC LIMIT 10";
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
    <form method="post" action="message_DB.php">
        <h2>הודעות </h2>
        <div class="search-filter">
            <div class="input-search">
                <input type="text" name="valueToSearch" placeholder="Value To Search" autocomplete="off">
                <button type="submit" name="search" class="btn" value="Filter">חפש</button>
            </div>
        </div>


        <table class="table">
            <thead>

                <tr>
                    <th>ממי</th>
                    <th>למי</th>
                    <th>אימייל</th>
                    <th>סוג שירות</th>
                    <th>מספר טלפון</th>
                    <th>תאריך</th>
                    <th>הודעות</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($rows = mysqli_fetch_array($search_result)) : ?>
                    <?php if ($rows['fromU'] == $_SESSION['username'] or $rows['toU'] == $_SESSION['username']) : ?>
                        <tr>
                            <td data-label="ממי"><?php echo $rows['fromU']; ?></td>
                            <td data-label="למי"><?php echo $rows['toU']; ?></td>
                            <td data-label="אימייל"><?php echo $rows['email']; ?></td>
                            <td data-label="סוג שירות"><?php echo $rows['typeservice']; ?></td>
                            <td data-label="מספר טלפון"><?php echo $rows['phone']; ?></td>
                            <td data-label="תאריך"><?php echo $rows['date']; ?></td>
                            <td data-label="הודעות"><?php echo $rows['text']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>

</body>

</html>