<!DOCTYPE html>
<html>

    <title>Classificateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <body>

    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
       
        <div class="w3-main" style="margin-left:0px;"> 

            <div class="w3-top w3-theme w3-large w3-hide-large">
                 <i class="fa fa-bars w3-button w3-teal w3-xlarge" onclick="w3_open()"></i>
            </div>

<?php

        include ('fonctions_moteur.php');
 
        //ini_set("display_errors",0);error_reporting(0);
        
        $post_0 = array();
        $post_0=$_POST['check_list'];

        $post_1 = array();
        $post_1=$_POST['post'];

        $nbchoix = count($post_1);

        $res = array();
        $mat = array("ACDA", "ANGLAIS", "APL", "ART", "ASR", "EC", "EGOG", "MATHS", "SGBD", "SPORT");

        echo "<header class='w3-container w3-theme w3-padding-64 w3-center'>";
            echo "<h1 class='w3-xxxlarge w3-padding-16'>";
        
                for ($i = 0; $i<$nbchoix; $i++){
                    echo $mat[$post_1[$i]];
                    echo ". ";
                }
        
            echo "</h1>";
        echo "</header>";

        echo "<br> <br>";

        /* Création d'un Tableau structuré des données */
        $res = createTabVoteListEtu($post_0);

        /* Création de la matrice selon la matière et la $précision */
        createMatrice($res[2] ,$res[0], $res[1], $post_1 ,0.15, $post_0);

?>
    </body>
</html>
