<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Płatność</title>
	<link rel="stylesheet" href="metoda_platnosci_style.css" type="text/css"  />
</head>
<body>
	<div class="naglowek">Płatność</div>
		<div class="ogolny">		
			<div class="dane"> 
				<div class="lines">Twoje dane:</div>
				<form method="post" action="platnosc_walidacja.php">
				Imię: <br />
				<input type="text" class="pole" value="<?php sesja_wypisz('ch_imie'); ?>" name="imie" placeholder="Imię"/>
					<?php
					sesja_wypisz('err_imie');
					?>
				<br /><br />
				Nazwisko: <br />
				<input type="text" class="pole" value="<?php sesja_wypisz('ch_nazwisko'); ?>" name="nazwisko" placeholder="Nazwisko"/>
					<?php
					sesja_wypisz('err_nazwisko');
					?>
				<br /><br />
				Adres e-mail: <br />
				<input type="text" class="pole" value="<?php sesja_wypisz('ch_email_1'); ?>" name="email_1" placeholder="E-mail"/>
					<?php
					sesja_wypisz('err_email_1');
					?>
				<br /><br />
				Powtórz adres e-mail: <br />
				<input type="text" class="pole" value="<?php sesja_wypisz('ch_email_2'); ?>" name="email_2" placeholder="E-mail"/>
					<?php
					sesja_wypisz('err_email_2');
					?>
				<br /><br />
				Numer telefonu: <br />
				<input type="text" class="pole" value="<?php sesja_wypisz('ch_telefon'); ?>" name="telefon" placeholder="Numer Telefonu"/>
					<?php
					sesja_wypisz('err_telefon');
					?>
				<br /><br />
			</div>
			<div class="metodyplatnosci"> 
				<div class="lines">Metody płatności:</div>
				<label>
				<input type="radio" name="methods" value="1"/>
				<img src="img/paypal.jpg" alt="paypal.jpg" class="images" />
				</label>
				<label>
				<input type="radio" name="methods" value="2"/>
				<img src="img/ing.png" alt="paypal.jpg" class="images" />
				</label>
				<label>
				<input type="radio" name="methods" value="3"/>
				<img src="img/visa.jpg" alt="paypal.jpg" class="images" />
				</label>
				<label>
				<input type="radio" name="methods" value="4"/>
				<img src="img/blik.png" alt="paypal.jpg" class="images" />
				</label>
				<label>
				<input type="radio" name="methods" value="5"/>
				<img src="img/bitcash.png" alt="paypal.jpg" class="images" />
				</label>
				<label>
				<input type="radio" name="methods" value="6"/>
				<img src="img/mastercard.png" alt="paypal.jpg" class="images" />
				</label>
					<?php
					sesja_wypisz('err_methods');
					?>
				<br />
				<label>
				<br>
				<input type="checkbox" name="regulamin" class="regulamin"/> Akceptuję regulamin <br />
					<?php
					sesja_wypisz('err_regulamin');
					?>
				<br />
				</label>
				<input type="submit"  value="Zapłać" class="przycisk"/> <br /><br />
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