<div class="container">
    <?php 
    if (isset($nombre)) {
        echo("<p>-- $nombre->nbcompte comptes activés--</p>");
    } else {
        echo("<p>Pas de comptes !</p>");
    }
    ?>
    <h2><?= $titre ?></h2>
</br>

    <?php
    if (!empty($logins) && is_array($logins)) {
    ?>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>statut</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($logins as $pseudos) {
                ?>
                    <tr>
                        <td><?= $pseudos["CPT_loginCompte"] ?></td>
                        <td><?= $pseudos["CPT_typeCompte"] ?></td>
                        <td><?= $pseudos["CPT_activiteCompte"] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo("<h3>Aucun compte pour le moment</h3>");
    }



    echo "<div style='text-align: center;'>
        <a href='" . base_url('index.php/compte/creer') . "'>
            <button style='background-color: #4CAF50; color: white;'>+</button> Créer un Compte
        </a>
    </div>";
    ?>
</div>
