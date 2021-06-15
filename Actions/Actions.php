<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Δράσεις</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_actions.css">
    <?php
        if (isset($_GET['pressed_action'])) {
            $action_id = $_GET['pressed_action'];
            $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
            include("../General-components/connect_to_database.php");
            if (!isset($_SESSION['connected_id'])) { // αν ο χρήστης δεν είναι συνδεδεμένος πρέπει πρώτα να συνδεθεί
                $_SESSION['submit_action'] = "connect_first";
            } else {
                $id = $_SESSION['connected_id'];
                $query = "SELECT user_id FROM user_in_action WHERE user_id=$id AND action_id=$action_id";
                $results = mysqli_query($link, $query);
                $num_results = mysqli_num_rows($results);

                if ($num_results == 0) { //ο χρήστης δεν συμμετέχει ήδη σε αυτή την δράση
                    $_SESSION['submit_action'] = "joined_action";
                    $query = "INSERT INTO user_in_action (user_id, action_id, date_joined) 
                      VALUES ('$id', '$action_id', CURRENT_DATE())";
                    mysqli_query($link, $query);
                } else {
                    $query = "DELETE FROM user_in_action WHERE user_id=$id AND action_id=$action_id";
                    mysqli_query($link, $query);
                    $_SESSION['submit_action'] = "cancel_join";
                }
            }
        }
    ?>
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>

<!---------------Navigation bar--------------->
<?php include("../General-components/navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="../images/Main/Underwater.mp4">
            </video>
        </div>
        <h2>Δράσεις</h2>
    </div>
</div>

<!---------------Actions--------------->
<article class="actionIntro">
    <h3>Τι κάνουμε</h3>
    <p>
        Η συνεχώς αυξανόμενη μόλυνση των θαλασσών σε συνδυασμό με την τεράστια αξία των υδάτινων πόρων για την ζωή μας καθιστούν
        άμεση και αναγκαία την δραστηριοποίηση όλων μας για την προστασία των θαλασσών. Η ομάδα μας έχει ως στόχο τη διοργάνωση
        και την προώθηση εθελοντικών δράσεων με σκοπό να μπορούμε όλοι να απολαύσουμε  στο μέλλον (και το παρόν!)
        καθαρές και όμορφες θάλασσες και λίμνες, καθώς και υγιείς υδροβιότοπους. Παρακάτω μπορείτε να δείτε τις τρέχουσες
        δράσεις και να συμμετέχετε συνεισφέροντας  και εσείς σε όλη αυτή την προσπάθεια!
    </p>
</article>

<?php
$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
include("../General-components/connect_to_database.php");

$query = "SELECT id, title, date, location, description, image, link 
                      FROM action";//" where id>9 or id=1";
$results = mysqli_query($link, $query);
while ($row = mysqli_fetch_array($results)) {
    echo '<article class="action">
             <div class="action_row">
                <div class="column image">';
    echo            '<img src="images/Uploads/Action_Images/' . $row['image'] . '/" alt="Άνθωπος κάτω από το νερό!"/>';
    echo        '</div>
                <div class="column text" >
                    <div>';
    echo                '<h3><b>' . $row['title'] . '</b></h3>';
    echo "<div class='calendar'>
                        <img class='smallImage' src='../images/3.Actions/calendar.png' alt='Calendar'>";
    echo                $row['date'] . ', ' . $row['location'];
    echo            "</div> <br>";
    echo            "<p>" . $row['description'] . "</p>";
    if ($row['link']!="" && $row['link']!=null){
        echo "<a href=" . $row['link'] . " target='_blank'> Περισσότερες πληροφορίες</a>";
    }
    echo            "</div>
                </div>";

    echo            "<div class='column button'>";
    $link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
    include("../General-components/connect_to_database.php");
    $action_id = $row['id'];
    if (!isset($_SESSION['connected_id'])){ // αν ο χρήστης δεν είναι συνδεδεμένος πρέπει πρώτα να συνδεθεί
        echo "<a href='?pressed_action=$action_id'><button class='buttonJoinActions'>Θέλω να συμμετέχω και εγώ</button></a>";
    } else {
        $id = $_SESSION['connected_id'];
        $query = "SELECT user_id FROM user_in_action WHERE user_id=$id AND action_id=$action_id";
        $results2 = mysqli_query($link, $query);
        $num_results = mysqli_num_rows($results2);
        if ($num_results == 0){ //ο χρήστης δεν συμμετέχει ήδη σε αυτή την δράση
            echo "<a href='?pressed_action=$action_id'><button class='buttonJoinActions'>Θέλω να συμμετέχω και εγώ</button></a>";
        } else {
            echo "<a href='?pressed_action=$action_id'><button class='buttonJoinActions' style='background-color: #f44336;'>ακύρωση συμμετοχής</button></a>";
        }
    }
    //echo                "<input type='submit' name='button_user_joins_action#" . $row['id'] . "' value='Θέλω να συμμετέχω και εγώ' class='buttonJoinActions'/>";
    echo            "</div>";
    echo    "</div>";
    echo "</article>";
}

?>

<div class="alert" id="joined_action">
    <span class="closeBtn" onclick="closeAlertMessage('joined_action')">&times;</span>
    <strong>Έγινε!</strong> Συμμετέχεις στην δράση!
</div>

<div class="alert red" id="connect_first">
    <span class="closeBtn" onclick="closeAlertMessage('connect_first')">&times;</span>
    <strong>Ουπς!</strong> Για να δηλώσεις συμμετοχή σε μια δράση πρέπει πρώτα να συνδεθείς!
</div>

<div class="alert" id="cancel_join">
    <span class="closeBtn" onclick="closeAlertMessage('cancel_join')">&times;</span>
    <strong>Αποχώρησες από τη δράση!</strong>
</div>

<script>
    function openAlertMessage(id) {
        document.getElementById(id).style.display = "block";
        setTimeout(hideElement, 7000) //milliseconds
        function hideElement() {
            closeAlertMessage(id);
        }
    }
    function closeAlertMessage(id) {
        document.getElementById(id).style.display = "none";
    }
</script>

<?php
if (isset($_SESSION['submit_action'])) {
    if ($_SESSION['submit_action'] == "connect_first") {
        echo '<script  type="text/javascript">openAlertMessage("connect_first");</script>';
        $_SESSION['submit_action'] = null;
    } else if ($_SESSION['submit_action'] == "joined_action") {
        echo '<script  type="text/javascript">openAlertMessage("joined_action");</script>';
        $_SESSION['submit_action'] = null;
    } else if ($_SESSION['submit_action'] == "cancel_join") {
        echo '<script  type="text/javascript">openAlertMessage("cancel_join");</script>';
        $_SESSION['submit_action'] = null;
    }
}
?>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>

</body>
</html>