<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assurance Formulaire devis</title>
</head>
<body>
<form action="" method="get" >
    <div>
        <label for="name">Renseignez votre age: </label>
        <input type="number" min="0" name="age" id="name" required>
    </div>
    <div>
        <label for="anciennete">Renseignez l'ancienneté de votre permis: </label>
        <input type="number" min="0" name="anciennetePermis" id="anciennete" required>
    </div>
    <div>
        <label for="assurance">Renseignez l'ancienneté de votre assurance: </label>
        <input type="number" min="0" name="assurance" id="ancienneteAssurance" required>
    </div>
    <div>
        <label for="accident">Renseignez votre nombre d'accident responsable: </label>
        <input type="number" min="0" name="accident" id="accident" required>
    </div>
    
    <div>
        <input type="submit" value="Enregistrer">
    </div>
</form> 
</body>
</html>