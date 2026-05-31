<?php
  // Function with parameters and returning a value
  function qoutient($x, $y) {
      return $x / $y;
  }
  printf("The quotient is %.2f<br/>", qoutient(7, 3));

  // Using a static variable
  function counter($value) {
      static $count = 0;
      $count += $value;
      echo "The value of the counter is $count<br>";
  }
  counter(4); // Outputs 4
  counter(3); // Outputs 7
?>
