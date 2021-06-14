<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Σελίδα διαχείρισης</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_admin.css">
    <?php
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
    <h2>Σελίδα διαχείρισης</h2>
</div>

<!---------------Σελίδα διαχείρησης--------------->
<?php
// αν ο χρήστης δεν είναι ο admin και προσπαθήσει να φορτώσει την σελίδα Admin_contact.php τότε φορτώνεται η σελίδα UnauthorizedProfile.php για την ασφάλεια και απόκρυψη των στοιχείων
if ($_SESSION['connected_id'] != 1){
    header("Location: ../Profile/UnauthorizedProfile.php");
}
$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
include("../General-components/connect_to_database.php");

function print_size_of_table($link, $table){
    $query = "SELECT COUNT(*) FROM $table";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo '(' . $row[0] . ')';
}
?>

<div class="admin-page">

    <div class="admin_bar" id="navbar_admin">
        <a href="Admin_user.php">Χρήστες</a>
        <a href="Admin_action.php">Δράσεις</a>
        <a href="Admin_user_in_action.php">Χρήστες σε Δράσεις</a>
        <a href="Admin_contact.php">Επικοινωνία χρηστών</a>
    </div>

    <h3 style="padding-top: 40px">Επικοινωνία χρηστών</h3>
    <div class="contact-table">
        <p>ΟΛΕΣ ΟΙ ΦΟΡΜΕΣ
            <?php //εμφανίζουμε το πλήθος των σχόλιων των χρηστών
            print_size_of_table($link,'contact');
            ?>
            <?php
            // προεργασίες του paging (εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10)
            include("../General-components/connect_to_database.php");
            if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                $page_no = $_GET['page_no'];
            } else {
                $page_no = 1;
            }

            $total_records_per_page = 10;

            $offset = ($page_no-1) * $total_records_per_page;
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;
            $adjacents = "2";

            //6
            $result_count = mysqli_query($link, "SELECT COUNT(*) As total_records FROM `contact`");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total pages minus 1

            echo "<div class='sort_dropdown'>
                <button class='sort_dropbtn'>Ταξινόμηση</button>
                <div class='sort_dropdown-content'>";
            echo       "<a href='Admin_contact.php?page_no=".$page_no."&sortBy_contact_id'> ". 'id' . "</a>";
            echo       "<a href='Admin_contact.php?page_no=".$page_no."&sortBy_contact_firstname'> ". 'Όνομα' . "</a>";
            echo       "<a href='Admin_contact.php?page_no=".$page_no."&sortBy_contact_lastname'> ". 'Επίθετο' . "</a>";
            echo       "<a href='Admin_contact.php?page_no=".$page_no."&sortBy_contact_email'> ". 'Email' . "</a>";
            echo       "<a href='Admin_contact.php?page_no=".$page_no."&sortBy_contact_date'> ". 'Ημερομηνία' . "</a>";
            echo   "</div>";
            echo "</div>";

            ?>
        </p>

        <form action="Admin_contact.php" method="post">
            <input type="text" placeholder="Πληκτρολογήστε εδώ" name="search">
            <button type="submit" name="submit" class="table_button_search">Αναζήτηση</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" AND @$_POST["search"]!="") { // αν ο χρήστης πατήσει το κουμπί για αναζήτηση ( κληθεί η POST)
            //echo '<h4>'.'KANEI method post == Αναζήτηση' . '</h4>';
            $search = $_POST["search"];
            $query = ("SELECT * FROM  contact  WHERE id LIKE '%{$search}%' OR email LIKE '%{$search}%' OR last_name LIKE '%{$search}%' OR date_of_comment LIKE '%{$search}%' OR comment LIKE '%{$search}%'  OR first_name LIKE '%{$search}%'");
            $results = mysqli_query($link, $query);
            $num_results = mysqli_num_rows($results);
            if ($num_results == 0) {    // αν δεν υπάρχουν αποτελέσματα
                echo "<h3>Δεν βρέθηκαν αποτελέσματα αναζήτησης για " . $search ." !</h3>";
            } else {    // αν υπάρχουν αποτελέσματα στην αναζήτηση
                echo "<h3>Αποτελέσματα αναζήτησης</h3>";
                echo "<table>
                        <tr>
                            <th>id</th>
                            <th>Όνομα</th>
                            <th>Επίθετο</th>
                            <th>Email</th>
                            <th>Ημερομηνία</th>
                            <th class='keno'></th>
                        </tr>";
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['first_name'] . '</td>';
                    echo '<td>' . $row['last_name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['date_of_comment'] . '</td>';
                    echo "<td class='keno'>
                              <a href='?contact_id=".$row['id']."' ><button class='table_button cyan'>Προβολή</button></a>                     
                          </td>";
                    echo '</tr>';
                }
                @mysqli_free_result($results);
                echo '</table>';
            }
            $_POST["search"] = null;

        } else { // αν ο χρήστης δεν πατήσει το κουμπί για αναζήτηση (δεν κληθεί η POST)
            //echo '<h4>'.'DEN KANEI method post == Αναζήτηση' . '</h4>';
            echo "<table>
                        <tr>
                            <th>id</th>
                            <th>Όνομα</th>
                            <th>Επίθετο</th>
                            <th>Email</th>
                            <th>Ημερομηνία</th>
                            <th class='keno'></th>
                        </tr>";
            // εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10
            //7
            if (isset($_GET['sortBy_contact_id'])) {
                $query = "SELECT * FROM contact ORDER BY id LIMIT $offset, $total_records_per_page";
            } elseif (isset($_GET['sortBy_contact_firstname'])) {
                $query = "SELECT * FROM contact ORDER BY first_name LIMIT $offset, $total_records_per_page";
            } elseif (isset($_GET['sortBy_contact_lastname'])) {
                $query = "SELECT * FROM contact ORDER BY last_name LIMIT $offset, $total_records_per_page";
            } elseif (isset($_GET['sortBy_contact_email'])) {
                $query = "SELECT * FROM contact ORDER BY email LIMIT $offset, $total_records_per_page";
            } elseif (isset($_GET['sortBy_contact_date'])) {
                $query = "SELECT * FROM contact ORDER BY date_of_comment LIMIT $offset, $total_records_per_page";
            } else {
                $query = "SELECT * FROM contact LIMIT $offset, $total_records_per_page";
            }

            $results = mysqli_query($link, $query);

            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['date_of_comment'] . '</td>';
                echo "<td class='keno'>
                        <a href='?contact_id=".$row['id']."' ><button class='table_button cyan'>Προβολή</button></a>                     
                    </td>";
                echo '</tr>';
            }

            echo '</table>';
            include("../General-components/show_number_of_pages.php");
            echo '<div class="table_page" style="padding: 10px 20px 0px; border-top: dotted 1px #CCC;">
                        <strong>Σελίδα '. $page_no.'/'.$total_no_of_pages .'</strong>
                  </div>';
        }
        ?>

    </div>

    <script>
        function openForm(id) {
            document.getElementById(id).style.display = "block";
            window.onkeydown = function(event) {
                if ( event.keyCode === 27 ) {
                    closeForm(id);
                }
            };
        }
        function closeForm(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>

    <!-- pop up παράθυρο για την προβολή μιας φόρμας επικοινωνίας -->
    <div class="form-popup" id="FORM_FOR_CONTACT">
        <form class="form-container">
            <h3>Προβολή φόρμας</h3>
            <?php
            if (isset($_GET['contact_id'])) {
                include("../General-components/connect_to_database.php");
                $id = $_GET['contact_id'];
                $query = "SELECT * FROM contact WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                echo "<div style='font-size: 20px'><b>Όνομα:</b> ".$row['first_name']."<br>
                <b>Επίθετο:</b> ".$row['last_name']."<br>
                <b>Email:</b> ".$row['email']."<br>
                <b>Ημερομηνία:</b> ".$row['date_of_comment']."<br>
                <b>Σχόλιο:</b><br>".$row['comment']."</div>";
            }
            ?>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_CONTACT')">κλείσιμο</button>
        </form>
    </div>
    <?php
    if (isset($_GET['contact_id'])) {
        echo '<script type="text/javascript">'."openForm('FORM_FOR_CONTACT');".'</script>';
    }
    ?>

</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>

</body>
</html>
