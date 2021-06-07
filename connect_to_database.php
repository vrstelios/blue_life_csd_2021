<?php
$link = @mysqli_connect("localhost","bluelife_admin","csd2021");

if (!$link) {
    echo '<p> Error connecting to the database! <br>';
    echo 'Please try again.</p>';
    exit();
}

$result = @mysqli_select_db($link, 'bluelife_database');

if (!$result) {
    echo '<p> Error selecting database table! <br>';
    echo 'Please try again.</p>';
    exit();
}

?>
