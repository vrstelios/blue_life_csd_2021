<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Ζώα στο νερό</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_categories.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>

<!---------------Navigation bar--------------->
<nav>
    <div class="navbar" id="navbar">
        <a href="Home.php">Αρχική</a>
        <div class="dropdown">
            <button class="dropbtn">Κατηγορίες</button>
            <div class="dropdown-content">
                <a href="Oceans.php" target="_self">Ωκεανοί</a>
                <a href="Lakes-Rivers.php">Λίμνες/Ποτάμια</a>
                <a href="Wetlands.php">Υδροβιότοποι</a>
                <a href="Animals.php">Ζώα στο νερό</a>
                <a href="Fishing.php">Αλιεία/Εμπόριο</a>
            </div>
        </div>
        <a href="Actions.php">Δράσεις</a>
        <a href="Did-you-know-that.php">Ήξερες ότι...</a>
        <a href="Contact.php">Επικοινωνία</a>
        <a href="Login.php">Είσοδος/Εγγραφή</a>
        <div class="search-box">
            <input type="text" class="search-box-input" placeholder="Αναζήτησε..">
            <button class="search-box-btn">
                <i class="search-box-icon material-icons"><img src="images/Main/magnifying-glass-blue.png" alt="search" style="width:16px;height:16px "></i>
            </button>
        </div>
        <div class="title_menu hide" id="title_menu">Blue Life</div>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("navbar");
            if (x.className === "navbar") {
                x.className += " responsive";
            } else {
                x.className = "navbar";
            }
        }

        myID = document.getElementById("title_menu");
        var myScrollFunc = function() {
            var y = document.getElementById("header").offsetHeight;
            if (window.scrollY >= y) {
                myID.className = "title_menu show"
            } else {
                myID.className = "title_menu hide"
            }
        };
        window.addEventListener("scroll", myScrollFunc);
    </script>
</nav>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="images/Main/Underwater.mp4">
            </video>
        </div>
        <h2>Ζώα στο νερό</h2>
    </div>
</div>

<!---------------Ζώα στο νερό--------------->
<div class="category_content">
    <h3>Βασικές κατηγορίες θαλάσσιων ζώων</h3>
    <img src="images/2.Categories/Animals_seabed.jpg" alt="sharks" >

    <p> Τα θαλάσσια ζώα χωρίζονται σε 3 κύριες ομάδες: το ζωοπλαγκτόν, το νηκτό και το βένθος.<br>
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
        την ανάπτυξη υδρόβιας βλάστησης. </p>

</div>

<div class="category_content">
    <h3>Θαλάσσια είδη υπό εξαφάνιση</h3>
    <img src="images/2.Categories/Animals_shark.jpg" alt="corals and fishes"  >
    <p> Το μεγαλύτερο ποσοστό του πλανήτη καλύπτεται από θάλασσα, καθώς οι ωκεανοί καταλαμβάνουν το μεγαλύτερο μέρος του.
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
    </p>
    Πηγές: <br>
    <a href="https://www.helmepacadets.gr/gr/marine-environment/fauna?fbclid=IwAR2tbvq7Ek2lywmzHm_vbbJCexvNokr208XDHz0wzAImZrCAAy34Xx6WQEE" target="_blank">Ναυτιλοι της HELMEPA,</a>
    <a href="https://www.wwf.gr/ti_kanoume/fysh/apeiloumena_eidh/?" target="_blank"> WWF</a>
</div>

<div class="animals_gallery">
    <div class="wrapper">
        <img src="images/2.Categories/Gallery-an/turtle.jpg" alt="Χελώνα">
        <img src="images/2.Categories/Gallery-an/crab.jpg" alt="Κάβουρας">
        <img src="images/2.Categories/Gallery-an/jellyfish.jpg" alt="Τσούχτρα">
        <img src="images/2.Categories/Gallery-an/seal.jpg" alt="Φώκια">
        <img src="images/2.Categories/Gallery-an/dolphin.jpg" alt="Δελφίνι">
        <img src="images/2.Categories/Gallery-an/fish.jpg" alt="Ψαράκια">
        <img src="images/2.Categories/Gallery-an/air-dolphin.jpg" alt="Δελφίνι">
        <img src="images/2.Categories/Gallery-an/sharks.jpg" alt="Καρχαρίες">
        <img src="images/2.Categories/Gallery-an/hippocampus.jpg" alt="Ιππόκαμπος">
        <img src="images/2.Categories/Gallery-an/red-fish.jpg" alt="Ψάρι-Νέμο">
    </div>
</div>

<!-----------------Go to top button----------------->
<button onclick="topFunction()" id="myBtn" title="Go to top"><img src="images/Main/up-arrow.png" alt="up arrow"></button>
<script>
    var mybutton = document.getElementById("myBtn");
    var rootElement = document.documentElement;

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        rootElement.scrollTo({
            top: 0,
            behavior: "smooth"
        })
    }
</script>

<!-----------------Footer----------------->
<footer>
    <div class="row">
        <div class="column left">
            <h4>SITEMAP</h4>
            <a href="Home.php"><button class="sitemapButton"> Αρχική </button></a>
            <a href="Oceans.php"><button class="sitemapButton"> Ωκεανοί </button></a>
            <a href="Lakes-Rivers.php"><button class="sitemapButton"> Λίμνες/Ποτάμια </button></a>
            <a href="Wetlands.php"><button class="sitemapButton"> Υδροβιότοποι </button></a>
            <a href="Animals.php"><button class="sitemapButton"> Ζώα στο νερό </button></a>
            <a href="Fishing.php"><button class="sitemapButton"> Αλιεία/Εμπόριο </button></a>
            <a href="Actions.php"><button class="sitemapButton"> Δράσεις </button></a>
            <a href="Did-you-know-that.php"><button class="sitemapButton"> Ήξερες ότι... </button></a>
            <a href="Contact.php"><button class="sitemapButton"> Επικοινωνία </button></a>
            <a href="Login.php"><button class="sitemapButton"> Είσοδος </button></a>
            <a href="Register.php"><button class="sitemapButton"> Εγγραφή </button></a>
        </div>

        <div class="column middle" >
            <h4> Ποιοι είμαστε </h4>
            <p>Είμαστε μία εθελοντική ομάδα αποτελούμενη από φοιτητές του ΑΠΘ. Με πολλή αγάπη για το νερό και τον μπλε πλανήτη, υλοποιήσαμε αυτόν τον ιστότοπο στα πλαίσια μιας εργασίας που
                αποτέλεσε το εναρκτήριο λάκτισμα για να την συνεχή ενασχόληση μας σε δράσεις για την προστασία του υδάτινου κόσμου.
            </p>
        </div>

        <div class="column right">
            <h4> Βρείτε μας </h4>
            <a> Τηλέφωνο: 6912345678 </a><br>
            <a> Email: bluelifeauth@gmail.com </a><br>
            <div class="icons">
                <a href="https://www.facebook.com/Blue-Life-101638112084101/" target="_blank">
                    <img src="images/Main/facebook.png"
                         onmouseover="this.src='images/Main/facebook-hover.png';"
                         onmouseout="this.src='images/Main/facebook.png';"
                         alt="facebook" title="facebook"></a>
                <a href="https://www.instagram.com/bluelifeproject/" target="_blank">
                    <img src="images/Main/instagram.png"
                         onmouseover="this.src='images/Main/instagram-hover.png';"
                         onmouseout="this.src='images/Main/instagram.png';"
                         alt="instagram" title="instagram"></a>
                <a href="https://twitter.com/BlueLif14473198" target="_blank">
                    <img src="images/Main/twitter.png"
                         onmouseover="this.src='images/Main/twitter-hover.png';"
                         onmouseout="this.src='images/Main/twitter.png';"
                         alt="twitter" title="twitter"></a>
            </div>
        </div>
    </div>
    <div id="copyrights"> BlueLife 2021&copy; </div>
</footer>

</body>
</html>