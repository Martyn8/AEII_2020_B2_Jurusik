<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";
	REQUIRE_ONCE "connect.php";
?>

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
        <div class="header">Wydanie zegarka dla klientów, którzy zakupili bilet przez internet.</div>  
        <div class="info">
          <div class="form">
          <form method="post" action="zegarek.php"> <!-- Form-->
            <label for="pass_number"><h2>Kod weryfikacyjny:</h2></label><br>
            <div class="textbox">
            <input type="number" id="pass_number" name="kod_weryfikacyjny" placeholder="6-cyfrowy kod" ><br>
            </div>
            <input type="submit" class="button" value="Wydaj">
          </form> 
        </div>
 



        <p style="font-size: 23px;">
<?php

if(isset($_POST['kod_weryfikacyjny'])){
  $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);

  $kod_weryfikacyjny=$_POST['kod_weryfikacyjny'];
  if(strlen($kod_weryfikacyjny)==6){

    $query = $polaczenie->query("SELECT id_klienta FROM klient WHERE kod_weryfikacyjny = '$kod_weryfikacyjny';");
    $wiersz = $query->fetch_assoc();
    $id_klienta = $wiersz['id_klienta'];

    $query = $polaczenie->query("SELECT id_biletu FROM bilet WHERE klient_id_klienta=$id_klienta;");
    $id_biletu_array = $query->fetch_all(); // wszysktie bilety
    $id_biletu = @$wiersz['id_biletu'];


    echo "<br />";

    $query = $polaczenie->query("SELECT id_zegarka FROM zegarek WHERE klient_id_klienta IS NULL;");
      $id_zegarka_array = $query->fetch_all();

    echo "<br />";
    $czas_wejscia=date("Y-m-d H:i:s");
    for($i=0; $i<sizeof($id_biletu_array); $i++){	
      $id_biletu=$id_biletu_array[$i][0];
      $id_zegarka=@$id_zegarka_array[$i][0];
      
      if($id_zegarka){
        $query = $polaczenie->query("UPDATE zegarek SET klient_id_klienta='$id_klienta',bilet_id_biletu='$id_biletu',karnet_id_karnetu=NULL,czas_wejscia='$czas_wejscia',czas_wyjscia=NULL WHERE id_zegarka='$id_zegarka';");
        echo "Zegarek ".$id_zegarka." został przydzielony."."<br>";
      }
      else{
        echo "Nie ma wolnego zegarka. <br>";
        exit();
      }
    }
  }
  $polaczenie->close();
}
?>
        </p>
</div>
    </div>
</div>
</body>
</html>