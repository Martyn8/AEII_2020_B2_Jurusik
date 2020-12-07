<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";
	REQUIRE_ONCE "connect.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Ważność</title>
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
        <div class="header">Sprawdzenie ważności karnetu.</div>  
        <div class="info">
          <div class="form">
          <form action="waznosc.php" method="post">
            <label for="pass_number"><h2>Kod karnetu:</h2></label><br>
            <div class="textbox">
            <input type="number" id="pass_number" name="kod_karnetu" placeholder="8-cyfrowy kod" ><br>
            </div>
            <input type="submit" class="button" value="Sprawdź">
          </form> 
        </div>
		<p style="font-size: 23px;">
			<?php
			if(isset($_POST['kod_karnetu']) && strlen($_POST['kod_karnetu'])==8){
				$polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
	
				$kod_weryfikacyjny=$_POST['kod_karnetu'];
				
				$query = $polaczenie->query("SELECT data_aktywacji,data_waznosci FROM karnet WHERE kod_weryfikacyjny_karnetu='$kod_weryfikacyjny';");
				$wiersz = $query->fetch_assoc();
				$data_waznosci = @$wiersz['data_waznosci'];
				$data_aktywacji = @$wiersz['data_aktywacji'];
		if($data_aktywacji!=NULL){
			echo "<br />";
			echo "<br />";
					
			$czas_aktywacji=date('Y-m-d');
			if(strtotime($data_waznosci)>=strtotime($czas_aktywacji)){
					$diff = abs(strtotime($data_waznosci) - strtotime($czas_aktywacji));

					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

			printf("Pozostało: %d miesięcy, %d dni<br />", $months, $days);
			}
			else{
			  $query = $polaczenie->query("UPDATE karnet SET kod_weryfikacyjny_karnetu=NULL WHERE kod_weryfikacyjny_karnetu='$kod_weryfikacyjny' ");
			  echo "<br>";
			  echo "Karnet przeterminowany. ";
			}
					$polaczenie->close();				
					
			}
		}
		?>	</p>
      </div>
    </div>
</div>

</body>
</html>