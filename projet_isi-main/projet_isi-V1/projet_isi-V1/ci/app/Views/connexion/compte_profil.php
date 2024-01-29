<h2>Données du profil</h2>
<?php
    $session = session();
    echo $le_message;
    echo $session->get('user');
    // Afficher les informations du compte
    echo "<table class='table'>";
    echo "<tr><th>Profil de</th><th>Type de compte</th></tr>";
    echo "<tr><td>{$infosCompte->CPT_loginCompte}</td><td>{$infosCompte->CPT_typeCompte}</td></tr>";
    // Ajoutez d'autres lignes pour afficher d'autres informations du compte...
    echo "</table>";


    /*echo "<p> id du compte : "  . $infosCompte->CPT_idCompte . "</p>";
    echo "<h2>Profil de " . $infosCompte->CPT_loginCompte . "</h2>";
    echo "<p>Type de compte : $infosCompte->CPT_typeCompte</p>";
    // Autres informations du compte ...*/

    // Bouton pour modifier le mot de passe
    echo "<a href='" . base_url() . "index.php/compte/compte_modifier_mot_de_passe' class='btn btn-primary'>Modifier le mot de passe</a>";

?>


