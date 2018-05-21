<!DOCTYPE html>
<html lang="hr">
  <head>
    <link type="text/css" rel="stylesheet" href="style.css" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

		<meta name="description" content="Vijesti TVZ-a">
		<meta name="keywords" content="vijesti, TVZ">
		<meta name="author" content="Kristijan Zdelarec">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVZ News</title>
  </head>
  <body >
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
      <section id="content" class="content">
        <?php
          $dbc = mysqli_connect('localhost', 'root', '9zwrGst6', 'vijesti') or die('Error connecting to MySQL server.');
          $query = "SELECT * FROM clanci";
          $result = mysqli_query($dbc, $query);
          if(mysqli_num_rows ($result) > 0)
          {
            while($row = mysqli_fetch_array($result)) {
              if($row['isVisible']==1){
                echo '<article>';
                echo'<h1>'.$row['naslov'].'</h1>';
                echo'<img class="floatLeft" src="images/'.$row['slika'].'" alt="img"/>';
                echo'<p class="sazetak">'.$row['sazetak'].'</p>';
                echo'<p>'.$row['vijest'].'</p>';
                echo'<p class="autor">Autor: '.$row['autor'].'<br>Kategorija: '.$row['kategorija'].'</p>';
                echo '</article>';
              }
            }
          }
          else{
            echo '0 results';
          }
          mysqli_close($dbc);
        ?>
      </section>
      <aside id="aside" class="aside">
        <a target="_blank" href="https://en.wi kipedia.org/wiki/Advertising"><img src="images/ad.png" alt="img"/></a>
        <iframe   class="yt"  src="https://www.youtube.com/embed/y6120QOlsfU" allowfullscreen></iframe>
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
      <script type="text/javascript">
        var contentHeight = document.getElementById('content').clientHeight;
        var asideHeight = document.getElementById('aside').clientHeight;
        if(contentHeight<asideHeight){
          document.getElementById("content").style.borderRight="0px";
          document.getElementById("aside").style.borderLeft="3px outset gray";
        }
      </script>
    </section>

    <footer>
      <p>Copyright © 2018 - Kristijan Zdelarec, kzdelarec@tvz.hr</p>
    </footer>
  </body>
</html>
