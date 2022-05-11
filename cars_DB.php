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
 $query=" SELECT * FROM `cars` WHERE CONCAT (`username`,`idcar`, `typecar`, `engineoil`, `typefuel`, `year`, `airpressure`, `coolant`, `tiresize`) LIKE '%".$valueToSearch."%' ORDER BY `id` DESC"; 
 $search_result=filterTable($query);
 }  
else{
     $query=" SELECT * FROM `cars` ORDER BY `cars`.`id` DESC LIMIT 10";
     $search_result=filterTable($query); 
 }
 $result=mysqli_query($con, $query); 
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
    <form method="post" action="cars_DB.php">
        <h2>פרטי רכבים </h2>
        <div class="search-fltier">
            <div class="input-search">
                <input type="text" name="valueToSearch" placeholder="Value To Search">
                <button type="submit" name="search" class="btn" value="Filter">חפש</button>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>שם לקוח</th>
                <th>מספר רכב</th>
                <th>סוג רכב</th>
                <th>שמן מנוע</th>
                <th>סוג דלק</th>
                <th>שנת יצור</th>
                <th>לחץ אוויר</th>
                <th>נוזל קירור</th>
                <th>גודל צמיג</th>
            </tr>
            <?php while($rows=mysqli_fetch_array($result)):?>
            
            <!-- data car only on username logged-->
            <tr>
                <td><?php echo $rows['username']; ?></td>
                <td><?php echo $rows['idcar']; ?></td>
                <td><?php echo $rows['typecar']; ?></td>
                <td><?php echo $rows['engineoil']; ?></td>
                <td><?php echo $rows['typefuel']; ?></td>
                <td><?php echo $rows['year']; ?></td>
                <td><?php echo $rows['airpressure'];?></td>
                <td><?php echo $rows['coolant']; ?></td>
                <td><?php echo $rows['tiresize']; ?></td>
            </tr>
        
            <?php endwhile;?>
        </table>
    </form>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>