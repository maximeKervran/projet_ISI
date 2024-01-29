<h2>Données du profil</h2>
<?php
    $session = session();
    echo $le_message;
    echo $session->get('user');
    // Afficher les informations du compte
    echo "<table class='table'>";
    echo "<tr><th>Profil de</th>";
    echo "<th>Type de compte</th>";
    echo "<th>Activite du compte</th>";
    echo "<th>ID du compte</th></tr>";
    echo "<tr><td>{$infosCompte->CPT_loginCompte}</td>";
    echo "<td>{$typeCompte}</td>";
    echo "<td>{$infosCompte->CPT_activiteCompte}</td>";
    echo "<td>{$infosCompte->CPT_idCompte}</td></tr>";
    echo "</table>";

    // Bouton pour modifier le mot de passe
    echo "<a href='" . base_url() . "index.php/compte/compte_modifier_mot_de_passe' class='btn btn-primary'>Modifier le mot de passe</a>";
    echo"</br>";
    echo"type O = organisateur / type A =administrateur";

?>


