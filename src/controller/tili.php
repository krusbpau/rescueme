<?php

function lisaaTili($formdata) {

//Tuodaan henkilo-mallin funktiot, joilla voidaan lisätä henkilön tiedot tietokantaan.
require_once(MODEL_DIR . 'henkilo.php');

//Alustetaan virhetaulukko, joka palautuu joko tyhjänä tai  virheillä täytettynä.
$error = [];

//Tarkistetaan onko nimi määritelty ja oikeassa muodossa.
if (!isset($formdata['nimi']) || !$formdata['nimi']) {
   $error['nimi'] = "Anna nimesi.";
 } else {
   if (!preg_match("/^[-'\p{L}]+$/u", $formdata["nimi"])) {
   $error['nimi'] = "Syötä nimesi ilman erikoismerkkejä.";
  }
}

//Tarkistetaan onko sähköpostiosoite määritelty ja se on oikeassa muodossa.
if (!isset($formdata['email']) || !$formdata['email']) {
  $error['email'] = "Anna sähköpostiosoitteesi.";
 } else {
   if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
   $error['email'] = "Sähköpostiosoite on virheellisessä muodossa.";
  }
}

//Tarkistetaan, että molemmat salasanat on annettu ja, että ne vastaavat toisiaan.
if (isset($formdata['salasana1']) && $formdata['salasana1'] &&
    isset($formdata['salasana2']) && $formdata['salasana2']) {
    if ($formdata['salasana1'] != $formdata['salasana2']) {
    $error['salasana'] = "Salasanasi eivät olleet samat!";
   }
 } else {
   $error['salasana'] = "Syötä salasanasi kahteen kertaan.";
}

//Lisätään tiedot tietokantaan, jos syötetyt tiedot oli oikein.
if (!$error) {

//Haetaan syötetyt tiedot omiin muuttujiinsa ja salataan salasana.
    $nimi = $formdata['nimi'];
    $email = $formdata['email'];
    $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);

//Lisätään henkilö tietokantaan. Jos lisäys onnistui, palautetaan henkilön id-tunniste.
$idhenkilo = lisaaHenkilo($nimi,$email,$salasana);

//Tarkistetaan onnistuiko henkilön tietojen lisääminen.
if ($idhenkilo) {
   return [
    "status" => 200,
    "id"     => $idhenkilo,
    "data"   => $formdata
   ];
 } else {
   return [
    "status" => 500,
    "data"   => $formdata
   ];
  }
 } else {
   return [
    "status" => 400,
    "data"   => $formdata,
    "error"  => $error
   ];

 }
}

?>

