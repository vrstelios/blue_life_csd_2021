<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Εγγραφή</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_signup.css">

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");

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

        $sql1 = "SELECT * FROM user WHERE email='$email'";
        $sql2 = "SELECT * FROM user WHERE username='$username'";
        $res1 = mysqli_query($link,$sql1);
        $res2 = mysqli_query($link,$sql2);
        if(mysqli_num_rows($res2)>0){
            echo '<script language="javascript">';
            echo 'alert("Υπάρχει ήδη λογαριασμός με αυτό το username!");';
            echo '</script>';
            exit;
        }elseif(mysqli_num_rows($res1)>0){
            echo '<script language="javascript">';
            echo 'alert("Υπάρχει ήδη λογαριασμός με αυτό το email!");';
            echo '</script>';
            exit;
        }elseif ($checkPassword != $password){
            echo '<script language="javascript">';
            echo 'alert("Υπάρχει ήδη λογαριασμός με αυτό ο κωδικός!");';
            echo '</script>';
            exit;
        }else{
            $query = "INSERT INTO user (username,password,first_name,last_name,email)VALUES ('$username','$password','$firstname','$lastname','$email');";
        }

        if ($results = mysqli_query($link, $query)) {
            // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
            header("Location:Login.php");
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
        <h2>Εγγραφή</h2>
    </div>
</div>

<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα Register.php τότε φορτώνεται η σελίδα Home.php
if (isset($_SESSION['connected_id'])){
    header("Location: Home.php");
}
?>

<!---------------Εγγραφή--------------->
<div class="SignUp">
    <div class="login-img">
        <form   method="post" class="container_page_register">
            <h3 class="register">Δημιούργησε τον λογαριασμό σου</h3>

            <label class="user"><b>Username</b></label>
            <input  type="text" name="username" placeholder="Γράψε username" size="37" required>

            <label class="email_register"><b>Διεύθυνση email</b></label>
            <input type="email" name="email" placeholder="Γράψε email" size="37" required>

            <label class="first_name"><b>Όνομα</b></label>
            <input  type="text" name="first_name" placeholder="Γράψε Όνομα" size="37" required>

            <label class="last_name"><b>Επίθετο</b></label>
            <input  type="text" name="last_name" placeholder="Γράψε Επίθετο" size="37" required>

            <label class="pass1"><b>Κωδικός</b></label>
            <input type="password" class="input_pass1" id="password" name="password" placeholder="Γράψε κωδικό" size="37" onkeyup='check()' required>

            <label class="pass2"><b>Επαλήθευση κωδικού</b></label>
            <input type="password" id="checkPassword" name="checkPassword" class="input_pass2" placeholder="Γράψε κωδικό" size="37" onkeyup='check()' required>

            <p id="alertPassword"></p>

            <button class="btn_register" >Εγγραφή</button>

            <button class="btn_back" onclick="document.location='Login.php'">Μήπως έχεις ήδη λογαριασμό;</button>
        </form>
    </div>
</div>

<script>
    var check = function() {
        if(document.getElementById('checkPassword').value !== "") {
            if (document.getElementById('password').value === document.getElementById('checkPassword').value) {
                document.getElementById('alertPassword').style.color = '#3e8e41';
                document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-check-circle"></i>Match !</span>';
            } else {
                document.getElementById('alertPassword').style.color = '#f10516';
                document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-exclamation-triangle"></i>not matching</span>';
            }
        }else {
            document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-check-circle"></i></span>';
        }
    }
</script>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>