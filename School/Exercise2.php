<?php

echo "<table border='2' cellspacing='0' cellpadding='3' 
style='border-collapse:collapse; text-align:center; margin:auto; font-family:Arial; width:700px;'>";

//title
echo "<tr style='background-color:#d9ead3; font-weight:bold;'>";
echo "<td colspan='11'>MULTIPLICATION TABLE</td>";
echo "</tr>";


//header
echo "<tr style='background-color:#b4a7d6; font-weight:bold;'>";
echo "<td style='background-color:#d5a6bd;'>x</td>";

for ($i = 1; $i <= 10; $i++) {
    echo "<td>$i</td>";
}
echo "</tr>";

//body
for ($row = 1; $row <= 10; $row++) {

    echo "<tr>";

    echo "<td style='background-color:#b4a7d6; font-weight:bold;'>$row</td>";

    for ($col = 1; $col <= 10; $col++) {

        $ans = $row * $col;

        if ($row == $col) {
            $color = "#d5a6bd";
        } 
        elseif ($row + $col == 11){
            $color = "#e6b8af";
        }
        else {
            $color = "#DDE3E6";
        }

        echo "<td style='background-color:$color;'>$ans</td>";
    }

    echo "</tr>";
}

//footer
echo "<tr style='background-color:#d9ead3; font-weight:bold;'>";
echo "<td colspan='11' style='text-align:left;'>by: Narvasa, Ailish Sophia D. / TN23 </td>";
echo "</tr>";

echo "</table>";

?>
