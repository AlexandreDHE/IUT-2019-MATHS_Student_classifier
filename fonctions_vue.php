<?php  

function showMeTableDeVotes($ListEtu,$tabVotes,$ListEtuVote){

    $nbetudiant = count($ListEtu);
    $nbvotes = count($ListEtuVote);

    

    echo "<p class='w3-xlarge' id='Etape1'><b>Etape1: Resultat des votes pour les étudiants qui ont voté</b></p>";

    echo "<a class='w3-xlarge' href='#Etape2'>Etape 2: Voire la matrice:</a><br/>";
    echo "<a class='w3-xlarge' href='#Etape3'>Etape 3: Voire le Classement:</a><br/>";

    echo "<br>";
    echo "<a class='w3-xlarge' href='index.html'>Page d'accueil</a><br/>";
    echo "<br>";

    echo '<table id="customers">';

    echo "<tr>";
    echo "<th>Etudiants</th>";
    echo "<th>ACDA</th>";
    echo "<th>ANG</th>";
    echo "<th>APL</th>";
    echo "<th>ART</th>";
    echo "<th>ASR</th>";
    echo "<th>EC</th>";
    echo "<th>EGOG</th>";
    echo "<th>MATH</th>";
    echo "<th>SGBD</th>";
    echo "<th>SPORT</th>";
    echo "</tr>";

    echo "<tr>";

    for ($c=0; $c<$nbvotes; $c++){ // nbligne

      echo "<th>";
      echo $ListEtu[$c];
      echo "</th>";

        for ($m=0; $m<10; $m++){
          $nbélu = count($tabVotes[$c][$m]);
          echo "<td>";
          for ($e=0; $e<$nbélu ; $e++){
            echo $tabVotes[$c][$m][$e];
            echo "<br>";
          }
            echo "</td>";
        }
        echo "</tr>";
    };

    echo '</table>';
}

function showMe($tabnbélu, $etudiant,$ListeEtutTotale, $tabmatrice, $choixMatière){

    $nbetudianttotal = count($ListeEtutTotale); // Compte le nombre d'étudiant enregistré (voté + élu mélangé)
    $nbetudiant = count($etudiant);

    echo "<p class='w3-xlarge' id='Etape2'><b>Etape2:Voici la matrice des votes, puis matrice exp(100) </b></p>";

    echo "<a class='w3-xlarge' href='#Etape3'>Etape 3: Voire le classement</a><br/>";
    echo "<a class='w3-xlarge' href='#Etape1'>Etape1: Voire le résultat des votes pour les étudiants qui ont voté</a><br/>";

    echo "<br>";
    echo "<a class='w3-xlarge' href='index.html'>Page d'accueil</a><br/>";
    echo "<br>";


    echo '<table id="customers">';

    echo "<tr>";
    echo "<th>nomMatiere</th>";
    echo "<th>Nb Votes</th>";

    for ($z=0; $z<$nbetudianttotal; $z++){
      echo "<th>";
      echo $ListeEtutTotale[$z];
      echo $z;
      echo "</th>";
    }

    for ($c=0; $c<$nbetudianttotal; $c++){ // nbligne
      echo "<tr>";

      echo "<th>";
      echo "$etudiant[$c]";
      echo $c;
      echo "</th>";

      echo "<td>";
      echo $tabnbélu[0][$c];
      echo "</td>";

      for ($m=0; $m<$nbetudianttotal; $m++){
        if ($tabmatrice[0][$c][$m] == $tabmatrice[0][0][0]){
          echo "<td>";
          echo $tabmatrice[0][$c][$m];
          echo "</td>";
        }else {
          echo "<td>";
          echo "<div>";
          echo $tabmatrice[0][$c][$m];
          echo "</div>";
          echo "</td>";
        }
      }
      echo "</tr>";
  };

  echo "</tr>";
  echo '</table>';
}

function  showMeClassement($ListeEtutTotale, $resultatfinal){

    $nbetudianttotal = count($ListeEtutTotale); // Compte le nombre d'étudiant enregistré (voté + élu mélangé)

    echo "<p class='w3-xlarge' id='Etape3'><b>Etape3:Voici le classement: </b></p>";

    echo "<a class='w3-xlarge' href='#Etape2'>Etape 2: Voire la matrice:</a><br/>";
    echo "<a class='w3-xlarge' href='#Etape1'>Etape1: Voire le résultat des votes pour les étudiants qui ont voté</a><br/>";

    echo "<br>";
    echo "<a class='w3-xlarge' href='index.html'>Page d'accueil</a><br/>";
    echo "<br>";

    echo '<table id="customers">';

    echo "<tr>";
    echo "<th> Classement </th>";
    echo "<th> Etudiants </th>";
    echo "<tr>";

    $d = 0;

    for ($c=0; $c<$nbetudianttotal; $c++){ // nbligne
      
      $d++;

      echo "<tr>";
      echo "<td>";
      echo " $d ";
      echo "</td>";

      echo "<td>";
      echo $resultatfinal[$c][0];
      echo "</td>";

      echo "<tr>";
    }

}

?>