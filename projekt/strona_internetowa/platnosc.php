<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";
	REQUIRE_ONCE "connect.php";
	
	if((!isset($_SESSION['ch_imie']))||(!isset($_SESSION['ch_nazwisko']))||(!isset($_SESSION['ch_email_1']))||(!isset($_SESSION['ch_email_2']))||(!isset($_SESSION['ch_telefon'])))
	{
		header('Location: metoda_platnosci.php'); // Dla przypadku gdyby ktoś wszedł na strone wpisując po url, wtedy wyśle do metoda_platnosci.php
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Transakcja</title>
	<link rel="stylesheet" href="platnosc.css?v=<?php echo time(); ?>" type="text/css"  />
</head>
<body>
	<div class="naglowek_master">Wpisz dane karty</div>	
	<div class="ogolny_master" >
		<div class="dane"> 
			<form class="master" method="post" action="potwierdzenie_zakupu.php">
				<br /> Imię właściciela karty: <br />
				<input type="text" class="pole_master" name="pl_imie" placeholder="Imię"/>
				<?php
				sesja_wypisz('err_pl_imie');
				?>				
				<br /><br />
				Numer karty: <br />
				<input type="text" class="pole_master" name="pl_master" placeholder="np. 1111-1111-1111-1111"/>
				<?php
				sesja_wypisz('err_pl_master');
				?>				
				<br /><br />
				Kod bezpieczeństwa: <br />
				<input type="text" class="short_master" name="pl_trzy_cyfry" placeholder="np. 111"/>
				<?php
				sesja_wypisz('err_pl_trzy_cyfry');
				?>				
				<br /><br />
				Data wygaśnięcia karty: <br />
				<input type="text" class="short_master" name="pl_data" placeholder="np. 01/23"/>
				<?php
				sesja_wypisz('err_pl_data');
				?>					<br /><br />
				<input type="submit"  value="Potwierdź" class="przycisk_master"/> <br /><br />
			</form>	
		</div>	
	</div>
	<button class="powrot" onclick="backButton();">Powrót na stronę główną</button>

	<script>
		function backButton() 
		{
			if (confirm("Twoje zamówienie zosatnie odrzucone! Aby powrócić do transakcji kliknij \"Anuluj\".")) 
			{
				window.location='index.php';
			}
		}
	</script>
</body>
</html>