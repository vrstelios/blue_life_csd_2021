<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Υδροβιότοποι</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_categories.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>
<!---------------database--------------->
<?php include("../General-components/connect_to_database.php") ?>

<!---------------Navigation bar--------------->
<?php include("../General-components/navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="../images/Main/Underwater.mp4">
            </video>
        </div>
        <h2>Υδροβιότοποι</h2>
    </div>
</div>

<!---------------Υδροβιότοποι--------------->
<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=16";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Wetlands_wetland1.jpg" alt="Υδροβιότοπος">';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

</div>

<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=17";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Wetlands_wetland2.jpg" alt="Υδροβιότοπος">';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

</div>

<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=18";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo ' <img src="../images/2.Categories/Wetlands_wetland3.jpg" alt="Υδροβιότοπος">';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

    <?php
    $query = "SELECT * FROM article WHERE id=19";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo $row['title'] ;
    echo "<br>";
    echo $row['description'] ;
    ?>

</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>
</body>
</html>