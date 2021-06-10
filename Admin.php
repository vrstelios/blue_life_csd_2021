<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Σελίδα διαχείρησης</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_admin.css">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");
        echo $_POST['submit'];
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

            $query = "SELECT id FROM user WHERE username LIKE '$username' ";

            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                $num_results = mysqli_num_rows($results);
                if ($num_results > 0) {
                    echo '<script type="text/javascript">' . 'alert("Υπάρχει ήδη λογαριασμός με αυτό το username!");' . '</script>';
                } else {
                    $query = "INSERT INTO user (username, password, first_name, last_name, email)
                                      VALUES ('$username', '$password', '$firstname', '$lastname', '$email');";
                    if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                        echo '<script type="text/javascript">' . 'closeFormForUser();' . '</script>';
                        header("Location: Admin.php");
                    }
                }
            }
        }
        if ($_POST['submit'] == 'Καταχώρηση δράσης') {
            echo $_POST['submit'];
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
            /*
            $image = $_FILES['image']['tmp_name'];
            $img = file_get_contents($image);
            */
            if (isset($_POST['img'])) {
                $image = $_POST['img'];
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
                echo '<script type="text/javascript">' . 'closeFormForAction();' . '</script>';
                header("Location: Admin.php");
            }
        }
        @mysqli_free_result($results);
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
    <h2>Σελίδα διαχείρησης</h2>
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
        <button class="table_button" onclick="openFormForUser()">προσθήκη χρήστη</button>
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

    <!-- pop up form για προσθήκη νέου χρήστη από τον διαχειριστή -->
    <div class="form-popup" id="myForm1" role="dialog">
        <form action="Admin.php" method="post" class="form-container">
            <h3>Δημιουργία χρήστη</h3>
            <p>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Γράψε username" name="username" required>
            </p>
            <p>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Γράψε Email" name="email" required>
            </p>
            <p>
            <label for="first_name"><b>Όνομα</b></label>
            <input type="text" placeholder="Γράψε Όνομα" name="firstname" required>
            </p>
            <p>
            <label for="last_name"><b>Επίθετο</b></label>
            <input type="text" placeholder="Γράψε Επίθετο"  name="lastname" required>
            </p>
            <p>
            <label for="password"><b>Κωδικός</b></label>
            <input type="password" placeholder="Γράψε κωδικό" name="pass" required>
            </p>
            <input name="submit" type="submit" value="Καταχώρηση χρήστη" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeFormForUser()">Ακύρωση</button>
        </form>
    </div>

    <script>
        function openFormForUser() {
            document.getElementById("myForm1").style.display = "block";
        }
        function closeFormForUser() {
            document.getElementById("myForm1").style.display = "none";
        }
    </script>


    <h3>Δράσεις</h3>
    <div class="actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΡΑΣΕΙΣ
            <?php //εμφανίζουμε το πλήθος των δράσεων
            print_size_of_table($link,'action');
            ?>
            <button class="table_button" onclick="openFormForAction()">προσθήκη δράσης</button>
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
    <div class="form-popup" id="myForm2">
        <form action="Admin.php" method="post" class="form-container">
            <h3>Δημιουργία δράσης</h3>
            <p>
                <label for="title"><b>Τίτλος</b></label>
                <input type="text" placeholder="Δώσε τίτλο" name="title" required>
            </p>
            <p>
                <label for="location"><b>Τοποθεσία</b></label>
                <input type="text" placeholder="Δώσε τοποθεσία" name="location">
            </p>
            <p>
                <label for="link"><b>Link</b></label>
                <input type="url" placeholder="Δώσε link" name="link">
            </p>
            <p>
                <label for="date"><b>Ημερομηνία</b></label>
                <input type="date" placeholder="Δώσε ημερομηνία" name="date">
            </p>
            <p>
                <label for="image"><b>Εικόνα</b></label>
                <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα">
            </p>
            <p style="width: 100%">
                <label for="subject"><b>Λεπτομέρειες</b></label>
                <textarea placeholder="Δώσε περισσότερες πληροφορίες..." style="height:100px; width: 100%; resize: none;" name="subject" id="subject"></textarea>
            </p>
            <input name="submit" type="submit" value="Καταχώρηση δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeFormForAction()">Ακύρωση</button>
        </form>
    </div>

    <script>
        function openFormForAction() {
            document.getElementById("myForm2").style.display = "block";
        }
        function closeFormForAction() {
            document.getElementById("myForm2").style.display = "none";
        }
        function saveData2() {

        }
    </script>

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
                    <a href='javascript:void(0);' onclick='openForm3()'>Read</a>
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
    <div class="form-popup" id="myForm3">
        <form action="Admin.php" class="form-container">
            <h3>Προβολή φόρμας</h3>
            <?php
                echo "Όνομα:";
                echo "Επίθετο:";
                echo "Email:";
                echo "Ημερομηνία:";
                echo "Σχόλια:";
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm3()">κλείσιμο</button>
        </form>
    </div>

    <script>
        function openForm3() {
            document.getElementById("myForm3").style.display = "block";
        }
        function closeForm3() {
            document.getElementById("myForm3").style.display = "none";
        }
    </script>

</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>