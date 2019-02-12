<?php

/* Alexandre Delahousse & Thomas Quernec */ 
/* Cette page contient toutes les fonctions qui permettent l'établissement des classements */ 

ini_set("display_errors",0);error_reporting(0);

include ('fonctions_vue.php');

function createTabVoteListEtu($post_0){

    $res = array();

    /* Traitement des logins --> création d'un tableau qui reprend les logins du fichier login.json */

    $login = file_get_contents("login.json");
    $tabetudiant= json_decode($login,true);

    $Listetu=[];
    $Listetu_2=[];

    $c = 0 ;

    foreach ($tabetudiant as $key => $étudiant) {
        $c++;
        $Listetu[$c] = $key;
    }

    sort($Listetu);

    /* Traitement des votes --> création d'un tableau qui créé un tableau en fonction des votants - des matières - et des étudiants votés par le votant*/

    $tableau = file_get_contents("tableau.json");
    $tabM = json_decode($tableau,true);

    $c;
    $c1 = -1;
    $c2 = -1;
    $c3 = -1;

    /* Tableau des Étudiants qui ont voté */
    $ListEtu = array();

    /* Tableau qui repertorie les etudiants qui ont été élu 
    $tabVotes = array(array(array())); /* Tableau qui repertorie les étudiant qui ont été VOTÉ par les votants en fonction des matières*/
    $Listetu_2 = array(); 

    foreach ($tabM as $key1 => $electeur) {
        $c1++;
        $c2 = -1;
        $ListEtu[$c1] = $key1;
        foreach ($electeur as $key2 => $matière) {
            $c2++;
            $c3 = -1;
            foreach ($matière as $key3 => $élu) {
              	$c++;
            	$c3++;
            	$tabVotes[$c1][$c2][$c3] = $élu;
            	$Listetu_2[$c] = $élu;
          	}
        }
    }

    /*on trie dans l'ordre alphabétique le tableau des étudiants qui ont votés*/
    sort($ListEtu); 


	/* Liste de tous les étudiants qui ont eu un role dans ce classement. IL regroupe les etudiants des logins qui n'ont pas voté, les etudiants qui ont voté mais qui ne se trouvent pas dans login.json, et les etudiants qui ont été elu mais qui ne se trouve ni dans login.json, ni dans la liste des étudiants qui ont voté */
    $ListeEtutTotale = array_merge($Listetu, $ListEtu, $Listetu_2); 

    /* On enlève les doublons */ 
    $ListeEtutTotale = array_unique($ListeEtutTotale);

    /*On trie dans l'ordre alphabetique*/
    sort($ListeEtutTotale);

    /* Tableau de personnes qui n'on pas voté */ 
    $ListNONvote = array_diff($ListeEtutTotale, $ListEtu);

    /* Tableau qui a dans sa première partie les etudiants qui ont voté puis ceux qui n'ont pas voté */
    $ListeEtuVNV = array_merge($ListEtu, $ListNONvote);

    showMeTableDeVotes($ListeEtuVNV,$tabVotes, $ListEtu); /* Tableau recapitulatif des votes */
 

    $res[0]= $ListeEtuVNV;
    $res[1]= $ListeEtutTotale;
    $res[2]= $tabVotes;

    return $res; 
}

/*******  Représentaation sous forme de matrice  *******/

function createMatrice($tabM, $etudiant, $ListeEtutTotale, $choixMatière, $precision, $post_0){

      	$nbchoix = count($choixMatière); // Compte le nombre de matiere que l'utilisateur a choisi pour le classement
	    $nbetudianttotal = count($ListeEtutTotale); // Compte le nombre d'étudiant qui interviennent dans l'étude
	    $nbetudiant = count($etudiant);  //Compte e nombre détudiants qui ont voté
	    $nbmatiere = count($tabM); // Compte le nombre de matières (ACDA ...)

	    /* Calcule du coeff pour remplacer 0 par 0.000xxx */
	    $coeff = $precision/$nbetudianttotal ;
	    $formule;
	    $poidsVote;
	    /* Tous les etudiant n'ayant pas voté pour un etudiant se verra accordé un vote equivalent a un coeff de poids presque nul, celui du coeef ci-dessus */ 
	    $poidsNonVote = $coeff; 

	    /* Création d'un tableau de matrice en fonction de la matiere et du resultat des votes.*/ 
	    $tabmatrice = array(array(array())); // Tableau qui va représenter la matrice
	    $tabnbélu = array(array()); // Tableau qui enregistre le nombre d'élu par etudiant votant
	
	    for ($nb=0; $nb<$nbchoix; $nb++){ //Nombre de matières que l'on a selectionné 

	        for ($c=0; $c<$nbetudiant; $c++){ //lignes

	        	// On compte le nombre d'élèves elus par l'étudiant votant 
	            $nbélu = count($tabM[$c][$choixMatière[$nb]]); 
	            $tabnbélu[$nb][$c] = $nbélu;

	            /* Pour que la somme des valeurs d'une ligne, on remplace le 1 par une valeur plus petite en fonction du coeff(ci-dessus)*/
	            $formule = ((($nbetudianttotal - $nbélu)*$coeff)/$nbélu);
	            /*Le 1 pour un étudiant élu equivaut a une autre valeur, en fonction de nombre de personnes élus*/
	            $poidsVote = ((1/$nbélu)-$formule);

	            for ($m=0; $m<$nbetudianttotal; $m++){

	              	$bit = 0 ;
	              	$yes;

	              	for ($e=0; $e<$nbélu ; $e++){
		                if($tabM[$c][$choixMatière[$nb]][$e] == $ListeEtutTotale[$m]){
		                  	$bit = 1;
		                  	$yes = $tabM[$c][$choixMatière[$nb]][$e];
		                }
	              	}
	            
		            /* On remplit la matrice */ 
		            if($nbélu == 0 ){
		                $tabmatrice[$nb][$c][$m] = 1/$nbetudianttotal;
		              	}else {
		                  	if($bit == 0){
		                    	$tabmatrice[$nb][$c][$m] = $poidsNonVote;
		                  	}else {
		                    	$tabmatrice[$nb][$c][$m] = $poidsVote;
		                  	}	
		              	}
		        }

		        /* Pour verifier que la somme des lignes est bien egale a 1 */ /* OUII elle est bien = 1 */
		        if($nbélu == 0 ){
		            $total = (1/$nbetudianttotal)*$nbetudianttotal;
		         }else {
		            $total =(($nbélu*$poidsVote)+(($nbetudianttotal - $nbélu)*$poidsNonVote));
		        }
	        }

		    /* OPTION POUR AFFICHAGE DE LA MATRICE */ 
			 showMe($tabnbélu, $etudiant, $ListeEtutTotale, $tabmatrice,$choixMatière );

  		};

  		/* Fonction qui permet de mettre une matrice au carré, au cupe et a l'exposant n */
  		puissanceMatrice($tabnbélu, $etudiant, $ListeEtutTotale , $tabmatrice, $choixMatière);
}

/***************************************************  Représentaation sous forme de matrice exposant 100*****************************/

function puissanceMatrice($tabnbélu, $etudiant, $ListeEtutTotale, $tabmatrice, $choixMatière){

  		$taille = count($ListeEtutTotale); /* Taille du tableau d'étudiant */ 
  		$nbchoix = count($choixMatière); 
  
  		//showMe($tabnbélu, $etudiant, $ListeEtutTotale, $tabmatrice);

 		$tabmatriceP = array( array( array() ) );

 		/* Matrice au carré soit A PAR A, A ETANT LA MATRICE INITIALE */
  		for ($nb=0; $nb<$nbchoix; $nb++){

        	$somme = 0;
        	for ($k = 0; $k<$taille; $k++){
          		$somme = 0;
          		for ($l = 0; $l <$taille; $l++){
            		$somme = 0;
            		for ($m = 0; $m <$taille; $m++){
              			$produit=  $tabmatrice[$nb][$k][$l] * $tabmatrice[$nb][$k][$l] ;
              			$somme = $somme + $produit;
            		}
            		/* Le resulat est une matrice P, la matrice carré  de la matrice A */
            		$tabmatriceP[$nb][$k][$l] = $somme;
          		}
       		}

        	//showMe($tabnbélu, $etudiant, $ListeEtutTotale, $tabmatriceP);

       		/* Matrice au cube soit la nouvelle matrice P que multiplie la matrice A, A ETANT LA MATRICE INITIALE */
        	$somme = 0;
        	for ($k = 0; $k<$taille; $k++){
          		$somme = 0;
          		for ($l = 0; $l <$taille; $l++){
            		$somme = 0;
            		for ($m = 0; $m <$taille; $m++){
              			$produit=  $tabmatrice[$nb][$k][$l] * $tabmatriceP[$nb][$k][$l] ;
              			$somme = $somme + $produit;
            		}
              		$tabmatriceP[$nb][$k][$l] = $somme;
              		/* Resulat: matrice cubique de A */ 
          		}
        	}

        	//showMe($tabnbélu, $etudiant, $ListeEtutTotale, $tabmatrice);

        	$p = 6;


       		/* Matrice expsant n soit la nouvelle matrice P que multiplie la matrice A, A ETANT LA MATRICE INITIALE */
        	$somme = 0;
        	for ($ex = 0; $ex<2; $ex++){
          		$somme = 0;
          		for ($k = 0; $k< $taille; $k++){
            		$somme = 0;
            		for ($l = 0; $l < $taille; $l++){
             			$tabmatriceP[$nb][$k][$l] = (pow($tabmatriceP[$nb][$k][$l], 2) * $taille);
            		}
          		}
          		$p = $p*2;
          		if($ex == 4 ){
            		//showMe($tabnbélu, $etudiant, $ListeEtutTotale, $tabmatriceP);
          		}
        	}
  		}

  		/* Fonction qui va permettre d'établir le classement */ 
  		resultat($tabnbélu,$ListeEtutTotale,$tabmatriceP, $choixMatière);
}; 

function resultat($tabnbélu,$ListeEtutTotale,$tabmatriceP, $choixMatière){

		$nbetudiant = count($ListeEtutTotale);
    	$nbchoix = count($choixMatière);

    	$resultat = array();
    	$resultatM = array();

    	for ($nb=0; $nb<$nbchoix; $nb++){


    		/* On fait la sommes des colonnes de chaques étudiants pour faire un resulat total */ 
        	for ($k = 0; $k<$nbetudiant; $k++){
         		$somme = 0;
            	for ($l = 0; $l < $nbetudiant; $l++){
            		$somme = $somme + $tabmatriceP[$nb][$l][$k];
            	}
            	$resultat[$k] = $somme; 
        	}
        	/* On recère pour chaque matière le resultat de chaques élèves */ 
        	$resultatM[$nb] = $resultat; 
    	}
     
    	$resultat = array();

    	/* on additionne la note totale de chaque matières pour chaque élève */ 
    	for ($k = 0; $k<$nbetudiant; $k++){
        	$somme = 0;
        	for ($nb = 0; $nb < $nbchoix; $nb++){
        		$somme = $somme + $resultatM[$nb][$k] ;
        	}
        	$resultat[$ListeEtutTotale[$k]] = $somme; 
    	}
       	
    	arsort($resultat); /* Classement dans l'ordre decroissant */ 

    	$c1 = 0 ;

    	$resultatfinal = array();

    	foreach ($resultat as $key1 => $score) {
        	$resultatfinal[$c1][0] = $key1; /* élève */
        	$resultatfinal[$c1][1] = $score; /* note */ 
        	$c1++;
    	}

    	/* fonction qui affiche les resultats */
    	showMeClassement($ListeEtutTotale, $resultatfinal);
}

?>