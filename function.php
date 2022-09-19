<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


<?php function ConnectToDB() // connect to DB;
{
    $con = mysqli_connect("localhost", "root", "", "garagedb");
    mysqli_set_charset($con, "utf8");

    return $con;
} ?>
<?php function nav() // web navbar
{
?>
    <header>
        <img src="images/logo.jpg" class="logo">
        <div class="nameUser">
            <?php if (isset($_SESSION["username"])) : ?>
                <p><ins>שלום</ins> <strong> <?php echo $_SESSION['username']; ?></strong></p>
            <?php endif ?>
        </div>
        <div class="menu">
            <?php type_nav(); ?>
        </div>
    </header>
<?php
} ?>

<?php function admin_nav() // admin navbar
{
?>
    <nav>
        <?php menu(); ?>
        <ul>
            <li><a href="admin.php">דף הבית</a></li>
            <li><a href="new_service.php">טיפול חדש</a></li>
            <li><a href="new_message.php">הודעה חדשה</a></li>
            <li><a href="new_user.php">הוספת לקוח</a></li>
            <li><a href="new_car.php">הוספת רכב</a></li>
            <li><a href="users_DB.php" class="aB">פרטי לקוחות</a></li>
            <li><a href="cars_DB.php" class="aB">פרטי רכבים</a></li>
            <li><a href="message_DB.php" class="aB">מאגר הודעות</a></li>
            <li><a href="history_service.php" class="aB">היסטוריית טיפולים</a></li>
            <li><a href="login.php?logout='1'" class="aR">התנתק</a></li>
        </ul>
    </nav>
    <section></section>
<?php
} ?>

<?php function user_nav() // user navbar
{
?>
    <nav>
        <?php menu(); ?>
        <ul>
            <li><a href="profile.php" class="aG">דף הבית</a></li>
            <li><a href="about_car.php">פרטי רכב</a></li>
            <li><a href="request_service.php">בקשת שירות</a></li>
            <li><a href="message_DB.php" class="aB">מאגר הודעות</a></li>
            <li><a href="history_service.php" class="aB">היסטוריית טיפולים</a></li>
            <li><a href="login.php?logout='1'" class="aR">התנתק</a></li>
        </ul>
    </nav>
    <section></section>
<?php
} ?>

<?php function login_nav() //login navbar
{
?>
    <nav>      
    <?php menu(); ?>
        <ul>
            <li><a href="contact.php">יצירת קשר</a></li>
            <li><a href="about.php">עלינו</a></li>
            <li><a href="login.php">התחבר</a></li>
        </ul>
    </nav>
    <section></section>
<?php
} ?>
<?php function menu() //login navbar
{
?>    
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
<?php
} ?>

<?php function type_nav() // type navbar
{
    if (!isset($_SESSION['username']))
        login_nav();
    elseif ("admin" == $_SESSION['username'] and $_SESSION['ID'] == 1) {
        admin_nav();
    } elseif (isset($_SESSION['username'])) {
        user_nav();
    }
} ?>

<?php function check_user() // check if has user session
{
    if (isset($_SESSION['username']))
        return true;
    else
        return false;
} ?>

<?php function check_admin() // check if admin log in
{
    if ($_SESSION['ID'] == 1)
        return true;
    else
        return false;
} ?>

<?php function logout() // logout method
{
    if (isset($_GET['logout'])) {
        unset($_SESSION['username']);
        unset($_SESSION['ID']);
        session_destroy();
        header('location: login.php');
    }
} ?>

<?php function checkSESSION() // check if have session

{
    if (!(isset($_SESSION['username']))) {
        header('location: login.php');
    }
} ?>
<?php function filterTable($query)
{
    $con = ConnectToDB();
    $filter_Result = mysqli_query($con, $query);
    return $filter_Result;
} ?>

<?php function get_option_users()
{
    $queryUsers = " SELECT `username` FROM `users` ";
    $search_result = filterTable($queryUsers);
    $options = '';
    while ($row = mysqli_fetch_array($search_result)) :
        $options .= '<option value="' . $row['username'] . '">' . $row['username'] . '</option>';
    endwhile;
    return $options;
} ?>
<?php function get_option($table, $valueToSearch)

{
    $queryUsers = " select LIKE '%" . $valueToSearch . "%' from LIKE '%" . $table . "%' ";
    $search_result = filterTable($queryUsers);
    $options = '';
    while ($row = mysqli_fetch_array($search_result)) :
        $options .= '<option value="' . $row['' % ".$valueToSearch." % ''] . '">' . $row['' % ".$valueToSearch." % ''] . '</option>';
    endwhile;
    return $options;
} ?>
<?php function addstrCar($str)
{
    if (strlen($str) == 8) {
        $str = substr($str, 0, 3) . "-" . substr($str, 3, 2) . "-" . substr($str, 5, 3);
    }
    if (strlen($str) == 7) {
        $str = substr($str, 0, 2) . "-" . substr($str, 2, 3) . "-" . substr($str, 5, 2);
    }
    return $str;
} ?>
<?php function addstrPhone($str)
{
    if (strlen($str) == 10)
        $str = substr($str, 0, 3) . "-" . substr($str, 3, 7);
    return $str;
} ?>