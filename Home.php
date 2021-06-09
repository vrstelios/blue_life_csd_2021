<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Life</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_home.css">
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
<?php include("navigation.php") ?>


<!---------------Title section--------------->
<video autoplay muted loop id="myVideo">
    <source src="images/1.Home/Sea-home.mp4" type="video/mp4">
</video>
<div class="home-page-title">
    <div>
        <h5><i>"Πόσο άστοχο είναι να αποκαλούμε αυτόν τον πλανήτη Γη,<br> ενώ είναι εντελώς ξεκάθαρο ότι είναι Ωκεανός"</i></h5>
        <h6><i> Άρθουρ Κλαρκ&emsp;</i></h6>
    </div>
</div>

<!---------------Περιεχόμενο αρχικής σελίδας--------------->
<div class="home_articles">
    <div class="row">
        <div class="column left">
            <img src="images/1.Home/waves.jpg" alt="Wild sea"/>
        </div>
        <div class="column right">
            <h3>Το νερό, ο «μπλε χρυσός» </h3>
            <p>Σύμφωνα με μελέτη  (Water in Europe: Green tape or Blue Gold?) του European  Water Platform για το 2014,
                ο πλανήτης μας και όλος ο κόσμος εξαρτάται από το νερό.  Σε παγκόσμιο επίπεδο, το 70% της κατανάλωσης του
                γλυκού νερού γίνεται από τη γεωργία, το 22% από τη βιομηχανία και 8% για τις εγχώριες δραστηριότητες μίας
                χώρας. Ο κλάδος νερού στην Ευρώπη αποτελείται από περίπου 70.000 εταιρείες ύδρευσης και με περίπου 3.000
                παρόχους τεχνολογίας.  Όλες οι οικονομικές δραστηριότητες στον κόσμο που εξαρτώνται από το νερό έχουν
                αποτελούν μία αγορά που αξίζει περίπου 70 τρισ. Δολάρια!<br>
                Σε λίγα χρόνια το νερό θα ξεπερνά σε αξία το χρυσό! Οι περισσότεροι οικονομολόγοι και αναλυτές επισημαίνουν ότι το νερό
                θα είναι το πολυτιμότερο εμπόρευμα στο κόσμο σε λίγα χρόνια και θα ξεπεράσει σε αξία πετρέλαιο και χρυσό, καθώς θα αναδειχθεί σε
                νούμερο 1 αγαθό για το οποίο θα αυξάνεται η ζήτηση και θα μειώνεται η ποσότητά του. Oι προβλέψεις αναφέρουν ότι η ζήτηση για καθαρό
                νερό θα αυξηθεί έως το 2030, με ρυθμούς διπλάσιους σε σχέση με του πετρελαίου, ενώ η  Citigroup εκτιμά ότι περίπου το ένα τρίτο του παγκόσμιου πληθυσμού δεν θα έχει πρόσβαση σε πόσιμο νερό μέχρι το 2025. Αυτή τη στιγμή, πάνω από το 35% του παγκόσμιου
                πληθυσμού, ή 2,7 δισεκατομμύρια άνθρωποι, δεν έχουν πρόσβαση σε ασφαλές πόσιμο νερό, σύμφωνα με τον ΟΗΕ.</p>
        </div>
    </div>
</div>

<!-----------------Φωτογραφία με ρητό----------------->
<div class="section">
    <div>
        <h5><i>"Το νερό είναι ψυχή της Γης"</i></h5>
        <h6><i>W.H. Auden&emsp;</i></h6>
    </div>
</div>

<div class="home_articles">
    <div class="row">
        <div class="column left2">
            <h3>Τι μπορείς να κάνεις;</h3>
            <p>Σίγουρα όλοι μας θα έχουμε αναρωτηθεί κάποια στιγμή τι μπορούμε να κάνουμε για να συνεισφέρουμε ενεργά στην προστασία των θαλάσσιων κόσμων.<br>
                Πάρε τώρα μέρος στις δράσεις που διοργανώνουμε και σώσε τις θάλασσες!
            </p>
            <a href="Actions.php"><button class="youCanHelpHomeButton"> Δες πώς μπορείς να βοηθήσεις! </button></a>
        </div>
        <div class="column right2">
            <img src="images/1.Home/Home_helpSea.jpg" alt="You can do it"/>
        </div>
    </div>
</div>

<div class="home_articles">
    <div class="row">
        <div class="column left">
            <img src="images/1.Home/bubbles.jpg" alt="Cute Bubbles"/>
        </div>
        <div class="column right">
            <h3>Σημασία του νερού...</h3>
            <p> Το νερό είναι ένας φυσικός πόρος που έχει μεγάλη σημασία γιατί είναι από τους βασικούς παράγοντες για τη
                ζωή και την ανάπτυξη. Τα τελευταία χρόνια το αγαθό αυτό βρίσκεται σε ανεπάρκεια, παρ’ ότι ένας παρατηρητής
                που θα ατένιζε τη Γη από το διάστημα θα τη χαρακτήριζε ως “γαλάζιο πλανήτη” λόγω του άφθονου νερού που
                την καλύπτει. Το συντριπτικά μεγαλύτερο ποσόστο του νερού που βρίσκεται στη φύση αποτελεί το θαλλασινό
                νερό.</p>
            <p>Αν μπορούσαμε να κατανείμουμε ομοιόμορφα τα αποθέματα του νερού σε όλη την επιφάνεια του πλανήτη μας, θα
                δημιουργούσαμε ένα υδάτινο μανδύα βάθους περίπου 3 χιλιομέτρων. Το νερό όμως δεν είναι ομοιόμορφα
                κατανεμημένο σε όλες τις περιοχές του πλανήτη και αν ο παρατηρητής πλησίαζε τη Γη θα έβλεπε σε άλλες
                περιοχές πλημμύρες και σε άλλες λειψυδρία.</p>
            <p>Νερό είναι το φυσικό στοιχείο το οποίο προκύπτει από την χημική ένωση των μορίων υδρογόνου και οξυγόνου.
                Στη Χημεία το νερό συμβολίζεται ως H2O.</p>
        </div>
    </div>
</div>

<div class="home_articles">
    <div class="row">        
        <div class="column left2"> 
          <h3>Όταν η έλλειψη νερού φτάσει στην πόρτα μας</h3>
            <p>Συνήθως το περιβαλλοντικό ζήτημα που μονοπωλεί τις παγκόσμιες συνόδους είναι η κλιματική αλλαγή. Αλλά εξίσου σημαντικό είναι
                και το θέμα των αποθεμάτων νερού σε όλο τον κόσμο. Το πρόβλημα της έλλειψης νερού αλλά και οι τρόποι καλύτερης διαχείρισης
                των υδάτινων πόρων βρίσκονται στο επίκεντρο του όγδοου Παγκόσμιου Συμβουλίου Υδάτων (World Water Council) που συνεδριάζει αυτές
                τις μέρες στην πρωτεύουσα της Βραζιλίας Μπραζίλια (μέχρι τις 23 Μαρτίου).<br>
                Οι περιοχές που πλήττονται περισσότερο από την έλλειψη νερού εντοπίζονται κυρίως στη Μέση Ανατολή, όπου οι φυσικοί υδάτινοι πόροι είναι
                ελάχιστοι και δεν μπορούν να καλύψουν τις ανάγκες του πληθυσμού. Ωστόσο, τελευταία ολοένα περισσότερες περιοχές του πλανήτη αντιμετωπίζουν
                αντίστοιχα προβλήματα. «Στην Αφρική για παράδειγμα η Κένυα ή η Νότια Αφρική. Στη Λατινική Αμερική η βορειοδυτική Βραζιλία, στις ΗΠΑ η Καλιφόρνια. Αλλά
                και στην Ευρώπη, η Πορτογαλία – η Πορτογαλία ειδικότερα αντιμετωπίζει πολύ έντονη ξηρασία» αναφέρει ο επικεφαλής του WWC, τονίζοντας βέβαια
                ότι η Ευρώπη, όπως και άλλες οικονομικά εύρωστες χώρες, διαθέτουν περισσότερα μέσα ώστε να αντιμετωπίζουν πιο αποτελεσματικά ακραία φαινόμενα
                που σχετίζονται με τους υδάτινους πόρους.<br>
                «Σύμφωνα με τη γνώση που έχουμε σήμερα, είναι πιθανό να αντιμετωπίσουμε πολλά τέτοια προβλήματα στο μέλλον. (…) Το μήνυμα που θέλουμε
                να περάσουμε από το WWC είναι ότι και οι πολιτικοί πρέπει να καταλάβουν ότι αυτό που συμβαίνει τώρα σε μακρινές περιοχές,
                μπορεί να συμβεί μελλοντικά και στη δική μας πόρτα. Πρέπει να προετοιμαστούμε ολοι καλύτερα για το μέλλον», σημειώνει τέλος ο επικεφαλής του WWC.
            </p>
        </div>
        <div class="column right2">
            <img src="images/1.Home/dry_water.jpg" alt="Wave"/>
        </div>
    </div>
    Πηγές: <br>
    <a href="https://www.protothema.gr/economy/article/429012/ble-hrusos-poso-axizei-to-nero-tou-planiti-/" target="_blank">Πρώτο Θέμα</a>,
    <a href="https://www.deyamp.gr/oikologia-periballon-nero/to-nero-kai-i-simasia-tou/" target="_blank"> Δ.Ε.Υ.Α.Μ.Π</a>,
    <a href="https://www.dw.com/el/%CF%8C%CF%84%CE%B1%CE%BD-%CE%B7-%CE%AD%CE%BB%CE%BB%CE%B5%CE%B9%CF%88%CE%B7-%CE%BD%CE%B5%CF%81%CE%BF%CF%8D-%CF%86%CF%84%CE%AC%CF%83%CE%B5%CE%B9-%CF%83%CF%84%CE%B7%CE%BD-%CF%80%CF%8C%CF%81%CF%84%CE%B1-%CE%BC%CE%B1%CF%82/a-43039279" target="_blank"> DW</a>
</div>

<div class="home_articles">
    <hr>
    <div class="gallery">
        <div class="box">
            <span style="--i:1;"><img src="images/1.Home/Gallery-3d/wave.jpg" alt="Κύμα"></span>
            <span style="--i:2;"><img src="images/1.Home/Gallery-3d/lake.jpg" alt="Λίμνη"></span>
            <span style="--i:3;"><img src="images/1.Home/Gallery-3d/view-river.jpg" alt="Ποτάμι"></span>
            <span style="--i:4;"><img src="images/1.Home/Gallery-3d/fish-tank.jpg" alt="Ψάρι"></span>
            <span style="--i:5;"><img src="images/1.Home/Gallery-3d/wetland.jpg" alt="Υδροβιότοπος"></span>
            <span style="--i:6;"><img src="images/1.Home/Gallery-3d/fishing-boat.jpg" alt="Ψάρεμα"></span>
            <span style="--i:7;"><img src="images/1.Home/Gallery-3d/lake-mountain.jpg" alt="Λίμνη"></span>
            <span style="--i:8;"><img src="images/1.Home/Gallery-3d/fish.jpg" alt="Ψάρια"></span>
        </div>
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>


</body>
</html>