<?php
$row = 5;
$col = 5;

for ($i = 0; $i < $row; $i++) {
    for ($j = 0; $j < $col; $j++) {

        if (
            $i == 0 ||                    // top border
            $i == $row - 1 ||             // bottom border
            $j == 0 ||                    // left border
            $j == $col - 1 ||             // right border
            $i == $j ||                   // left diagonal
            $i + $j == $col - 1           // right diagonal
        ) {
            echo "*";
        } else {
            echo "&nbsp;&nbsp;";
        }
    }
    echo "<br>";
}
?> 


