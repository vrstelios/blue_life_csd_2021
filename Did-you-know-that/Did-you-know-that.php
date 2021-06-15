<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Ήξερες ότι...</title>
    <link rel="icon" href="../images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="../General-components/styles_main.css">
    <link rel="stylesheet" href="styles_dykt.css">
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
                <source src="../images/Main/Underwater2.mp4">
            </video>
        </div>
        <h2>Ήξερες ότι...</h2>
    </div>
</div>

<!---------------Ήξερες ότι--------------->
<div class="did-you-know-that">
    <ul>
        <?php
        $query = "SELECT * FROM article WHERE id=27";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '<img src="../images/4.Did-you-know-that/iceberg.jpg" alt="iceberg" >';
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        ?>

        <?php
        $query = "SELECT * FROM article WHERE id=28";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

         <?php
        $query = "SELECT * FROM article WHERE id=29";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>

        <?php
        $query = "SELECT * FROM article WHERE id=30";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

        <?php
        $query = "SELECT * FROM article WHERE id=31";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>

         <?php
        $query = "SELECT * FROM article WHERE id=32";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo ' <img src="../images/4.Did-you-know-that/seabed.jpg" alt="uderwater life" >';
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>


         <?php
        $query = "SELECT * FROM article WHERE id=33";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>


        <?php
        $query = "SELECT * FROM article WHERE id=34";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>


        <?php
        $query = "SELECT * FROM article WHERE id=35";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>


         <?php
        $query = "SELECT * FROM article WHERE id=36";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
         echo "<li>";
         echo $row['title'] ;
         echo "</li>";
         echo "<p>";
         echo $row['description'] ;
         echo "</p>";
        ?>


        <?php
        $query = "SELECT * FROM article WHERE id=37";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>



        <?php
        $query = "SELECT * FROM article WHERE id=38";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo '<img src="../images/4.Did-you-know-that/scuba-diving.jpg" alt="ship underwater" >';
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>


        <?php
        $query = "SELECT * FROM article WHERE id=39";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_array($results);
        echo "<li>";
        echo $row['title'] ;
        echo "</li>";
        echo "<p>";
        echo $row['description'] ;
        echo "</p>";
        ?>


    </ul>
    <?php
    $query = "SELECT * FROM article WHERE id=40";
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