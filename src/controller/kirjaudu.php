<?php

//Luodaan funktio, joka huolehtii käyttäjätunnuksen ja salasanan oikeellisuuden tarkistamisesta.

function tarkistaKirjautuminen($email="", $salasana="") {

//Haetaan käyttäjätiedot sähköpostiosoitteella.
require_once(MODEL_DIR . 'henkilo.php');
$tiedot = haeHenkiloSahkopostilla($email);
//Tarkistuksessa käytetään tulosjoukon ensimmäistä tulosta.
$tiedot = array_shift($tiedot);

//Tarkistetaan löytyykö käyttäjä.
//Jos tiedot löytyy, tarkistetaan täsmääkö käyttäjän antama salasana tietokannan salasanaan
if ($tiedot && password_verify($salasana, $tiedot['salasana'])) {
//Käyttäjä löytyi, palautuu tosi.
   return true;
 }
//Käyttäjää ei löydy tai salasana on väärin.
 return false;

 }

?>
