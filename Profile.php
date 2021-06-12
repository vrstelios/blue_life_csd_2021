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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("connect_to_database.php");
        if ($_POST['submit'] == 'Ενημέρωση των δεδομένων του χρήστη') {
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
            if (isset($_POST['age'])) {
                $age = $_POST['age'];
            } else {
                $age = null;
            }
            if (isset($_POST['region'])) {
                $region = $_POST['region'];
            } else {
                $region = null;
            }
            if (isset($_POST['pass'])) {
                $password = $_POST['pass'];
            } else {
                $password = null;
            }
            if (isset($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
            } else {
                $image = null;
            }

            $id = $_SESSION['connected_id'];

            $query1 = "SELECT id FROM user WHERE username='$username' AND id!=$id";
            $query2 = "SELECT id FROM user WHERE email='$email' AND id!=$id";
            $results1 = mysqli_query($link, $query1);
            $results2 = mysqli_query($link, $query2);

            if (mysqli_num_rows($results1) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE USERNAME";
            } else if (mysqli_num_rows($results2) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE EMAIL";
            } else {
                $query = "UPDATE user SET username='$username', password='$password', first_name='$firstname',
                  last_name='$lastname', email='$email', age='$age', region='$region', image='$image' WHERE id=$id;";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "EDIT USER SAVED";
                }
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
        <h3>Στοιχεία Λογαριασμού&emsp;
        <?php
        if($_SESSION['connected_id']!=1){
            echo '<a href="?edit_my_profile='.$_SESSION['connected_id'].'"><img src="images/6.Admin/edit.png" alt="edit"></a>';
        }
        echo '</h3>';
        ?>

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

<!-- pop up form για την τροποποίηση των στοιχείων ενός χρήστη -->
<div class="form-popup" id="FORM_FOR_EDIT_USER" role="dialog">
    <form action="Profile.php" method="post" class="form-container">
        <h3>Τροποποίηση των δεδομένων του χρήστη</h3>
        <?php
        if (isset($_GET['edit_my_profile'])) { // ο χρήστης έχει πατήσει τον κάδο για να αποχωρήσει από κάποια δράση και η μεταβλητή $_GET['leave_action'] έχει το id αυτής της δράσης
            include("connect_to_database.php");
            $id = $_GET['edit_my_profile'];
            $query = "SELECT * FROM user WHERE id=$id;";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo '<p>
                <label for="username"><b>Username</b><br>
                    <input type="text" placeholder="Γράψε username" name="username" value="'.$row['username'].'" required>
                </label>
                </p>
                <p>
                    <label for="email"><b>Email</b><br>
                        <input type="email" placeholder="Γράψε Email" name="email" value="'.$row['email'].'" required>
                    </label>
                </p>
                <p>
                    <label for="first_name"><b>Όνομα</b><br>
                        <input type="text" placeholder="Γράψε Όνομα" name="firstname" value="'.$row['first_name'].'" required>
                    </label>
                </p>
                <p>
                    <label for="last_name"><b>Επίθετο</b><br>
                        <input type="text" placeholder="Γράψε Επίθετο" name="lastname" value="'.$row['last_name'].'" required>
                    </label>
                </p>
                <p>
                    <label for="age"><b>Ηλικία</b><br>
                        <input type="number" placeholder="Γράψε Ηλικία" value="'.$row['age'].'" name="age">
                    </label>
                </p>
                <p>
                    <label for="region"><b>Περιοχή</b><br>
                        <input type="text" placeholder="Γράψε Περιοχή" name="region" value="'.$row['region'].'">
                    </label>
                </p>
                <p>
                    <label for="password"><b>Κωδικός</b><br>
                        <input type="text" placeholder="Γράψε κωδικό" name="pass" value="'.$row['password'].'" required>
                    </label>
                </p>
                <p class="input_image">
                    <label for="image"><b>Εικόνα</b></label><br>
                    <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" value="'.$row['image'].'">
                </p>';
        }
        ?>
        <input name="submit" type="submit" value="Ενημέρωση των δεδομένων του χρήστη" class="btn"/>
        <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_EDIT_USER')">Ακύρωση</button>
    </form>
</div>

<script>
    function openForm(id) {
        document.getElementById(id).style.display = "block";
        window.onkeydown = function(event) {
            if ( event.keyCode === 27 ) {
                closeForm(id);
            }
        };
    }
    function closeForm(id) {
        document.getElementById(id).style.display = "none";
    }
</script>

<?php
if (isset($_GET['edit_my_profile'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα του και η μεταβλητή $_GET['edit_my_profile'] έχει το id του
    echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_USER');".'</script>';
}
?>

<div class="alert red" id="EDIT_NOT_AVAILABLE_USERNAME">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_NOT_AVAILABLE_USERNAME')">&times;</span>
    <strong>Αποτυχία τροποίησης του χρήστη!</strong> Το συγκεκριμένο username χρησιμοποιείται
</div>

<div class="alert red" id="EDIT_NOT_AVAILABLE_EMAIL">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_NOT_AVAILABLE_EMAIL')">&times;</span>
    <strong>Αποτυχία τροποίησης του χρήστη!</strong> Το συγκεκριμένο email χρησιμοποιείται
</div>

<div class="alert" id="EDIT_USER_SAVED">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_USER_SAVED')">&times;</span>
    <strong>Επιτυχία!</strong> Τα δεδομένα του χρήστη τροποποιήθηκαν
</div>

<?php
if (isset($_SESSION['submit'])) {
    if ($_SESSION['submit'] == "EDIT NOT AVAILABLE USERNAME") {
        echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_USERNAME");</script>';
        $_SESSION['submit'] = null;
    } else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE EMAIL") {
        echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_EMAIL");</script>';
        $_SESSION['submit'] = null;
    } else if ($_SESSION['submit'] == "EDIT USER SAVED") {
        echo '<script type="text/javascript">openAlertMessage("EDIT_USER_SAVED");</script>';
        $_SESSION['submit'] = null;
    }
}
?>


<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>