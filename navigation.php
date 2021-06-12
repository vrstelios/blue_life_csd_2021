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
    <?php
        if (isset($_GET['logout'])) { // αν ο συνδεδεμένος χρήστης πατήσει τον σύνδεσμο 'Αποσύνδεση’ στο naxigation menu τότε προστήθεται το ?logout στο τέλος του url και έτσι αποσυνδέεται
            $_SESSION['connected_username'] = null;
            $_SESSION['connected_id'] = null;
        }

        if (isset($_SESSION['connected_username'])){
            echo "<div class='dropdown'>
                    <button class='dropbtn'>" . $_SESSION['connected_username'] . "</button>
                    <div class='dropdown-content'>";
            if ($_SESSION['connected_id'] == 1){
                echo    "<a href='Admin.php' target='_self'> ". 'Σελίδα Διαχείρισης' . "</a>";
            }
            if ($_SESSION['connected_id'] != 1){
                echo        "<a href='Profile.php' target='_self'> ". 'Το προφίλ μου' . "</a>";
            }
            echo        "<a href='Login.php?logout'> ". 'Αποσύνδεση' . "</a>";
            echo   "</div>";
            echo "</div>";
        } else {
            echo "<a href='Login.php'> ". 'Είσοδος/Εγγραφή' . "</a>";
        }
    ?>

    <!--<div class="search-box">
      <input type="text" class="search-box-input" placeholder="Αναζήτησε..">
      <button class="search-box-btn">
        <i class="search-box-icon material-icons"><img src="images/Main/magnifying-glass-blue.png" alt="search" style="width:16px;height:16px "></i>
      </button>
    </div>
    <div class="title_menu hide" id="title_menu">Blue Life</div>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="displayMobileMenuButton()">&#9776;</a>
  </div>-->
      <form action="javascript:" class="search-bar">
          <input type="search" name="search" pattern=".*\S.*" required>
          <button class="search-btn" type="submit">
              <span>Search</span>
          </button>
      </form>

  <script>
    function displayMobileMenuButton() { // για κινητό, εμφανίζει το μενού πάνω δεξιά με 3 γραμμές
      var x = document.getElementById("navbar");
      if (x.className === "navbar") {
        x.className += " responsive";
      } else {
        x.className = "navbar";
      }
    }

    // για κινητό, όταν κάνεις scroll προς τα κάτω να εμφανίζεται το όνομα του Blue Life πάνω στο μενού
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