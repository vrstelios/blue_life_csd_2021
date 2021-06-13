<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Σελίδα διαχείρισης</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_admin.css">
    <?php
    if (isset($_GET['delete_action']) && $_SESSION['connected_id']==1) { // ο admin έχει πατήσει τον κάδο για να διαγράψει μία δράση και η μεταβλητή $_GET['delete_action'] έχει το id αυτής της δράσης
        delete_action($_GET['delete_action']);
    }

    function delete_action($delete_action_id)
    {
        include("connect_to_database.php");
        $query = "DELETE FROM action WHERE id=$delete_action_id";
        mysqli_query($link, $query);
        $_SESSION['action_deleted'] = "ACTION DELETED";
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
        include("connect_to_database.php");
        if ($_POST['submit'] == 'Καταχώρηση δράσης') {
            if (isset($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                $title = null;
            }
            if (isset($_POST['location'])) {
                $location = $_POST['location'];
            } else {
                $location = null;
            }
            if (isset($_POST['link'])) {
                $link_info = $_POST['link'];
            } else {
                $link_info = null;
            }
            if (isset($_POST['date'])) {
                $date = $_POST['date'];
            } else {
                $date = null;
            }

            // Αποθήκευση εικόνας στον server στο directory images/Uploads/Action_Images/ και ονόματος της εικόνας στην βάση δεδομένων
            $targetDir = "images/Uploads/Action_Images/";
            $fileName = basename($_FILES["image"]["name"]);

            $fileName =  generateRandomString(5) . $fileName;

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(!empty($_FILES["image"]["name"])) {
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                if (in_array($fileType, $allowTypes)) {
                    move_uploaded_file($_FILES["image"]["name"], $targetFilePath);
                }
            }

            if (isset($_POST['subject'])) {
                $description = $_POST['subject'];
            } else {
                $description = null;
            }

            $query = "SELECT id FROM action WHERE title='$title'";
            $results = mysqli_query($link, $query);

            if (mysqli_num_rows($results) > 0) { // unique title
                $_SESSION['submit'] = "NOT AVAILABLE TITLE";
            } else {
                // εισάγουμε τα στοιχεία της δράσης στο db
                $query = "INSERT INTO action (title,date,location,description,image,link)
                  VALUES ('$title','$date','$location','$description','$fileName','$link_info');";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "ACTION CREATED";
                }
                // τροποποιούμε το name της εικόνας με βάση το id της δράσης για να είναι το όνομα μοναδικό
                $query = "SELECT id FROM action WHERE title='$title'";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);

                $_FILES["image"]["name"] = 'A' . $row['id'] . $fileName;;
                $new_filename = $_FILES["image"]["name"];

                $query = "UPDATE action SET image=$new_filename WHERE title=$title";
                mysqli_query($link, $query);
                //echo "The file ".$new_filename. " has been uploaded.";
            }

        }

        if ($_POST['submit'] == 'Ενημέρωση των δεδομένων της δράσης') {
            if (isset($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                $title = null;
            }
            if (isset($_POST['location'])) {
                $location = $_POST['location'];
            } else {
                $location = null;
            }
            if (isset($_POST['link'])) {
                $link_info = $_POST['link'];
            } else {
                $link_info = null;
            }
            if (isset($_POST['date'])) {
                $date = $_POST['date'];
            } else {
                $date = null;
            }
            if (isset($_POST['subject'])) {
                $description = $_POST['subject'];
            } else {
                $description = null;
            }

            $id = $_SESSION['action_id'];

            $query = "SELECT id FROM action WHERE title='$title' AND id!=$id";
            $results = mysqli_query($link, $query);

            if (mysqli_num_rows($results) > 0) {
                $_SESSION['submit'] = "EDIT NOT AVAILABLE TITLE";
            } else {
                // επαναεισάγουμε τα στοιχεία της δράσης στο db
                $query = "UPDATE action SET title='$title', date='$date', location='$location',
                  description='$description', image='$fileName', link='$link_info' WHERE id=$id;";
                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $_SESSION['submit'] = "EDIT ACTION SAVED";
                }
            }

        }

        if ($_POST['submit'] == 'Ενημέρωση της εικόνας της δράσης') {
            // Αποθήκευση εικόνας στον server στο directory images/Uploads/Action_Images/ και ονόματος της εικόνας στην βάση δεδομένων
            $targetDir = "images/Uploads/Action_Images/";
            $fileName = basename($_FILES["image"]["name"]);

            $fileName =  generateRandomString(5) . $fileName;

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(!empty($_FILES["image"]["name"])) {
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                if (in_array($fileType, $allowTypes)) {
                    move_uploaded_file($_FILES["image"]["name"], $targetFilePath);
                }
            }

            $id = $_SESSION['action_id'];

            $query = "UPDATE action SET image='$fileName' WHERE id=$id";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                $_SESSION['submit'] = "EDIT ACTION IMAGE SAVED";
            }

            // τροποποιούμε το name της εικόνας με βάση το id της δράσης για να είναι το όνομα μοναδικό
            $_FILES["image"]["name"] = 'A' . $id . $fileName;;
            $new_filename = $_FILES["image"]["name"];

            $query = "UPDATE action SET image=$new_filename WHERE id=$id";
            mysqli_query($link, $query);
        }
        @mysqli_close($link);
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
    <h2>Σελίδα διαχείρισης</h2>
</div>

<!---------------Σελίδα διαχείρησης--------------->
<?php
// αν ο χρήστης δεν είναι ο admin και προσπαθήσει να φορτώσει την σελίδα Admin_action.php τότε φορτώνεται η σελίδα UnauthorizedProfile.php για την ασφάλεια και απόκρυψη των στοιχείων
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

    <div class="navbar" id="navbar_admin">
        <a href="Admin_user.php">Χρήστες</a>
        <a href="Admin_action.php">Δράσεις</a>
        <a href="Admin_user_in_action.php">Χρήστες σε Δράσεις</a>
        <a href="Admin_contact.php">Επικοινωνία χρηστών</a>
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


    <h3>Δράσεις</h3>
    <div class="actions-table">
        <p>ΟΛΕΣ ΟΙ ΔΡΑΣΕΙΣ
            <?php //εμφανίζουμε το πλήθος των δράσεων
            print_size_of_table($link,'action');
            ?>
            <button class="table_button" onclick="openForm('FORM_FOR_ACTION')">προσθήκη δράσης</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>

        <table>
            <tr>
                <th>id</th>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Τοποθεσία</th>
                <th>Εικόνα</th>
                <th>Σύνδεσμος</th>
                <th></th>
                <th class="keno"></th>
            </tr>

        <?php // εμφανίζουμε τον πίνακα των χρηστών με τα στοιχεία τους, σελιδοποιημένο κατά 10
        include ("connect_to_database.php");
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

            $result_count = mysqli_query($link, "SELECT COUNT(*) As total_records FROM `action`");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total pages minus 1

        $query = "SELECT * FROM `action` LIMIT $offset, $total_records_per_page";
        $results = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($results)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['location'] . '</td>';
            echo '<td><a href="?action_image='.$row['id'].'">' . $row['image'] . '</a></td>';
            echo '<td>' . $row['link'] . '</td>';
            echo "<td><a href='?action_id=".$row['id']."'><button class='table_button cyan'>Προβολή</button></a>";
            echo "<td class='keno'>
                   <a href='?edit_action=".$row['id']."'><img src='images/6.Admin/edit.png' alt='edit'></a>
                   <a href='?edit_action_image=".$row['id']."'><img src='images/6.Admin/camera.png' alt='camera'></a>
                   <a href='?delete_action=" . $row['id'] . "'><img src='images/6.Admin/delete-bin.png' alt='delete'></a>                   
               </td>";
            echo '</tr>';
        }
        ?>

        </table>

        <?php //εμφανίζουμε τη λίστα των σελίδων
        include("show_number_of_pages.php");
        ?>

        <div class="table_page" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Σελίδα <?php echo $page_no."/".$total_no_of_pages; ?></strong>
        </div>
    </div>


    <!-- pop up form για προσθήκη νέας δράσης από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_ACTION">
        <form action="Admin_action.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Δημιουργία δράσης</h3>
            <span>* Υποχρεωτικά πεδία</span><br>
            <p>
                <label for="title"><b>Τίτλος</b><span>*</span><br>
                    <input type="text" placeholder="Δώσε τίτλο" name="title" required>
                </label>
            </p>
            <p>
                <label for="location"><b>Τοποθεσία</b><span>*</span><br>
                    <input type="text" placeholder="Δώσε τοποθεσία" name="location" required>
                </label>
            </p>
            <p>
                <label for="link"><b>Link</b><br>
                    <input type="url" placeholder="Δώσε link" name="link">
                </label>
            </p>
            <p>
                <label for="date"><b>Ημερομηνία</b><span>*</span><br>
                    <input type="date" placeholder="Δώσε ημερομηνία" name="date" required>
                </label>
            </p>
            <p class="input_image">
                <label for="image"><b>Εικόνα</b><span>*</span></label><br>
                <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" required>
            </p>
            <p style="width: 100%">
                <label for="subject"><b>Λεπτομέρειες</b><span>*</span></label><br>
                <textarea placeholder="Δώσε περισσότερες πληροφορίες..." name="subject" id="subject" required></textarea>
            </p>
            <input name="submit" type="submit" value="Καταχώρηση δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_ACTION')">Ακύρωση</button>
        </form>
    </div>

    <!-- pop up form για την τροποποίηση των δεδομένων μιας δράσης από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_EDIT_ACTION">
        <form action="Admin_action.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Τροποποίηση των δεδομένων της δράσης</h3>
            <?php
            if (isset($_GET['edit_action'])) { // ο χρήστης έχει πατήσει τον κάδο για να αποχωρήσει από κάποια δράση και η μεταβλητή $_GET['leave_action'] έχει το id αυτής της δράσης
                include("connect_to_database.php");
                $id = $_GET['edit_action'];
                $query = "SELECT * FROM action WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                $_SESSION['action_id'] = $id;
                echo '<p>
                    <label for="title"><b>Τίτλος</b><br>
                        <input type="text" placeholder="Δώσε τίτλο" name="title" value="'.$row['title'].'" required>
                    </label>
                </p>
                <p>
                    <label for="location"><b>Τοποθεσία</b><br>
                        <input type="text" placeholder="Δώσε τοποθεσία" name="location" value="'.$row['location'].'" required>
                    </label>
                </p>
                <p>
                    <label for="link"><b>Link</b><br>
                        <input type="url" placeholder="Δώσε link" name="link" value="'.$row['link'].'" >
                    </label>
                </p>
                <p>
                    <label for="date"><b>Ημερομηνία</b><br>
                        <input type="date" placeholder="Δώσε ημερομηνία" name="date" value="'.$row['date'].'" required>
                    </label>
                </p>
                <p style="width: 100%">
                    <label for="subject"><b>Λεπτομέρειες</b></label><br>
                    <textarea placeholder="Δώσε περισσότερες πληροφορίες..." name="subject" id="subject" required>'.$row['description'].'</textarea>
                </p>
                ';
            }
            ?>
            <input name="submit" type="submit" value="Ενημέρωση των δεδομένων της δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_EDIT_ACTION')">Ακύρωση</button>
        </form>
    </div>

    <!-- pop up form για την τροποποίηση των δεδομένων μιας δράσης από τον διαχειριστή -->
    <div class="form-popup" id="FORM_FOR_EDIT_ACTION_IMAGE">
        <form action="Admin_action.php" method="post" enctype="multipart/form-data" class="form-container">
            <h3>Τροποποίηση της εικόνας της δράσης</h3>
            <?php
            if (isset($_GET['edit_action_image'])) {
                include("connect_to_database.php");
                $id = $_GET['edit_action_image'];
                $query = "SELECT image FROM action WHERE id=$id;";
                $results = mysqli_query($link, $query);
                $row = mysqli_fetch_array($results);
                $_SESSION['action_id'] = $id;
                echo '<p class="input_image">
                    <label for="image"><b>Εικόνα</b></label><br>
                    <input type="file" id="img" name="image" accept="image/*" placeholder="Δώσε εικόνα" value="'.$row['image'].'" required>
                </p>';
            }
            ?>
            <input name="submit" type="submit" value="Ενημέρωση της εικόνας της δράσης" class="btn"/>
            <button type="button" class="btn_cancel" onclick="closeForm('FORM_FOR_EDIT_ACTION_IMAGE')">Ακύρωση</button>
        </form>
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

    <div class="alert" id="ACTION_CREATED">
        <span class="closeBtn" onclick="closeAlertMessage('ACTION_CREATED')">&times;</span>
        <strong>Επιτυχία!</strong> Η δράση καταχωρήθηκε
    </div>

    <div class="alert" id="EDIT_ACTION_SAVED">
        <span class="closeBtn" onclick="closeAlertMessage('EDIT_ACTION_SAVED')">&times;</span>
        <strong>Επιτυχία!</strong> Τα δεδομένα της δράσης τροποποιήθηκαν
    </div>

    <div class="alert" id="EDIT_ACTION_IMAGE_SAVED">
        <span class="closeBtn" onclick="closeAlertMessage('EDIT_ACTION_IMAGE_SAVED')">&times;</span>
        <strong>Επιτυχία!</strong> H εικόνα της δράσης τροποποιήθηκε
    </div>

    <div class="alert red" id="NOT_AVAILABLE_TITLE">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_TITLE')">&times;</span>
        <strong>Αποτυχία δημιουργίας δράσης!</strong> Ο συγκεκριμένος τίτλος χρησιμοποιείται
    </div>

    <div class="alert red" id="EDIT_NOT_AVAILABLE_TITLE">
        <span class="closeBtn" onclick="closeAlertMessage('NOT_AVAILABLE_TITLE')">&times;</span>
        <strong>Αποτυχία τροποποίησης της δράσης!</strong> Ο συγκεκριμένος τίτλος χρησιμοποιείται
    </div>

    <!--Εμφάνιση μηνύματος όταν διαγραφεί μία δράση-->
    <div class="alert" id="DELETE_ACTION">
        <span class="closeBtn" onclick="closeAlertMessage('DELETE_ACTION')">&times;</span>
        <strong>Η δράση διαγράφτηκε!</strong>
    </div>

    <?php
    if (isset($_GET['edit_action'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα ενός χρήστη και η μεταβλητή $_GET['edit_user'] έχει το id αυτού του χρήστη
        echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_ACTION');".'</script>';
    }
    if (isset($_GET['edit_action_image'])) { // ο χρήστης έχει πατήσει το μολύβι για τροποιήσει τα δεδομένα ενός χρήστη και η μεταβλητή $_GET['edit_user'] έχει το id αυτού του χρήστη
        echo '<script type="text/javascript">'."openForm('FORM_FOR_EDIT_ACTION_IMAGE');".'</script>';
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

    <?php
    if (isset($_SESSION['submit'])) {
        if ($_SESSION['submit'] == "ACTION CREATED") {
            echo '<script type="text/javascript">openAlertMessage("ACTION_CREATED");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "NOT AVAILABLE TITLE") {
            echo '<script type="text/javascript">openAlertMessage("NOT_AVAILABLE_TITLE");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "EDIT ACTION SAVED") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_ACTION_SAVED");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "EDIT NOT AVAILABLE TITLE") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_NOT_AVAILABLE_TITLE");</script>';
            $_SESSION['submit'] = null;
        } else if ($_SESSION['submit'] == "EDIT ACTION IMAGE SAVED") {
            echo '<script type="text/javascript">openAlertMessage("EDIT_ACTION_IMAGE_SAVED");</script>';
            $_SESSION['submit'] = null;
        }
    }
    if (isset($_SESSION['action_deleted'])){
        if ($_SESSION['action_deleted'] == "ACTION DELETED"){
            echo '<script type="text/javascript">openAlertMessage("DELETE_ACTION");</script>';
            $_SESSION['action_deleted'] = null;
        }
    }
    ?>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>
<?php //echo date("Y");?>
<!--https://www.allphptricks.com/create-simple-pagination-using-php-and-mysqli/-->
</body>
</html>
