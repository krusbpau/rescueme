<?php
//Lisätään istunnon aloitus, joká huolehtii kaikkien sivujen kutsuista.
  session_start();


 //Siistitään polku niin, että url-osoite lyhentyy muotoon /tapahtuma.

 // Suoritetaan projektin aloitusskripti
   require_once '../src/init.php';
//Tarkistetaan onko käyttäjä kirjautunut sisälle, jos on haetaan käyttäjän tiedot ja tallennetaan ne loggeduser-muuttujaan.
 if (isset($_SESSION['user'])) {
  require_once MODEL_DIR . 'henkilo.php';
  $loggeduser = haeHenkilo($_SESSION['user']);
 } else {
//Jos käyttäjä ei ole kirjautunut, loggeduserin arvoksi määritellään tyhjä (NULL).
  $loggeduser = NULL;
}

 //Poistetaan polku kutsuttuun skriptiin.
 $request = str_replace($config['urls']['baseUrl'], '',$_SERVER['REQUEST_URI']);
 //Poistetaan selaimelta tulleesta pyynnöstä urlin lopussa olevat parametrit, jotka erotetaan ?-merkillä osoitteesta.
 $request = strtok($request, '?');



//Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.

 $templates = new League\Plates\Engine(TEMPLATE_DIR);

 //Ehtolauseilla selvitetään, mitä sivua on alunperin kutsuttu ja suoritetaan sivua vastaava käsittelijä.
 //Jos sivua ei tunnisteta, tulostuu tieto virheellisestä sivupyynnöstä.
 switch ($request) {
   case '/':
   case '/tapahtumat':
     require_once MODEL_DIR . 'tapahtuma.php';
     $tapahtumat = haeTapahtumat();
     echo $templates->render('tapahtumat', ['tapahtumat' => $tapahtumat]);
   break;
   case  '/tapahtuma':
     require_once MODEL_DIR . 'tapahtuma.php';
     require_once MODEL_DIR . 'ilmoittautuminen.php';
     $tapahtuma = haeTapahtuma($_GET['id']);
     if ($tapahtuma) {
        if($loggeduser) {
         $ilmoittautuminen = haeIlmoittautuminen($loggeduser['idhenkilo'],$tapahtuma['idtapahtuma']);
    } else {
         $ilmoittautuminen = NULL;
    }
      echo $templates->render('tapahtuma',['tapahtuma' => $tapahtuma,
                                           'ilmoittautuminen' => $ilmoittautuminen,
                                           'loggeduser' => $loggeduser]);
   }  else {
      echo $templates->render('tapahtumanotfound');
    }
   break;
   case  '/lisaa_tili':
     if (isset($_POST['laheta'])){
     $formdata = cleanArrayData($_POST);
     require_once CONTROLLER_DIR . 'tili.php';
     $tulos = lisaaTili($formdata,$config['urls']['baseUrl']);
     if ($tulos['status'] == "200"){
     echo $templates->render('tili_luotu', ['formdata' => $formdata]);
   break;
}
   echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
   break;
  } else {
    echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
   break;

}
  case '/kirjaudu':
  if (isset($_POST['laheta'])){
   require_once CONTROLLER_DIR . 'kirjaudu.php';
   if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
//Määritellään käyttäjän sähköpostiosoitteen user-nimisen istuntomuuttujan arvoksi.
//Edelleenohjataan käyttäjä sovelluksen etusivulle.

//Vaihdetaan istuntotunnus kirjautumisen yhteydessä.
    session_regenerate_id();
    $_SESSION['user'] = $_POST['email'];
    header("Location: " . $config['urls']['baseUrl']);
 } else {
   echo $templates->render('kirjaudu', ['error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana']]);
 }
} else {
   echo $templates->render('kirjaudu', ['error' => []]);
 }
  break;
 case '/logout':
   require_once CONTROLLER_DIR . 'kirjaudu.php';
   logout();
   header("Location: " . $config['urls']['baseUrl']);
   break;

 case '/ilmoittaudu':
//Tarkistetaan onko kutsun yhteydessä annettut tapahtuman id.
   if ($_GET['id']) {
   require_once MODEL_DIR . 'ilmoittautuminen.php';
   $idtapahtuma = $_GET['id'];
//Lisätään ilmoittautuminen kirjautuneelle käyttäjälle ja ohjataan takaisin tapahtumasivulle.
   if ($loggeduser) {
     lisaaIlmoittautuminen($loggeduser['idhenkilo'], $idtapahtuma);
   }
   header("Location: tapahtuma?id=$idtapahtuma");
 } else {
   header("Location: tapahtumat");
}
   break;

 case '/peru':
   if ($_GET['id']) {
   require_once MODEL_DIR . 'ilmoittautuminen.php';
   $idtapahtuma = $_GET['id'];
   if ($loggeduser) {
     poistaIlmoittautuminen($loggeduser['idhenkilo'], $idtapahtuma);
  }
   header("Location: tapahtuma?id=$idtapahtuma");
  } else {
    header("Location: tapahtumat");
  }
  break;

 case '/vahvista':
   if (isset($_GET['key'])) {
     $key = $_GET['key'];
     require_once MODEL_DIR . 'henkilo.php';
     if (vahvistaTili($key)) {
      echo $templates->render('tili_aktivoitu');
     } else {
      echo $templates->render('tili_aktivointi_virhe');
      }
    } else {
     header("Location: " . $config['urls']['baseUrl']);
    }
   break;

   default:
    echo $templates->render('notfound');
  }

?>
