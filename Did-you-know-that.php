<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Ήξερες ότι...</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_dykt.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>
<!---------------database--------------->
<?php include("connect_to_database.php") ?>

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
        <h2>Ήξερες ότι...</h2>
    </div>
</div>

<!---------------Ήξερες ότι--------------->
<div class="did-you-know-that">
    <ul>
        <?php
        $query = "SELECT * FROM article WHERE id=27";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '<img src="images/4.Did-you-know-that/iceberg.jpg" alt="iceberg" >';
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>
        <!--<img src="images/4.Did-you-know-that/iceberg.jpg" alt="iceberg" >
        <li>Μόνο το 1% του νερού της Γης είναι πόσιμο</li>
        <p>Παρόλο που το 70% της Γης καλύπτεται από το νερό,μόλις το 1% αυτού του νερού είναι πόσιμο και αυτό το ποσοστό
            πρέπει να μοιραστεί και να καλύψει τις ανάγκες 6,4 δισεκατομμυρίων ανθρώπων. Εξαιτίας, λοιπόν αυτής της
            δυσαναλογίας οι πολίτες των υπανάπτυκτων χωρών δεν μπορούν να εξασφαλίσουν πρόσβαση στο πόσιμο νερό.</p>-->
        <?php
        $query = "SELECT * FROM article WHERE id=28";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

        <!--<li>Υπάρχει ένα "φύλλο" πάγου μεγαλύτερο από τις ηπειρωτικές Ηνωμένες Πολιτείες.</li>
        <p>Σύμφωνα με το National Snow & Ice Data Center (NSIDC) το φύλλο πάγου της Ανταρκτικής έχει φτάσει τα 5,4
            εκατομμύρια τετραγωνικά μίλια που είναι περίπου το μέγεθος των ηπειρωτικών Ηνωμένων Πολιτειών και του Μεξικού
            που συνδυάζονται!</p>-->

         <?php
        $query = "SELECT * FROM article WHERE id=29";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>
        <!--<li>Ένα παγόβουνο θα μπορούσε να τροφοδοτήσει ένα εκατομμύριο ανθρώπους με πόσιμο νερό για πέντε χρόνια</li>
        <p>Ένα μεγάλο παγόβουνο από την Ανταρκτική περιέχει περισσότερα από 20 δισεκατομμύρια γαλόνια νερού.Γι αυτό μια
            εταιρεία στα Ηνωμένα Αραβικά Εμιράτα σχεδιάζει να ξεκινήσει να έλκει παγόβουνα από την Ανταρκτική στην ακτή
            για να λύσει το πρόβλημα της ξηρασίας.</p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=30";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

        <!--<li>Το νερό στο κάτω μέρος του ωκεανού είναι απίστευτα ζεστό.</li>
        <p>Σε αυτά τα βαθύτερα μέρη του ωκεανού, η θερμοκρασία του νερού μπορεί να είναι μόνο 2º έως 4º Κελσίου, με
            εξαίρεση το νερό που βγαίνει από υδροθερμικούς αεραγωγούς στον πυθμένα. Το νερό που απελευθερώνεται από αυτούς
            τους αεραγωγούς μπορεί να φτάσει τους 400º Κελσίου </p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=31";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>
        <!--<li>Το νερό από τον πάγο του θαλλασινού νερού είναι πόσιμο</li>
        <p>Δεν μπορείτε να πιείτε θαλασσινό νερό, αλλά μπορείτε να πιείτε πάγο από θαλασσινό νερό. Ο φρέσκος πάγος έχει
            μικρές τσέπες άλμης παγιδευμένες μεταξύ κρυστάλλων πάγου.Καθώς όμως μεγαλώνει, η άλμη αποστραγγίζεται και,
            σύμφωνα με το NSIDC, μπορεί να λιώσει και να καταναλωθεί.</p>-->
         <?php
        $query = "SELECT * FROM article WHERE id=32";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo ' <img src="images/4.Did-you-know-that/seabed.jpg" alt="uderwater life" >';
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>

        <!--<img src="images/4.Did-you-know-that/seabed.jpg" alt="uderwater life" >
        <li>Η πίεση στον πυθμένα του ωκεανού μπορεί να σε συνθλίψει σαν μυρμήγκι</li>
        <p>Στην τάφρο των Μαριανών (35.802 πόδια κάτω από την επιφάνεια), που περιλαμβάνει το βαθύτερο
            σημείο του πλανήτη, η πίεση του νερού είναι οκτώ τόνοι ανά τετραγωνική ίντσα. Αν φτάσατε εκεί, θα αισθανόσασταν
            ότι κρατούσατε σχεδόν 50 jumbo jets(αεροσκάφη).</p>-->

         <?php
        $query = "SELECT * FROM article WHERE id=33";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>

       <!-- <li>Ο ωκεανός φιλοξενεί σχεδόν το 95% όλης της ζωής</li>
        <p>Με τόσα πολλά να συμβαίνουν πολύ κάτω από την επιφάνεια, είναι εύκολο να ξεχνάμε ότι οι ωκεανοί είναι γεμάτοι
            ζωή. Στην πραγματικότητα, το 94 τοις εκατό της ζωής είναι υδρόβιο,
            σύμφωνα με το USA Science & Engineering Festival. Αυτό σημαίνει ότι όσοι από εμάς ζούμε στη στεριά είναι μέρος
            μιας πολύ μικρής μειονότητας.</p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=34";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

       <!-- <li>Περισσότερο από το 90 τοις εκατό των μορφών ζωής του πλανήτη δεν έχουν ανακαλυφθεί ακόμα καθώς βρίσκονται υποβρύχια.</li>
        <p>Λόγω της δυσκολίας εξερεύνησης στους ωκεανούς, εκτιμάται ότι το 91% των ειδών που υπάρχουν κάτω από τη θάλασσα
            δεν έχουν ακόμη ανακαλυφθεί, σύμφωνα με μια μελέτη του 2011 που δημοσιεύθηκε στο PLoS Biology.
        </p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=35";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

        <!--<li>Υπάρχουν 3 εκατομμύρια ναυάγια στον ωκεανό</li>
        <p>Από τον Τιτανικό έως το Santa Maria του Χριστόφορου Κολόμβου, οι ωκεανοί φιλοξενούν περίπου 3 εκατομμύρια
            ναυάγια, σύμφωνα με τον Εκπαιδευτικό, Επιστημονικό και Πολιτιστικό Οργανισμό των Ηνωμένων Εθνών</p>-->

         <?php
        $query = "SELECT * FROM article WHERE id=36";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>

        <!--<li>Υπάρχει αρκετός χρυσός στον ωκεανό για να έχει ο καθένας μας 9 κιλά</li>
        <p>Υπάρχουν περίπου 20 εκατομμύρια τόνοι χρυσού διασκορπισμένοι σε όλους τους ωκεανούς, αλλά δεν είναι οικονομικά
            αποδοτικό να εξορυχθεί.</p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=37";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

        <!--<li>Η Τάφρος των Μαριανών (Mariana Trench) είναι το βαθύτερο σημείο των ωκεανών του πλανήτη</li>
        <p> Βρίσκεται στον δυτικό Ειρηνικό Ωκεανό στα ανατολικά των Μαριάνων νήσων και φτάνει στα 10.983 μέτρα κάτω από
            την επιφάνεια της θάλασσας. </p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=38";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '<img src="images/4.Did-you-know-that/scuba-diving.jpg" alt="ship underwater" >';
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>


        <!--<li>Αν αφήσουμε ανοιχτή την βρύση την ώρα που πλένουμε τα δόντια μας σπαταλάμε 20 λίτρα νερού</li>
        <p>Αυτή η ποσότητα νερού είναι αρκετή ώστε να ένας μέσος άνθρωπος να καλύψει την ανάγκη του για νερό για 10 ημέρες.</p>-->

        <?php
        $query = "SELECT * FROM article WHERE id=39";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

        <!--<li>Ο ωκεανός είναι η μεγαλύτερη πηγή οξυγόνου μας</li>
        <p>Το μεγαλύτερο μέρος του οξυγόνου στην ατμόσφαιρά μας προέρχεται από μικροσκοπικά θαλάσσια φυτά στον ωκεανό -
            φυτοπλαγκτόν, φύκια και πλαγκτόν φυκών. Οι επιστήμονες εκτιμούν ότι είναι υπεύθυνοι για περίπου το 70% του
            οξυγόνου της ατμόσφαιρας, σύμφωνα με το National Geographic</p>-->

    </ul>
    <?php
    $query = "SELECT * FROM article WHERE id=40";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo $row['title'] ;
    echo "<br>";
    echo $row['description'] ;
    ?>
    <!--Πηγές: <br>
    <a href="https://bestlifeonline.com/crazy-ocean-facts/" target="_blank">Best Life</a>,
    <a href="https://www.deyalagada.gr/%CE%B5%CE%BE%CE%BF%CE%B9%CE%BA%CE%BF%CE%BD%CF%8C%CE%BC%CE%B7%CF%83%CE%B7-%CE%BD%CE%B5%CF%81%CE%BF%CF%8D-2/" target="_blank">ΔΕΥΑΛ</a>-->
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>