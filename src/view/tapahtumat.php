
<?php $this->layout('template', ['title' => 'Tulevat tapahtumat']) ?>

<h1 class='etusivu'>Westie Rescuen tulevat tapahtumat</h1>

<div class='tapahtumat'>
<?php

foreach ($tapahtumat as $tapahtuma) {

  $start = new DateTime($tapahtuma['tap_alkaa']);
  $end = new DateTime($tapahtuma['tap_loppuu']);

  echo "<div>";
   echo "<div>$tapahtuma[nimi]</div>";
   echo "<div>" . $start->format('j.n.Y'). "</div>";
   echo "<div><a href='tapahtuma?id=" . $tapahtuma['idtapahtuma'] . "'>LUE LISÄÄ</a></div>";
  echo "</div>";

}

?>
</div>
