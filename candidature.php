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
    $reglement  = isset($_POST['reglement']);

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
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <title>Candidature - Club Scolaire</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">

        <h1>Formulaire de candidature</h1>
        <p class="subtitle">Club Informatique de l'école</p>

        <!-- Affichage des erreurs -->
        <?php if (!empty($erreurs)): ?>
            <ul class="erreurs">
                <?php foreach ($erreurs as $e): ?>
                    <li><?php echo $e; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>


        <form action="candidature.php" method="POST">

            <!-- Champ Prénom -->
            <div class="champ">
                <label for="prenom">Prénom *</label>
                <!-- value dans la balise pour conserver la saisie -->
                <input type="text" id="prenom" name="prenom"
                       placeholder="Votre prénom"
                       value="<?php echo $prenom; ?>">
            </div>

            <!-- Champ Nom -->
            <div class="champ">
                <label for="nom">Nom *</label>
                <input type="text" id="nom" name="nom"
                       placeholder="Votre nom"
                       value="<?php echo $nom; ?>">
            </div>

            <!-- Champ Email -->
            <div class="champ">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email"
                       placeholder="exemple@domaine.com"
                       value="<?php echo $email; ?>">
            </div>

            <!-- Champ Âge -->
            <div class="champ">
                <label for="age">Âge *</label>
                <input type="number" id="age" name="age"
                       placeholder="Entre 16 et 30" min="16" max="30"
                       value="<?php echo $age; ?>">
            </div>

            <!-- Champ Filière -->
            <div class="champ">
                <label for="filiere">Filière souhaitée *</label>
                <select id="filiere" name="filiere">
                    
                    <option value="">-- Choisir --</option>
                    <!-- selected sur l'option qui correspond à $filiere -->
                    <option value="Informatique" <?php echo ($filiere === 'Informatique') ? 'selected' : ''; ?>>Informatique</option>
                    <option value="Électronique" <?php echo ($filiere === 'Électronique') ? 'selected' : ''; ?>>Électronique</option>
                    <option value="Mécanique"    <?php echo ($filiere === 'Mécanique')    ? 'selected' : ''; ?>>Mécanique</option>
                    <option value="Autre"        <?php echo ($filiere === 'Autre')        ? 'selected' : ''; ?>>Autre</option>
                </select>
            </div>

            <!-- Champ Motivation -->
            <div class="champ">
                <label for="motivation">Lettre de motivation * <small>(30 caractères minimum)</small></label>
                <!-- pour textarea, valeur entre les balises  -->
                <textarea id="motivation" name="motivation" rows="6"
                          placeholder="Expliquez pourquoi vous souhaitez rejoindre le club..."
                ><?php echo $motivation; ?></textarea>
            </div>

            <!-- Champ Règlement -->
            <div class="champ champ-checkbox">
                <label>
                    <!-- checked si la case avait été cochée -->
                    <input type="checkbox" name="reglement" value="1"
                           <?php echo $reglement ? 'checked' : ''; ?>>
                    J'ai lu et j'accepte le règlement du club.
                </label>
            </div>

            <!-- Bouton d'envoi -->
            <div class="champ">
                <button type="submit">Envoyer ma candidature</button>
            </div>

        </form>

    </div>
</body>
</html>