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
    <?php
    if (isset($_GET['leave_action'])) { // ο χρήστης έχει πατήσει τον κάδο για να αποχωρήσει από κάποια δράση και η μεταβλητή $_GET['leave_action'] έχει το id αυτής της δράσης
        user_leaves_action($_GET['leave_action']);
    }

    function user_leaves_action($leave_action_id)
    {
        include("connect_to_database.php");
        if (!isset($_SESSION['connected_id'])){ // αν ο χρήστης δεν είναι συνδεδεμένος πρέπει πρώτα να συνδεθεί
            echo '<script  type="text/javascript">openAlertMessage_connect_first();</script>';
        } else {
            $id = $_SESSION['connected_id'];
            $query = "DELETE FROM user_in_action WHERE user_id='$id' AND action_id=$leave_action_id";
            mysqli_query($link, $query);
            $_SESSION['user_leaves_action'] = "user_leaves_action_";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("connect_to_database.php");
        if ($_POST['submit'] == 'Ενημέρωση των δεδομένων μου') {
            if (isset($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $username = null;
            }
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $email = null;
            }
            if (isset($_POST['firstname'])) {
                $firstname = $_POST['firstname'];
            } else {
                $firstname = null;
            }
            if (isset($_POST['lastname'])) {
                $lastname = $_POST['lastname'];
            } else {
                $lastname = null;
            }
            if (isset($_POST['age'])) {
                $age = $_POST['age'];
            } else {
                $age = null;
            }
            if (isset($_POST['region'])) {
                $region = $_POST['region'];
            } else {
                $region = null;
            }
            if (isset($_POST['pass'])) {
                $password = $_POST['pass'];
            } else {
                $password = null;
            }

            $id = $_SESSION['connected_id'];

            $query1 = "SELECT id FROM user WHERE username='$username' AND id!=$id";
            $query2 = "SELECT id FROM user WHERE email='$email' AND id!=$id";
            $results1 = mysqli_query($link, $query1);
            $results2 = mysqli_query($link, $query2);

            if (mysqli_num_rows($results1) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE USERNAME";
            } else if (mysqli_num_rows($results2) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE EMAIL";
            } else {
                $query = "UPDATE user SET username='$username', password='$password', first_name='$firstname',
                  last_name='$lastname', email='$email', age='$age', region='$region' WHERE id=$id;";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "EDIT USER SAVED";
                }
            }
        }

        if ($_POST['submit'] == 'Ενημέρωση της εικόνας μου') {
            $id = $_SESSION['connected_id'];
            // Αποθήκευση εικόνας στον server στο directory images/Uploads/User_Images/ και ονόματος της εικόνας στην βάση δεδομένων
            $targetDir = "images/Uploads/User_Images/";
            $fileName = basename($_FILES["image"]["name"]);

            $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
            $fileName =  'User'.$id.'.'.$fileType;

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(!empty($_FILES["image"]["name"])) {
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                if (in_array($fileType, $allowTypes)) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
                }
            }

            $query = "UPDATE user SET image='$fileName' WHERE id=$id;";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                $_SESSION['submit'] = "EDIT USER IMAGE SAVED";
            }
            mysqli_query($link, $query);
        }
    }

    ?>
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

<?php
// αν ο χρήστης δεν είναι συνδεδεμένος τότε δεν έχει πρόσβαση στα στοιχεία
if (!isset($_SESSION['connected_id'])){
    header("Location: UnauthorizedProfile.php");
}
?>

<!---------------user--------------->
<div class="page_user">
    <div class="profile_img container">
        <button style="cursor: pointer" onclick="openForm('FORM_FOR_EDIT_USER_IMAGE')">
            <?php
            $id = $_SESSION['connected_id'];
            include("connect_to_database.php");
            $query = "SELECT image FROM user WHERE id=$id";
            $results = $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            if ($row['image'] == null){
                echo '<img src="images/Main/blank-profile-picture.png" alt="error_img" class="image_profile">';
                echo '<div class="centered">Προσθέστε εικόνα</div>';
            } else {
                echo '<img src="images/Uploads/User_images/' . $row['image'] . '/" alt="profile user" style="max-width:400px; max-height:350px ">';
                echo '<div class="centered">Τροποποιήστε την εικόνα</div>';
            }
            ?>
        </button>
    </div>

    <div class="mydata">
        <h3>Στοιχεία Λογαριασμού
        <?php
        if($_SESSION['connected_id']!=1){
            echo '<img onclick="openEdit()" src="images/6.Admin/edit.png" alt="edit" style="cursor: pointer">';
        }
        echo '</h3>';
        ?>
        <script>
            function openEdit(){
                openForm('FORM_FOR_EDIT_USER');
            }
        </script>

        <?php
        $link=1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");

        if (isset($_SESSION['connected_id'])){
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
        } else {
            header("Location: UnauthorizedProfile.php");
        }

        ?>
    </div>

    <h3 style="padding-top: 40px">Οι Δράσεις μου
        <?php //εμφανίζουμε το πλήθος των δράσεων που συμμετέχει ο συγκεκριμένος χρήστης
        if (isset($_SESSION['connected_id'])) {
            $query = "SELECT COUNT(*) FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo '(' . $row[0] . ')';
        }
        ?>
    </h3>
    <div class="actions-table">
        <p>
            <a href="Actions.php"> <button class="table_button">Συμμετοχή σε δράση</button></a>
            <?php
            // προεργασίες του paging (εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10)
            include ("connect_to_database.php");
            //?if (isset($_SESSION['connected_id'])) {
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
            $result_count = mysqli_query($link, "SELECT COUNT(*) As total_records FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id 
                      WHERE user_in_action.user_id = $current_user_id");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total pages minus 1

            echo "<div class='sort_dropdown'>
                    <button class='sort_dropbtn'>Ταξινόμηση</button>
                        <div class='sort_dropdown-content'>";
            echo       "<a href='Profile.php?page_no=".$page_no."&sortBy_id_action'> ". 'id' . "</a>";
            echo       "<a href='Profile.php?page_no=".$page_no."&sortBy_title'> ". 'Τίτλος' . "</a>";
            echo       "<a href='Profile.php?page_no=".$page_no."&sortBy_date'> ". 'Ημερομηνία' . "</a>";
            echo       "<a href='Profile.php?page_no=".$page_no."&sortBy_location'> ". 'Τοποθεσία' . "</a>";
            echo   "</div>";
            echo "</div>";

            ?>
        </p>

        <form action="Profile.php" method="post">
            <input type="text" placeholder="Πληκτρολογήστε εδώ" name="search">
            <button type="submit" name="submit" class="table_button_search">Αναζήτηση</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" AND $_POST["search"]!="") { // αν ο χρήστης πατήσει το κουμπί για αναζήτηση ( κληθεί η POST)
            //echo '<h4>'.'KANEI method post == Αναζήτηση' . '</h4>';
            $search = $_POST["search"];
            $query = "SELECT * FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE id LIKE '%{$search}%' OR title LIKE '%{$search}%' OR date LIKE '%{$search}%' OR description LIKE '%{$search}%'  OR location LIKE '%{$search}%'";
            $results = mysqli_query($link, $query);
            $num_results = mysqli_num_rows($results);
            if ($num_results == 0) {    // αν δεν υπάρχουν αποτελέσματα
                echo "<h3>Δεν βρέθηκαν αποτελέσματα αναζήτησης για " . $search ." !</h3>";
            } else {    // αν υπάρχουν αποτελέσματα στην αναζήτηση
                echo "<h3>Αποτελέσματα αναζήτησης</h3>";
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Τίτλος</th>
                            <th>Ημερομηνία</th>
                            <th>Τοποθεσία</th>
                            <th>Εικόνα</th>
                            <th>Σύνδεσμος</th>
                            <th class='keno'></th>
                            <th class='keno'></th>
                        </tr>";
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['location'] . '</td>';
                    echo '<td><a href="?action_image='.$row['id'].'">' . $row['image'] . '</a></td>';
                    echo '<td>' . $row['link'] . '</td>';
                    echo "<td><a href='?action_id=".$row['id']."'><button class='table_button cyan'>Προβολή</button></a></td>";
                    echo "<td class='keno'>
                           <a href='?delete_action=" . $row['id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>                   
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
                            <th>Τίτλος</th>
                            <th>Ημερομηνία</th>
                            <th>Τοποθεσία</th>
                            <th>Εικόνα</th>
                            <th>Σύνδεσμος</th>
                            <th class='keno'></th>
                            <th class='keno'></th>
                        </tr>";
            // εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10
            //7
            if (isset($_GET['sortBy_id_action'])) {
                $query = "SELECT * FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id ORDER BY id LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_title'])) {
                $query = "SELECT * FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id ORDER BY title LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_date'])) {
                $query = "SELECT * FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id ORDER BY date LIMIT $offset, $total_records_per_page";
            }elseif (isset($_GET['sortBy_location'])) {
                $query = "SELECT * FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id ORDER BY location LIMIT $offset, $total_records_per_page";
            }else {
                $query = "SELECT * FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id WHERE user_in_action.user_id = $current_user_id LIMIT $offset, $total_records_per_page";
            }

            $results = mysqli_query($link, $query);

            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td><a href="?action_image='.$row['id'].'">' . $row['image'] . '</a></td>';
                echo '<td>' . $row['link'] . '</td>';
                echo "<td><a href='?action_id=".$row['id']."'><button class='table_button cyan'>Προβολή</button></a></td>";
                echo "<td class='keno'>
                           <a href='?delete_action=" . $row['id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>                   
                      </td>";
                echo '</tr>';
            }

            echo '</table>';
            include("show_number_of_pages.php");
            echo '<div class="table_page" style="padding: 10px 20px 0px; border-top: dotted 1px #CCC;">
                        <strong>Σελίδα '. $page_no.'/'.$total_no_of_pages .'</strong>
                  </div>';
        }
        ?>



        <!-- old
        <table>
            <tr>
                <th>ID</th>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Τοποθεσία</th>
                <th>Περιγραφή</th>
                <th>Σύνδεσμος</th>
                <th class="keno"></th>
            </tr>
            -->

            <?php //εμφανίζουμε τον πίνακα των δράσεων που συμμετέχει ο συγκεκριμένος χρήστης, σελιδοποιημένο κατά 10
            //include ("connect_to_database.php");
            //if (isset($_SESSION['connected_id'])) {
            /*

                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                $total_records_per_page = 10;

                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $query = "SELECT action.id, action.title, action.date, action.location, action.description, action.link 
                      FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id 
                      WHERE user_in_action.user_id = $current_user_id";
                //$query = "SELECT COUNT(*) As total_records FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id
                //      WHERE user_in_action.user_id = $current_user_id";
                $result_count = mysqli_query($link, $query);
                $total_records = mysqli_fetch_array($result_count);
                $total_records = $total_records['total_records'];
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total pages minus 1 */

            /*
                $query = "SELECT action.id, action.title, action.date, action.location, action.description, action.link 
                      FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id 
                      WHERE user_in_action.user_id = $current_user_id";
                if (isset($_GET['sortBy_id_action'])) {
                    $query = $query . " ORDER BY id LIMIT $offset, $total_records_per_page";
                }elseif (isset($_GET['sortBy_title'])) {
                    $query = $query . " ORDER BY title LIMIT $offset, $total_records_per_page";
                }elseif (isset($_GET['sortBy_date'])) {
                    $query = $query . " ORDER BY date LIMIT $offset, $total_records_per_page";
                }elseif (isset($_GET['sortBy_location'])) {
                    $query = $query . " ORDER BY location LIMIT $offset, $total_records_per_page";
                }else {
                    $query = $query . " LIMIT $offset, $total_records_per_page";
                }

                //$query = "SELECT action.id, action.title, action.date, action.location, action.description, action.link
                //      FROM user_in_action INNER JOIN action ON user_in_action.action_id = action.id
                //      WHERE user_in_action.user_id = $current_user_id LIMIT $offset, $total_records_per_page";
                $results = mysqli_query($link, $query);
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['location'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['link'] . '</td>';
                    echo "<td class='keno'>
                    <a href='?leave_action=" . $row['id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>
                    </td>";
                    echo '</tr>';
                }
*/
            ?>

        </table>

        <?php //εμφανίζουμε τη λίστα των σελίδων
        //include("show_number_of_pages.php");
        ?>

        <!--div class="table_page" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Σελίδα <?php //echo $page_no."/".$total_no_of_pages; ?></strong>
        </div-->
    </div>
</div>

<!-- pop up form για την προβολή μιας δράσης -->
<div class="form-popup" id="FORM_FOR_ACTION_VIEW">
    <form class="form-container">
        <h3>Προβολή δράσης</h3>
        <?php
        if (isset($_GET['action_id'])) {
            include("connect_to_database.php");
            $id = $_GET['action_id'];
            $query = "SELECT * FROM action WHERE id=$id;";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo "<div style='font-size: 20px'><b>Τίτλος:</b> ".$row['title']."<br>
                <b>Εικόνα:</b><br><img src='images/Uploads/Action_Images/".$row["image"]."' alt='action image' style='max-width: 300px; max-height: 300px'><br>
                <b>Ημερομηνία:</b> ".$row['date']."<br>
                <b>Σύνδεσμος:</b> ".$row['link']."<br>
                <b>Περιγραφή:</b><br>".$row['description']."</div>";
        }
        ?>
        <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_ACTION_VIEW')">κλείσιμο</button>
    </form>
</div>

<!--Εμφάνιση μηνύματος ότι ο χρήστης αποχώρησε από την δράση-->
<div class="alert" id="user_leaves_action">
    <span class="closeBtn" onclick="closeAlertMessage('user_leaves_action')">&times;</span>
    <strong>Αποχώρησες από τη δράση!</strong>
</div>

<script>
    function openAlertMessage(id) {
        document.getElementById(id).style.display = "block";
        setTimeout(hideElement, 7000) //milliseconds
        function hideElement() {
            closeAlertMessage(id);
        }
    }
    function closeAlertMessage(id) {
        document.getElementById(id).style.display = "none";
    }
</script>


<?php
if (isset($_SESSION['user_leaves_action'])) {
    if ($_SESSION['user_leaves_action'] == "user_leaves_action_") {
        echo '<script  type="text/javascript">openAlertMessage("user_leaves_action");</script>';
        $_SESSION['user_leaves_action'] = null;
    }
}
?>
<!--τέλος εμφάνισης μηνύματος-->

<!-- pop up form για την τροποποίηση των στοιχείων ενός χρήστη -->
<div class="form-popup" id="FORM_FOR_EDIT_USER" role="dialog">
    <form action="Profile.php" method="post" class="form-container">
        <h3>Τροποποίηση των δεδομένων του χρήστη</h3>
        <?php

        include("connect_to_database.php");
        $id = $_SESSION['connected_id'];
        $query = "SELECT * FROM user WHERE id=$id;";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '<p>
            <label for="username"><b>Username</b><br>
                <input type="text" placeholder="Γράψε username" name="username" value="'.$row['username'].'" required>
            </label>
            </p>
            <p>
                <label for="email"><b>Email</b><br>
                    <input type="email" placeholder="Γράψε Email" name="email" value="'.$row['email'].'" required>
                </label>
            </p>
            <p>
                <label for="first_name"><b>Όνομα</b><br>
                    <input type="text" placeholder="Γράψε Όνομα" name="firstname" value="'.$row['first_name'].'" required>
                </label>
            </p>
            <p>
                <label for="last_name"><b>Επίθετο</b><br>
                    <input type="text" placeholder="Γράψε Επίθετο" name="lastname" value="'.$row['last_name'].'" required>
                </label>
            </p>
            <p>
                <label for="age"><b>Ηλικία</b><br>
                    <input type="number" placeholder="Γράψε Ηλικία" value="'.$row['age'].'" name="age">
                </label>
            </p>
            <p>
                <label for="region"><b>Περιοχή</b><br>
                    <input type="text" placeholder="Γράψε Περιοχή" name="region" value="'.$row['region'].'">
                </label>
            </p>
            <p>
                <label for="password"><b>Κωδικός</b><br>
                    <input type="text" placeholder="Γράψε κωδικό" name="pass" value="'.$row['password'].'" required>
                </label>
            </p>';
        ?>
        <input name="submit" type="submit" value="Ενημέρωση των δεδομένων μου" class="btn"/>
        <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_EDIT_USER')">Ακύρωση</button>
    </form>
</div>

<!-- pop up form για την τροποποίηση της εικόνας ενός χρήστη -->
<div class="form-popup" id="FORM_FOR_EDIT_USER_IMAGE" role="dialog">
    <form action="Profile.php" method="post" enctype="multipart/form-data" class="form-container">
        <h3>Αλλαγή εικόνας</h3>
        <?php
        include("connect_to_database.php");
        $id = $_SESSION['connected_id'];
        $query = "SELECT image FROM user WHERE id=$id;";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '<p class="input_image">
                <label for="image"><b>Εικόνα</b><br>
                    <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" value="'.$row['image'].'" required>
                </label>
            </p>';
        ?>
        <input name="submit" type="submit" value="Ενημέρωση της εικόνας μου" class="btn"/>
        <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_EDIT_USER_IMAGE')">Ακύρωση</button>
    </form>
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

<?php
if (isset($_GET['edit_my_profile'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα του και η μεταβλητή $_GET['edit_my_profile'] έχει το id του
    echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_USER');".'</script>';
}
if (isset($_GET['action_id'])) {
    echo '<script type="text/javascript">'."openForm('FORM_FOR_ACTION_VIEW');".'</script>';
}
?>

<!-- pop up παράθυρο για την προβολή μιας εικόνας μιας δράσης -->
<div class="form-popup" id="FORM_FOR_ACTION_IMAGE">
    <form class="form-container">
        <?php
        if (isset($_GET['action_image'])) {
            include("connect_to_database.php");
            $id = $_GET['action_image'];
            $query = "SELECT title, image FROM action WHERE id=$id;";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo '<h3>Προβολή εικόνας της δράσης '.$row["title"].'</h3><br>
                <div style="display: flex;align-items: center;justify-content: center;">
                <img height="400px" alt="action image" src="images/Uploads/Action_Images/'.$row["image"].'"></div>';
        }
        ?>
        <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_ACTION_IMAGE')">κλείσιμο</button>
    </form>
</div>

<?php
if (isset($_GET['action_image'])) {
    echo '<script type="text/javascript">'."openForm('FORM_FOR_ACTION_IMAGE');".'</script>';
}
?>

<div class="alert red" id="EDIT_NOT_AVAILABLE_USERNAME">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_NOT_AVAILABLE_USERNAME')">&times;</span>
    <strong>Αποτυχία τροποίησης του χρήστη!</strong> Το συγκεκριμένο username χρησιμοποιείται
</div>

<div class="alert red" id="EDIT_NOT_AVAILABLE_EMAIL">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_NOT_AVAILABLE_EMAIL')">&times;</span>
    <strong>Αποτυχία τροποίησης του χρήστη!</strong> Το συγκεκριμένο email χρησιμοποιείται
</div>

<div class="alert" id="EDIT_USER_SAVED">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_USER_SAVED')">&times;</span>
    <strong>Επιτυχία!</strong> Τα δεδομένα του χρήστη τροποποιήθηκαν
</div>

<div class="alert" id="EDIT_USER_IMAGE_SAVED">
    <span class="closeBtn" onclick="closeAlertMessage('EDIT_USER_SAVED')">&times;</span>
    <strong>Επιτυχία!</strong> Η εικόνα σου ενημερώθηκε
</div>

<?php
if (isset($_SESSION['submit'])) {
    if ($_SESSION['submit'] == "EDIT NOT AVAILABLE USERNAME") {
        echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_USERNAME");</script>';
        $_SESSION['submit'] = null;
    } else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE EMAIL") {
        echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_EMAIL");</script>';
        $_SESSION['submit'] = null;
    } else if ($_SESSION['submit'] == "EDIT USER SAVED") {
        echo '<script type="text/javascript">openAlertMessage("EDIT_USER_SAVED");</script>';
        $_SESSION['submit'] = null;
    } else if ($_SESSION['submit'] == "EDIT USER IMAGE SAVED"){
        echo '<script type="text/javascript">openAlertMessage("EDIT_USER_IMAGE_SAVED");</script>';
        $_SESSION['submit'] = null;
    }
}
?>


<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>

</body>
</html>