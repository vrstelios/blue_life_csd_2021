<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Είσοδος</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_contact_singin_up.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>

<!---------------Navigation bar--------------->
<?php include("navigation.html")?>


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
        <form action="px.php" method="post" class="container_page_login">
            <h3 class="login">Σύνδεση</h3>

            <label class="username"><b>Username</b></label>
            <input  type="text" placeholder="Εισάγετε username"  name="user" size="35" required>
            <label class="pass"><b>Κωδικός</b></label>
            <input  type="password"  placeholder="Εισάγετε Κωδικό" name="pass" size="35" required>

            <button class="btn_login">Είσοδος</button>

            <button onclick="document.location='Register.php'" class="btn_SignUp">Δημιουργήστε τον δικό σας λογαριασμό!</button>

            <button class="btn_Forgot_your_Pass" id="btn-modal">Ξεχάσατε τον κωδικό σας;</button>
            <div class="overlay" id="overlay"></div>
            <div class="modal" id="modal">
                <button class="modal-close-btn" id="close-btn"><i class="fa fa-times" ></i></button>
                <p>Ξέχασες των κωδικό σου κανένα πρόβλημα δώσε μας το email σου και θα σου στείλουμε εμείς τον καινούργιο κωδικό σου.</p>
                <label class="email_register"><b>Διεύθυνση email</b></label><br/>
                <input type="text_email" placeholder="Γράψε email" size="37" required><br/><br/>
                <button class="btn_submit">Υποβολή</button>
            </div>

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