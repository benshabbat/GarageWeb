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
    $query=" SELECT * FROM `message` WHERE CONCAT (`fromU`, `toU`, `phone`, `typeservice`, `email`, `date`, `text`) LIKE '%".$valueToSearch."%' ORDER BY `id` DESC"; 
    $search_result=filterTable($query);
    }  
else{
        $query=" SELECT * FROM `message` ORDER BY `message`.`id` DESC LIMIT 10";
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
    <form method="post" action="message_DB.php">
        <h2>הודעות </h2>
        <div class="search-fltier">
            <div class="input-search">
                <input type="text" name="valueToSearch" placeholder="Value To Search">
                <button type="submit" name="search" class="btn" value="Filter">חפש</button>
            </div>
        </div>


        <table class="table">
            <tr>
                <th>ממי</th>
                <th>למי</th>
                <th>אימייל</th>
                <th>סוג שירות</th>
                <th>מספר טלפון</th>
                <th>תאריך</th>
                <th>הודעות</th>
            </tr>
            <?php while($rows=mysqli_fetch_array($search_result)):?>
            <?php if($rows['fromU']==$_SESSION['username'] or $rows['toU']==$_SESSION['username']):?>
            <tr>
                <td><?php echo $rows['fromU']; ?></td>
                <td><?php echo $rows['toU']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['typeservice']; ?></td>
                <td><?php echo $rows['phone']; ?></td>
                <td><?php echo $rows['date']; ?></td>
                <td><?php echo $rows['text']; ?></td>
            </tr>
            <?php endif;?>
            <?php endwhile;?>
        </table>
    </form>
    <!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>