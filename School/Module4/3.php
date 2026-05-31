<?php
  // Number formatting (adds commas and sets decimals)
  $price = 217795.75;
  echo number_format($price, 2, '.', ','); // Outputs: 217,795.75

  // Date formatting
  echo date('l jS \of F Y h:i:s A'); // Outputs ex: Wednesday 6th of February 2013 08:35:22 AM
?>
