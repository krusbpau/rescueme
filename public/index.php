<?php
//Lisätään istunnon aloitus, joká huolehtii kaikkien sivujen kutsuista.
  session_start();

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
 switch ($request) {
   case '/':
   case '/tapahtumat':
     require_once MODEL_DIR . 'tapahtuma.php';
     $tapahtumat = haeTapahtumat();
     echo $templates->render('tapahtumat', ['tapahtumat' => $tapahtumat]);
   break;
   case  '/tapahtuma':
     require_once MODEL_DIR . 'tapahtuma.php';
     $tapahtuma = haeTapahtuma($_GET['id']);
     if ($tapahtuma) {
      echo $templates->render('tapahtuma',['tapahtuma' => $tapahtuma]);
   }  else {
      echo $templates->render('tapahtumanotfound');
    }
   break;
   case  '/lisaa_tili':
     if (isset($_POST['laheta'])){
     $formdata = cleanArrayData($_POST);
     require_once CONTROLLER_DIR . 'tili.php';
     $tulos = lisaaTili($formdata);
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
   if(tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
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

   default:
    echo $templates->render('notfound');
  }

?>
