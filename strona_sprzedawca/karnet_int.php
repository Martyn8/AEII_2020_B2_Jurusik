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
            <li><a href="karnet_lokal.php"><i class="fas fa-hand-holding"></i>Wydanie zegarka</a></li>
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
    </div>
    <div class="main_content">
        <div class="header">Wydanie karnetu dla klienta internetowego na podstawie uzyskanego po zakupie kodu weryfikacyjnego.</div>  
        <div class="info">
          <div class="form">
          <form action="#"> <!-- Form-->
            <label for="ver_number"><h2>Kod weryfikacyjny:</h2></label><br>
            <div class="textbox">
            <input type="number" id="ver_number" name="ver_number" placeholder="6-cyfrowy kod" ><br>
            </div>
            <input type="submit" class="button" value="Wydaj">
          </form> 
        </div>
      </div>
    </div>
</div>

</body>
</html>