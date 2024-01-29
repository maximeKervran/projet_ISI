<?php
echo "<h2>Liste des Scénarii</h2>";
echo "<table border='1'>";
echo "<tr>
        <th>Intitule</th>
        <th>Auteur</th>
        <th>Image</th>
        <th>Code</th>
        <th>Etat</th>
        <th>Actions</th>
        <th>Activer/Désactiver</th>
    </tr>";

foreach ($scenario as $scenario) {
    echo "<tr>";
    echo "<td>{$scenario['SCE_intituleScenario']}</td>";
    echo "<td>{$scenario['CPT_loginCompte']}</td>";
    echo "<td style='text-align: center;'><img src='" . base_url('uploads/') . "{$scenario['SCE_imageScenario']}' alt='Scenario image' style='max-width: 50px; max-height: 50px;'></td>";
    echo "<td>{$scenario['SCE_codeScenario']}</td>";
    echo "<td>{$scenario['SCE_etatScenario']}</td>";
    echo "<td>";
    echo "<a href='" . base_url('index/scenario/visualiser/') . "{$scenario['SCE_codeScenario']}'>";
    echo "<button>Visualiser</button>";
    echo "</a>";
    echo "</td>";
    echo "<td>";

    if ($scenario['SCE_etatScenario'] == 'A') {
        echo "<a href='" . base_url('index/scenario/activer_desactiver/') . "{$scenario['SCE_codeScenario']}/D'>
                <button>Désactiver</button>
            </a>";
    } else {
        echo "<a href='" . base_url('index/scenario/activer_desactiver/') . "{$scenario['SCE_codeScenario']}/A'>
                <button>Activer</button>
            </a>";
    }

    echo "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<div style='text-align: center;'>
        <a href='" . base_url('index/scenario/ajouter/') . "'>
            <button style='background-color: #4CAF50; color: white;'>+</button> Ajouter un scénario
        </a>
    </div>";
?>
