<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assurance Formulaire devis</title>
</head>
<body>
<form action="" method="post" >
    <div>
        <label for="name">Renseignez votre age: </label>
        <input type="number" min="18" name="age" id="name" required placeholder="chiffre en années">
    </div>
    <div>
        <label for="anciennete">Renseignez l'ancienneté de votre permis: </label>
        <input type="number" min="0" name="anciennetePermis" id="anciennete" required placeholder="xx années">
    </div>
    <div>
        <label for="assurance">Renseignez l'ancienneté de votre assurance: </label>
        <input type="number" min="0" name="assurance" id="ancienneteAssurance" required placeholder="format en chiffre">
    </div>
    <div>
        <label for="accident">Renseignez votre nombre d'accident responsable: </label>
        <input type="number" min="0" name="accident" id="accident" required placeholder="merci d'indiquer un nombre">
    </div>
    
    <div>
        <input type="submit" value="Enregistrer">
    </div>
</form> 

<?php

var_dump($_POST);

// ?age=52&anciennetePermis=22&assurance=10&accident=0

if(isset($_POST['age']) && isset($_POST['anciennetePermis']) && isset($_POST['assurance']) && isset($_POST['accident'])){

    // Les données que je recois via ma super-globale $_POST sont de type string. J'applique donc toute une série de fonctions natives à php afin de nettoyer / purifier / sanitize ma chaîne de caractère de tous caractères pouvant représenter un risque d'injection de code malveillant.
    
    // fonction trim() supprime espaces debut et fin de chaîner + certains caractères : https://www.php.net/manual/fr/function.trim.php
   $age = trim($_POST['age']);

   // fonction stripslashes() supprime les antislashs : https://www.php.net/manual/fr/function.stripslashes.php
   $age = stripslashes($age);

   // https://www.php.net/manual/fr/function.htmlspecialchars.php
   $age = htmlspecialchars($age);

   $age = filter_var($age, FILTER_SANITIZE_NUMBER_INT);

   $ancienneteAssurance = trim($_POST['assurance']);
   $ancienneteAssurance = stripslashes($ancienneteAssurance);
   $ancienneteAssurance = htmlspecialchars($ancienneteAssurance);
   $ancienneteAssurance = filter_var($ancienneteAssurance, FILTER_SANITIZE_NUMBER_INT);

   // Il faudrait appliquer l'ensemble des functions de "nettoyage" à chacun des index de $_POST, mais là je suis fainéante et vous avez compris le principe. 

   // Là je vais donc directement stocker les valeurs de $_POST dans des variables que je vais manipuler sans contrôle =>>>> il ne faut pas le faire dans la vraie vie. 

    $anciennetePermis = $_POST['anciennetePermis'];    
    $accident = $_POST['accident']; 

    $tarifCouleur = [
        "1" => "rouge", 
        "2" => "orange", 
        "3" => "vert", 
        "4" =>"bleu"
    ];

    $tarif = 1;

    // Partie Algorithmie
    // Ici je retranche du tarif le nombre d'accident


    $tarif -= $accident;

    // Une ancienneté de permis de plus de 2 ans augmente le palier d'un niveau
    if($anciennetePermis > 2){
        $tarif++;
    };

    // Si le conducteur a plus de 25 ans, le palier augmente d'un niveau
    if($age > 25){
        $tarif++;
    };
    // Une ancienneté d'assurance de plus de 5 ans augmente le palier d'un niveau si le conducteur n'est pas déjà refusé. 
    if($ancienneteAssurance > 5 && $tarif > 0){
        $tarif++;
    };

    /////////////// COMMENT EMPECHER QUE $tarif soit negatif ?

    // Solution 1 : par exemple, je peux empêcher que $tarif soit en dessous de 0 en mettant une structure de contrôle 
    /*
    if($tarif < 0){
        $tarif = 0;
    }
    */

    // Solution 2, je retranche le nombre d'accident de mon tarif si et seulement si mon nombre d'accident est inférieur à la valeur de tarif, par conséquent cette opération doit intervenir en dernier dans mon script. 
    /*
    if($accident >= $tarif){
        echo "Pas le droit d'assurer";
    }else {
        $tarif-=$accident;
    }
    var_dump($tarif);
    */

    // Solution 3 : 
    /*
    if($tarif > $accident){
        $tarif-=$accident;
    } else {
        $tarif = 0;
    }
    */
    ///////////////////////////////////////////////

    //(au dessous de 18 ans, je ne peux pas faire un devis d'assurance).
    if($age < 18){
        echo ' Vous êtes trop jeune, pas de devis d\'assurance possible';
    } elseif ($tarif <= 0){
        echo 'Vous n\'êtes pas assurable';
    }else {
        echo 'Vous bénéficiez du tarif '.$tarifCouleur[$tarif];
    }

}

    //var_dump($tarifCouleur);

?>
</body>
</html>