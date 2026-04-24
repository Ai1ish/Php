<?php

$n = 20;

for ($i = 1; $i <= $n; $i++) {
    
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz<br>";
    }
    elseif ($i % 3 == 0) {
        echo "Fizz<br>";
    }
    elseif ($i % 5 == 0) {
        echo "Buzz<br>";
    }
    else {
        echo $i . "<br>";
    }
}

echo "<br>";
echo "202411893 - Narvasa, Ailish Sophia D.<br><br>";

?>
