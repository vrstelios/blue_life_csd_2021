<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Το προφίλ μου</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_profile.css">
    <?php
    if (isset($_GET['leave_action'])) { // ο χρήστης έχει πατήσει τον κάδο για να αποχωρήσει από κάποια δράση και η μεταβλητή $_GET['leave_action'] έχει το id αυτής της δράσης
        user_leaves_action($_GET['leave_action']);
    }

    function user_leaves_action($leave_action_id)
    {
        include("connect_to_database.php");
        if (!isset($_SESSION['connected_id'])){ // αν ο χρήστης δεν είναι συνδεδεμένος πρέπει πρώτα να συνδεθεί
            echo '<script  type="text/javascript">openAlertMessage_connect_first();</script>';
        } else {
            $id = $_SESSION['connected_id'];
            $query = "DELETE FROM user_in_action WHERE user_id='$id' AND action_id=$leave_action_id";
            mysqli_query($link, $query);
            $_SESSION['user_leaves_action'] = "user_leaves_action_";
        }
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
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="images/Main/Underwater2.mp4">
            </video>
        </div>
        <h2>Το προφίλ μου</h2>
    </div>
</div>

<!---------------user--------------->
<div class="page_user">
    <div class="profile_img container">
        <button>
            <img src="images/Main/blank-profile-picture.png" alt="error_img" style="width:250px;height:250px ">
            <div class="centered">Προσθέστε εικόνα</div>
        </button>
    </div>

    <div class="mydata">
        <h3>Στοιχεία Λογαριασμού&emsp;<a href="Profile.php"><img src="images/6.Admin/edit.png" alt="edit"></a></h3>
        <?php
        $link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");

        if (isset($_SESSION['connected_id'])){
            $current_user_id = $_SESSION['connected_id'];//'kogal';

            $query = "SELECT * FROM user WHERE id=$current_user_id";
            $results = mysqli_query($link, $query);
            $num_results = mysqli_num_rows($results);
            if ($num_results != 0){ //υπάρχει ο χρήστης στην βάση
                $row = mysqli_fetch_array($results);
                echo '<p> Username: ' . $row['username']. '</p>';
                echo '<p> Όνομα: ' . $row['first_name']. '</p>';
                echo '<p> Επίθετο: ' . $row['last_name']. '</p>';
                echo '<p> email: ' . $row['email']. '</p>';
                echo '<p> Ηλικία: ' . $row['age']. '</p>';
                echo '<p> Περιοχή: ' . $row['region']. '</p>';
            } else {
                echo '<p> Username: </p>';
                echo '<p> Όνομα: </p>';
                echo '<p> Επίθετο: </p>';
                echo '<p> email: </p>';
                echo '<p> Ηλικία: </p>';
                echo '<p> Περιοχή: </p>';
            }
            @mysqli_free_result($results);
        } else {
            header("Location: UnauthorizedProfile.php");
        }

        ?>
    </div>
    <br>
    <br>

    <h3>Οι Δράσεις μου
        <?php //εμφανίζουμε το πλήθος των δράσεων που συμμετέχει ο συγκεκριμένος χρήστης
        if (isset($_SESSION['connected_id'])) {
            $query = "SELECT COUNT(*) FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo '(' . $row[0] . ')';
        }
        ?>
    </h3>
    <div class="actions-table">
        <p>
            <a href="Actions.php"> <button class="table_button">Συμμετοχή σε δράση</button></a>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>ID</th>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Τοποθεσία</th>
                <th>Περιγραφή</th>
                <th>Σύνδεσμος</th>
                <th class="keno"></th>
            </tr>

            <?php //εμφανίζουμε τον πίνακα των δράσεων που συμμετέχει ο συγκεκριμένος χρήστης, σελιδοποιημένο κατά 10
            include ("connect_to_database.php");
            if (isset($_SESSION['connected_id'])) {
                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                $total_records_per_page = 10;

                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $query = "SELECT COUNT(*) As total_records FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id 
                      WHERE user_in_action.user_id = $current_user_id";
                $result_count = mysqli_query($link, $query);
                $total_records = mysqli_fetch_array($result_count);
                $total_records = $total_records['total_records'];
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total pages minus 1

                $query = "SELECT action.id, action.title, action.date, action.location, action.description, action.link 
                      FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id 
                      WHERE user_in_action.user_id = $current_user_id LIMIT $offset, $total_records_per_page";
                $results = mysqli_query($link, $query);
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['location'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['link'] . '</td>';
                    echo "<td class='keno'>
                    <a href='?leave_action=" . $row['id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                    </td>";
                    echo '</tr>';
                }
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
</div>

<!--Εμφάνιση μηνύματος ότι ο χρήστης αποχώρησε από την δράση-->
<div class="alert" id="user_leaves_action">
    <span class="closeBtn" onclick="closeAlertMessage('user_leaves_action')">&times;</span>
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
if (isset($_SESSION['user_leaves_action'])) {
    if ($_SESSION['user_leaves_action'] == "user_leaves_action_") {
        echo '<script  type="text/javascript">openAlertMessage("user_leaves_action");</script>';
        $_SESSION['user_leaves_action'] = null;
    }
}
?>
<!--τέλος εμφάνισης μηνύματος-->

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>