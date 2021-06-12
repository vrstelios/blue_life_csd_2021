<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Είσοδος</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_signin.css">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
            include_once("connect_to_database.php");
            //$_SESSION['connected_id'] = 0; //temporary μόνο και μόνο για να μην εμφανίζεται warning στο navigation.php
            if (isset($_POST['user'])) { // ο χρήστης έχει δώσει κάποια τιμή στο πεδίο username του Login.php ( και έχει πατήσει το κουμπί Είσοδος)
                //echo '<br>' . $username . '<br>';
                $username = $_POST['user'];
                if (isset($_POST['pass'])) { // ο χρήστης έχει δώσει επίσης κάποια τιμή στο πεδίο password του Login.php
                    //echo $password . '<br>';
                    //echo '<h1>' ."YPARXEI TO \$_POST['pass']!!!!!!!" . '</h1>';
                    $password = $_POST['pass'];

                    $query = "SELECT id, password FROM user WHERE username='$username' "; // έλεγχος του username αν υπάρχει στη βάση

                    if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                        $num_results = mysqli_num_rows($results);
                        if ($num_results > 0) {
                            $row = mysqli_fetch_array($results);
                            $right_password = $row['password'];
                            if ($password == $right_password) { // έλεγχος του password που έδωσε ο χρήστης αν ταυτίζεται με αυτόν που υπάρχει στη βάση
                                $_SESSION['connected_username'] = $username; // ΟΡΙΖΟΥΜΕ ΤΗΝ "ΚΑΘΟΛΙΚΗ" ΜΕΤΑΒΛΗΤΗ ΓΙΑ ΤΟ USERNAME ΤΟΥ ΧΡΗΣΤΗ
                                $_SESSION['connected_id'] = $row['id'];
                                header("Location: Home.php"); // Ανακατεύθυνση από την σελίδα Login στην Home μόλις κάνει επιτυχή σύνδεση ο χρήστης
                            }
                        } //else { echo '<h1>not connected</h1> <br>'; }
                        $_SESSION['submit'] = "FALSE LOGIN DATA";
                        @mysqli_free_result($results);
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
<?php include("navigation.php"); ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="images/Main/Underwater2.mp4">
            </video>
        </div>
        <h2>Είσοδος</h2>
    </div>
</div>

<?php
    // αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα Login.php τότε φορτώνεται η σελίδα Home.php
    if (isset($_SESSION['connected_id'])){
        header("Location: Home.php");
    }
?>
<!---------------Είσοδος--------------->
<div class="SignIn">
    <div class="login-img">
        <form action="Login.php" method="post" class="container_page_login">
            <h3 class="login"> Σύνδεση </h3>

            <label class="username">
                <b> Username </b>
            </label>
            <input type="text" placeholder="Εισάγετε username"  name="user" size="35" required>

            <label class="pass">
                <b> Κωδικός </b>
            </label>
            <input type="password" placeholder="Εισάγετε Κωδικό" name="pass" size="35" required>

            <!--button class="btn_login">Είσοδος</button   Παλιό-->
            <!--input type="submit" name="submit" value="Είσοδος" class="btn_login"/ Αυτό ή-->
            <input type="submit" value="Είσοδος" class="btn_login"/> <!-- ...αυτό;-->

            <button onclick="document.location='Register.php'" class="btn_SignUp">Δημιουργήστε τον δικό σας λογαριασμό!</button>

            <!--
            <button class="btn_Forgot_your_Pass" id="btn-modal">Ξεχάσατε τον κωδικό σας;</button>
            <div class="overlay" id="overlay"></div>
            <div class="modal" id="modal">
                <button class="modal-close-btn" id="close-btn"><i class="fa fa-times" ></i></button>
                <p>Ξέχασες τον κωδικό σου; Κανένα πρόβλημα! Γράψε το email σου και θα λάβεις τον καινούργιο κωδικό σου εκεί.</p>
                <label class="email_register"><b>Διεύθυνση email</b></label><br/>
                <input type="text_email" placeholder="Γράψε email" size="37" required><br/><br/>
                <button class="btn_submit">Υποβολή</button>
            </div>
            -->

        </form>
        <!-----------------dialog-------------->
        <script>
            document.getElementById('btn-modal').addEventListener('click', function() {
                document.getElementById('overlay').classList.add('is-visible');
                document.getElementById('modal').classList.add('is-visible');
            });

            document.getElementById('close-btn').addEventListener('click', function() {
                document.getElementById('overlay').classList.remove('is-visible');
                document.getElementById('modal').classList.remove('is-visible');
            });
            document.getElementById('overlay').addEventListener('click', function() {
                document.getElementById('overlay').classList.remove('is-visible');
                document.getElementById('modal').classList.remove('is-visible');
            });
        </script>
    </div>

    <div class="alert red" id="FALSE_LOGIN_DATA">
        <span class="closeBtn" onclick="closeAlertMessage('FALSE_LOGIN_DATA')">&times;</span>
        <strong>Αποτυχία σύνδεσης!</strong> Λάθος username ή κωδικός
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

    <?php
    if (isset($_SESSION['submit'])) {
        if ($_SESSION['submit'] == "FALSE LOGIN DATA") {
            echo '<script type="text/javascript">openAlertMessage("FALSE_LOGIN_DATA");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "USER CREATED") {
            echo '<script type="text/javascript">openAlertMessage("USER_CREATED");</script>';
            $_SESSION['submit'] = null;
        }
    }
    ?>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>
</body>
</html>