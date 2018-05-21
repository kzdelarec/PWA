<?php
  session_start();
  $idClanka = $_SESSION['idClanka'];
  $naslovClanka = $_POST['naslov'];
  $tekstClanka = $_POST['tekst'];
  $sazetakClanka = $_POST['sazetak'];
  $autorClanka = $_POST['autor'];
  $kategorijaClanka = $_POST['kategorije'];
  $idClanka2 = $_POST['id'];

  //spajanje na bazu podataka
  $dbc = mysqli_connect('localhost', 'root', '9zwrGst6', 'vijesti') or die('Error connecting to MySQL server.');

  //provjerava je li stisnut 'spremi' gumb i ako je, updatea bazu
  if (isset($_POST["spremi"])) {

    if($_POST['isVisible']){
      $promjena = 0;
    }
    else{
      $promjena = 1;
    }
    $idClanka = $_POST['id'];
    $query = ("UPDATE clanci SET naslov = '$naslovClanka', sazetak = '$sazetakClanka', vijest = '$tekstClanka',
       autor = '$autorClanka', kategorija = '$kategorijaClanka', isVisible = '$promjena' WHERE id = $idClanka2");
    if (mysqli_query($dbc, $query)) {
        echo "<script type='text/javascript'>alert('Promjena uspješno spremljena');</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbc);
    }
  }
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
        <?php
          $dbc = mysqli_connect('localhost', 'root', '9zwrGst6', 'vijesti') or die('Error connecting to MySQL server.');
          $query = "SELECT * FROM clanci WHERE id = ".$idClanka;
          $result = mysqli_query($dbc, $query);
          if(mysqli_num_rows ($result) > 0)
          {
            while($row = mysqli_fetch_array($result)) {
                echo '<form name="formaZaUnos" enctype="multipart/form-data" action="" method="POST"><br>';
                echo '<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />';
                echo '<input type="hidden" name="id" value="'.$row['id'].'">';
                echo'<input id="naslov" type="text" name="naslov" style="width: 100%; padding-top: 5px; padding-bottom: 5px;" value="'.$row['naslov'].'" />';
                echo '<br>
                <label id="naslovPoruka"></label>';
                echo'<br>Kratki sadržaj:<br>';
                echo'<textarea id="sazetak" name="sazetak" rows="10" style="width: 100%;">'.$row['sazetak'].'</textarea>';
                echo'<br>
                <label id="sadrzajPoruka"></label>';
                echo'<br>Tekst:<br>';
                echo '<textarea id="tekst" name="tekst" rows="20" style="width: 100%;">'.$row['vijest'].'</textarea>';
                echo '<br>
                <label id="tekstPoruka"></label>';
                echo '<br><label for="autor">Autor: </label><br>';
                echo '<input id="autor" type="text" name="autor" style="width: 100%; padding-top: 5px; padding-bottom: 5px;" value ="'.$row['autor'].'"/>';
                echo '<br>
                  <select name="kategorije" style="padding-top: 5px; padding-bottom: 5px;">
                  <option value="Računarstvo"';
                if($row['kategorija']=='Računarstvo'){echo'selected="selected"';}
                echo '>Računarstvo</option>
                  <option value="Gadgeti"';
                if($row['kategorija']=='Gadgeti'){echo'selected="selected"';}
                echo '>Gadgeti</option>
                  <option value="Trendovi"';
                if($row['kategorija']=='Trendovi'){echo'selected="selected"';}
                echo '>Trendovi</option>
                </select>';
                if($row['isVisible']==0){
                  $checked = "checked";
                }
                elseif($row['isVisible']==1){
                  $checked = "";
                }
                echo '<label><input type="checkbox" name="isVisible"'.$checked.'>Sakrij vijest</label>';
                echo '<br>
                  <input type="submit" value="Spremi" name ="spremi">
                  </form>';
                echo '</article>';
              }
          }
          else{
            echo '0 results';
          }
         ?>
      </section>
      <aside class="aside">
        <a target="_blank" href="https://en.wikipedia.org/wiki/Advertising"><img src="images/ad.png" alt="img"/></a>
        <iframe class="yt"  src="https://www.youtube.com/embed/y6120QOlsfU" allowfullscreen></iframe>
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
