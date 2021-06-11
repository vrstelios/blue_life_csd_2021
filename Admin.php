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
                <th>Όνομα</th>
                <th>Επίθετο</th>
                <th>Email</th>
                <th>Ηλικία</th>
                <th>Περιοχή</th>
                <th>Εικόνα</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους
            $query = "SELECT * FROM user";
            $results = mysqli_query($link, $query);
            while  ($row = mysqli_fetch_array($results)) {
                $edit_id = $row['id'];
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>' . $row['region'] . '</td>';
                echo '<td>' . $row['image'] . '</td>';
                echo "<td class='keno'>
                    <img class='pencil' src='images/6.Admin/edit.png' alt='edit' onclick='javascript:openEditForm($edit_id)'>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';

            }
            @mysqli_free_result($results);

            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <!-- pop up form για προσθήκη νέου χρήστη από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_USER" role="dialog">
        <form action="Admin.php" method="post" class="form-container">
            <h3>Δημιουργία χρήστη</h3>
            <span>* Υποχρεωτικά πεδία</span><br>
            <p>
                <label for="username"><b>Username</b><span>*</span>
                    <input type="text" placeholder="Γράψε username" name="username" required>
                </label>
            </p>
            <p>
                <label for="email"><b>Email</b><span>*</span>
                    <input type="email" placeholder="Γράψε Email" name="email" required>
                </label>
            </p>
            <p>
                <label for="first_name"><b>Όνομα</b><span>*</span>
                    <input type="text" placeholder="Γράψε Όνομα" name="firstname" required>
                </label>
            </p>
            <p>
                <label for="last_name"><b>Επίθετο</b><span>*</span>
                    <input type="text" placeholder="Γράψε Επίθετο" name="lastname" required>
                </label>
            </p>
            <p>
                <label for="password"><b>Κωδικός</b><span>*</span>
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
                $_SESSION["o"]=null;
                echo '<script type="text/javascript">["o"]=sessionStorage.user_id;</script>';
                echo $_SESSION["o"];
            ?>
            <p>
                <label for="username"><b>Username</b>
                    <input type="text" placeholder="Γράψε username" name="username" required>
                </label>
            </p>
            <p>
                <label for="email"><b>Email</b>
                    <input type="email" placeholder="Γράψε Email" name="email" required>
                </label>
            </p>
            <p>
                <label for="first_name"><b>Όνομα</b>
                    <input type="text" placeholder="Γράψε Όνομα" name="firstname" required>
                </label>
            </p>
            <p>
                <label for="last_name"><b>Επίθετο</b>
                    <input type="text" placeholder="Γράψε Επίθετο" name="lastname" required>
                </label>
            </p>
            <p>
                <label for="age"><b>Ηλικία</b>
                    <input type="number" placeholder="Γράψε Ηλικία" name="age">
                </label>
            </p>
            <p>
                <label for="region"><b>Περιοχή</b>
                    <input type="text" placeholder="Γράψε Περιοχή" name="region">
                </label>
            </p>
            <p>
                <label for="password"><b>Κωδικός</b>
                    <input type="password" placeholder="Γράψε κωδικό" name="pass" required>
                </label>
            </p>
            <p class="input_image">
                <label for="image"><b>Εικόνα</b></label>
                <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα">
            </p>
            <input name="submit" type="submit" value="Αποθήκευση" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeEditForm()">Ακύρωση</button>
        </form>
    </div>

    <script>
        function openEditForm(user_id) {
            sessionStorage.user_id = user_id;
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
                echo '<td>' . $row['image'] . '</td>';
                echo '<td>' . $row['link'] . '</td>';
                echo "<td class='keno'>
                    <a href='Admin.php'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
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
                <label for="title"><b>Τίτλος</b><span>*</span>
                    <input type="text" placeholder="Δώσε τίτλο" name="title" required>
                </label>
            </p>
            <p>
                <label for="location"><b>Τοποθεσία</b><span>*</span>
                    <input type="text" placeholder="Δώσε τοποθεσία" name="location" required>
                </label>
            </p>
            <p>
                <label for="link"><b>Link</b>
                    <input type="url" placeholder="Δώσε link" name="link">
                </label>
            </p>
            <p>
                <label for="date"><b>Ημερομηνία</b><span>*</span>
                    <input type="date" placeholder="Δώσε ημερομηνία" name="date" required>
                </label>
            </p>
            <p class="input_image">
                <label for="image"><b>Εικόνα</b><span>*</span></label>
                <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" required>
            </p>
            <p style="width: 100%">
                <label for="subject"><b>Λεπτομέρειες</b><span>*</span></label>
                <textarea placeholder="Δώσε περισσότερες πληροφορίες..." name="subject" id="subject" required></textarea>
            </p>
            <input name="submit" type="submit" value="Καταχώρηση δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_ACTION')">Ακύρωση</button>
        </form>
    </div>

    <div class="alert" id="ACTION_CREATED">
        <span class="closeBtn" onclick="closeAlertMessage('ACTION_CREATED')">&times;</span>
        <strong>Επιτυχία!</strong> Η δράση καταχωρήθηκε
    </div>

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
                        <a href='Admin.php'><img src='images/6.Admin/edit.png' alt='edit'></a>
                        <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
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
                        <a href='javascript:void(0);' >Read</a>
                    </td>";
                    echo '</tr>';
                }
                @mysqli_free_result($results);
                @mysqli_close($link);
            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <!-- pop up form για προσθήκη νέας δράσης από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_CONTACT">
        <form action="Admin.php" class="form-container">
            <h3>Προβολή φόρμας</h3>
            <?php
                echo "Όνομα:";
                echo "Επίθετο:";
                echo "Email:";
                echo "Ημερομηνία:";
                echo "Σχόλια:";
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_CONTACT')">κλείσιμο</button>
        </form>
    </div>

    <?php
        if($_SESSION['submit']=="NOT AVAILABLE USERNAME"){
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_USERNAME");</script>';
            $_SESSION['submit'] = null;
        } else if($_SESSION['submit']=="NOT AVAILABLE EMAIL"){
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_EMAIL");</script>';
            $_SESSION['submit'] = null;
        } else if($_SESSION['submit']=="USER CREATED"){
            echo '<script type="text/javascript">openAlertMessage("USER_CREATED");</script>';
            $_SESSION['submit'] = null;
        } else if($_SESSION['submit']=="ACTION CREATED"){
            echo '<script type="text/javascript">openAlertMessage("ACTION_CREATED");</script>';
            $_SESSION['submit'] = null;
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
