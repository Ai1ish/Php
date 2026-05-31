<?php
  $a = 50; 
  $b = 80;
  
  // If...else statement
  if ($a < $b) {
      echo "<p>\$a is less than \$b</p>";
  } elseif ($a == $b) {
      echo "<p>\$a is equal to \$b</p>";
  } else {
      echo "<p>\$a is greater than \$b</p>";
  }

  // Ternary operator (shorthand for simple if/else)
  $x = $a > $b ? "\$a is larger": "\$b is larger";
  echo $x;
?>
