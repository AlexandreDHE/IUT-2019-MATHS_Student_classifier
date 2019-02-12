<!DOCTYPE html>
<html>

    <title>Classificateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <body>


    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

      <div class="w3-main" style="margin-left:0px;"> 

        <div class="w3-top w3-theme w3-large w3-hide-large">
          <i class="fa fa-bars w3-button w3-teal w3-xlarge" onclick="w3_open()"></i>
        </div>

        <header class="w3-container w3-theme w3-padding-64 w3-center">
          <h1 class="w3-xxxlarge w3-padding-16">Mathématiques & Informatique </h1>
        </header>

      <div class="w3-container w3-padding-large w3-section w3-light-grey">
      
          <h1 class="w3-jumbo">Le classificateur </h1>

          <p class="w3-xlarge">Choisissez une matière pour voir le classement des étudiants</p>

          <form name="classificateur" method="post" action="etape2.php">

            <input type="checkbox" name="check_list[]" value="1"> Etape 1: Afficher le résultat des votes
            <br> 
            <input type="checkbox" name="check_list[]" value="2"> Etape 2: Afficher la matrice des votes 

            <br> <br>

            <p> Etape 3: Sur quelle(s) matière(s) voulez vous faire un classement <p>

            <input type="checkbox" value="0" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 50px; margin-left: 15px;"> ACDA
            <input type="checkbox" value="1" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> ANGLAIS 
            <input type="checkbox" value="2" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> APL  
            <input type="checkbox" value="3" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> ART 
            <input type="checkbox" value="4" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> ASR  
            <input type="checkbox" value="5" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> EC  
            <input type="checkbox" value="6" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> EGOD     
            <input type="checkbox" value="7" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> MATHS 
            <input type="checkbox" value="8" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;margin-left: 15px;"> SGBD  
            <input type="checkbox" value="9" name="post[]" class="w3-button w3-theme w3-hover-white" href="/css/default.asp" style="font-size: 35px;background-color: red;margin-left: 15px;">SPORT<br><br>

            <input type="submit" name="valider" value="OK"/>

          </form>

      <div style="height: 50px;background: #f1f1f1;"> </div>

    </div>
     
      <footer class="w3-container w3-theme w3-padding-64 w3-center">

        <p><nav>
        <a href="http://dwarves.iut-fbleau.fr/~delahous" target="_blank">Alexandre Delahousse</a> 
        <a href="http://dwarves.iut-fbleau.fr/~quernec" target="_top">Thomas Quernec</a>
        </nav></p>

      </footer>

  <script>
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }

  openNav("nav01");
  function openNav(id) {
    document.getElementById("nav01").style.display = "none";
    document.getElementById("nav02").style.display = "none";
    document.getElementById("nav03").style.display = "none";
    document.getElementById(id).style.display = "block";
  }
  </script>

  <script src="https://www.w3schools.com/lib/w3codecolor.js"></script>

  <script>
  w3CodeColor();
  </script>

  </body>
  </html> 
