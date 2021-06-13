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
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


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

            //if (isset($_FILES['image']['name'])) {
             //   $image = $_FILES['image']['name'];
            //} else {
            //    $image = null;
            //}


            // Αποθήκευση εικόνας στον server στο directory images/Uploads/User_Images/ και ονόματος της εικόνας στην βάση δεδομένων
            $targetDir = "images/Uploads/User_Images/";
            $fileName = basename($_FILES["image"]["name"]);

            $fileName =  generateRandomString(5) . $fileName;

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(!empty($_FILES["image"]["name"])) {
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    }
                }
            }


            $query = "SELECT id FROM user WHERE username='$username'";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            $id = $row['id'];

            $query1 = "SELECT id FROM user WHERE username='$username' AND id!=$id";
            $query2 = "SELECT id FROM user WHERE email='$email' AND id!=$id";
            $results1 = mysqli_query($link, $query1);
            $results2 = mysqli_query($link, $query2);

            if (mysqli_num_rows($results1) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE USERNAME";
            } else if (mysqli_num_rows($results2) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE EMAIL";
            }
            else {
                $query = "UPDATE user SET username='$username', password='$password', first_name='$firstname',
                  last_name='$lastname', email='$email', age='$age', region='$region', image='$fileName' WHERE id=$id;";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "EDIT USER SAVED";
                }
                // τροποποιούμε το name της εικόνας με βάση το id της δράσης για να είναι το όνομα μοναδικό
                $query = "SELECT id FROM user WHERE username='$username'";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);

                $_FILES["image"]["name"] = 'U' . $row['id'] . $fileName;;
                $new_filename = $_FILES["image"]["name"];

                $query = "UPDATE user SET image=$new_filename WHERE username=$username";
                mysqli_query($link, $query);
                //echo "The file ".$new_filename. " has been uploaded.";
            }
        }

        @mysqli_close($link);
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
// αν ο χρήστης δεν είναι ο admin και προσπαθήσει να φορτώσει την σελίδα Admin_user.php τότε φορτώνεται η σελίδα UnauthorizedProfile.php για την ασφάλεια και απόκρυψη των στοιχείων
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

    <h3>Χρήστες</h3>
    <div class="users-table">
        <p>ΟΛΟΙ ΟΙ ΧΡΗΣΤΕΣ
            <?php //εμφανίζουμε το πλήθος των χρηστών
            print_size_of_table($link,'user');
            ?>
            <button class="table_button" onclick="openForm('FORM_FOR_USER')">προσθήκη χρήστη</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>

        <table>
            <tr>
                <th>id</th>
                <th>Username</th>
                <th>Κωδικός</th>
                <th>Όνομα</th>
                <th>Επίθετο</th>
                <th>Email</th>
                <th>Ηλικία</th>
                <th>Περιοχή</th>
                <th>Εικόνα</th>
                <th class="keno"></th>
            </tr>

            <?php // εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10
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
            $result_count = mysqli_query($link, "SELECT COUNT(*) As total_records FROM `user`");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total pages minus 1

            //7
            $result = mysqli_query($link, "SELECT * FROM `user` LIMIT $offset, $total_records_per_page");
            while($row = mysqli_fetch_array($result)){
                echo "<tr>
                     <td>".$row['id']."</td>
                     <td>".$row['username']."</td>
                     <td>".$row['password']."</td>
                     <td>".$row['first_name']."</td>
                     <td>".$row['last_name']."</td>
                     <td>".$row['email']."</td>
                     <td>".$row['age']."</td>
                     <td>".$row['region']."</td>";
                echo '<td><a href="?user_image='.$row['id'].'">' . $row['image'] . '</a></td>';
                if ($row['id'] == 1){ //ο admin δεν μπορεί να αλλάξει τον κωδικό ή/και τα στοιχεία του
                    echo "<td class='keno'> </tr>";
                } else {
                    echo "<td class='keno'>
                    <a href='?edit_user=" . $row['id'] . "'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='?leave_action=" . $row['id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                     </tr>";
                }
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

    <!-- pop up form για προσθήκη νέου χρήστη από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_USER" role="dialog">
        <form action="Admin_user.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Δημιουργία χρήστη</h3>
            <span>* Υποχρεωτικά πεδία</span><br>
            <p>
                <label for="username"><b>Username</b><span>*</span><br>
                    <input type="text" placeholder="Γράψε username" name="username" required>
                </label>
            </p>
            <p>
                <label for="email"><b>Email</b><span>*</span><br>
                    <input type="email" placeholder="Γράψε Email" name="email" required>
                </label>
            </p>
            <p>
                <label for="first_name"><b>Όνομα</b><span>*</span><br>
                    <input type="text" placeholder="Γράψε Όνομα" name="firstname" required>
                </label>
            </p>
            <p>
                <label for="last_name"><b>Επίθετο</b><span>*</span><br>
                    <input type="text" placeholder="Γράψε Επίθετο" name="lastname" required>
                </label>
            </p>
            <p>
                <label for="password"><b>Κωδικός</b><span>*</span><br>
                    <input type="password" placeholder="Γράψε κωδικό" name="pass" required>
                </label>
            </p>
            <input name="submit" type="submit" value="Καταχώρηση χρήστη" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_USER')">Ακύρωση</button>
        </form>
    </div>

    <!-- pop up form για την τροποποίηση των στοιχείων ενός χρήστη -->
    <div class="form-popup" id="FORM_FOR_EDIT_USER" role="dialog">
        <form action="Admin_user.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Τροποποίηση των δεδομένων του χρήστη</h3>
            <?php
            if (isset($_GET['edit_user'])) { // ο χρήστης έχει πατήσει τον κάδο για να αποχωρήσει από κάποια δράση και η μεταβλητή $_GET['leave_action'] έχει το id αυτής της δράσης
                include("connect_to_database.php");
                $id = $_GET['edit_user'];
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
        function openEditForm(user_id) {
            document.getElementById('FORM_FOR_EDIT_USER').style.display = "block";
            window.onkeydown = function(event) {
                if ( event.keyCode === 27 ) {
                    closeEditForm();
                }
            };
        }
        function closeEditForm() {
            document.getElementById('FORM_FOR_EDIT_USER').style.display = "none";
        }
    </script>

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

    <div class="alert red" id="NOT_AVAILABLE_USERNAME">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_USERNAME')">&times;</span>
        <strong>Αποτυχία δημιουργίας χρήστη!</strong> Το συγκεκριμένο username χρησιμοποιείται
    </div>

    <div class="alert red" id="NOT_AVAILABLE_EMAIL">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_EMAIL')">&times;</span>
        <strong>Αποτυχία δημιουργίας χρήστη!</strong> Το συγκεκριμένο email χρησιμοποιείται
    </div>

    <div class="alert" id="USER_CREATED">
        <span class="closeBtn" onclick="closeAlertMessage('USER_CREATED')">&times;</span>
        <strong>Επιτυχία!</strong> Ο χρήστης δημιουργήθηκε
    </div>

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
    if (isset($_GET['edit_user'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα ενός χρήστη και η μεταβλητή $_GET['edit_user'] έχει το id αυτού του χρήστη
        echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_USER');".'</script>';
    }
    ?>

    <!--Εμφάνιση μηνύματος ότι ο χρήστης αποχώρησε από την δράση-->
    <div class="alert" id="user_leaves_action">
        <span class="closeBtn" onclick="closeAlertMessage('user_leaves_action')">&times;</span>
        <strong>Αποχώρησες από τη δράση!</strong>
    </div>
    <?php
    if (isset($_SESSION['user_leaves_action'])) {
        if ($_SESSION['user_leaves_action'] == "user_leaves_action_") {
            echo '<script  type="text/javascript">openAlertMessage("user_leaves_action");</script>';
            $_SESSION['user_leaves_action'] = null;
        }
    }
    ?>
    <!--τέλος εμφάνισης μηνύματος-->

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

    <!-- pop up παράθυρο για την προβολή μιας εικόνας ενός χρήστη -->
    <div class="form-popup" id="FORM_FOR_USER_IMAGE">
        <form class="form-container">
            <?php
            if (isset($_GET['user_image'])) {
                include("connect_to_database.php");
                $id = $_GET['user_image'];
                $query = "SELECT username, image FROM user WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                echo '<h3>Προβολή εικόνας του χρήστη '.$row["username"].'</h3><br>
                <img height="400px" alt="user image" src="images/Uploads/User_Images/'.$row["image"].'/">';
            }
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_USER_IMAGE')">κλείσιμο</button>
        </form>
    </div>
    <?php
    if (isset($_GET['user_image'])) {
        echo '<script type="text/javascript">'."openForm('FORM_FOR_USER_IMAGE');".'</script>';
    }
    ?>

    <?php
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
        } else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE USERNAME") {
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

</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>
<?php //echo date("Y");?>
<!--https://www.allphptricks.com/create-simple-pagination-using-php-and-mysqli/-->
</body>
</html>
