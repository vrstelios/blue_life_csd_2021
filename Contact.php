<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Επικοινωνία</title>
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
        <h2>Επικοινωνία</h2>
    </div>
</div>

<!---------------Επικοινωνία--------------->
<div class="contact">
    <div>
    <h3>Με ενδιαφέρον περιμένουμε τις σκέψεις σας</h3>
    <form>
        <label for="fname">Όνομα</label><br>
        <input type="text" id="fname" placeholder="Το όνομά σου..."><br>
        <label for="lname">Επώνυμο</label><br>
        <input type="text" id="lname" placeholder="Το επίθετό σου..."><br>
        <label for="email">Email</label><br>
        <input type="text" id="email" placeholder="Το email σου..."><br>
        <label for="subject">Σχόλια</label><br>
        <textarea id="subject" name="subject" placeholder="Τα σχόλιά σου..." style="height:160px"></textarea>
        <a href="Contact.php"><input type="submit" value="Υποβολή"></a>
    </form>
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>