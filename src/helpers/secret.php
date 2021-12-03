<?php

//Generoidaan vahvistusavain.
 function generateActivationCode($text='') {
    return hash('sha1', $text . rand());
 }

?>
