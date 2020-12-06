<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Sprzedaż</title>
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
        <div class="header">Sprzedaż biletów i karnetów klientowi lokalnemu.</div>  
        <div class="info">
          <?php
	session_start();
?>
<!doctype html>
<html lang="pl">

  <head>
    <meta charset="UTF-8">
    <title>Panel sprzedaży</title>
    <link rel="stylesheet" href="seller_style.css" type="text/css" />
  </head>

  <script>
    <?php
      function getPrice($connection, $s1, $s2, $s3)
      {
        $query = $connection->query("SELECT cena FROM cennik WHERE typ='$s1' AND rodzaj='$s2' AND czas='$s3';");
        $result = mysqli_fetch_assoc($query);
        $resultstring = $result['cena'];
        echo $resultstring;
      }
    ?>

    function populate1(s1,s2)
    {
      var s1 = document.getElementById(s1);
      var s2 = document.getElementById(s2);
      s2.innerHTML = "";
      if(s1.value == "Wybierz rodzaj")
      {
        var optionArray = ["Wybierz typ|Wybierz typ"];
      } 
      else if(s1.value == "Bilet" || s1.value == "Karnet")
      {
        var optionArray = ["Wybierz typ|Wybierz typ","Normalny|Normalny","Ulgowy|Ulgowy"];
      } 

      for(var option in optionArray)
      {
        var pair = optionArray[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        s2.options.add(newOption);
      }
    }

    function populate2(s1,s3)
    {
      var s1 = document.getElementById(s1);
      var s3 = document.getElementById(s3);
      s3.innerHTML = "";
      if(s1.value == "Wybierz rodzaj")
      {
        var optionArray = ["Wybierz czas|Wybierz czas"];
      } 
      else if(s1.value == "Karnet")
      {
        var optionArray = ["Wybierz czas|Wybierz czas","Tygodniowy|Tygodniowy","Miesięczny|Miesięczny"];
      } 
      else if(s1.value == "Bilet")
      {
        var optionArray = ["Wybierz czas|Wybierz czas","1h|1h","3h|3h","5h|5h","12h|12h"];
      }

      for(var option in optionArray)
      {
        var pair = optionArray[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        s3.options.add(newOption);
      }
    }

    function displayPrice(s1,s2,s3)
    {
      <?php
        REQUIRE_ONCE "connect.php";
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
      ?>  
      var s1 = document.getElementById(s1);
      var s2 = document.getElementById(s2);
      var s3 = document.getElementById(s3);
      var price = "";
      if(s1.value == "Bilet")
      { 
        document.cookie = "s1.value";
        if(s2.value == "Ulgowy")
        {
          if(s3.value == "1h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Ulgowy';
                        $s3 = '1';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "3h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Ulgowy';
                        $s3 = '3';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "5h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Ulgowy';
                        $s3 = '5';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "12h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Ulgowy';
                        $s3 = '12';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
        }
        else if(s2.value == "Normalny")
        {
          if(s3.value == "1h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Normalny';
                        $s3 = '1';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "3h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Normalny';
                        $s3 = '3';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "5h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Normalny';
                        $s3 = '5';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "12h")
          {
            price =  "<?php
                        $s1 = 'Bilet';
                        $s2 = 'Normalny';
                        $s3 = '12';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
        }
      }
      else if(s1.value == "Karnet")
      {
        if(s2.value == "Ulgowy")
        {
          if(s3.value == "Tygodniowy")
          {
            price =  "<?php
                        $s1 = 'Karnet';
                        $s2 = 'Ulgowy';
                        $s3 = 'tygodniowy';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "Miesięczny")
          {
            price =  "<?php
                        $s1 = 'Karnet';
                        $s2 = 'Ulgowy';
                        $s3 = 'miesięczny';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
        }
        else if(s2.value == "Normalny")
        {
          if(s3.value == "Tygodniowy")
          {
            price =  "<?php
                        $s1 = 'Karnet';
                        $s2 = 'Normalny';
                        $s3 = 'tygodniowy';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
          else if(s3.value == "Miesięczny")
          {
            price =  "<?php
                        $s1 = 'Karnet';
                        $s2 = 'Normalny';
                        $s3 = 'miesięczny';
                        getPrice($connection, $s1, $s2, $s3);
                      ?>" + " zł";
          }
        }
      }
      document.getElementById("textValue").innerHTML = price;
      <?php
        $connection->close();
      ?>
    }

    function addToSummary(s1,s2,s3,chosenPrice)
    {
      var s1 = document.getElementById(s1);
      var s2 = document.getElementById(s2);
      var s3 = document.getElementById(s3);
      var p = document.getElementById("chosenPrice").rows[1].cells[0].innerHTML;
      if(p != 0)
      {
        var sum = parseInt(p, 10);
        document.getElementById("toPay").innerHTML += sum;
        var elem = "- " + s1.value + " " + s2.value + " " + s3.value;
        var table = document.getElementById("chosenElements");
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = elem;
        cell2.innerHTML = p;
        var btn = document.createElement("BUTTON");
        btn.innerHTML = "usuń";
        btn.onclick = function() {deleteButton(this); sumPrices()};
        btn.style.backgroundColor = 'orangered';
        btn.style.border = '2px solid black';
        btn.style.borderRadius = '4px';
        cell3.appendChild(btn);
      }
    }

    function deleteButton(r)
    {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("chosenElements").deleteRow(i);
    }

    function sumPrices(paymentMethod)
    {
      var table = document.getElementById("chosenElements");
      var sum = 0;    
      for(var i = 0; i < chosenElements.rows.length; i++)
      {
        sum = sum + parseInt(chosenElements.rows[i].cells[1].innerHTML);
      }  
      if(sum == 0)
      {
        document.getElementById("toPay").innerHTML = "";
      }
      else
      {
        document.getElementById("toPay").innerHTML = sum + " zł";
        document.getElementById("toPaySelect").innerHTML = sum;
      }
      buttonEnable();
    }

    function buttonEnable()
    {
      var f = document.getElementById("paymentMethod");
      var s = document.getElementById("sum").rows[1].cells[0].innerHTML;
      if(f.value != "Wybierz formę płatności" && s != 0)
      {
        document.getElementById("transaction").disabled = false;
      }
      else
      {
        document.getElementById("transaction").disabled = true;
      }
    }

    function makeTransaction()
    {
      var table = document.getElementById("chosenElements");
      var all = "";    
      for(var i = 0; i < chosenElements.rows.length; i++)
      {
        var row = chosenElements.rows[i].cells[0].innerHTML;
        row = row.substring(2);
        all = all + ";" + row;
      }
      document.getElementById("allChosen").innerHTML = all;
    }
  </script>
  
  <body>

    <form method="post" action="transaction.php">

      <div id="main"> 
        <h2>Wybierz rodzaj, typ oraz czas przepustki:</h2>
        <select id="s1" name="s1" onchange="populate1(this.id,'s2'); populate2(this.id,'s3'); displayPrice(this.id,'s2','s3')">
         <option value="Wybierz rodzaj">Wybierz rodzaj</option>
          <option value="Bilet">Bilet</option>
          <option value="Karnet">Karnet</option>
        </select>
        
        <select id="s2" name="s2" onchange="displayPrice('s1',this.id,'s3')">
          <option vaule="Wybierz typ">Wybierz typ</option>
        </select>

        <select id="s3" name="s3" onchange="displayPrice('s1','s2',this.id)">
          <option vaule="Wybierz czas">Wybierz czas</option>
        </select>
        
       
        <table id=chosenPrice>
          <tr>
            <th>Cena wybranego:</th>
          </tr>
          <tr>
            <th id="textValue"></th>
          </tr>
          <tr>
            <th colspan="2"><button id=add type="button" onclick="addToSummary('s1','s2','s3','textValue'); sumPrices('paymentMethod');">Dodaj +</button></th>
          </tr>
        </table>
     
      
        <div>
          <h2>Wybierz fromę płatności:</h2>
          <select id=paymentMethod onchange="buttonEnable()">
            <option>Wybierz formę płatności</option>
            <option>Gotówka</option>
            <option>Karta płatnicza</option>
            <option>Blik</option>
          </select>
        
          <table id=sum>
            <tr>
              <th style="text-align: left;">Suma do zapłaty:</th>
            </tr>
            <tr>
              <th id=toPay></th>
              <select hidden id=hiddenPrice name="hiddenPrice">
                <option id=toPaySelect name="toPaySelect"></option>
              </select> 
            </tr>
            <tr>
              <select hidden id=hiddenList name="hiddenList">
                <option id=allChosen name="allChosen"></option>
              </select> 
              <th><button disabled id=transaction type="submit" onclick="makeTransaction();">Przejdź do transakcji</button></th>
              <th><button id=clear type="button" onclick="window.location.reload()">Wyczyść</button></th>
            </tr>
          </table>
        </div>
      </div>
    
      <div class="right">
        <label id=summary style="margin-left: 100px;">Podsumowanie</label>
        <table id=chosenElements style="margin-left: 100px;"></table>
      </div>

    </form>

  </body>
</html>
      </div>
    </div>
</div>

</body>
</html>