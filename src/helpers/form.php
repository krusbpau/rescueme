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

function getValue($values, $key) {
//Palautetaan kentän arvo taulukosta, jos se on määritelty, muuten palautetaan tyhjäarvo.
 if (array_key_exists($key, $values)) {
//Muutetaan tietyt merkit erikoismerkeiksi, jotta kentän arvo turvallista tulostaa sivulle.
   return htmlspecialchars($values[$key]);
 } else {
  return null;
 }
}

?>
