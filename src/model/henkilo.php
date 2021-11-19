<?php
//Luodaan tietokantafunktio, joka huolehtii henkilön lisäämisestä tietokantaan.
 require_once HELPERS_DIR . 'DB.php';

//lisaaHenkilo-funktio lisää henkilön tietokantaan, kun henkilöstä annetaan parametrina sen nimi, sähköpostiosoite ja salasana.
//Funktio palauttaa lisätyn henkilön idhenkilo-tunnisteen.
 function lisaaHenkilo($nimi, $email, $salasana) {
  DB::run('INSERT INTO henkilo (nimi, email, salasana) VALUE (?,?,?);',[$nimi, $email, $salasana]);
   return DB::lastInsertId();
}

?>
