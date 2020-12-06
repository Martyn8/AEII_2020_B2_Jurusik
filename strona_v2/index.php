<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="./img/mini.jpg">
  <title>Aquapark Gliwice</title>
</head>
<body>
  <script src="dissapearing_nav_bar.js"></script> 
  <a href="#" id="scrollup">Powrót</a>
  <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="b4">
          <a href="#home"><h1><span>AQUA</span><div class="po">PARK</div></h1></a>
        </div>
        <div class="nav-list">
          <ul>
            <li><a href="#home" data-after="Home" class="active">Strona główna</a></li>
            <li><a href="#onas" data-after="O nas">O nas</a></li>
            <li><a href="#atrakcje" data-after="Atrakcje">Atrakcje</a></li>
            <li><a href="#cennik" data-after="Cennik">Cennik</a></li>
            <li><a href="#kontakt" data-after="kontakt">Kontakt</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->

  <!-- Popup Modal -->
  <div class="popup" id="popup">
    <div class="overlay"></div>
    <div class="content">
      <div class="close-btn" onclick="togglePopup()">&times;</div>
      <div class="popup-header">
        Kup bilet lub karnet już teraz!
      </div>
      <div class="popup-body" id="popup-body">

        <form method="post" action="transaction.php">

          <div class=main> 
            <h2 class="naglowek">Wybierz rodzaj, typ oraz czas przepustki:</h2>
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
            <label id=summary style="margin-left: 50px;">Podsumowanie</label>
            <table id=chosenElements style="margin-left: 50px;"></table>
          </div>
    
        </form>
      </div>
    </div>
  </div>
  <!-- End Popup Modal -->

  <!-- HOME Section  -->
  <section id="home">
    <div class="home container">
      <div class="na">
        <h1>Aquapark Gliwice - największy park wodny w Polsce</h1>
        <div class="middle">
        <a onclick="togglePopup()" type="button" id="kup" class="kup">Zamów bilet już teraz</a>
        </div>
      </div>
    </div>
  </section>
  <!-- End HOME Section  -->

  <!-- ONAS Section -->
  <section id="onas">
    <div class="onas container">
        <h1 class="section-title"><span>Aqua</span>park Gliwice</h1>
        <p> </p>
    </br></br><br><div class="onas-item">
          <h2>Dlaczego my?</h2>
          <p>Nasz Aquapark w Gliwicach jest położony w dogodnej lokalizacji, a mianowicie 5 minut od autostrady A4 i 15 minut od Drogowej Trasy Średnicowej co umożliwia szybkie dotarcie do placówki z większości miast aglomeracji Śląskiej. Ponadto nasz Aquapark dysponuje wieloma atrakcjami oraz niskimi cenami.</p>
        </div>
        <div class="onas-item">
          <h2>Setki atrakcji</h2>
          <p>Aquapark w Gliwicach to trzy strefy – Rekreacji, Sportu i Saunarium – z których każda wyróżnia się na swój sposób, tworząc jednocześnie spójną i atrakcyjną ofertę na aktywne spędzenie czasu wolnego.</p>
        </div>
          <div class="onas-item">
          <h2>Niskie ceny</h2>
          <p>W porównaniu do jakości oferowanej usługi nasze ceny są bardzo dogodne, co ważniejsze dla każdego dnia tygodnia i o każdej godzinie nasze ceny są niezmienne. Sprawdź zakładkę cennik, aby dowiedzieć się więcej.</p>
        </div>
        <div class="onas-item">
          <h2>Zamknięcie do odwołania</h2>
          <p>Niestety z powodu epidemii koronawirusa w Polsce i na świecie byliśmy zmuszeni do zamknięcia placówki od 10. października do odwołania. Jednak mimo wszystko będziemy przyjmować internetowe zamówienia karnetów i biletów na rok kalendarzowy 2021.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- End ONAS Section -->

  <!-- atrakcje Section -->
  <section id="atrakcje">
    <div class="atrakcje container">
      <div class="atrakcje-header">
        <h1 class="section-title">Nasze<span> Atrakcje</span></h1>
        <div class="atrakcje-info">
        <p>Aquapark w Gliwicach to trzy strefy – Rekreacji, Sportu i Saunarium – z których każda wyróżnia się na swój sposób, tworząc jednocześnie spójną i atrakcyjną ofertę na aktywne spędzenie czasu wolnego.</p>
        <BR><br><br><br><br><br><br></div>
      </div>
      <div class="all-atrakcje">
        <h1 class="section-title">STREFA<span> REKREACJI</span></h1>
        <p>Została zaprojektowana z myślą o osobach, które pragnąróżnorodnej rozrywki. Te atrakcje są często jedynie tłem licznych wydarzeń odbywających się w Aquadromie. Imprezy tematyczne, animacje, zajęcia aqua fresh w basenie zewnętrznym  czy wodne urodziny dla dzieci stały się ważnym punktem działalności obiektu.</p>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>La Chilera</h1></br>
            <h2>Strefa rekreacji</h2></br>
            <p>Relaks, wytchnienie, wypoczynek, chillout. Basen pokryty roślinnością z każdej niemal strony. Istna laguna, w której bicze wodne, gejzery, leżanki powietrzne i hydromasaże razem z pięknym krajobrazem tworzą oazę spokoju w Strefie </p>
         <br><br> </div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/155.png" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Cebula</h1></br>
            <h2>Strefa rekreacji</h2></br>
            <p>Najbardziej spektakularna zjeżdżalnia Aquaparku, nazwana tak żargonowo z powodu jej wyglądu. Zakończona wielkim lejkiem, w którym płynie się z zawrotną prędkością, wpadając w wir, by na końcu wylądować w basenie. Poziom startowy – 9 metrów. Zakręcone emocje gwarantowane! Ze zjeżdżalni można korzystać od 13 roku życia.</p>
        </br></br></div>
        
          <div class="atrakcje-img">
            <img class="iatra" src="./img/4.jpg" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Pętla żwawości</h1></br>
            <h2>Strefa rekreacji</h2></br>
            <p>Rwąca rzeka, o dużej szybkości, porwie nas do Sztormu Wielkiego. Możemy też – kiedy już wyrwiemy się z wartkiego nurtu – zrelaksować się na wodnej ławeczce. Atrakcja dozwolona od 12 roku życia.</p>
        </br></br></div>
        
          <div class="atrakcje-img">
            <img class="iatra" src="./img/212.png" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Długa ruuuura</h1></br>
            <h2>Strefa rekreacji</h2></br>
            <p>Zjeżdżalnia, która zachwyci każdego fana interakcji. Startujemy z poziomu ponad 14 metrów i jedziemy 139 metrów. Wraz z naszym startem uruchamiany jest stoper. Po drodze mijamy kilka interaktywnych miejsc wewnątrz zjeżdżalni, których należy dotknąć, aby zdobyć punkty. Po minięciu mety punkty przeliczane są na sekundy, które odejmujemy od czasu przejazdu.
               Ze zjeżdżalni można korzystać od 15 roku życia.</p>
        </br></br></div>

          <div class="atrakcje-img">
            <img class="iatra" src="./img/216.png" alt="img">
          </div>
        </div><br><br><br><br><br><br>
        <h1 class="section-title">STREFA<span> SPORTU</span></h1>
        <P>Odnajdują się w niej zwolennicy ustanawiania swoich życiowych rekordów, a także ci, którzy decydując się na korzystanie z basenu z ruchomym dnem, największe rekordy mają jeszcze przed sobą. Dwa baseny sportowe oraz specjalna fosa instruktorska stanowią doskonałe zaplecze dla początkujących pływaków. Dzieci, młodzież, jak również dorośli zdobywają umiejętności pływackie pod okiem wykwalifikowanych instruktorów. To właśnie z myślą o nich powstała Aquadromowa Szkoła Pływania.
        </P><br><br><br><br><br><br><br>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Basen sportowy</h1></br>
            <h2>Strefa sportowa</h2></br>
            <p>Klasyczny 25-metrowy basen podzielony na 4 tory. W godzinach porannych wykorzystywany głównie przez osoby, które bez intensywnego treningu nie wyobrażają sobie rozpoczęcia dnia.</p>
        </br></br></div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/5.jpg" alt="img">
          </div>
        </div>

        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Basen z ruchomym dnem</h1></br>
            <h2>Strefa sportowa</h2></br>
            <p>Nowatorski basen, którego głębokość uzależniona jest od rodzaju prowadzonych zajęć. Głębokość basenu możemy regulować od 0 cm do 180 cm. Ta część Aquaparku wykorzystywana jest przede wszystkim do zajęć z aqua fitnessu czy nauki pływania.</p>
        </br></br></div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/224.png" alt="img">
          </div>
        </div><br><br><br><br><br><br>
        <h1 class="section-title"><span> SAUNARIUM</span></h1>
        <P>Ścieżka Zmysłów czy Łaźnia Parowa wprawiają zarówno ciało, jak i umysł w stan głębokiego odprężenia. Pomagają w tym specjalne rytuały saunowe, wykonywane przez utytułowanych saunamistrzów. Około 10-minutowe seanse przygotowane w specjalnej oprawie muzycznej, z elementami teatralnymi, zapewniają nie tylko wyciszenie, ale i wysublimowaną rozrywkę.
        </P><br><br><br><br><br><br><br>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Sauna parowa</h1></br>
            <h2>Saunarium</h2></br>
            <p>Sauna parowa jest rodzajem zabiegu fizykalnego wykorzystywanego w leczeniu, odnowie biologicznej oraz w celach higienicznych. Kąpiel parową wykonuje się w pomieszczeniu o wysokiej zawartości pary wodnej. Wilgotność powietrza wewnątrz jest bliska 95 proc. Łaźnie parowe dysponują tzw. generatorami pary – urządzenia te pozwalają na zautomatyzowane zarządzanie poszczególnymi parametrami. Pomieszczenie jest rozgrzane do temperatury blisko 95oC, dodatkowo wywołuje się uderzenia strumienia pary wodnej, dzięki czemu zwiększeniu ulega wilgotność powietrza.</p>
        </br></br> </div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/6.jpg" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Biosauna</h1></br>
            <h2>Saunarium</h2></br>
            <p>Doskonałe miejsce dla tych, których do saunowania zniechęcają wysokie temperatury. W tym pomieszczeniu temperatura powietrza jest nieco niższa niż w pozostałych saunach, a wilgotność dość nietypowa jak dla sauny suchej. Dzięki niższej, niż w większości saun, temperaturze, można przebywać w niej nieco dłużej, bo od 15 do 30 minut. Aromatyczne olejki sprawią, że uczucie odprężenia będzie jeszcze głębsze.</p>
        </br></br></div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/1034.png" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Sauna na podczerwień</h1></br>
            <h2>Saunarium</h2></br>
            <p>Sauna infrared (sauna ir) czyli sauna na podczerwień sprawdzi się, gdy cierpisz na bóle kręgosłupa różnego pochodzenia, chorobę zwyrodnieniową stawów, dyskopatie, zaburzenia krążenia obwodowego, stany pourazowe narządu ruchu, cukrzycę czy otyłość. </p>
        </br></br> </div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/8.jpg" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Sauna ziołowa</h1></br>
            <h2>Saunarium</h2></br>
            <p>Idealne połączenie sauny parowej z leczniczym działaniem ziół, które w kabinie dozowane są za pomocą zintegrowanego rozpylacza.</p>
        </br></br></div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/9.jpg" alt="img">
          </div>
        </div>
        <div class="atrakcje-item">
          <div class="atrakcje-info">
            <h1>Sauna fińska</h1></br>
            <h2>Saunarium</h2></br>
            <p>Sauna fińska, zwana też suchą, jest znacznie efektywniejsza niż sauna mokra czy łaźnia parowa. Wysoka temperatura i niska wilgotność powodują intensywniejsze pocenie organizmu, a tym samym szybsze działanie na organizm.</p>
        </br></br></div>
          <div class="atrakcje-img">
            <img class="iatra" src="./img/10.jpg" alt="img">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End atrakcje Section -->

  <!-- About Section -->
  <section id="cennik">
        <h1 class="section-title"><span>Cen</span>nik</h1>
        <h2>Zaktualizowany na dzień dzisiejszy</h2>
        <p>Aquapark Gliwce oferuje najniższe ceny na Śląsku, nie robimy sztucznego podziału na godziny czy dni tygodnia. Cennik jest regularnie aktualizowany. Każda atrakacja jest opłacana osobno podczas rozliczenia przy kasie, a jej kwota wynosi 20 zł. Zakup karnetu i biletu po zakupie jest potwierdzany kodem weryfikacyjnym, uprzejmie prosimy o jego zatrzymanie w celach weryfikacji. Karnety oraz bilety nie mają konkretnego czasu aktywacji, data oraz godzina pierwszego wejścia na teren placówki są czasem aktywacji.</p>
        <table class="price_list">
            <tr>
                <th>Lp.</th>
                <th>Typ</th>
                <th>Rodzaj</th>
                <th>Czas</th>
                <th>Cena</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Bilet</td>
                <td>Normalny</td>
                <td>2h</td>
                <td>20</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Bilet</td>
                <td>Normalny</td>
                <td>4h</td>
                <td>25</td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Bilet</td>
                <td>Ulgowy</td>
                <td>2h</td>
                <td>12</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Bilet</td>
                <td>Ulgowy</td>
                <td>4h</td>
                <td>15</td>
            </tr>
        </table>
  </section>
  <!-- End About Section -->

  <!-- Contact Section -->
  <section id="kontakt">
       <div><h1 class="section-title"> <span>Kontakt</span></h1></div>
        <div class="kontakt-item">
          <div class="icon"><img class="ikonka" src="./img/2.png"/></div>
            <h1>Numer telefonu:</h1>
            <h1 style="color:black;">+123 456 789;</h1>
            <h1 style="color:black;">+987 654 321</h1>
        

          <div class="icon"><img class="ikonka" src="./img/3.png"/></div>
            <h1>Adres e-mail:</h1>
            <h1 style="color:black;">aquagc@gmail.com</h1>


          <div class="icon"><img class="ikonka" src="./img/4.png"/></div>
            <h1>Adres placówki:</h1>
            <h1 style="color:black;">Gliwice, Polska</h1>
        </div>
    </div>
    <h1 class="section-title"><span>Odwiedź Nas</span> też tutaj</h1>
    <div class="social-icon">
        <a href="facebook.com"><img class="ikonka" src="./img/5.png"/></a>
        <a href="instagram.com"><img class="ikonka" src="./img/5.jpeg"/></a>
        <a href="twitter.com"><img class="ikonka" src="./img/6.png"/></a> 
  </section>
  <!-- End Contact Section -->

<script>
  
  var mybutton = document.getElementById("scrollup");
   
 
   window.onscroll = function() {
     scrollFunction();
     dissapear();
   };
   
   function scrollFunction() {
     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
       mybutton.style.display = "block";
     } else {
       mybutton.style.display = "none";
     }
   }
   
   function topFunction() {
     document.body.scrollTop = 0;
     document.documentElement.scrollTop = 0;
   }

    var prevScrollpos = window.pageYOffset;
    
    function dissapear(){
   var currentScrollPos = window.pageYOffset;
   if (prevScrollpos > currentScrollPos) {
     document.getElementById("header").style.top = "0";
   } else {
     document.getElementById("header").style.top = "-100vw";
   }
   prevScrollpos = currentScrollPos;
 }


  // -- Popup functions -- //
  function togglePopup()
  {
    document.getElementById("popup").classList.toggle("active");
  }

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

    function sumPrices()
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
      var s = document.getElementById("sum").rows[1].cells[0].innerHTML;
      if(s != 0)
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
    // -- End Popup functions -- //

</script>
</body>
</html>