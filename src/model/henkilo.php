<?php
//Luodaan tietokantafunktio, joka huolehtii henkilön lisäämisestä tietokantaan.
require_once HELPERS_DIR . 'DB.php';

//lisaaHenkilo-funktio lisää henkilön tietokantaan, kun henkilöstä annetaan parametrina sen nimi, sähköpostiosoite ja salasana.
//Funktio palauttaa lisätyn henkilön idhenkilo-tunnisteen.
function lisaaHenkilo($nimi, $email, $salasana) {
  DB::run('INSERT INTO henkilo (nimi, email, salasana) VALUE (?,?,?);',[$nimi, $email, $salasana]);
   return DB::lastInsertId();
}
//Haetaan tietokannasta kaikki ne henkilöt, joilla on parametrina annettu sähköpostiosoite.
//Funktio palauttaa taulukon.
function haeHenkiloSahkopostilla($email) {
   return DB::run('SELECT * FROM henkilo WHERE email =?;', [$email])->fetchAll();
}

//Funktio palauttaa tulosjoukon ensimmäisen rivin.
function haeHenkilo($email) {
  return DB::run('SELECT * FROM henkilo WHERE email = ?;', [$email])->fetch();
}

function paivitaVahvavain($email,$avain) {
  return DB::run('UPDATE henkilo SET vahvavain = ? WHERE email = ?', [$avain,$email])->rowCount();
}

function vahvistaTili($avain) {
  return DB::run('UPDATE henkilo SET vahvistettu = TRUE WHERE vahvavain = ?', [$avain])->rowCount();
}
?>
