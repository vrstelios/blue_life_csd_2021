<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Το προφίλ μου</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_profile.css">
</head>
<body>
<header id="header">
    <h1>Blue Life</h1>
</header>

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
        <h2>Το προφίλ μου</h2>
    </div>
</div>

<!---------------user--------------->
<div class="page_user">
    <div class="profile_img container">
        <button>
            <img src="images/Main/blank-profile-picture.png" alt="error_img" style="width:250px;height:250px ">
            <div class="centered">Προσθέστε εικόνα</div>
        </button>
    </div>

    <div class="mydata">
        <h3>Στοιχεία Λογαριασμού&emsp;<a href="Profile.php"><img src="images/6.Admin/edit.png" alt="edit"></a></h3>
        <?php
        $link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");

        $current_user_id = $_SESSION['connected_id'];//'kogal';

        $query = "SELECT * FROM user WHERE id=$current_user_id";
        $results = mysqli_query($link, $query);
        $num_results = mysqli_num_rows($results);
        if ($num_results != 0){ //υπάρχει ο χρήστης στην βάση
            $row = mysqli_fetch_array($results);
            echo '<p> Username: ' . $row['username']. '</p>';
            echo '<p> Όνομα: ' . $row['first_name']. '</p>';
            echo '<p> Επίθετο: ' . $row['last_name']. '</p>';
            echo '<p> email: ' . $row['email']. '</p>';
            echo '<p> Ηλικία: ' . $row['age']. '</p>';
            echo '<p> Περιοχή: ' . $row['region']. '</p>';
        } else {
            echo '<p> Username: </p>';
            echo '<p> Όνομα: </p>';
            echo '<p> Επίθετο: </p>';
            echo '<p> email: </p>';
            echo '<p> Ηλικία: </p>';
            echo '<p> Περιοχή: </p>';
        }

        @mysqli_free_result($results);
        ?>
    </div>
    <br>
    <br>

    <h3>Οι Δράσεις μου
        <?php //εμφανίζουμε το πλήθος των δράσεων που συμμετέχει ο συγκεκριμένος χρήστης
        $query = "SELECT COUNT(*) FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '(' . $row[0] . ')';
        ?>
    </h3>
    <div class="actions-table">
        <p>
            <button class="table_button">Συμμετοχή σε δράση</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Τοποθεσία</th>
                <th>Περιγραφή</th>
                <th>Σύνδεσμος</th>
                <th class="keno"></th>
            </tr>
            <?php //εμφανίζουμε τον πίνακα των δράσεων που συμμετέχει ο συγκεκριμένος χρήστης
            $query = "SELECT action.title, action.date, action.location, action.description, action.link 
                      FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id 
                      WHERE user_in_action.user_id = $current_user_id";
            $results = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['link'] . '</td>';
                echo "<td class='keno'>
                    <a href='Admin.php'><img src='images/6.Admin/edit.png' alt='edit'></a>
                    <a href='Admin.php'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                </td>";
                echo '</tr>';
            }

            @mysqli_free_result($results);
            ?>
            <!--
            <tr>
                <td>Δράση1</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td class="keno">
                    <a href="Profile.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση2</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td class="keno">
                    <a href="Profile.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση3</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td class="keno">
                    <a href="Profile.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση4</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td class="keno">
                    <a href="Profile.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            <tr>
                <td>Δράση5</td>
                <td>26/04/2021</td>
                <td>Μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα μπλα...</td>
                <td class="keno">
                    <a href="Profile.php"><img src="images/6.Admin/delete-bin.png" alt="delete"></a>
                </td>
            </tr>
            -->
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