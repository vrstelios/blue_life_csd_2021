<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Σελίδα διαχείρησης</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_admin.css">
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
        <a href="Admin.php">Admin</a>
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
    <h2>Σελίδα διαχείρησης</h2>
</div>

<!---------------Σελίδα διαχείρησης--------------->
<?php
$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
include("connect_to_database.php");
?>
<div class="admin-page">
    <h3>Χρήστες</h3>
    <div class="users-table">
        <p>ΟΛΟΙ ΟΙ ΧΡΗΣΤΕΣ
            <?php //εμφανίζουμε το πλήθος των χρηστών
            $query = "SELECT COUNT(*) FROM user";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo '(' . $row[0] . ')';
            ?>
        <button class="table_button">προσθήκη χρήστη</button>
        <button class="table_button">Ταξινόμηση</button>
        </p>

        <table>
            <tr>
                <th>Username</th>
                <th>first_name</th>
                <th>last_name</th>
                <th>Email</th>
                <th>age</th>
                <th>region</th>
                <th>image</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους
            $query = "SELECT * FROM user";
            $results = mysqli_query($link, $query);
            while  ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>' . $row['region'] . '</td>';
                echo '<td>' . $row['image'] . '</td>';
                echo "<td class='keno'>
                    <a href='Admin.php'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';
            }

            @mysqli_free_result($results);
            @mysqli_close($link);

            ?>
            <!--asd>
            <tr>
                <th>Username</th>
                <th>Όνομα</th>
                <th>Επίθετο</th>
                <th>Email</th>
                <th class="keno">Ηλικία</th>
                <th>Περιοχή</th>
                <th class="keno"></th>
            </tr>
            <tr>
                <td>user1</td>
                <td>Ον1</td>
                <td>Επ1</td>
                <td>u1@csd.auth.gr</td>
                <td class="keno">25</td>
                <td>Θεσσαλονίκη</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>user2</td>
                <td>Ον2</td>
                <td>Επ2</td>
                <td>u2@csd.auth.gr</td>
                <td class="keno">25</td>
                <td>Καρδίτσα</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>user3</td>
                <td>Ον3</td>
                <td>Επ3</td>
                <td>u3@csd.auth.gr</td>
                <td class="keno">25</td>
                <td>Σέρρες</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>user4</td>
                <td>Ον4</td>
                <td>Επ4</td>
                <td>u4@csd.auth.gr</td>
                <td class="keno">25</td>
                <td>Λαμία</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>user5</td>
                <td>Ον5</td>
                <td>Επ5</td>
                <td>u5@csd.auth.gr</td>
                <td class="keno">25</td>
                <td>Καρδίτσα</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>user6</td>
                <td>Ον6</td>
                <td>Επ6</td>
                <td>u6@csd.auth.gr</td>
                <td class="keno">25</td>
                <td>Αθήνα</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            </asd-->
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <h3>Δράσεις</h3>
    <div class="actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΡΑΣΕΙΣ (6)
            <button class="table_button">προσθήκη δράσης</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Πριγραφή</th>
                <th>Εικόνα</th>
                <th class="keno"></th>
            </tr>
            <tr>
                <td>Δράση1</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td>image1.jpg</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση2</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td>image2.jpg</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση3</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td>image3.jpg</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση4</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td>image4.jpg</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση5</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td>image5.jpg</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση6</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td>image6.jpg</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <h3>Χρήστης στη δράση</h3>
    <div class="user-actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΗΛΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ (4)
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>Τίτλος δράσης</th>
                <th>Username συμμετέχοντα</th>
                <th>Ημερομηνία δήλωσης</th>
                <th class="keno"></th>
            </tr>
            <tr>
                <td>Δράση2</td>
                <td>User1</td>
                <td>24/04/2021</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση4</td>
                <td>User2</td>
                <td>25/04/2021</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση1</td>
                <td>User1</td>
                <td>28/04/2021</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση1</td>
                <td>User6</td>
                <td>28/04/2021</td>
                <td class="keno">
                    <a href="Admin.php"><img src="images/6.Admin/edit.png" alt="edit"></a>
                    <a href="Admin.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
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