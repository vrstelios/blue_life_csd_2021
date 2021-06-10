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

<!---------------Εγγραφή--------------->
<div class="SignUp">
    <div class="login-img">
        <form  class="container_page_register">
             <h3 class="register">Δημιούργησε τον λογαριασμό σου</h3>

            <label class="user"><b>Username</b></label>
            <input  type="text_name" placeholder="Γράψε username" size="37" required>

            <label class="email_register"><b>Διεύθυνση email</b></label>
            <input type="text_email" placeholder="Γράψε email" size="37" required>

            <label class="first_name"><b>Όνομα</b></label>
            <input  type="text_first_name" placeholder="Γράψε Όνομα" size="37" required>

            <label class="last_name"><b>Επίθετο</b></label>
            <input  type="text_last_name" placeholder="Γράψε Επίθετο" size="37" required>

            <label class="pass1"><b>Κωδικός</b></label>
            <input type="password"  class="input_pass1" placeholder="Γράψε κωδικό" size="37" required>

            <label class="pass2"><b>Επαλήθευση κωδικού</b></label>
            <input type="password" class="input_pass2" placeholder="Γράψε κωδικό" size="37" required>

            <button class="btn_register" >Εγγραφή</button>

            <button class="btn_back" onclick="document.location='Login.php'">Μήπως έχεις ήδη λογαριασμό;</button>
        </form>
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>