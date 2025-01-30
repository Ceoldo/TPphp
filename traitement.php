<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $rue = $_POST['rue'];
    $zip = $_POST['zip'];
    $ville = $_POST['ville'];
    $nationalite = $_POST['nationalite'];
    $pays = $_POST['pays'];
    $description = $_POST['description'] ?? ''; 
    $activites = implode(', ', $_POST['activites']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $consentement = isset($_POST['consentement']) ? 'Oui' : 'Non';

    
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    
    $fichier_utilisateurs = 'utilisateur.txt';
    if (file_exists($fichier_utilisateurs)) {
        $lines = file($fichier_utilisateurs, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $data = explode(';', $line);
            if ($data[2] === $email) {
                die("Une erreur est survenue : cet email est déjà enregistré.");
            }
        }
    }

    
    $avatar_path = '';
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $allowed_types = ['image/png', 'image/jpeg', 'image/gif'];
        if (in_array($_FILES['avatar']['type'], $allowed_types)) {
            $avatar_path = 'avatars/' . basename($_FILES['avatar']['name']);
            move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_path);
        } else {
            die("Format de fichier non supporté. Formats acceptés : PNG, JPEG, GIF.");
        }
    }

    
    $ligne = "$nom;$prenom;$email;$age;$sexe;$rue;$zip;$ville;$nationalite;$pays;$description;$activites;$password;$consentement;$avatar_path" . PHP_EOL;

    
    file_put_contents($fichier_utilisateurs, $ligne, FILE_APPEND);

    
    echo "Bienvenue sur le site $prenom $nom !";
}
?>
