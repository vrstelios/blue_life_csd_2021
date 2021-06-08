<?php
$link = @mysqli_connect("localhost","bluelife_admin","csd2021");

if (!$link) {
    echo '<p> Error connecting to the server! <br>';
    echo 'Please try again.</p>';
    exit();
}

$result_of_connection = @mysqli_select_db($link, 'bluelife_database');

if (!$result_of_connection) {
    echo '<p> Error connecting to the database! <br>';
    echo 'Please try again.</p>';
    exit();
}

?>
