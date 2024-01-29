    <style>
        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Style for table rows */
        tr {
            border-bottom: 1px solid #ccc;
        }

        /* Style for table cells */
        td {
            padding: 10px;
            vertical-align: top;
        }

        /* Style for table headers */
        th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
        }
    </style>

<?php

$session = session();
$login = $session->get('user');

echo "<h2>Liste des Scénarii</h2>";
echo "<table border='1'>";
echo "<tr>
        <th>Identifiant</th>
        <th>Intitule</th>
        <th>Auteur</th>
        <th>Image</th>
        <th>Code</th>
        <th>Visualiser</th>
        <th>Copier</th>
        <th>Remise à 0</th>
        <th>Supprimer</th>
        <th>Modifier</th>
        <th>Activer/Désactiver</th>
    </tr>";

foreach ($scenario as $scenario) {
    echo "<tr>";
    echo "<td>{$scenario['SCE_idScenario']}</td>";
    echo "<td>{$scenario['SCE_intituleScenario']}</td>";
    echo "<td>{$scenario['CPT_loginCompte']}</td>";
    echo "<td style='text-align: center;'><img src='" . base_url('uploads/') . "{$scenario['SCE_imageScenario']}' alt='Scenario image' style='max-width: 80px; max-height: 80px;'></td>";
    echo "<td>{$scenario['SCE_codeScenario']}</td>";
    echo "<td>";

    /** Affichage des bons boutons pour l'organisateur connecté **/
    if ($scenario['CPT_loginCompte'] == $login) {
        echo "<a href='" . base_url('index.php/scenario/afficher_detail_scenario/') . "{$scenario['SCE_idScenario']}'><button>Visualiser</button></a>";
        echo "</td>";
        echo "<td>";
        echo "<button>Copier</button>";
        echo "</td>";
        echo "<td>";
        echo "<button>RAZ</button>";
        echo "</td>";
        echo "<td>";
        echo "<a href='" . base_url('index.php/scenario/confirmer_suppression/') . "{$scenario['SCE_idScenario']}'><button>Supprimer</button></a>";
        echo "</td>";
        echo "<td>";
        echo "<button>Modifier</button>";
        echo "</td>";
        echo "<td>";

        if ($scenario['SCE_etatScenario'] == 'P') {
            echo "<a href='" . base_url('index.php/scenario/activer_desactiver/') . "{$scenario['SCE_codeScenario']}/D'>
                    <button>Désactiver</button>
                </a>";
        } else {
            echo "<a href='" . base_url('index.php/scenario/activer_desactiver/') . "{$scenario['SCE_codeScenario']}/A'>
                    <button>Activer</button>
                </a>";
        }


        echo "</td>";
    } else {
        echo "<a href='" . base_url('index.php/scenario/afficher_detail_scenario/') . "{$scenario['SCE_idScenario']}'><button>Visualiser</button></a>";
        echo "</td>";
        echo "<td>";
        echo "<button>Copier</button>";
        echo "</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
    }
}

echo "</table>";

echo "<div style='text-align: center;'>
        <a href='" . base_url('index.php/scenario/ajouter_scenario') . "'>
            <button style='background-color: #4CAF50; color: white;'>+</button> Ajouter un scénario
        </a>
    </div>";
?>
