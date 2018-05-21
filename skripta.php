<?php
  $naslovClanka = $_POST['naslov'];
  $tekstClanka = $_POST['tekst'];
  $sazetakClanka = $_POST['sazetak'];
  $autorClanka = $_POST['autor'];
  $kategorijaClanka = $_POST['kategorije'];
  $isVisible = $_POST['isVisible'];
  $isTrueOrFalse;

  $picture = $_FILES['slikaUpload']['name'];
  $uploaddir = 'images/';
  $uploadfile = $uploaddir . basename($_FILES['slikaUpload']['name']);

  if (move_uploaded_file($_FILES['slikaUpload']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
  } else {
     echo "Upload failed";
  }

?>
<!DOCTYPE html>
<html lang="hr">
<header class="logo">
  <a href="index.php">
    <img src="images/logo.png" alt="logo">
  </a>
</header>
<nav class="floatLeft">
  <ul>
    <li><a class="navLink" href="index.php">Naslovna</a></li>
    <li><a class="navLink" href="onama.html">O nama</a></li>
    <li><a class="navLink" target="_blank" href="https://www.tvz.hr/">Stranica TVZ-a</a></li>
    <li><a class="navLink" href="unos.html">Unos</a></li>
    <li><a class="navLink" href="login.html">Administracija</a></li>
    <li><a class="navLink" href="login.html">Prijavi se</a></li>
    <li><a class="navLink" href="registracija.html">Registriraj se</a></li>
  </ul>
</nav>

    <section class="wrapper">
      <section class="content">
        <article>
          <?php
          echo '<h1>'.$naslovClanka.'</h1>';
          echo '<p class="sazetak">'.$sazetakClanka.'</p>';
          echo '<br><p>'.$tekstClanka.'</p>';
          echo '<p class="autor">Autor: '.$autorClanka.'<br>Kategorija: '.$kategorijaClanka.'</p>';
          if ($isVisible) {
            echo "<p>Članak nije vidljiv</p>";
            $isTrueOrFalse = 0;
          }
          else {
            echo "<p>Članak je vidljiv</p>";
            $isTrueOrFalse = 1;
          }
          $dbc = mysqli_connect('localhost', 'root', '9zwrGst6', 'vijesti') or die('Error connecting to MySQL server.');
          $query = "INSERT INTO clanci (naslov, sazetak, vijest, autor, kategorija, isVisible, slika)
          VALUES ('$naslovClanka', '$sazetakClanka', '$tekstClanka', '$autorClanka', '$kategorijaClanka', '$isTrueOrFalse', '$picture')";
          if (mysqli_query($dbc, $query)) {
              echo "Članak dodan u bazu";
          } else {
              echo "Error: " . $query . "<br>" . mysqli_error($dbc);
          }
          mysqli_close($dbc);
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
          <a href="images/img1.jpg"><img class="floatLeft" src="images/img1.jpg" alt="img"/></a>
          <a href="images/img2.jpg"><img class="floatLeft" src="images/img2.jpg" alt="img"/></a>
          <a href="images/img3.jpg"><img class="floatLeft" src="images/img3.jpg" alt="img"/></a>
          <a href="images/img4.jpg"><img class="floatLeft" src="images/img4.jpg" alt="img"/></a>
          <a href="images/img5.jpg"><img class="floatLeft" src="images/img5.jpg" alt="img"/></a>
          <a href="images/img6.jpg"><img class="floatLeft" src="images/img6.jpg" alt="img"/></a>
        </div>
      </aside>
    </section>

    <footer>
      <p>Copyright © 2018 - Kristijan Zdelarec, kzdelarec@tvz.hr</p>
    </footer>
  </body>
</html>
