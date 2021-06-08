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
<?php include("navigation.html")?>

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
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>