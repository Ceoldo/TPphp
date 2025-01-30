<?php
$message = 'Veuillez remplir le formulaire d\'inscription';

if (!empty($_POST)) {
    if (empty($_POST['nom'])) {
        $message = 'Veuillez indiquer votre nom de famille svp !';
    } elseif (empty($_POST['prenom'])) {
        $message = 'Veuillez indiquer votre prénom svp !';
    } elseif (empty($_POST['email'])) {
        $message = 'Veuillez indiquer votre email svp !';
    } elseif (empty($_POST['age'])) {
        $message = 'Veuillez indiquer votre âge svp !';
    } elseif (empty($_POST['sexe'])) {
        $message = 'Veuillez indiquer votre sexe svp !';
    } elseif (empty($_POST['rue'])) {
        $message = 'Veuillez indiquer votre rue svp !';
    } elseif (empty($_POST['zip'])) {
        $message = 'Veuillez indiquer votre code postal svp !';
    } elseif (empty($_POST['ville'])) {
        $message = 'Veuillez indiquer votre ville svp !';
    } elseif (empty($_POST['nationalite'])) {
        $message = 'Veuillez indiquer votre nationalité svp !';
    } elseif (empty($_POST['pays'])) {
        $message = 'Veuillez indiquer votre pays de naissance svp !';
    } elseif (empty($_POST['password'])) {
        $message = 'Veuillez indiquer votre mot de passe svp !';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $message = 'Les mots de passe ne correspondent pas !';
    } elseif (empty($_POST['consentement'])) {
        $message = 'Veuillez accepter les conditions de traitement des données !';
    } else {
        $message = 'Inscription réussie ! Bienvenue ' . htmlspecialchars($_POST['prenom'], ENT_QUOTES) . ' ' . htmlspecialchars($_POST['nom'], ENT_QUOTES) . ' !';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        select[multiple] {
            width: 300px;  /* Ajuste selon ta préférence */
            height: 120px;  /* Permet d'afficher plusieurs options */
        }
    </style>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom de famille :</label>
        <input type="text" id="nom" name="nom" value="<?php if (!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom'], ENT_QUOTES); } ?>" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php if (!empty($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom'], ENT_QUOTES); } ?>" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php if (!empty($_POST['email'])) { echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" required><br><br>

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" value="<?php if (!empty($_POST['age'])) { echo htmlspecialchars($_POST['age'], ENT_QUOTES); } ?>" required><br><br>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe" required>
            <option value="femme" <?php if (!empty($_POST['sexe']) && $_POST['sexe'] === 'femme') { echo 'selected'; } ?>>Femme</option>
            <option value="homme" <?php if (!empty($_POST['sexe']) && $_POST['sexe'] === 'homme') { echo 'selected'; } ?>>Homme</option>
        </select><br><br>

        <label for="rue">Numéro et nom de rue :</label>
        <input type="text" id="rue" name="rue" value="<?php if (!empty($_POST['rue'])) { echo htmlspecialchars($_POST['rue'], ENT_QUOTES); } ?>" required><br><br>

        <label for="zip">Code postal :</label>
        <input type="text" id="zip" name="zip" value="<?php if (!empty($_POST['zip'])) { echo htmlspecialchars($_POST['zip'], ENT_QUOTES); } ?>" required><br><br>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" value="<?php if (!empty($_POST['ville'])) { echo htmlspecialchars($_POST['ville'], ENT_QUOTES); } ?>" required><br><br>

        <label for="nationalite">Nationalité :</label>
        <select id="nationalite" name="nationalite" required>
            <?php
            $nationalites = file('nationality.csv', FILE_IGNORE_NEW_LINES);
            foreach ($nationalites as $nationalite) {
                echo "<option value='$nationalite'";
                if (!empty($_POST['nationalite']) && $_POST['nationalite'] === $nationalite) {
                    echo ' selected';
                }
                echo ">$nationalite</option>";
            }
            ?>
        </select><br><br>

        <label for="pays">Pays de naissance :</label>
        <select id="pays" name="pays" required>
            <?php
            $pays = file('pays.csv', FILE_IGNORE_NEW_LINES);
            foreach ($pays as $unPays) {
                echo "<option value='$unPays'";
                if (!empty($_POST['pays']) && $_POST['pays'] === $unPays) {
                    echo ' selected';
                }
                echo ">$unPays</option>";
            }
            ?>
        </select><br><br>

        <label for="description">Description (optionnel) :</label>
        <textarea id="description" name="description" maxlength="978"><?php if (!empty($_POST['description'])) { echo htmlspecialchars($_POST['description'], ENT_QUOTES); } ?></textarea><br><br>

        <label for="activites">Activités de loisir (choisissez entre 2 et 4) :</label>
        <select id="activites" name="activites[]" multiple required>
            <?php
            $activites = file('activity.txt', FILE_IGNORE_NEW_LINES);
            if (!empty($activites)) {
                foreach ($activites as $activite) {
                    echo "<option value='" . htmlspecialchars($activite, ENT_QUOTES) . "'";
                    if (!empty($_POST['activites']) && in_array($activite, $_POST['activites'])) {
                        echo ' selected';
                    }
                    echo ">" . htmlspecialchars($activite, ENT_QUOTES) . "</option>";
                }
            } else {
                echo "<option disabled>Aucune activité disponible</option>";
            }
            ?>
        </select><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirmation du mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="avatar">Avatar (optionnel, formats acceptés : PNG, JPEG, GIF) :</label>
        <input type="file" id="avatar" name="avatar"><br><br>

        <label for="consentement">
            <input type="checkbox" id="consentement" name="consentement" required>
            J'accepte le traitement et l'enregistrement de mes données à des fins internes et non commerciales.
        </label><br><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
