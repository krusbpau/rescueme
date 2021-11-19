<?php

function cleanArrayData($array=[]) {
  $result = array();
  foreach ($array as $key => $value) {
//Poistetaan merkkijonon alusta ja lopusta tyhjät merkit.
    $cleaned = trim($value);
//Poistetaan merkkien edestä mahdolliset \-ohjausmerkit.
    $cleaned = stripslashes($cleaned);
    $result[$key] = $cleaned;
 }
  return $result;
 }

?>
