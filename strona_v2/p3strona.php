<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Płatność</title>
	<link rel="stylesheet" href="p3styl.css">
</head>
<body>
	<div class="naglowek">Proszę podać swoje dane oraz wybrać formę płatności</div>
	<div class="dane"> 
		<div class="lines">Twoje dane: </div>

		Imię: <br>
		<input type="text" class="pole" placeholder="Imię"/> <br /><br />
		Nazwisko: <br />
		<input type="text" class="pole" placeholder="Nazwisko"> <br /><br />
		E-Mail: <br />
		<input type="text" class="pole" placeholder="E-mail"> <br /><br />
		Powtórz E-mail: <br />
		<input type="text" class="pole" placeholder="E-mail"> <br /><br />
		Numer telefonu: <br />
		<input type="text" class="pole" placeholder="Numer telefonu"> <br /><br />
		</form>
	</div>
	<div class="metodyplatnosci"> 
		<div class="lines">Metody platnosci:</div>
		<form>
			<label>
				<input type="radio" name="methods"/>
				<img src="payment_img/paypal.jpg" alt="paypal.jpg" class="images" />
			</label>
			<label>
				<input type="radio" name="methods"/>
				<img src="payment_img/ing.png" alt="paypal.jpg" class="images" />
			</label>
			<label>
				<input type="radio" name="methods"/>
				<img src="payment_img/visa.jpg" alt="paypal.jpg" class="images" />
			</label>
			<label>
				<input type="radio" name="methods"/>
				<img src="payment_img/blik.png" alt="paypal.jpg" class="images" />
			</label>
			<label>
				<input type="radio" name="methods"/>
				<img src="payment_img/bitcash.png" alt="paypal.jpg" class="images" />
			</label>
			<label>
				<input type="radio" name="methods"/>
				<img src="payment_img/mastercard.png" alt="paypal.jpg" class="images" />
			</label>
			<br />
			<label>
				<input type="checkbox" /> Akceptuje regulamin<br /><br />
			</label>
				<input type="submit"  value="Zapłać" class="przycisk"/> <br /><br />
		</form>
	</div>

	<button class="powrot" onclick="backButton();">Powrót na stronę główną</button>

	<script>
		function backButton() 
		{
			if (confirm("Twoje zamówienie zosatnie anulowane! Aby powrócić do transakcji kliknij \"Anuluj\".")) 
			{
				window.location='index.php';
			}
		}
	</script>
	
</body>
</html>