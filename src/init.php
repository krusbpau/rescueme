<?php

 //Ladataan tarvittavat määritykset ja toiminnallisuudet ennen kuin skripti suoritetaan.
   require_once '../config/config.php';

 //Otetaan autoload-skripti käyttöön.
   require_once '../vendor/autoload.php';

 //Liitetään apufunktio osaksi koodia.
   require_once HELPERS_DIR . 'form.php';

 //Esitellään helpers-kansiossa oleva DB-luokka.
   require_once HELPERS_DIR . 'DB.php';

?>
