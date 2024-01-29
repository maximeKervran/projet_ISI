<style>
  img {
	margin: 0 auto;
    width: 150px;
    height: 150px;
    background: #fff;
    border-radius: 4px;
    display: flex;
    margin-right: 1100px;
    transition: 0.3s;
}
  .etape-text {
    color: grey; /* ou une autre couleur grise selon vos préférences */
  }
</style>


<?php

    // Vérifier si les paramètres existent dans l'URL
    if (isset($etape)) {

echo "<div class='card border-warning mx-auto text-center mt-5 d-flex flex-column align-items-center' style='max-width: 80rem; border: 2px solid #ffc451; border-radius : 50px;'>";
echo "<div class='card-header'><h3 style='color: #b31717; font-weight: bold;'>" . $etape->ETA_intituleEtape . "</h3></div>";
echo "<div class='card-body text-secondary'>";
echo"<div class='image'>";
echo"<img src=". base_url()."uploads/astronaute_peche.png>";
echo"</div>";
echo $etape->ETA_descrEtape . "</div>";
echo "</br>";
echo "<h4 class='card-title'>". $etape->ETA_questionEtape ."</h4>";
echo "</br>";
echo "<div style='margin-top: 20px; font-style: italic;'>";
echo "<h5><a href='". $etape->IND_lienIndice ."'> indice<a href='". $etape->IND_lienIndice ."'>💡</a></h5>";
echo "</div>";
echo "</br></br>";
echo "<form class='form-inline'>";
echo "<div class='form-group mx-sm-3 mb-2'>";
echo "<input type='reponse' class='form-control' id='reponse' placeholder='réponse'>";
echo "</div>";
echo"</br>";
echo "<button type='submit' class='btn btn-danger mb-2'>Confirmer</button>";
echo "</form>";
echo "</br></br></br></br>";
echo "<p class='mt-auto text-center'><strong class='etape-text'>Etape n°1</strong></p>";
echo "</div>";

echo "</div>";


        // Utilisez $codeScenario et $indice comme nécessaire dans le reste de votre code.
    } else {
        // Afficher un message d'erreur si les paramètres ne sont pas présents
        echo"</br>";
        echo "Pas d'étapes dsponibles pour le moment";
        echo"</br>";
    }

?>