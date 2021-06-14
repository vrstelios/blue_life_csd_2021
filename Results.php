<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Life</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_results.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>

<!---------------Navigation bar--------------->
<?php include("navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <h2>Αποτελέσματα αναζήτησης</h2>
</div>

<!---------------Περιεχόμενο  σελίδας--------------->
<?php
include("connect_to_database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" AND $_POST["navigation_search"]!="") { // αν ο χρήστης πατήσει το κουμπί για αναζήτηση ( κληθεί η POST)
    $navigation_search = $_POST["navigation_search"];
    //echo '<h4>'.'KANEI method post == Αναζήτηση, navigation_search= '. $navigation_search . '</h4>';

    $query = "SELECT * FROM article WHERE title LIKE '%{$navigation_search}%' OR
                          description LIKE '%{$navigation_search}%'  OR page LIKE '%{$navigation_search}%'"; // to page LIKe να φύγει??????
    $results = mysqli_query($link, $query);


    $num_results = mysqli_num_rows($results);
    echo "<div class='results_content'>";
    if ($num_results == 0) {    // αν δεν υπάρχουν αποτελέσματα
        echo "<h3>Δεν βρέθηκαν αποτελέσματα αναζήτησης για " . $navigation_search ." !</h3>";
    } else {    // αν υπάρχουν αποτελέσματα στην αναζήτηση

        $pattern = "/".$navigation_search."/";
        $replacement = '<span style="background-color: yellow; " >' . $navigation_search . '</span>';

        while ($row = mysqli_fetch_array($results)) {
            echo "<div class='results_content'>";
            echo "<h3>" . preg_replace($pattern, $replacement, $row['title']) . "</h3>";
            echo "Αποτέλεσμα από σελίδα <a href=".$row['page'].">".$row['page']."</a>";
            echo "<p>" . preg_replace($pattern, $replacement, $row['description']) . "</p>";
            echo '</div>';
            echo '<hr>';
        }
    }
    echo '</div>';
    $_POST["$navigation_search"] = null;
}
?>


<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>


</body>
</html>