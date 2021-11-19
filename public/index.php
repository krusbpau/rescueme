<?php
 //Siistitään polku niin, että url-osoite lyhentyy muotoon /tapahtuma.

 // Suoritetaan projektin aloitusskripti
   require_once '../src/init.php';
 //Poistetaan polku kutsuttuun skriptiin.
 $request = str_replace($config['urls']['baseUrl'], '',$_SERVER['REQUEST_URI']);
 //Poistetaan selaimelta tulleesta pyynnöstä urlin lopussa olevat parametrit, jotka erotetaan ?-merkillä osoitteesta.
 $request = strtok($request, '?');

//Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.

 $templates = new League\Plates\Engine(TEMPLATE_DIR);

 //Ehtolauseilla selvitetään, mitä sivua on alunperin kutsuttu ja suoritetaan sivua vastaava käsittelijä.
 //Jos sivua ei tunnisteta, tulostuu tieto virheellisestä sivupyynnöstä.
 if ($request === '/' || $request === '/tapahtumat') {
    require_once MODEL_DIR . 'tapahtuma.php';
    $tapahtumat = haeTapahtumat();
    echo $templates->render('tapahtumat', ['tapahtumat' => $tapahtumat]);
  } else if ($request === '/tapahtuma') {
    require_once MODEL_DIR . 'tapahtuma.php';
    $tapahtuma = haeTapahtuma($_GET['id']);
    if ($tapahtuma) {
    echo $templates->render('tapahtuma',['tapahtuma' => $tapahtuma]);
  } else {
    echo $templates->render('tapahtumanotfound');
    }
  } else {
    echo $templates->render('notfound');
  }

?>
