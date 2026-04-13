
<?php
$prenom    = '';
$nom       = '';
$email     = '';
$age       = '';
$filiere   = '';
$motivation = '';
$reglement  = false;
$erreurs   = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prenom     = $_POST['prenom']     ?? '';
    $nom        = $_POST['nom']        ?? '';
    $email      = $_POST['email']      ?? '';
    $age        = $_POST['age']        ?? '';
    $filiere    = $_POST['filiere']    ?? '';
    $motivation = $_POST['motivation'] ?? '';


    $reglement = isset($_POST['reglement']); 

    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }
 
    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email est invalide.";
    }

    if (!is_numeric($age) || (int)$age < 16 || (int)$age > 30) {
        $erreurs[] = "L'âge doit être un nombre entre 16 et 30.";
    }

    if (empty($filiere)) {
        $erreurs[] = "Veuillez choisir une filière.";
    }

    if (strlen($motivation) < 30) {
        $erreurs[] = "La motivation doit contenir au moins 30 caractères.";
    }

    if (!$reglement) {
        $erreurs[] = "Vous devez accepter le règlement.";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Candidature - Club Scolaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Formulaire de candidature</h1>
        <p class="subtitle">Club Informatique de l'école</p>
    </div>

    <div>

        <form action="candidature.php" method="POST">
 
            <!--Champ Prénom -->
            <div class="champ">
                <label for="prenom">Prénom *</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">
            
            </div>
 
            <!--Champ Nom -->
            <div class="champ">
                <label for="nom">Nom *</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom">
            </div>
 
            <!--Champ Email -->
            <div class="champ">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email" placeholder="exemple@domaine.com">
            </div>
 
            <!--Champ Âge -->
            <div class="champ">
                <label for="age">Âge *</label>
                <input type="number" id="age" name="age" placeholder="Entre 16 et 30" min="16" max="30">
            </div>
 
            <!--Champ Filière -->
            <div class="champ">
                <label for="filiere">Filière souhaitée *</label>
                <select id="filiere" name="filiere">

                    <option value="">-- Choisir --</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Électronique">Électronique</option>
                    <option value="Mécanique">Mécanique</option>
                    <option value="Autre">Autre</option>

                </select>
            </div>
 
            <!--Champ Motivation -->
            <div class="champ">
                <label for="motivation">Lettre de motivation * <small>(30 caractères minimum)</small></label>
                <textarea id="motivation" name="motivation" rows="6" placeholder="Expliquez pourquoi vous souhaitez rejoindre le club..."></textarea>
            </div>
 
            <!--Champ Règlement-->
            <div class="champ champ-checkbox">
                <label>
                    <input type="checkbox" name="reglement" value="1">
                    J'ai lu et j'accepte le règlement du club.
                </label>
            </div>
 
            <!--Bouton d'envoi -->
            <div class="champ">
                <button type="submit">Envoyer ma candidature</button>
            </div>
 
        </form>
 
    </div>
    
</body>
</html>
