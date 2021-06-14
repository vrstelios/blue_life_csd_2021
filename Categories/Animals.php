<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Ζώα στο νερό</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_categories.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>
<!---------------database--------------->
<?php include("../General-components/connect_to_database.php") ?>

<!---------------Navigation bar--------------->
<?php include("../General-components/navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="../images/Main/Underwater.mp4">
            </video>
        </div>
        <h2>Ζώα στο νερό</h2>
    </div>
</div>

<!---------------Ζώα στο νερό--------------->
<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=20";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Animals_seabed.jpg" alt="sharks" >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>
    <!--<h3>Βασικές κατηγορίες θαλάσσιων ζώων</h3>-->


    <!--<p> Τα θαλάσσια ζώα χωρίζονται σε 3 κύριες ομάδες: το ζωοπλαγκτόν, το νηκτό και το βένθος.<br>
        Το <b>ζωοπλαγκτόν</b> αποτελείται από μικρούς ζωικούς οργανισμούς, οι οποίοι κινούνται με την βοήθεια των ρευμάτων
        και των κυμάτων. Στο ζωοπλαγκτόν ανήκουν επίσης τα αυγά των ψαριών και οι οργανισμοί στο στάδιο της νύμφης,
        που μεγαλώνοντας εντάσσονται στο νηκτό ή το βένθος.<br>
        Στο <b> νηκτό</b> ανήκουν ζωικοί οργανισμοί που μπορούν και κινούνται από μόνοι τους και ζουν κολυμπώντας στο νερό.
        Σε αυτή τη κατηγορία ανήκουν τα περισσότερα ζώα της θάλασσας, από τα κοινά ψάρια και τα κεφαλόποδα (καλαμάρια, χταπόδια κα)
        ως και τα θαλάσσια θηλαστικά (φάλαινες, δελφίνια κ.ά.).<br>
        Στο <b>βένθος</b> ανήκουν τα θαλάσσια ζώα που περνούν όλη τους τη ζωή προσκολλημένα στο θαλάσσιο πυθμένα. Στο βένθος ανήκουν
        οι αστακοί, οι αστερίες, διάφορα σκουλήκια, σαλιγκάρια, μύδια και πολλά άλλα είδη. Μερικά είδη, όπως οι αστακοί,
        είναι σε θέση να κολυμπήσουν στο κατώτατο σημείο της υδάτινης στήλης, αλλά η επιβίωση τους εξαρτάται άμεσα από τον θαλάσσιο πυθμένα.<br>
        Η θαλάσσια πανίδα είναι πιο πλούσια στα ρηχά νερά απ’ ότι στα βαθιά λόγω της αυξημένης φωτεινότητας, που ευνοεί
        την ανάπτυξη υδρόβιας βλάστησης. </p>-->

</div>

<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=21";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Animals_shark.jpg" alt="corals and fishes"  >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>
    <!--<h3>Θαλάσσια είδη υπό εξαφάνιση</h3>-->

    <!--<p> Το μεγαλύτερο ποσοστό του πλανήτη καλύπτεται από θάλασσα, καθώς οι ωκεανοί καταλαμβάνουν το μεγαλύτερο μέρος του.
        Έτσι, εκτός από εμάς, στον πλανήτη αυτό κατοικούν και πολλά θαλάσσια ζώα. Πολλές φορές όμως, ο άνθρωπος δεν τα σέβεται
        και είτε από φόβο είτε για εμπορικούς σκοπούς, τα σκοτώνει. Δε γνωρίζει ότι μπορεί να του επιτίθενται για να προστατέψουν
        τον εαυτό τους ή ακόμα και τα μικρά τους. Οι ενέργειες αυτές του ανθρώπου, έχουν ως συνέπεια πολλά από τα θαλάσσια είδη να
        απειλούνται σήμερα με εξαφάνιση.Αυτά είναι: <br>  <b>Ο λευκός καρχαρίας</b> (επιστημονική ονομασία: Carcharodon carcharias -
        (Καρχαρόδων Καρχαρίας)), γνωστός και ως σπρίλλιος, μεγάλος λευκός, λευκός θάνατος ή και σκέτο καρχαρίας, είναι ένας εξαιρετικά
        μεγάλος καρχαρίας που βρίσκεται στα παράκτια νερά κοντά στην επιφάνεια σε όλους τους σημαντικούς ωκεανούς. Είναι το μόνο είδος του γένους
        του (Carcharodon) που υπάρχει ακόμα. Επίσης, είναι αναμφισβήτητα το μεγαλύτερο γνωστό αρπακτικό ψάρι.<br> <b>Τα  δελφίνια </b> είναι
        θαλάσσια θηλαστικά, που ανήκουν στην ίδια οικογένεια με τις φάλαινες. Υπάρχουν περίπου 17 γένη δελφινιών και 40 είδη. Απατώνται σε όλες
        σχεδόν τις θάλασσες του κόσμου, καθώς και σε ορισμένα ποτάμια, όπως είναι ο Αμαζόνιος και ο ποταμός Γιανγκτσέ της Κίνας. Τα δελφίνια
        θεωρούνται από τα πλέον ευφυή ζώα και έχουν καταστεί δημοφιλή στους ανθρώπους εδώ και πολλούς αιώνες για την παιχνιδιάρικη συμπεριφορά
        τους και τη φιλική τους εμφάνιση.<br> <img src="images/2.Categories/Animals_turtle.jpg" alt="sea turtle" > <b>Η θαλάσσια χελώνα καρέτα (caretta caretta) </b> εμφανίστηκε στη γη πριν από δεκάδες εκατομμύρια
        χρόνια και αποτελεί μια από τις πιο επιτυχημένες μορφές ζωής στην ιστορία του πλανήτη μας. Είναι το μόνο είδος θαλάσσιας χελώνας που αναπαράγεται
        στην Ελλάδα, όπου βρίσκονται οι πιο σημαντικοί βιότοποί της στη Μεσόγειο. Ωστόσο, τα τελευταία χρόνια, η υποβάθμιση και η καταστροφή του
        βιότοπου εξαιτίας ανθρωπογενών δραστηριοτήτων, έχουν οδηγήσει σε δραστική μείωση των πληθυσμών της. Για πρώτη φορά εδώ και εκατομμύρια χρόνια,
        η καρέτα απειλείται με εξαφάνιση.<br> <b>Η μεσογειακή φώκια μονάχους (Monachus monachus)</b>, είναι το ένα από τα δύο εναπομείναντα είδη
        φώκιας μοναχού της οικογένειας των φωκιδών. Κάποτε ήταν εξαπλωμένη σε όλες τις ακτές της Μεσογείου, της Μαύρης Θάλασσας και του ανατολικού
        Ατλαντικού. Σήμερα, με αριθμό μικρότερο από 600 ζώα, συγκαταλέγεται στα σπανιότερα και πλέον απειλούμενα ζωικά είδη του πλανήτη και
        χαρακτηρίζεται ως κρισίμως κινδυνεύον με αφανισμό από τη Διεθνή Ένωση Προστασίας Της Φύσης. Ο μισός περίπου πληθυσμός, γύρω στα 250-300 άτομα,
        ζει στην Ελλάδα.<br> <b>Η Όρκα </b>, που αναφέρεται κοινώς ως φάλαινα δολοφόνος (και σπανιότερα ως "Μαύρο ψάρι"), είναι μία από τις οδοντοφόρες
        φάλαινες. Οι Όρκες απαντώνται σε όλους τους ωκεανούς, από τις παγωμένες περιοχές της Αρκτικής και της Ανταρκτικής έως τις τροπικές θάλασσες.
    </p>-->
    <?php
    $query = "SELECT * FROM article WHERE id=22";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo $row['title'] ;
    echo "<br>";
    echo $row['description'] ;
    ?>
    <!--Πηγές: <br>
    <a href="https://www.helmepacadets.gr/gr/marine-environment/fauna?fbclid=IwAR2tbvq7Ek2lywmzHm_vbbJCexvNokr208XDHz0wzAImZrCAAy34Xx6WQEE" target="_blank">Ναυτιλοι της HELMEPA,</a>
    <a href="https://www.wwf.gr/ti_kanoume/fysh/apeiloumena_eidh/?" target="_blank"> WWF</a>-->
</div>

<div class="animals_gallery">
    <div class="wrapper">
        <img src="../images/2.Categories/Gallery-an/turtle.jpg" alt="Χελώνα">
        <img src="../images/2.Categories/Gallery-an/crab.jpg" alt="Κάβουρας">
        <img src="../images/2.Categories/Gallery-an/jellyfish.jpg" alt="Τσούχτρα">
        <img src="../images/2.Categories/Gallery-an/seal.jpg" alt="Φώκια">
        <img src="../images/2.Categories/Gallery-an/dolphin.jpg" alt="Δελφίνι">
        <img src="../images/2.Categories/Gallery-an/fish.jpg" alt="Ψαράκια">
        <img src="../images/2.Categories/Gallery-an/air-dolphin.jpg" alt="Δελφίνι">
        <img src="../images/2.Categories/Gallery-an/sharks.jpg" alt="Καρχαρίες">
        <img src="../images/2.Categories/Gallery-an/hippocampus.jpg" alt="Ιππόκαμπος">
        <img src="../images/2.Categories/Gallery-an/red-fish.jpg" alt="Ψάρι-Νέμο">
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>

</body>
</html>