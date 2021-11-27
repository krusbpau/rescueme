<?php

require_once HELPERS.DIR . 'DB.php';

function haeIlmoittautuminen($idhenkilo, $idtapahtuma) {
 return DB::run('SELECT * FROM ilmoittautuminen WHERE idhenkilo = ? AND idtapahtuma = ?',
                  [$idhenkilo, $idtapahtuma])->fetchAll();
}

function lisaaIlmoittautuminen($idhenkilo, $idtapahtuma) {
  DB::run('INSERT INTO ilmoittautuminen ($idhenkilo, $idtapahtuma) VALUE (?,?)',
                  [$idhenkilo, $idtapahtuma]);
return DB::lastInsertID();
}

function poistaIlmoittautuminen($idhenkilo, $idtapahtuma) {
 return DB::run('DELETE FROM ilmoittautuminen WHERE idhenkilo = ? AND idtapahtuma = ?',
                [$idhenkilo, $idtapahtuma])->rowCount();
}

?> 
