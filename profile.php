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
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.jpg">
    <title>מוסך נגיש</title>

</head>
<body>
    <header><?php nav();?></header>

    <div class="about-text">
        <h2>About Us</h2>
        <p><strong>מוסך נגיש</strong> - האתר מיועד ללקוחות בעלי רכב שמתקשרים עם בעל המוסך</p>
        <br>
        <p>החברה שלנו ממוקמת בתל אביב ברחוב דוד אחמד נוסדה בשנת 2022.</p>
        <p>אנחנו מאוד מאמינים שהאתר יתן את מירב התקשורת בין הלקוח לבעל המוסך.</p>
        <br>
        <p>אנחנו מאוד רוצים לשרת את הלקוחות שלנו מכל הכיוונים בכל דרך.</p>
        <p> או ליצור קשר דרך האתר www.garage.com 03-999999 לתמיכה התקשרו .</p>
    </div>

</body>

</html>