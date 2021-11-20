<?php
 //Esitellään $config-niminen taulukko ja annetaan arvoksi projektissa käytettävät arvot.
 //Tehdään PDO-luokan päälle kääreluokka, joka hoitaa tietokantayhteyden luomisen automaattisesti.
 $config = array(
  "db" => array(
     "dbname" => $_SERVER["DB_DATABASE"],
     "username" => $_SERVER["DB_USERNAME"],
     "password" => $_SERVER["DB_PASSWORD"],
     "host" => "localhost"
   ),
    "urls" => array(
     "baseUrl" => "/~pkrusber/rescueme"
   )
 );

//Määritellään vakiot käytettäville kansioille.
 define("PROJECT_ROOT", dirname(__DIR__) . "/");
 define("HELPERS_DIR", PROJECT_ROOT . "src/helpers/");
 define("TEMPLATE_DIR", PROJECT_ROOT . "src/view/");
 define("MODEL_DIR", PROJECT_ROOT . "src/model/");
 define("CONTROLLER_DIR", PROJECT_ROOT . "src/controller/");
 define("BASEURL", $config['urls']['baseUrl']);
?>
