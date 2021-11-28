<?php

require_once HELPERS_DIR . 'DB.php';
//Haetaan käyttäjän ilmoittautuminen yksittäiseen tapahtumaan ja palautetaan tapahtuman tiedot..
function haeIlmoittautuminen($idhenkilo, $idtapahtuma) {
 return DB::run('SELECT * FROM ilmoittautuminen WHERE idhenkilo = ? AND idtapahtuma = ?',
                  [$idhenkilo, $idtapahtuma])->fetchAll();
}
//Ilmoitetaan käyttäjä tapahtumaan lisäämällä ilmoittautuminen-tauluun yhteys käyttäjän ja tapahtuman välille.
function lisaaIlmoittautuminen($idhenkilo, $idtapahtuma) {
  DB::run('INSERT INTO ilmoittautuminen ($idhenkilo, $idtapahtuma) VALUE (?,?)',
                  [$idhenkilo, $idtapahtuma]);
return DB::lastInsertID();
}
//Poistetaan ilmoittautuminen tapahtumasta ja palautetaan poistettujen rivien lukumäärä.
function poistaIlmoittautuminen($idhenkilo, $idtapahtuma) {
 return DB::run('DELETE FROM ilmoittautuminen WHERE idhenkilo = ? AND idtapahtuma = ?',
                [$idhenkilo, $idtapahtuma])->rowCount();
}

?> 
