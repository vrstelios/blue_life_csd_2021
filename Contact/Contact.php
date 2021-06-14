<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Επικοινωνία</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_contact.css">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("../General-components/connect_to_database.php");

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
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $email = null;
        }
        if (isset($_POST['subject'])) {
            $subject = $_POST['subject'];
        } else {
            $subject = null;
        }

        $query = "INSERT INTO contact (first_name,last_name,email,comment)
                  VALUES ('$firstname','$lastname','$email','$subject');";
        if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
            //echo '<h1>' . 'PAOK' . '</h1>';
            $_SESSION['submit_contact_form'] = "YES";
            //header("Location: Contact.php");
            //echo '<script>' . 'openAlertMessage();' . '</script>';
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
<?php include("../General-components/navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="../images/Main/Underwater2.mp4">
            </video>
        </div>
        <h2>Επικοινωνία</h2>
    </div>
</div>

<!---------------Επικοινωνία--------------->
<div class="contact">
    <div>
    <h3>Στείλτε μας τις ιδέες σας!</h3>
    <form method="post" action="Contact.php">
        <label><span>* Υποχρεωτικά πεδία</span></label><br><br>
        <label for="fname">Όνομα</label><br>
        <input type="text" id="fname" placeholder="Το όνομά σου..." name="firstname"><br>
        <label for="lname">Επίθετο</label><br>
        <input type="text" id="lname" placeholder="Το επίθετό σου..." name="lastname"><br>
        <label for="email">Email <span>*</span> </label><br>
        <input type="email" id="email" placeholder="Το email σου..." name="email" required><br>
        <label for="subject">Σχόλια <span>*</span> </label><br>
        <textarea id="subject" name="subject" placeholder="Τα σχόλιά σου..." style="height:160px" required></textarea>
        <input type="submit" value="Υποβολή">
    </form>
    </div>

    <div class="alert" id="alertMessage">
        <span class="closeBtn" onclick="closeAlertMessage()">&times;</span>
        <strong>Έγινε!</strong> Επιτυχής καταχώρηση της φόρμας επικοινωνίας
    </div>

    <script>
        function openAlertMessage() {
            document.getElementById("alertMessage").style.display = "block";
            setTimeout(hideElement, 7000) //milliseconds
            function hideElement() {
                closeAlertMessage();
            }
        }
        function closeAlertMessage() {
            document.getElementById("alertMessage").style.display = "none";
        }
    </script>
    <?php
        if(isset($_SESSION['submit_contact_form'])){
            echo '<script type="text/javascript">openAlertMessage();</script>';
            $_SESSION['submit_contact_form'] = null;
        }
    ?>
</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>

</body>
</html>