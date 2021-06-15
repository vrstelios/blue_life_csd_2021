<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Life</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_home.css">
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
<video autoplay muted loop id="myVideo">
    <source src="../images/1.Home/Sea-home.mp4" type="video/mp4">
</video>
<div class="home-page-title">
    <?php
    $query = "SELECT * FROM article WHERE id=1";
    $results = mysqli_query($link, $query); // Το error που εμφανίζεται εδώ είναι "εικονικό", δεν προκαλεί κανένα πρόβλημα. Το ίδιο error υπάρχει και σε κάποιες άλλες σελίδες
    $row = mysqli_fetch_array($results);
    echo "<div><h5><i>";
    echo $row['title'] ;
    echo "</i></h5>";
    echo "<h6><i>";
    echo $row['description'] ;
    echo "</i></h6></div>";
    ?>

</div>

<!---------------Περιεχόμενο αρχικής σελίδας--------------->
<div class="home_articles">
    <div class="row">
        <div class="column left">
            <img src="../images/1.Home/waves.jpg" alt="Wild sea"/>
        </div>
        <div class="column right">
            <?php
            $query = "SELECT * FROM article WHERE id=2";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo "<h3>";
            echo $row['title'] ;
            echo "</h3>";
            echo "<p>";
            echo $row['description'];
            echo "</p>";
            ?>
        </div>
    </div>
</div>

<!-----------------Φωτογραφία με ρητό----------------->
<div class="section">
    <div>
        <?php
        $query = "SELECT * FROM article WHERE id=3";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<h5><i>";
        echo $row['title'] ;
        echo "</i></h5>";
        echo "<h6><i>";
        echo $row['description'] ;
        echo "</i></h6>";
        ?>
    </div>
</div>

<div class="home_articles">
    <div class="row">
        <div class="column left2">
            <?php
            $query = "SELECT * FROM article WHERE id=4";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo "<h3>";
            echo $row['title'] ;
            echo "</h3>";
            echo "<p>";
            echo $row['description'] ;
            echo "</p>";
            ?>
            <a href="../Actions/Actions.php"><button class="youCanHelpHomeButton"> Δες πώς μπορείς να βοηθήσεις! </button></a>
        </div>
        <div class="column right2">
            <img src="../images/1.Home/Home_helpSea.jpg" alt="You can do it"/>
        </div>
    </div>
</div>

<div class="home_articles">
    <div class="row">
        <div class="column left">
            <img src="../images/1.Home/bubbles.jpg" alt="Cute Bubbles"/>
        </div>
        <div class="column right">
            <?php
            $query = "SELECT * FROM article WHERE id=5";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo "<h3>";
            echo $row['title'] ;
            echo "</h3>";
            echo "<p>";
            echo $row['description'] ;
            echo "</p>";
            ?>
        </div>
    </div>
</div>

<div class="home_articles">
    <div class="row">        
        <div class="column left2">
            <?php
            $query = "SELECT * FROM article WHERE id=6";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_array($results);
            echo "<h3>";
            echo $row['title'] ;
            echo "</h3>";
            echo "<p>";
            echo $row['description'] ;
            echo "</p>";
            ?>

        </div>
        <div class="column right2">
            <img src="../images/1.Home/dry_water.jpg" alt="Wave"/>
        </div>
    </div>
    <?php
    $query = "SELECT * FROM article WHERE id=7";
    $results = mysqli_query($link, $query);
    $row = mysqli_fetch_array($results);
    echo $row['title'] ;
    echo "<br>";
    echo $row['description'] ;
    ?>

</div>

<div class="home_articles">
    <hr>
    <div class="gallery">
        <div class="box">
            <span style="--i:1;"><img src="../images/1.Home/Gallery-3d/wave.jpg" alt="Κύμα"></span>
            <span style="--i:2;"><img src="../images/1.Home/Gallery-3d/lake.jpg" alt="Λίμνη"></span>
            <span style="--i:3;"><img src="../images/1.Home/Gallery-3d/view-river.jpg" alt="Ποτάμι"></span>
            <span style="--i:4;"><img src="../images/1.Home/Gallery-3d/fish-tank.jpg" alt="Ψάρι"></span>
            <span style="--i:5;"><img src="../images/1.Home/Gallery-3d/wetland.jpg" alt="Υδροβιότοπος"></span>
            <span style="--i:6;"><img src="../images/1.Home/Gallery-3d/fishing-boat.jpg" alt="Ψάρεμα"></span>
            <span style="--i:7;"><img src="../images/1.Home/Gallery-3d/lake-mountain.jpg" alt="Λίμνη"></span>
            <span style="--i:8;"><img src="../images/1.Home/Gallery-3d/fish.jpg" alt="Ψάρια"></span>
        </div>
    </div>
</div>

<!-----------------Go to top button----------------->
<?php include("../General-components/go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("../General-components/footer.html");?>


</body>
</html>