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