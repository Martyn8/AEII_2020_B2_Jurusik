<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Karnety</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Klient lokalny</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-money-check-alt"></i>Sprzedaż biletów i karnetów</a></li>
            <li><a href="waznosc.php"><i class="fas fa-key"></i>Sprawdź ważność karnetu</a></li>
          </ul> 
          <h2 class="pls_down">Klient internetowy</h2>
        <ul> 
            <li><a href="zegarek.php"><i class="fas fa-stopwatch"></i>Wydanie zegarka</a></li>
            <li><a href="karnet_int.php"><i class="fas fa-hand-holding"></i>Wydanie karnetu</a></li>
        </ul> 
        <h2 class="pls_down">Rozliczenie</h2>
        <ul> 
        <li><a href="symulacja.php"><i class="fas fa-clock"></i>Symulacja czasu pobytu</a></li>
        <li><a href="rozliczenie.php"><i class="fas fa-hand-holding-usd"></i>Rozliczenie klienta</a></li>
        </ul> 
        <h2 class="pls_down">Wylogowanie</h2>
<ul>
<li><a href="wyloguj.php"><i class="fas fa-sign-out-alt"></i>Wyloguj</a></li>
</ul>
    </div>
    <div class="main_content">
        <div class="header">Symulacje pobytu klienta - zegarka w placówce.</div>  
        <div class="info">
          <div class="form">
          <form method="post" action="symulacja.php"> <!-- Form-->
            <label for="watch_number"><h2>Numer zegarka:</h2></label><br>
            <div class="textbox">
            <input type="number" id="watch_number" name="id_zegarka" placeholder="Numer zegarka" ><br>
            </div>
            <h2>Korzystanie z atrakcji:</h2><br>
            <input type="checkbox" name="atrakcja[]" value="Sauna fińska" style="margin-left: 15px;"> Sauna fińska<br>
            <input type="checkbox" name="atrakcja[]" value="Sauna ziołowa" style="margin-left: 15px;"> Sauna ziołowa<br>
            <input type="checkbox" name="atrakcja[]" value="Sauna parowa" style="margin-left: 15px;"> Sauna parowa<br>
            <input type="checkbox" name="atrakcja[]" value="Sauna na podczerwień" style="margin-left: 15px;"> Sauna na podczerwień<br>
            <input type="checkbox" name="atrakcja[]" value="Biosauna" style="margin-left: 15px;"> Biosauna<br>

            <input type="submit" class="button" value="Symuluj">
          </form> 
        </div>

        <?php
        session_start();
        REQUIRE_ONCE "funkcje.php";
        
        REQUIRE_ONCE "connect.php";

        $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);


        if(isset($_POST['id_zegarka'])){
          $id_zegarka = $_POST['id_zegarka'];
          // echo $id_zegarka."<br>";
          $atrakcja_array = @$_POST['atrakcja'];
          if(@sizeof($atrakcja_array)!=0){
            for($i=0; $i < sizeof($atrakcja_array); $i++)
            {
              $atrakcja_pom = $atrakcja_array[$i];
              $query = $polaczenie->query("SELECT id_cennika FROM cennik WHERE typ='Atrakcja' AND rodzaj='$atrakcja_pom';");
              $wiersz = $query->fetch_assoc();
              $id_cennika = $wiersz['id_cennika'];
              $polaczenie->query("INSERT INTO atrakcja values(NULL,'Atrakcja','$atrakcja_pom','$id_zegarka','$id_cennika','$atrakcja_pom');");
            }
          }
        }
        ?>
      </div>
    </div>
</div>

</body>
</html>