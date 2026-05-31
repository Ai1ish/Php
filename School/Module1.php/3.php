<?php
  // Type Casting
  $x = (double) 8;
  echo "<p>$x</p>";
  
  $str = "19.00 pesos is the price";
  $x = (int) $str; // Outputs 19
  
  // Type Juggling (PHP automatically converts types based on context)
  $a = 10;
  $b = "20";
  $c = $a + $b; // Outputs 30
?>
