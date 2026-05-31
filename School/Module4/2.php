<?php
  // String Manipulation
  $str = "The quick brown fox jumps over the lazy dog";
  printf("Length of string: %s <br/>", strlen($str));
  printf("fox string is at position: %d <br/>", strpos($str, 'fox'));
  printf("Sub String \"fox jumps\": %s <br/>", substr($str, 16, 9));
  
  // Array Manipulation
  $fruitArr = array('orange', 'apple', 'grapes');
  $fruitStr = implode(",", $fruitArr); // Turns array into a string: "orange,apple,grapes"
  $newArr = explode(",", $fruitStr); // Splits the string back into an array
?>
