<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Εγγραφή</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_signup.css">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['submit'] == 'Εγγραφή') {
                $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
                include("../General-components/connect_to_database.php");

                if (isset($_POST['username'])) {
                    $username = $_POST['username'];
                }else {
                    $username = null;
                }
                if (isset($_POST['password'])) {
                    $password = $_POST['password'];
                } else {
                    $password = null;
                }
                if (isset($_POST['checkPassword'])) {
                    $checkPassword = $_POST['checkPassword'];
                } else {
                    $checkPassword = null;
                }
                if (isset($_POST['first_name'])) {
                    $firstname = $_POST['first_name'];
                } else {
                    $firstname = null;
                }
                if (isset($_POST['last_name'])) {
                    $lastname = $_POST['last_name'];
                } else {
                    $lastname = null;
                }
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $email = null;
                }

                $query1 = "SELECT * FROM user WHERE username='$username'";
                $query2 = "SELECT * FROM user WHERE email='$email'";
                $results1 = mysqli_query($link,$query1);
                $results2 = mysqli_query($link,$query2);
                if(mysqli_num_rows($results1)>0){
                    $_SESSION['submit'] = "NOT AVAILABLE USERNAME";
                }elseif(mysqli_num_rows($results2)>0){
                    $_SESSION['submit'] = "NOT AVAILABLE EMAIL";
                }elseif ($checkPassword != $password){
                    $_SESSION['submit'] = "DIFFERENT PASSWORDS";
                }else{
                    $query = "INSERT INTO user (username,password,first_name,last_name,email)
                      VALUES ('$username','$password','$firstname','$lastname','$email');";
                    if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                        $_SESSION['submit'] = "USER CREATED";
                        header("Location:Login-Register.php");
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
<?php include("../General-components/navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="../images/Main/Underwater2.mp4">
            </video>
        </div>
        <h2>Εγγραφή</h2>
    </div>
</div>

<?php
    // αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα Register.php τότε φορτώνεται η σελίδα Home.php
    if (isset($_SESSION['connected_id'])){
        header("Location: ../Home/Home.php");
    }
?>

<!---------------Εγγραφή--------------->
<div class="SignUp">
    <div class="login-img">
        <form action="Register.php" method="post" class="container_page_register">
            <h3 class="register">Δημιούργησε τον λογαριασμό σου</h3>
            <h1 class="necessary">* Υποχρεωτικά πεδία </h1>

            <label class="user"><b>Username <span class="necessary_fields">*</span> </b></label>
            <input  type="text" name="username" placeholder="Γράψε username" size="37" required>

            <label class="email_register"><b>Διεύθυνση email <span class="necessary_fields">*</span> </b></label>
            <input type="email" name="email" placeholder="Γράψε email" size="37" required>

            <label class="first_name"><b>Όνομα <span class="necessary_fields">*</span> </b></label>
            <input  type="text" name="first_name" placeholder="Γράψε Όνομα" size="37" required>

            <label class="last_name"><b>Επίθετο <span class="necessary_fields">*</span> </b></label>
            <input  type="text" name="last_name" placeholder="Γράψε Επίθετο" size="37" required>

            <label class="pass1"><b>Κωδικός <span class="necessary_fields">*</span> </b></label>
            <input type="password" class="input_pass1" id="password" name="password" placeholder="Γράψε κωδικό" size="37" onkeyup='check()' required>

            <label class="pass2"><b>Επαλήθευση κωδικού <span class="necessary_fields">*</span> </b></label>
            <input type="password" id="checkPassword" name="checkPassword" class="input_pass2" placeholder="Γράψε κωδικό" size="37" onkeyup='check()' required>

            <p id="alertPassword"></p>

            <input name="submit" type="submit" value="Εγγραφή" class="btn_register"/>
            <button class="btn_back" onclick="document.location='Login.php'">Μήπως έχεις ήδη λογαριασμό;</button>
        </form>
    </div>

    <script>
        var check = function() {
            if(document.getElementById('checkPassword').value !== "") {
                if (document.getElementById('password').value === document.getElementById('checkPassword').value) {
                    document.getElementById('alertPassword').style.color = '#3e8e41';
                    document.getElementById('alertPassword').innerHTML = '<span class="match">Αποδεκτός κωδικός!</span>';
                } else {
                    document.getElementById('alertPassword').style.color = '#f10516';
                    document.getElementById('alertPassword').innerHTML = '<span class="match">Ο κωδικός πρόσβασης δεν ταιριάζει!</span>';
                }
            }else {
                document.getElementById('alertPassword').innerHTML = '';
            }
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

    <div class="alert red" id="DIFFERENT_PASSWORDS">
        <span class="closeBtn" onclick="closeAlertMessage('DIFFERENT PASSWORDS')">&times;</span>
        <strong>Αποτυχία δημιουργίας χρήστη!</strong> Ο κωδικός δεν αντιστοιχούσε με την επιβεβαίωσή του
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
        if ($_SESSION['submit'] == "NOT AVAILABLE USERNAME") {
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_USERNAME");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "NOT AVAILABLE EMAIL") {
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_EMAIL");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "DIFFERENT PASSWORDS") {
            echo '<script type="text/javascript">openAlertMessage("DIFFERENT_PASSWORDS");</script>';
            $_SESSION['submit'] = null;
        }
    }
    ?>
</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>

</body>
</html>