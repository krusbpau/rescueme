<?php
  //Siistitään polku niin, että url-osoite lyhentyy muotoon /tapahtuma.

 //Poistetaan polku kutsuttuun skriptiin.
 $request = str_replace('~pkrusber/rescueme', '',$_SERVER['REQUEST_URI']);
 //Poistetaan selaimelta tulleesta pyynnöstä urlin lopussa olevat parametrit, jotka erotetaan ?-merkillä osoitteesta.
 $request = strtok($request, '?');

 //Ehtolauseilla selvitetään, mitä sivua on alunperin kutsuttu ja suoritetaan sivua vastaava käsittelijä.
 //Jos sivua ei tunnisteta, tulostuu tieto virheellisestä sivupyynnöstä.
 if ($request === '/' || $request === '/tapahtumat') {
    echo '<h1>Kaikki tapahtumat</h1>';
  } else if ($request === '/tapahtumat') {
    echo '<h1>Yksittäisen tapahtuman tiedot</h1>';
  } else {
    echo '<h1>Pyydettyä sivua ei löytynyt</h1>';
  }

?>
