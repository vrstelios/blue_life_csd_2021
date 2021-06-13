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
    if (isset($_GET['delete_user']) && isset($_GET['delete_action'])  && $_SESSION['connected_id']==1) {
        // ο admin έχει πατήσει τον κάδο για να αφαιρέσει έναν χρήστη από κάποια δράση
        delete_user_in_action($_GET['delete_user'], $_GET['delete_action']);
    }

    function delete_user_in_action($delete_user_id, $delete_action_id)
    {
        include("connect_to_database.php");
        $query = "DELETE FROM user_in_action WHERE user_id=$delete_user_id AND action_id=$delete_action_id";
        mysqli_query($link, $query);
        $_SESSION['remove_user_from_action'] = "REMOVE USER FROM ACTION";
    }
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

        <form action="Admin_user.php" method="post">
            <input type="text" placeholder="Πληκτρολογήστε εδώ" name="search">
            <button type="submit" name="submit">Αναζήτηση</button>
        </form>

        <?php
        // προεργασίες του paging (εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10)
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

        echo "<div class='sort_dropdown'>
                            <button class='sort_dropbtn'>Ταξινόμηση</button>                    
                            <div class='sort_dropdown-content'>";
        echo       "<a href='Admin_user_in_action.php?page_no=".$page_no."&sortBy_user_id'> ". 'id χρήστη' . "</a>";
        echo       "<a href='Admin_user_in_action.php?page_no=".$page_no."&sortBy_action_id'> ". 'id δράσης' . "</a>";
        echo       "<a href='Admin_user_in_action.php?page_no=".$page_no."&sortBy_username1'> ". 'Username συμμετέχοντα' . "</a>";
        echo       "<a href='Admin_user_in_action.php?page_no=".$page_no."&sortBy_title1'> ". 'Τίτλος δράσης' . "</a>";
        echo       "<a href='Admin_user_in_action.php?page_no=".$page_no."&sortBy_date_joined'> ". 'Ημερομηνία δήλωσης συμμετοχής' . "</a>";

        echo   "</div>";
        echo "</div>";

        ?>


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
            //include ("connect_to_database.php");
            //7
            if (isset($_GET['sortBy_action_id'])) {
                $query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id ORDER BY user_in_action.action_id LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_username1'])) {
                $query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id ORDER BY user.username LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_user_id'])) {
                $query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id ORDER BY user_in_action.user_id LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_title1'])) {
                $query =  "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id ORDER BY action.title LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_date_joined'])) {
                $query =  "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id ORDER BY user_in_action.date_joined LIMIT $offset, $total_records_per_page";
            }else {
                $query =  "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id LIMIT $offset, $total_records_per_page";
            }

            //7
            //$query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
            //              FROM user, user_in_action, action
             //             WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id
             //             LIMIT $offset, $total_records_per_page";
            $result = mysqli_query($link, $query);
            while($row = mysqli_fetch_array($result)){
                echo "<tr>
                     <td>".$row['user_id']."</td>
                     <td>".$row['action_id']."</td>
                     <td>".$row['username']."</td>
                     <td>".$row['title']."</td>
                     <td>".$row['date_joined']."</td>";
                echo "<td class='keno'>
                     <a href='?delete_user=" . $row['user_id'] .  "&delete_action=" . $row['action_id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                     </tr>";
            }
            ?>
        </table>

        <?php //εμφανίζουμε τη λίστα των σελίδων
        include("show_number_of_pages.php");
        ?>

        <div class="table_page" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Σελίδα <?php echo $page_no."/".$total_no_of_pages; ?></strong>
        </div>
    </div>


    <!--Εμφάνιση μηνύματος ότι ένας χρήστης διαγράφτηκε από μία δράση-->
    <div class="alert" id="DELETE_USER_FROM_ACTION">
        <span class="closeBtn" onclick="closeAlertMessage('DELETE_USER_FROM_ACTION')">&times;</span>
        <strong>Ο χρήστης αποχώρησε από τη δράση!</strong>
    </div>

    <?php
    if (isset($_SESSION['delete_user']) && isset($_SESSION['delete_action'])){
        if ($_SESSION['remove_user_from_action'] == "REMOVE USER FROM ACTION"){
            echo '<script type="text/javascript">openAlertMessage("DELETE_USER_FROM_ACTION");</script>';
            $_SESSION['remove_user_from_action'] = null;
        }
    }
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
