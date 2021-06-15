<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Ωκεανοί</title>
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
                <source src="images/Main/Underwater.mp4">
            </video>
        </div>
        <h2>Ωκεανοί</h2>
    </div>
</div>

<!---------------Ωκεανοί--------------->
<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=8";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Oceans_map.jpg" alt="world map" >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

</div>

<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=9";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Oceans_beach.jpg" alt="plastic bottle on the beach" >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

</div>

<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=10";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Oceans_wild-sea.jpg" alt="waves" >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

    <?php
    $query = "SELECT * FROM article WHERE id=11";
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