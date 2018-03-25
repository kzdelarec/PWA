<?php
  $naslovClanka = $_POST['naslov'];
  $tekstClanka = $_POST["tekst"];
?>
  <!DOCTYPE html>
  <html lang="hr">
    <head>
      <link type="text/css" rel="stylesheet" href="http://localhost/style.css" />
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  		<meta name="description" content="Vijesti TVZ-a">
  		<meta name="keywords" content="vijesti, TVZ">
  		<meta name="author" content="Kristijan Zdelarec">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
      <title>TVZ News</title>
    </head>
    <body >
      <header class="logo">
        <a href="index.html">
          <img src="images/logo.png" alt="logo">
        </a>
      </header>
      <nav class="floatLeft">
        <ul>
          <li><a class="navLink" href="http://localhost/index.html">Naslovna</a></li>
          <li><a class="navLink" href="http://localhost/onama.html">O nama</a></li>
          <li><a class="navLink" target="_blank" href="https://www.tvz.hr/">Stranica TVZ-a</a></li>
          <li><a class="navLink" href="http://localhost/unos.html">Unos</a></li>
        </ul>
      </nav>

    <section class="wrapper">
      <section class="content">
      <article>
        <?php
          echo '<h1>'.$naslovClanka.'</h1>';
          echo '<p>'.$tekstClanka.'</p>';
        ?>
      </article>
      </section>
      <aside class="aside">
        <a target="_blank" href="https://en.wikipedia.org/wiki/Advertising"><img src="images/ad.png" alt="img"/></a>
        <iframe   width="300" height="200"  src="https://www.youtube.com/embed/y6120QOlsfU" allowfullscreen></iframe>
        <h4 class="asideTitle">Lorem Ipsum</h4>
        <p>Nam arcu felis, feugiat sed purus vel, faucibus facilisis lacus. Vestibulum sagittis, magna sit amet ullamcorper posuere, nisi odio volutpat mauris, semper dictum turpis turpis eu augue. Mauris convallis id ex eu varius. Nulla bibendum fermentum turpis vel elementum. Morbi bibendum erat a risus rutrum congue. Praesent ante purus, bibendum sit amet ex vitae, tristique scelerisque dui. Quisque congue lacus augue, non bibendum purus vulputate ac. Quisque ornare nunc ac quam blandit, vitae lacinia augue sollicitudin.
        </p>
        <h3 class="asideTitle">Best Of Memes</h3>
        <div>
          <img class="floatLeft" src="images/img1.jpg" alt="img"/>
          <img class="floatLeft" src="images/img2.jpg" alt="img"/>
          <img class="floatLeft" src="images/img3.jpg" alt="img"/>
          <img class="floatLeft" src="images/img4.jpg" alt="img"/>
          <img class="floatLeft" src="images/img5.jpg" alt="img"/>
          <img class="floatLeft" src="images/img6.jpg" alt="img"/>
        </div>
      </aside>
    </section>

    <footer>
      <p>Copyright © 2018 - Kristijan Zdelarec, kzdelarec@tvz.hr</p>
    </footer>
  </body>
</html>
