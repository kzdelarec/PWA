<?php
    session_start();
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

      $query = 'UPDATE clanci SET isVisible = '.$promjena.' WHERE id = '.$idClanka;
      if (mysqli_query($dbc, $query)) {
          echo "<script type='text/javascript'>alert('Promjena uspješno spremljena');</script>";
      } else {
          echo "Error: " . $query . "<br>" . mysqli_error($dbc);
      }
    }
    if (isset($_POST["obrisi"])) {

      $idClanka = $_POST['id'];
      $query = 'DELETE FROM clanci WHERE id = '.$idClanka;
      if (mysqli_query($dbc, $query)) {
        echo "<script type='text/javascript'>alert('$idClanka. članak uspješno obrisan');</script>";
      } else {
          echo "Error: " . $query . "<br>" . mysqli_error($dbc);
      }
    }

    if (isset($_POST["uredi"])) {

      $idClanka = $_POST['id'];
      session_start();
      $_SESSION['idClanka'] = $idClanka;
      header("Location: http://localhost/uredivanje.php");
      die();

    }
 ?>

<!DOCTYPE html>
<html lang="hr">
  <head>
    <link type="text/css" rel="stylesheet" href="http://localhost/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <section>
        <?php
          $user = $_POST['uname'];
          $pass = md5($_POST['psw']);
          $razina;
          $sql="SELECT username, pass, razina FROM users WHERE username=? AND pass=?";
          $stmt=mysqli_stmt_init($dbc);
          if (mysqli_stmt_prepare($stmt, $sql)){
            /* Povezuje parametre i njihove tipove s statement objektom */
            mysqli_stmt_bind_param($stmt,'ss',$user,$pass);
            /* Izvršava pripremljeni upit i pohranjuje rezultate */
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
          }
          /* Povezuje atribute iz rezultata s varijablama */
          mysqli_stmt_bind_result($stmt, $user, $pass, $razina);
          mysqli_stmt_fetch($stmt);
          if (mysqli_stmt_num_rows($stmt)>0 and $razina == 3){
            $_SESSION['username'] = $row['username'];
            print '<table style="width:100%; border-spacing: 15px;">
            <tr>
              <th>Id</th>
              <th>Naslov</th>
              <th>Autor</th>
              <th>Kategorija</th>
              <th>Vidljivost</th>
            </tr>';
            $query = "SELECT * FROM clanci";
            $result = mysqli_query($dbc, $query);
            if(mysqli_num_rows ($result) > 0)
            {
              while($row = mysqli_fetch_array($result)) {
                echo '<form name="form'.$row['id'].'" action="http:////localhost//administracija.php" method="post">';
                echo '<tr><td>'.$row['id'].'<input type="hidden" name="id" value="'.$row['id'].'"></td>';
                echo '<td>'.$row['naslov'].'</td>';
                echo '<td>'.$row['autor'].'</td>';
                echo '<td>'.$row['kategorija'].'</td>';
                if($row['isVisible']==0){
                  $checked = "checked";
                }
                elseif($row['isVisible']==1){
                  $checked = "";
                }
                echo '<td><label><input type="checkbox" name="isVisible"'.$checked.'>Sakrij vijest</label></td>';
                echo '<td><input style="padding:2px;" type="submit" name="uredi" id="uredi" value="Uredi"></td>';
                echo '<td><button type="submit" style="padding 2px;" name="spremi"><i class="fa fa-floppy-o" style="font-size:16px"></i></i></button></td>';
                echo '<td><button type="submit" id="obrisiBtn'.$row['id'].'" style="padding 2px;" name="obrisi"><i class="fa fa-trash-o" style="font-size:16px;color:red"></i></button></td>';
                echo '<script type="text/javascript">
                  document.getElementById("obrisiBtn'.$row['id'].'").onclick=function(e){
                  var a=confirm("Jeste li sigurni da zelite obrisati vijest br. '.$row['id'].'?");
                  if (!a) e.preventDefault();
                  }
                  </script>';
                echo '</form>';
              }
            }
            else{
              echo '0 results';
              echo '<tr><td>null</td>';
              echo '<td>null</td>';
              echo '<td>null</td>';
              echo '<td>null</td>';
            }
          } elseif(mysqli_stmt_num_rows($stmt)>0 and $razina != 3){
            echo '<p align="center"><span style="color:red">'.$user.'</span>, nemate dovoljna prava za pristup ovoj stranici.<br>
            Ako smatrate da imate ovlasti za pristupanje stranici, obratit se administratoru sustava!</p>';
          }
          else{
            echo "<p align='center'>Kako biste pristupili sadržaju, molimo Vas da se registrirate<p><br>";
            print '<section id="content" class="">
              <form  class="loginForm" action="registracija.php" method="post" class="">

                  <label for="imeIprezime"><b>Ime i prezime</b></label>
                  <input type="text" name="imeIprezime" required>
                  <br>
                  <label for="uname"><b>Korisničko ime</b></label>
                  <input type="text" name="uname" required>
                  <br>
                  <label for="psw"><b>Lozinka</b></label>
                  <input type="password" name="psw" id="prva" required>
                  <br>
                  <label for="psw"><b>Ponovite lozinku</b></label>
                  <input type="password" name="psw1" id="druga" required>
                  <br>
                  <button type="submit" id="registriranje">Registriraj se</button>
                  <button type="button" class="cancelbtn">Cancel</button>
              </form>
              <script type="text/javascript">
                    document.getElementById("registriranje").onclick=function(e){

                        var slanje=true;

                        var pass1=document.getElementById("prva").value;
                        var pass2=document.getElementById("druga").value;

                        if(pass1 != pass2){
                          slanje = false;
                          document.getElementById("prva").style.border="2px solid red";
                          document.getElementById("druga").style.border="2px solid red";
                          document.getElementById("druga").value = "";
                          document.getElementById("prva").value = "";
                        }

                        if (!slanje){
                          alert("Lozinke se razlikuju");
                           e.preventDefault();
                        }
                    }
                </script>
            </section>';
          }

          mysqli_close($dbc);
        ?>

        </script>
      </table>
      </section>
      <!--<aside class="aside">
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
      </aside>-->
    </section>

    <!--<footer>
      <p>Copyright © 2018 - Kristijan Zdelarec, kzdelarec@tvz.hr</p>
    </footer>-->
  </body>

</html>
