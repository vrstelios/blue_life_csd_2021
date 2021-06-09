<?php
session_start();
?>
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
<?php include("navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <h2>Σελίδα διαχείρησης</h2>
</div>

<!---------------Σελίδα διαχείρησης--------------->
<?php
// αν ο χρήστης δεν είναι ο admin και προσπαθήσει να φορτώσει την σελίδα Admin.php τότε φορτώνεται η σελίδα UnauthorizedProfile.php για την ασφάλεια και απόκρυψη των στοιχείων
if ($_SESSION['connected_id'] != 1){
    header("Location: UnauthorizedProfile.php");
}
$link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
include("connect_to_database.php");

function print_size_of_table($link, $table){
    //εμφανίζουμε το πλήθος των συνολικών συμμετοχών στις δράσεις
    $query = "SELECT COUNT(*) FROM $table";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo '(' . $row[0] . ')';
}
?>

<div class="admin-page">
    <h3>Χρήστες</h3>
    <div class="users-table">
        <p>ΟΛΟΙ ΟΙ ΧΡΗΣΤΕΣ
            <?php //εμφανίζουμε το πλήθος των χρηστών
            print_size_of_table($link,'user');
            ?>
        <button class="table_button">προσθήκη χρήστη</button>
        <button class="table_button">Ταξινόμηση</button>
        </p>

        <table>
            <tr>
                <th>id</th>
                <th>Username</th>
                <th>Όνομα</th>
                <th>Επίθετο</th>
                <th>Email</th>
                <th>Ηλικία</th>
                <th>Περιοχή</th>
                <th>Εικόνα</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους
            $query = "SELECT * FROM user";
            $results = mysqli_query($link, $query);
            while  ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
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

            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <h3>Δράσεις</h3>
    <div class="actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΡΑΣΕΙΣ
            <?php //εμφανίζουμε το πλήθος των δράσεων
            print_size_of_table($link,'action');
            ?>
            <button class="table_button">προσθήκη δράσης</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>id</th>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Τοποθεσία</th>
                <th>Περιγραφή</th>
                <th>Εικόνα</th>
                <th>Σύνδεσμος</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα όλων των δράσεων
            $query = "SELECT id, title, date, location, description, image, link 
                      FROM action";
            $results = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['image'] . '</td>';
                echo '<td>' . $row['link'] . '</td>';
                echo "<td class='keno'>
                    <a href='Admin.php'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';
            }

            @mysqli_free_result($results);
            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>

    <h3>Χρήστης στη δράση</h3>
    <div class="user-actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΗΛΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ
            <?php //εμφανίζουμε το πλήθος των συνολικών συμμετοχών στις δράσεις
            print_size_of_table($link,'user_in_action');;
            ?>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>id χρήστη</th>
                <th>id δράσης</th>
                <th>Username συμμετέχοντα</th>
                <th>Τίτλος δράσης</th>
                <th>Ημερομηνία δήλωσης συμμετοχής</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τους συμμετέχοντες στις δράσεις
            $query = "SELECT user_in_action.user_id, user_in_action.action_id, user.username, action.title, user_in_action.date_joined
                      FROM user, user_in_action, action
                      WHERE user.id=user_in_action.user_id AND user_in_action.action_id=action.id";
            $results = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['user_id'] . '</td>';
                echo '<td>' . $row['action_id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date_joined'] . '</td>';
                echo "<td class='keno'>
                    <a href='Admin.php'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';
            }

            @mysqli_free_result($results);
            @mysqli_close($link);
            ?>
        </table>
        <div class="table_page">Σελίδα 1/1</div>
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>