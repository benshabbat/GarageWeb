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

if (isset($_POST['search']))// search cars
    { 
    $valueToSearch = $_POST['valueToSearch'];
    $query=" SELECT * FROM `users` WHERE CONCAT (`username`,`phone`,`email`) LIKE '%".$valueToSearch."%' ORDER BY `id` DESC"; 
    $search_result=filterTable($query);
    }  
else{
        $query=" SELECT * FROM `users` ORDER BY `users`.`id` DESC LIMIT 10";
        $search_result=filterTable($query); 
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
    <title>מוסך נגיש מנהל</title>
</head>

<body>
    <header><?php nav(); ?></header>
    <form method="post" action="users_DB.php">
        <h2>פרטי לקוחות</h2>
        <div class="search-filter">
            <div class="input-search">
                <input type="text" name="valueToSearch" placeholder="Value To Search">
                <button type="submit" name="search" class="btn" value="Filter">חפש</button>
            </div>
        </div>


        <table class="table">
            <tr>
                <th>שם לקוח</th>
                <th>אימייל</th>
                <th>מספר טלפון</th>

            </tr>
            <?php while($rows=mysqli_fetch_array($search_result)):?>
            <tr>
                <td><?php echo $rows['username']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['phone']; ?></td>
            </tr>
            <?php endwhile;?>
        </table>
    </form>
    <!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>