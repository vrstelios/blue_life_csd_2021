<?php //εμφανίζουμε τη λίστα των σελίδων
echo "<div class='my_table'>";
echo "<ul>";
if ($total_no_of_pages <= 10){
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
        if ($counter == $page_no) {
            echo "<li class='active'><a>$counter</a></li>";
        }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
    }
}elseif ($total_no_of_pages > 10){
    if($page_no <= 4) {
        for ($counter = 1; $counter < 8; $counter++){
            if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
            }else{
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }
        }
        echo "<li><a>...</a></li>";
        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    } elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
        echo "<li><a href='?page_no=1'>1</a></li>";
        echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for (
            $counter = $page_no - $adjacents;
            $counter <= $page_no + $adjacents;
            $counter++
        ) {
            if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
            }else{
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }
        }
        echo "<li><a>...</a></li>";
        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    } else {
        echo "<li><a href='?page_no=1'>1</a></li>";
        echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for (
            $counter = $total_no_of_pages - 6;
            $counter <= $total_no_of_pages;
            $counter++
        ) {
            if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
            }else{
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }
        }
    }
}
echo "</ul>";
echo "</div>";
?>