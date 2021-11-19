<!DOCTYPE html>
<html lang="fi">
  <head>
   <title>rescueme - <?=$this->e($title)?></title>
   <meta charset="UTF-8">
   <link href="styles/styles.css" rel="stylesheet">
  </head>
  <body>
   <header>
    <h1><a href="<?=BASEURL?>">Rescue me</a> </h1>
   </header>
   <section>
    <?=$this->section('content')?>
  </section>
  <footer>
   <hr>
   <div>rescue me</div>
  </footer>
 </body>
</html>
