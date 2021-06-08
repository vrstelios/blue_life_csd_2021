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
<?php include("navigation.html")?>

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
        <p>Username: user</p>
        <p>Όνομα: όνομα_χρήστη</p>
        <p>Επίθετο: επίθετο_χρήστη</p>
        <p>email: myemail@gmail.gr</p>
        <p>Ηλικία: 25</p>
        <p>Περιοχή: Σέρρες</p>
    </div>
    <br>
    <br>

    <h3>Οι Δράσεις μου (5)</h3>
    <div class="actions-table">
        <p>
            <button class="table_button">Συμμετοχή σε δράση</button>
            <button class="table_button">Ταξινόμηση</button>
        </p>
        <table>
            <tr>
                <th>Τίτλος</th>
                <th>Ημερομηνία</th>
                <th>Πριγραφή</th>
                <th class="keno"></th>
            </tr>
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