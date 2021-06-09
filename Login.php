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
    <link rel="stylesheet" href="styles_contact_singin_up.css">
    <?php
    //$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
    include_once("connect_to_database.php");
    if (isset($_POST['user'])) { // ο χρήστης έχει δώσει κάποια τιμή στο πεδίο username του Login.php (και στο password και έχει πατήσει το κουμπί Είσοδος)
        //echo '<br>' . $username . '<br>';
        $username = $_POST['user'];
        if (isset($_POST['pass'])){ // ο χρήστης έχει δώσει επίσης κάποια τιμή στο πεδίο password του Login.php
            //echo $password . '<br>';
            //echo '<h1>' ."YPARXEI TO \$_POST['pass']!!!!!!!" . '</h1>';
            $password = $_POST['pass'];

            $query = "SELECT id, password FROM user WHERE username LIKE '$username' "; // έλεγχος του username αν υπάρχει στη βάση

            if ($results = mysqli_query($link, $query)){ // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                $num_results = mysqli_num_rows($results);
                if ($num_results > 0){
                    $row = mysqli_fetch_array($results);
                    $right_password = $row['password'];
                    if ($password == $right_password) { // έλεγχος του password που έδωσε ο χρήστης αν ταυτίζεται με αυτόν που υπάρχει στη βάση
                        $_SESSION['connected_username'] = $username;
                    }
                } //else { echo '<h1>not connected</h1> <br>'; }
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
<?php include("navigation.php");
//echo "Session started !";
?>

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
    </div>
</div>

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

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>
</body>
</html>