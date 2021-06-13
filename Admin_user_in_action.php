<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Σελίδα διαχείρισης</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_admin.css">
    <?php
    /*
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");
        if ($_POST['submit'] == 'Καταχώρηση χρήστη'){
            if (isset($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $username = null;
            }
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $email = null;
            }
            if (isset($_POST['firstname'])) {
                $firstname = $_POST['firstname'];
            } else {
                $firstname = null;
            }
            if (isset($_POST['lastname'])) {
                $lastname = $_POST['lastname'];
            } else {
                $lastname = null;
            }
            if (isset($_POST['pass'])) {
                $password = $_POST['pass'];
            } else {
                $password = null;
            }

            $query1 = "SELECT id FROM user WHERE username='$username'";
            $query2 = "SELECT id FROM user WHERE email='$email'";
            $results1 = mysqli_query($link, $query1);
            $results2 = mysqli_query($link, $query2);

            if (mysqli_num_rows($results1) > 0) {
                $_SESSION['submit'] = "NOT AVAILABLE USERNAME";
            } else if (mysqli_num_rows($results2) > 0) {
                $_SESSION['submit'] = "NOT AVAILABLE EMAIL";
            }
            else {
                $query = "INSERT INTO user (username, password, first_name, last_name, email)
                          VALUES ('$username', '$password', '$firstname', '$lastname', '$email');";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "USER CREATED";
                }
            }
        }
        if ($_POST['submit'] == 'Καταχώρηση δράσης') {
            if (isset($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                $title = null;
            }
            if (isset($_POST['location'])) {
                $location = $_POST['location'];
            } else {
                $location = null;
            }
            if (isset($_POST['link'])) {
                $link_info = $_POST['link'];
            } else {
                $link_info = null;
            }
            if (isset($_POST['date'])) {
                $date = $_POST['date'];
            } else {
                $date = null;
            }
            if (isset($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
            } else {
                $image = null;
            }
            if (isset($_POST['subject'])) {
                $description = $_POST['subject'];
            } else {
                $description = null;
            }

            $query = "INSERT INTO action (title,date,location,description,image,link)
                  VALUES ('$title','$date','$location','$description','$image','$link_info');";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                $_SESSION['submit'] = "ACTION CREATED";
            }
        }
        @mysqli_close($link);
    }
*/
    ?>
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>

<!---------------Navigation bar--------------->
<?php include("navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <h2>Σελίδα διαχείρισης</h2>
</div>

<!---------------Σελίδα διαχείρησης--------------->
<?php
// αν ο χρήστης δεν είναι ο admin και προσπαθήσει να φορτώσει την σελίδα Admin_user_in_action.php τότε φορτώνεται η σελίδα UnauthorizedProfile.php για την ασφάλεια και απόκρυψη των στοιχείων
if ($_SESSION['connected_id'] != 1){
    header("Location: UnauthorizedProfile.php");
}
$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
include("connect_to_database.php");

function print_size_of_table($link, $table){
    $query = "SELECT COUNT(*) FROM $table";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo '(' . $row[0] . ')';
}
?>

<div class="admin-page">

    <div class="navbar" id="navbar_admin">
        <a href="Admin_user.php">Χρήστες</a>
        <a href="Admin_action.php">Δράσεις</a>
        <a href="Admin_user_in_action.php">Χρήστες σε Δράσεις</a>
        <a href="Admin_contact.php">Επικοινωνία χρηστών</a>
    </div>

    <h3>Χρήστες σε δράσεις</h3>
    <div class="user-actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΗΛΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ
            <?php //εμφανίζουμε το πλήθος των συνολικών συμμετοχών στις δράσεις
            print_size_of_table($link,'user_in_action');;
            ?>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>id χρήστη</th>
                <th>id δράσης</th>
                <th>Username συμμετέχοντα</th>
                <th>Τίτλος δράσης</th>
                <th>Ημερομηνία δήλωσης συμμετοχής</th>
                <th class="keno"></th>
            </tr>

            <?php // εμφανίζουμε τον πίνακα των χρηστών που συμμετέχουν σε κάποια δράση με τα στοιχεία τους, σελιδοποιημένο κατά 10
            include ("connect_to_database.php");
            if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                $page_no = $_GET['page_no'];
            } else {
                $page_no = 1;
            }

            $total_records_per_page = 10;

            $offset = ($page_no-1) * $total_records_per_page;
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;
            $adjacents = "2";

            //6
            $result_count = mysqli_query($link, "SELECT COUNT(*) As total_records FROM `user_in_action`");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total pages minus 1

            //7
            $query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                          FROM user, user_in_action, action
                          WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id
                          LIMIT $offset, $total_records_per_page";
            $result = mysqli_query($link, $query);
            while($row = mysqli_fetch_array($result)){
                echo "<tr>
                     <td>".$row['user_id']."</td>
                     <td>".$row['action_id']."</td>
                     <td>".$row['username']."</td>
                     <td>".$row['title']."</td>
                     <td>".$row['date_joined']."</td>";
                echo "<td class='keno'>
                     <a href='Admin_user_in_action.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                     </tr>";
            }
            //mysqli_close($link);
            ?>
        </table>

        <?php //εμφανίζουμε τη λίστα των σελίδων
        include("show_number_of_pages.php");
        ?>

        <div class="table_page" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Σελίδα <?php echo $page_no."/".$total_no_of_pages; ?></strong>
        </div>
    </div>


    <?php /*
    if (isset($_SESSION['submit'])) {
        if ($_SESSION['submit'] == "NOT AVAILABLE USERNAME") {
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_USERNAME");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "NOT AVAILABLE EMAIL") {
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_EMAIL");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "USER CREATED") {
            echo '<script type="text/javascript">openAlertMessage("USER_CREATED");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "ACTION CREATED") {
            echo '<script type="text/javascript">openAlertMessage("ACTION_CREATED");</script>';
            $_SESSION['submit'] = null;
        }
    }*/
    ?>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>
<?php //echo date("Y");?>
<!--https://www.allphptricks.com/create-simple-pagination-using-php-and-mysqli/-->
</body>
</html>
