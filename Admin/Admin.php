<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Σελίδα διαχείρισης</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_admin.css">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("../General-components/connect_to_database.php");
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

            $query = "SELECT id FROM action WHERE title='$title'";
            $results = mysqli_query($link, $query);

            if (mysqli_num_rows($results) > 0) {
                $_SESSION['submit'] = "NOT AVAILABLE TITLE";
            } else {
                $query = "INSERT INTO action (title,date,location,description,image,link)
                  VALUES ('$title','$date','$location','$description','$image','$link_info');";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "ACTION CREATED";
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
            if (isset($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
            } else {
                $image = null;
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
                  last_name='$lastname', email='$email', age='$age', region='$region', image='$image' WHERE id=$id;";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "EDIT USER SAVED";
                }
            }
        }
        if ($_POST['submit'] == 'Ενημέρωση των δεδομένων της δράσης') {
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
            if (isset($_POST['subject'])) {
                $description = $_POST['subject'];
            } else {
                $description = null;
            }

            $query = "SELECT id,image FROM action WHERE title='$title'";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            $id = $row['id'];

            if (isset($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
            } else {
                $image = $row['image'];
            }

            $query = "SELECT id FROM action WHERE title='$title' AND id!=$id";
            $results = mysqli_query($link, $query);

            if (mysqli_num_rows($results) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE TITLE";
            } else {
                $query = "UPDATE action SET title='$title', date='$date', location='$location',
                  description='$description', image='$image', link='$link' WHERE id=$id;";
                //το link χτυπάει έρρορ :( -----------------------------------------------------------
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "EDIT ACTION SAVED";
                }
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
// αν ο χρήστης δεν είναι ο admin και προσπαθήσει να φορτώσει την σελίδα Admin.php τότε φορτώνεται η σελίδα UnauthorizedProfile.php για την ασφάλεια και απόκρυψη των στοιχείων
if ($_SESSION['connected_id'] != 1){
    header("Location: UnauthorizedProfile.php");
}
$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
include("connect_to_database.php");

function print_size_of_table($link, $table){
    //εμφανίζουμε το πλήθος των συνολικών συμμετοχών στις δράσεις
    $query = "SELECT COUNT(*) FROM $table";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo '(' . $row[0] . ')';
}
?>

<div class="admin-page">
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
            include("connect_to_database.php");
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
                     <td>".$row['region']."</td>
                     <td>".$row['image']."</td>";
                echo "<td class='keno'>
                    <a href='Admin.php'><img src='../images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='../images/6.Admin/delete-bin.png' alt='delete'></a>
                     </tr>";
            }
            //mysqli_close($link);
            ?>

            <!--9-->

            <?php //εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους
            /*
            $query = "SELECT * FROM user";
            $results = mysqli_query($link, $query);
            while  ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>' . $row['region'] . '</td>';
                echo '<td><a href="?user_image='.$row['id'].'">' . $row['image'] . '</a></td>';
                echo "<td class='keno'>
                    <a href='?edit_user=" . $row['id'] . "'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';

            }
            @mysqli_free_result($results);
*/
            ?>
        </table>

        <?php //εμφανίζουμε τη λίστα των σελίδων
        echo "<div class='my_table'>";
        echo "<ul>";
        if ($total_no_of_pages <= 10){
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                if ($counter == $page_no) {
                    echo "<li class='active'><a>$counter</a></li>";
                }else{
                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                }
            }
        }elseif ($total_no_of_pages > 10){
            if($page_no <= 4) {
                for ($counter = 1; $counter < 8; $counter++){
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    }else{
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                echo "<li><a href='?page_no=1'>1</a></li>";
                echo "<li><a href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                    $counter = $page_no - $adjacents;
                    $counter <= $page_no + $adjacents;
                    $counter++
                ) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    }else{
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } else {
                echo "<li><a href='?page_no=1'>1</a></li>";
                echo "<li><a href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                    $counter = $total_no_of_pages - 6;
                    $counter <= $total_no_of_pages;
                    $counter++
                ) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    }else{
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }
        }
        echo "</ul>";
        echo "</div>";
        ?>


        <!--8-->
        <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Page <?php echo $page_no."/".$total_no_of_pages; ?></strong>
        </div>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <!-- pop up form για προσθήκη νέου χρήστη από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_USER" role="dialog">
        <form action="Admin.php" method="post" class="form-container">
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
        <form action="Admin.php" method="post" class="form-container">
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
    if (isset($_GET['edit_user'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα ενός χρήστη και η μεταβλητή $_GET['edit_user'] έχει το id αυτού του χρήστη
        echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_USER');".'</script>';
    }
    ?>

    <div class="alert red" id="NOT_AVAILABLE_USERNAME">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_USERNAME')">&times;</span>
        <strong>Αποτυχία δημιουργίας χρήστη!</strong> Το συγκεκριμένο username χρησιμοποιείται
    </div>

    <div class="alert red" id="NOT_AVAILABLE_EMAIL">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_EMAIL')">&times;</span>
        <strong>Αποτυχία δημιουργίας χρήστη!</strong> Το συγκεκριμένο email χρησιμοποιείται
    </div>

    <div class="alert red" id="EDIT_NOT_AVAILABLE_USERNAME">
        <span class="closeBtn" onclick="closeAlertMessage('EDIT_NOT_AVAILABLE_USERNAME')">&times;</span>
        <strong>Αποτυχία τροποίησης του χρήστη!</strong> Το συγκεκριμένο username χρησιμοποιείται
    </div>

    <div class="alert red" id="EDIT_NOT_AVAILABLE_EMAIL">
        <span class="closeBtn" onclick="closeAlertMessage('EDIT_NOT_AVAILABLE_EMAIL')">&times;</span>
        <strong>Αποτυχία τροποίησης του χρήστη!</strong> Το συγκεκριμένο email χρησιμοποιείται
    </div>

    <div class="alert" id="USER_CREATED">
        <span class="closeBtn" onclick="closeAlertMessage('USER_CREATED')">&times;</span>
        <strong>Επιτυχία!</strong> Ο χρήστης δημιουργήθηκε
    </div>

    <div class="alert" id="EDIT_USER_SAVED">
        <span class="closeBtn" onclick="closeAlertMessage('EDIT_USER_SAVED')">&times;</span>
        <strong>Επιτυχία!</strong> Τα δεδομένα του χρήστη τροποποιήθηκαν
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


    <h3>Δράσεις</h3>
    <div class="actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΡΑΣΕΙΣ
            <?php //εμφανίζουμε το πλήθος των δράσεων
            print_size_of_table($link,'action');
            ?>
            <button class="table_button" onclick="openForm('FORM_FOR_ACTION')">προσθήκη δράσης</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>id</th>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Τοποθεσία</th>
                <th>Περιγραφή</th>
                <th>Εικόνα</th>
                <th>Σύνδεσμος</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα όλων των δράσεων
            $query = "SELECT id, title, date, location, description, image, link 
                      FROM action";
            $results = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td><a href="?action_image='.$row['id'].'">' . $row['image'] . '</a></td>';
                echo '<td>' . $row['link'] . '</td>';
                echo "<td class='keno'>
                    <a href='?edit_action=".$row['id']. "'><img src='../images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='../images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';
            }
            @mysqli_free_result($results);
            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <!-- pop up form για προσθήκη νέας δράσης από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_ACTION">
        <form action="Admin.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Δημιουργία δράσης</h3>
            <span>* Υποχρεωτικά πεδία</span><br>
            <p>
                <label for="title"><b>Τίτλος</b><span>*</span><br>
                    <input type="text" placeholder="Δώσε τίτλο" name="title" required>
                </label>
            </p>
            <p>
                <label for="location"><b>Τοποθεσία</b><span>*</span><br>
                    <input type="text" placeholder="Δώσε τοποθεσία" name="location" required>
                </label>
            </p>
            <p>
                <label for="link"><b>Link</b><br>
                    <input type="url" placeholder="Δώσε link" name="link">
                </label>
            </p>
            <p>
                <label for="date"><b>Ημερομηνία</b><span>*</span><br>
                    <input type="date" placeholder="Δώσε ημερομηνία" name="date" required>
                </label>
            </p>
            <p class="input_image">
                <label for="image"><b>Εικόνα</b><span>*</span></label><br>
                <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" required>
            </p>
            <p style="width: 100%">
                <label for="subject"><b>Λεπτομέρειες</b><span>*</span></label><br>
                <textarea placeholder="Δώσε περισσότερες πληροφορίες..." name="subject" id="subject" required></textarea>
            </p>
            <input name="submit" type="submit" value="Καταχώρηση δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_ACTION')">Ακύρωση</button>
        </form>
    </div>

    <!-- pop up form για την τροποποίηση των δεδομένων μιας δράσης από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_EDIT_ACTION">
        <form action="Admin.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Τροποποίηση των δεδομένων της δράσης</h3>
            <?php
            if (isset($_GET['edit_action'])) { // ο χρήστης έχει πατήσει τον κάδο για να αποχωρήσει από κάποια δράση και η μεταβλητή $_GET['leave_action'] έχει το id αυτής της δράσης
                include("connect_to_database.php");
                $id = $_GET['edit_action'];
                $query = "SELECT * FROM action WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                echo '<p>
                    <label for="title"><b>Τίτλος</b><br>
                        <input type="text" placeholder="Δώσε τίτλο" name="title" value="'.$row['title'].'" required>
                    </label>
                </p>
                <p>
                    <label for="location"><b>Τοποθεσία</b><br>
                        <input type="text" placeholder="Δώσε τοποθεσία" name="location" value="'.$row['location'].'" required>
                    </label>
                </p>
                <p>
                    <label for="link"><b>Link</b><br>
                        <input type="url" placeholder="Δώσε link" name="link" value="'.$row['link'].'" >
                    </label>
                </p>
                <p>
                    <label for="date"><b>Ημερομηνία</b><br>
                        <input type="date" placeholder="Δώσε ημερομηνία" name="date" value="'.$row['date'].'" required>
                    </label>
                </p>
                <p class="input_image">
                    <label for="image"><b>Εικόνα</b></label><br>
                    <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" value="'.$row['image'].'">
                </p>
                <p style="width: 100%">
                    <label for="subject"><b>Λεπτομέρειες</b></label><br>
                    <textarea placeholder="Δώσε περισσότερες πληροφορίες..." name="subject" id="subject" required>'.$row['description'].'</textarea>
                </p>
                ';
            }
            ?>
            <input name="submit" type="submit" value="Ενημέρωση των δεδομένων της δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_EDIT_ACTION')">Ακύρωση</button>
        </form>
    </div>

    <div class="alert" id="ACTION_CREATED">
        <span class="closeBtn" onclick="closeAlertMessage('ACTION_CREATED')">&times;</span>
        <strong>Επιτυχία!</strong> Η δράση καταχωρήθηκε
    </div>

    <div class="alert" id="EDIT_ACTION_SAVED">
        <span class="closeBtn" onclick="closeAlertMessage('EDIT_ACTION_SAVED')">&times;</span>
        <strong>Επιτυχία!</strong> Τα δεδομένα της δράσης τροποποιήθηκαν
    </div>

    <div class="alert red" id="NOT_AVAILABLE_TITLE">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_TITLE')">&times;</span>
        <strong>Αποτυχία δημιουργίας δράσης!</strong> Ο συγκεκριμένος τίτλος χρησιμοποιείται
    </div>

    <div class="alert red" id="EDIT_NOT_AVAILABLE_TITLE">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_TITLE')">&times;</span>
        <strong>Αποτυχία τροποποίησης της δράσης!</strong> Ο συγκεκριμένος τίτλος χρησιμοποιείται
    </div>

    <?php
    if (isset($_GET['edit_action'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα ενός χρήστη και η μεταβλητή $_GET['edit_user'] έχει το id αυτού του χρήστη
        echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_ACTION');".'</script>';
    }
    ?>

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
                <img height="400px" alt="user image" src='.$row["image"].'>';
            }
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_USER_IMAGE')">κλείσιμο</button>
        </form>
    </div>

    <!-- pop up παράθυρο για την προβολή μιας εικόνας μιας δράσης -->
    <div class="form-popup" id="FORM_FOR_ACTION_IMAGE">
        <form class="form-container">
            <?php
            if (isset($_GET['action_image'])) {
                include("connect_to_database.php");
                $id = $_GET['action_image'];
                $query = "SELECT title, image FROM action WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                echo '<h3>Προβολή εικόνας της δράσης '.$row["title"].'</h3><br>
                <img height="400px" alt="action image" src='.$row["image"].'>';
            }
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_ACTION_IMAGE')">κλείσιμο</button>
        </form>
    </div>

    <?php
    if (isset($_GET['user_image'])) {
        echo '<script type="text/javascript">'."openForm('FORM_FOR_USER_IMAGE');".'</script>';
    }
    if (isset($_GET['action_image'])) {
        echo '<script type="text/javascript">'."openForm('FORM_FOR_ACTION_IMAGE');".'</script>';
    }
    ?>

    <h3>Χρήστης στη δράση</h3>
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
            <?php //εμφανίζουμε τους συμμετέχοντες στις δράσεις
            $query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                          FROM user, user_in_action, action
                          WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id";
            $results = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['user_id'] . '</td>';
                echo '<td>' . $row['action_id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date_joined'] . '</td>';
                echo "<td class='keno'>
                        <a href='Admin.php'><img src='../images/6.Admin/edit.png' alt='edit'></a>
                        <a href='Admin.php'><img src='../images/6.Admin/delete-bin.png' alt='delete'></a>
                    </td>";
                echo '</tr>';
            }

            @mysqli_free_result($results);
            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <h3>Επικοινωνία χρηστών</h3>
    <div class="contact-table">
        <p>ΟΛΕΣ ΟΙ ΦΟΡΜΕΣ
            <?php //εμφανίζουμε το πλήθος των σχόλιων των χρηστών
            print_size_of_table($link,'contact');
            ?>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>id</th>
                <th>Όνομα</th>
                <th>Επίθετο</th>
                <th>Email</th>
                <th>Ημερομηνία</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα των σχόλιων των χρηστών
            $query = "SELECT id, first_name, last_name, email, comment, date_of_comment 
                          FROM contact";
            $results = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['date_of_comment'] . '</td>';
                echo "<td class='keno'>
                        <a href='?contact_id=".$row['id']."' ><button class='table_button'>Προβολή</button></a>
                    </td>";
                echo '</tr>';
            }
            @mysqli_free_result($results);
            @mysqli_close($link);
            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <!-- pop up παράθυρο για την προβολή μιας φόρμας επικοινωνίας -->
    <div class="form-popup" id="FORM_FOR_CONTACT">
        <form class="form-container">
            <h3>Προβολή φόρμας</h3>
            <?php
            if (isset($_GET['contact_id'])) {
                include("connect_to_database.php");
                $id = $_GET['contact_id'];
                $query = "SELECT * FROM contact WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                echo "<div style='font-size: 20px'><b>Όνομα:</b> ".$row['first_name']."<br>
                <b>Επίθετο:</b> ".$row['last_name']."<br>
                <b>Email:</b> ".$row['email']."<br>
                <b>Ημερομηνία:</b> ".$row['date_of_comment']."<br>
                <b>Σχόλιο:</b><br>".$row['comment']."</div>";
            }
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_CONTACT')">κλείσιμο</button>
        </form>
    </div>
    <?php
    if (isset($_GET['contact_id'])) {
        echo '<script type="text/javascript">'."openForm('FORM_FOR_CONTACT');".'</script>';
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
        } else if ($_SESSION['submit'] == "ACTION CREATED") {
            echo '<script type="text/javascript">openAlertMessage("ACTION_CREATED");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "NOT AVAILABLE TITLE") {
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_TITLE");</script>';
            $_SESSION['submit'] = null;
        }else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE USERNAME") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_USERNAME");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE EMAIL") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_EMAIL");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "EDIT USER SAVED") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_USER_SAVED");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "EDIT ACTION SAVED") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_ACTION_SAVED");</script>';
            $_SESSION['submit'] = null;
        }else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE TITLE") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_TITLE");</script>';
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
