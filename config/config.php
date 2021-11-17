<?php
 //Esitellään $config-niminen taulukko ja annetaan arvoksi projektissa käytettävät arvot.
 $config = array(
    "urls" => array(
     "baseUrl" => "/~pkrusber/rescueme"
   )
 );

//Määritellään vakiot käytettäville kansioille.
 define("PROJECT_ROOT", dirname(__DIR__) . "/");
 define("HELPERS_DIR", PROJECT_ROOT . "src/helpers/");
 define("TEMPLATE_DIR", PROJECT_ROOT . "src/view/");
 define("MODEL_DIR", PROJECT_ROOT . "src/model/");
 define("CONTROLLER_DIR", PROJECT_ROOT . "src/controller");
?>
