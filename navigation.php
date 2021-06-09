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
    <!--a href='Login.php'-->
    <?php
        if (isset($_SESSION['connected_username'])){
            echo "<div class='dropdown'>
                    <button class='dropbtn'>" . $_SESSION['connected_username'] . "</button>
                    <div class='dropdown-content'>";
            echo        "<a href='Profile.php' target='_self'> ". 'Το προφίλ μου' . "</a>";
            echo        "<a href='Login.php'> ". 'Αποσύνδεση' . "</a>";
            echo   "</div>";
            echo "</div>";
            /* // Όταν ο χρήστης είναι συνδεδεμένος, στο μενού εμφανίζεται το όνομα του χρήστη στο σημείο που έλεγε πριν Είσοδος/Εγγραφή.
               // Τότε όταν ο κέρσορας του ποντικιού περάσει πάνω από αυτή τη στήλη εμφανίζεται ένα καινούργιο «υπομενού»: ‘Το προφίλ μου,
               // Αποσύνδεση’. Αν ο χρήστης είναι ο διαχειριστής τότε υπάρχει και η επιπλέον επιλογή: ‘Σελίδα διαχείρισης’.
               // 1ο Βήμα: Όταν ο συνδεδεμένος χρήστης πατήσει την επιλογή username (πχ kogal) στο navigation menu, θέλουμε να κάνει αποσύνδεση.
               // Αυτό το κομμάτι κώδικα δεν λειτουργεί αποδοτικά, είναι απλά η "βάση" για να υλοποιηθεί η λειτουργία
            function set_connected_Username_to_null()
            {
                $_SESSION['connected_username'] = null;
            }
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
            {
                set_connected_Username_to_null();
            }*/
        } else {
            echo "<a href='Login.php'> ". 'Είσοδος/Εγγραφή' . "</a>";
        }
    ?>
    <!--/a-->
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