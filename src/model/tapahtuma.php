<?php

   require_once HELPERS_DIR . 'DB.php';

//Esitellään haeTapahtumat-funktio, joka hakee tietokannasta kaikki tapahtumat tapahtuman aloitusajan mukaan järjestettynä.
   function haeTapahtumat() {
    return DB::run('SELECT * FROM tapahtuma ORDER BY tap_alkaa;')->fetchAll();
}

//Esitellään haeTapahtuma-funktio, joka hakee tietokannasta yksittäisen tapahtuman tiedot.
   function haeTapahtuma($id) {
    return DB::run('SELECT * FROM tapahtuma WHERE idtapahtuma = ?;',[$id])->fetch();
}
?>
