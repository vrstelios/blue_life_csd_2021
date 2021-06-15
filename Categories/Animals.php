<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Ζώα στο νερό</title>
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
        <h2>Ζώα στο νερό</h2>
    </div>
</div>

<!---------------Ζώα στο νερό--------------->
<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=20";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Animals_seabed.jpg" alt="sharks" >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";
    ?>

</div>

<div class="category_content">
    <?php
    $query = "SELECT * FROM article WHERE id=21";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo "<h3>";
    echo $row['title'] ;
    echo "</h3>";
    echo '<img src="../images/2.Categories/Animals_turtle.jpg" alt="turtle in the beach"  >';
    echo "<p>";
    echo $row['description'] ;
    echo "</p>";

    ?>

    <?php
    $query = "SELECT * FROM article WHERE id=22";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo $row['title'] ;
    echo "<br>";
    echo $row['description'] ;
    ?>

</div>

<div class="animals_gallery">
    <div class="wrapper">
        <img src="../images/2.Categories/Gallery-an/turtle.jpg" alt="Χελώνα">
        <img src="../images/2.Categories/Gallery-an/crab.jpg" alt="Κάβουρας">
        <img src="../images/2.Categories/Gallery-an/jellyfish.jpg" alt="Τσούχτρα">
        <img src="../images/2.Categories/Gallery-an/seal.jpg" alt="Φώκια">
        <img src="../images/2.Categories/Gallery-an/dolphin.jpg" alt="Δελφίνι">
        <img src="../images/2.Categories/Gallery-an/fish.jpg" alt="Ψαράκια">
        <img src="../images/2.Categories/Gallery-an/air-dolphin.jpg" alt="Δελφίνι">
        <img src="../images/2.Categories/Gallery-an/sharks.jpg" alt="Καρχαρίες">
        <img src="../images/2.Categories/Gallery-an/hippocampus.jpg" alt="Ιππόκαμπος">
        <img src="../images/2.Categories/Gallery-an/red-fish.jpg" alt="Ψάρι-Νέμο">
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>

</body>
</html>