<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Δράσεις</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_actions.css">
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
        <h2>Δράσεις</h2>
    </div>
</div>

<!---------------Actions--------------->
<article class="actionIntro">
    <h3>Τι κάνουμε</h3>
    <p>
        Η συνεχώς αυξανόμενη μόλυνση των θαλασσών σε συνδυασμό με την τεράστια αξία των υδάτινων πόρων για την ζωή μας καθιστούν
        άμεση και αναγκαία την δραστηριοποίηση όλων μας για την προστασία των θαλασσών. Η ομάδα μας έχει ως στόχο τη διοργάνωση
        και την προώθηση εθελοντικών δράσεων με σκοπό να μπορούμε όλοι να απολαύσουμε  στο μέλλον (και το παρόν!)
        καθαρές και όμορφες θάλασσες και λίμνες, καθώς και υγιείς υδροβιότοπους. Παρακάτω μπορείτε να δείτε τις τρέχουσες
        δράσεις και να συμμετέχετε συνεισφέροντας  και εσείς σε όλη αυτή την προσπάθεια!
    </p>
</article>

<article class="action">
    <div class="action_row">
        <div class="column image">
            <img src="images/3.Actions/Δράση2.jpg" alt="Άνθωπος κάτω από το νερό!"/>
        </div>
        <div class="column text" >
            <div>
                <h3><b>Πρόγραμμα Παράκτιων και Υποβρύχιων Καθαρισμών</b></h3>
                <div class="calendar">
                    <img class="smallImage" src="images/3.Actions/calendar.png" alt="Calendar"/>
                    Ενεργό (2021)
                </div> <br>
                <p> Η θαλάσσια ρύπανση χαρακτηρίζεται ως μια από τις μεγάλες κρίσεις της εποχής μας, με καταστροφικές συνέπειες
                    για την υγεία των ανθρώπων και των οικοσυστημάτων, για τις τοπικές οικονομίες, για την αισθητική του περιβάλλοντος
                    και για την ποιότητα ζωής. Η πρόληψη, η ενημέρωση και οι παρεμβάσεις στο παράκτιο και θαλάσσιο περιβάλλον χρειάζονται
                    τη συμμετοχή όλων. Κατά συνέπεια, η συνεργασία ανάμεσα σε φορείς με κοινές επιδιώξεις είναι αναγκαία για να ενισχυθούν
                    και να επιταχυνθούν οι σχετικές δράσεις. <br>
                    Σε αυτό το πλαίσιο, το Κοινωφελές Ίδρυμα Αθανασίου Κ. Λασκαρίδη, εκτός από τους καθαρισμούς που πραγματοποιεί ως μέρος
                    των δικών του προγραμμάτων, ενισχύει άλλες περιβαλλοντικές οργανώσεις στην προσπάθεια να καθαρίσουν τις ακτές όλης της χώρας.
                    Όλοι οι καθαρισμοί πραγματοποιούνται χρησιμοποιώντας κοινή μεθοδολογία με χρήση ενιαίου πρωτοκόλλου καταγραφής απορριμμάτων
                    και υλικά φιλικά προς το περιβάλλον και τις αρχές της αειφορίας. <br>
                    Μέχρι σήμερα, το Ίδρυμα έχει ενισχύσει πολλές οργανώσεις για την πραγματοποίηση παράκτιων και υποβρύχιων καθαρισμών, όπως την
                    Ελληνική Εταιρεία Προστασίας της Φύσης, Ελληνική Εταιρεία Περιβάλλοντος και Πολιτισμού, HELMEPA κ.α.
                </p>
                <a href=" https://www.aclcf.org/thalassa/programma-paraktion-ke-ipovrichion-katharismon/" target="_blank"> Περισσότερες πληροφορίες</a> (άνοιγμα σε νέα καρτέλα)
            </div>
        </div>
        <div class="column button">
            <button class="buttonJoinActions" onclick="alert_function()"> Θέλω να συμμετέχω και εγώ </button>
        </div>
    </div>
</article>

<article class="action">
    <div class="action_row">
        <div class="column image">
            <img src="images/3.Actions/ΔράσηΚαρχαρίες.png" alt="Αγγελοκαρχαρίας"/>
        </div>
        <div class="column text" >
            <div>
                <h3><b>Ενίσχυση της Προστασίας των Αγγελοκαρχαριών στο Νότιο Αιγαίο</b></h3>
                <div class="calendar">
                    <img class="smallImage" src="images/3.Actions/calendar.png" alt="Calendar"/>
                    Παρασκευή 23 Απριλίου 2021, 21:15-22:30
                </div><br>
                <p>
                    Στόχος του έργου είναι η βελτίωση και η ενίσχυση της διατήρησης των αγγελοκαρχαρίων στην Ελλάδα, και η προώθηση
                    της διατήρηση των ελασμοβράχιων στη χώρα. Μέσω αυτου του προγράμματος θα πραγματοποιηθεί περαιτέρω έρευνα για την
                    υποστήριξη δράσεων προστασίας και πολιτικών διατήρησης του είδους.
                </p>
                <a href="https://isea.com.gr/angelsharksgr/" target="_blank"> Περισσότερες πληροφορίες</a> (άνοιγμα σε νέα καρτέλα)
            </div>
        </div>
        <div class="column button">
            <button class="buttonJoinActions" onclick="alert_function()"> Θέλω να συμμετέχω και εγώ </button>
        </div>
    </div>
</article>

<article class="action">
    <div class="action_row">
        <div class="column image">
            <img src="images/3.Actions/ΔράσηΗμέραΘάλασσας.jpg" alt="Πρόγραμμα δράσεων"/>
        </div>
        <div class="column text" >
            <div>
                <h3><b>Ημέρες Θάλασσας 2021 στο Δήμο Θερμαϊκού</b></h3>
                <div class="calendar">
                    <img class="smallImage" src="images/3.Actions/calendar.png" alt="Calendar"/>
                    Εθελοντικός Καθαρισμός Παραλίας Αγγελοχωρίου, Κυριακή 25 Απριλίου, 11:00 π.μ. <br>
                    Σημείο έναρξης: παρκινγκ Ριβιέρα beach bar
                </div><br>
                <p>Όπως γνωρίζετε, η 20η Μαΐου έχει καθιερωθεί, με πρωτοβουλία της Ευρωπαϊκής Ένωσης, ως «Ευρωπαϊκή Ημέρα για τη Θάλασσα»,
                    με στόχο να τονίσει το σημαντικό ρόλο που παίζουν οι ωκεανοί και οι θάλασσες στην καθημερινή ζωή των πολιτών
                    της Ευρωπαϊκής Ένωσης και στην Ευρωπαϊκή προσπάθεια για τη βιώσιμη ανάπτυξή τους. Φέτος, το Ευρωπαϊκό Συνέδριο
                    Ναυτιλίας και Αλιείας  λαμβάνει χώρα στην Ολλανδία.<br>
                    Στο πλαίσιο, λοιπόν, του εορτασμού της Ευρωπαϊκής ημέρας Θάλασσας για το 2021, ο Δήμος Θερμαϊκού και συγκεκριμένα το ΝΠΔΔ
                    «Δημοτικές, Πολιτιστικές, Περιβαλλοντικές, Αθλητικές, Κοινωνικές Υπηρεσίες Θερμαϊκού (δ.τ. ΔΗ.Π.Π.Α.Κ.Υ.Θ.)», θα διοργανώσει και
                    φέτος για έκτη φορά, δράσεις οι οποίες έχουν άμεση σχέση με τη θάλασσα. Οι δράσεις μας είναι μέρος του συνεδρίου,
                    στο «EMD in My Country 2021».
                    <br>
                    Ο Δήμαρχος Θερμαϊκού, Γιώργος Τσαμασλής, αναφέρει σχετικά:
                    «Καθώς η κρίση του COVID-19 δεν έχει τελειώσει, με προσεγμένες δράσεις καλωσορίζουμε για 6η  φορά το θεσμό της Ευρωπαϊκής
                    Ημέρα Θάλασσας 2021 στο Δήμο μας! Οι εκδηλώσεις μας είναι εννιά (9) στο σύνολο από τις εικοσιπέντε (25) της Ελληνικής Συμμετοχής
                    και αυτό μας κάνει ιδιαίτερα χαρούμενους που μπορούμε να στηρίξουμε όλοι μαζί  οικολογικές  δράσεις και εκδηλώσεις με θέμα τη Θάλασσα.
                    Η συμβολή των υπαλλήλων της καθαριότητας και του περιβάλλοντος, των  κατοίκων και των εθελοντικών ομάδων στην καθαριότητα
                    των ακτών τον τελευταίο καιρό, μας δίνει τη χαρά, ότι η περιβαλλοντική  συνείδηση ωριμάζει.
                    Η Θάλασσα μας πρέπει να αγαπηθεί όπως της αξίζει.  Είμαστε κοντά της!»
                </p>
                <a href="https://www.facebook.com/SeaThermaikos/" target="_blank"> Περισσότερες πληροφορίες</a> (άνοιγμα σε νέα καρτέλα)
            </div>
        </div>
        <div class="column button">
            <button class="buttonJoinActions" onclick="alert_function()"> Θέλω να συμμετέχω και εγώ </button>
        </div>
    </div>
</article>

<script>
    function alert_function() {
        alert("Για να δηλώσεις συμμετοχή σε μια δράση πρέπει να συνδεθείς!");
    }
</script>

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