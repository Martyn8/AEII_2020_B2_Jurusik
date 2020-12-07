<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";
  	REQUIRE_ONCE "connect.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Rozliczenie</title>
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
        <div class="header">Rozliczenie klienta na podstawie numeru zegarka i danych zawartych w bazie o jego pobycie w placówce.</div>  
        <div class="info">
          <div class="form">
          <form method="post" action="rozliczenie.php"> <!-- Form-->
            <label for="watch_number"><h2>Numer zegarka:</h2></label><br>
            <div class="textbox">
            <input type="number" id="watch_number" name="zegarek" placeholder="Numer zegarka" ><br>
            </div>
            <label for="visit_time"><h2>Czas pobytu w minutach:</h2></label><br>
            <div class="textbox">
            <input type="number" id="visit_time" name="ile_minut" placeholder="Czas pobytu" ><br>
            </div>
			
			<h2>Rodzaj płatności:</h2>
          <div class="textbox">

              <select name="rodzaj_platnosci" style=" background: none;border:none; outline:none;font-size: 18px; color:gray;">
                <option value="Gotówka">Gotówka</option>
                <option value="Karta">Karta</option>
                <option value="Blik">Blik</option>
              </select>
          </div>
            <input type="submit" class="button" value="Rozlicz">
          </form> 
        </div>
      

		<p style="font-size: 23px;">
<?php
  if(isset($_POST['zegarek']) && isset($_POST['ile_minut'])){
    
    if($_POST['zegarek']!=NULL && $_POST['ile_minut']){
		echo "<br>";
		$polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
		$id_zegarka=$_POST['zegarek'];
		$ile_minut=$_POST['ile_minut'];
		$rodzaj_platnosci=$_POST['rodzaj_platnosci'];

		$query = $polaczenie->query("SELECT klient_id_klienta, bilet_id_biletu,karnet_id_karnetu,czas_wejscia FROM zegarek WHERE `id_zegarka`='$id_zegarka';");
		$wiersz = $query->fetch_assoc();
		$wejscie = $wiersz['czas_wejscia'];
		$id_klienta=$wiersz['klient_id_klienta'];
		$bilet = $wiersz['bilet_id_biletu'];
		$karnet = $wiersz['karnet_id_karnetu'];
		if($id_klienta!=NULL){
			if($bilet!=NULL){
				$query = $polaczenie->query("SELECT bilet.czas FROM bilet,zegarek WHERE zegarek.id_zegarka='$id_zegarka' AND zegarek.bilet_id_biletu=bilet.id_biletu");
				$wiersz = $query->fetch_assoc();
				$czas_biletu = $wiersz['czas'];
				
				$czas_wyjscia = dodaj_czas_do_biletu($wejscie, $ile_minut);


				$query = $polaczenie->query("UPDATE zegarek SET czas_wyjscia='$czas_wyjscia' WHERE id_zegarka='$id_zegarka';");

				// kod do sprawdzenia doplaty czas do zapłaty
				$query = $polaczenie->query("SELECT czas_wejscia, czas_wyjscia FROM zegarek WHERE id_zegarka='$id_zegarka';");
				$wiersz = $query->fetch_assoc();
				$wejscie = $wiersz['czas_wejscia'];
				$wyjscie = $wiersz['czas_wyjscia'];
				
				$query = $polaczenie->query("SELECT cena FROM cennik WHERE typ='Kara' AND rodzaj = 'Przedłużenie pobytu';");
				$wiersz = $query->fetch_assoc();
				$cena_za_minute= $wiersz['cena'];

				$minuty_spoznienia=czy_spoznienie_na_wyjsciu_z_basenu($wyjscie, $wejscie, $czas_biletu);
				
				// $zaplata = $minuty_spoznienia*$cena_za_minute;
				// echo "<br>"."Do zapłaty: ".$zaplata." zł";
			}
			else{//dla karnetu
				$czas_wyjscia = dodaj_czas_do_biletu($wejscie, $ile_minut);
				$query = $polaczenie->query("UPDATE zegarek SET czas_wyjscia='$czas_wyjscia' WHERE id_zegarka='$id_zegarka';");
				
				$query = $polaczenie->query("SELECT czas_wejscia,czas_wyjscia FROM zegarek WHERE id_zegarka='$id_zegarka';");
				$wiersz = $query->fetch_assoc();
				$wejscie = $wiersz['czas_wejscia'];
				$wyjscie = $wiersz['czas_wyjscia'];
				
				
				
				$query = $polaczenie->query("SELECT cena FROM cennik WHERE typ='Kara' AND rodzaj = 'Przedłużenie pobytu';");
				$wiersz = $query->fetch_assoc();
				$cena_za_minute= $wiersz['cena'];

				$minuty_spoznienia=czy_spoznienie_na_wyjsciu_z_basenu($wyjscie, $wejscie, 3);
				
				
			}

			$query = $polaczenie->query("SELECT cennik_id_cennika FROM atrakcja WHERE zegarek_id_zegarka = '$id_zegarka';");
			$atrakcje_na_zegarku = $query->fetch_all();
			// print_r($atrakcje_na_zegarku);
			$suma_za_atrakcje=0;
			if(sizeof($atrakcje_na_zegarku)!=0){
				for($i=0;$i<sizeof($atrakcje_na_zegarku);$i++){
					$atrakcje_pom=$atrakcje_na_zegarku[$i][0];
					// print_r($atrakcje_pom);
					// echo "<br>";
					$query = $polaczenie->query("SELECT cena FROM cennik WHERE id_cennika='$atrakcje_pom'");
					$wiersz = $query->fetch_assoc();
					$cena= $wiersz['cena'];
					$suma_za_atrakcje += $cena;
				}
			}
			// echo $suma_za_atrakcje;
			$zaplata = $minuty_spoznienia*$cena_za_minute;
			echo "Spóźnienie o ".$minuty_spoznienia." do dopłaty ".$zaplata." zł<br>";
			echo "Dopłata za atrakcje: ".$suma_za_atrakcje." zł<br>";
			$zaplata+=$suma_za_atrakcje;
			// dodanie ceny z petli atrakcji
			echo "<br>"."Do zapłaty: ".$zaplata." zł<br>";
			//czyszczenie zegarka w bazie
			$query = $polaczenie->query("UPDATE zegarek SET klient_id_klienta=NULL,bilet_id_biletu=NULL,karnet_id_karnetu=NULL,czas_wejscia=NULL,czas_wyjscia=NULL WHERE id_zegarka='$id_zegarka';");
			echo "Zegarek ".$id_zegarka." został przywrócony do puli zegarków.<br>";
			$query = $polaczenie->query("DELETE FROM atrakcja WHERE zegarek_id_zegarka='$id_zegarka';"); //usuwanie zegarka dla atrakcji
				
			if($zaplata>0){
				$query = $polaczenie->query("INSERT INTO doplata VALUES(NULL,'$zaplata','$rodzaj_platnosci');"); //usuwanie zegarka dla atrakcji
			}
			$polaczenie->close();
		}
	}
}
?></p>
        </div>
    </div>
</div>

</body>
</html>