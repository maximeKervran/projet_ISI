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
if (!empty($scenario)) {

    echo "<h2>Liste des Scénarii</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Ordre</th>
            <th>Intitule</th>
            <th>Auteur</th>
            <th>Image</th>
            <th>Description</th>
            <th>Question</th>
            <th>Réponse</th>
        </tr>";

    foreach ($scenario as $etape) {
        echo "<tr>";
        echo "<td>{$etape['ETA_ordreEtape']}</td>";
        echo "<td>{$etape['ETA_intituleEtape']}</td>";
        echo "<td>{$etape['CPT_loginCompte']}</td>";
        echo "<td style='text-align: center;'><img src='" . base_url('uploads/') . "{$etape['SCE_imageScenario']}' alt='Scenario image' style='max-width: 80px; max-height: 80px;'></td>";
        echo "<td>{$etape['ETA_descrEtape']}</td>";
        echo "<td>{$etape['ETA_questionEtape']}</td>";
        echo "<td>{$etape['ETA_reponseEtape']}</td>";
        echo "</tr>";
    }

    echo "</table>";
}else {
    echo ("Pas d'étapes pour ce scénario !");
}
?>

