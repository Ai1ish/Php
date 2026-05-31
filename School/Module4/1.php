<?php
  // Declaring a constant
  define('MAX_VALUE', 10);
  
  // Including a file (generates a warning if not found)
  include("header.inc");
  
  // Requires a file (generates a fatal error if not found)
  require("somefile.inc");
?>
