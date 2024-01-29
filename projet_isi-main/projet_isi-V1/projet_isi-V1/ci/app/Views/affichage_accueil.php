<style>
.titre {
	display : flex;
    justify-content: center;
      text-align: center;
	  width : 50%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Remplacez cela par la police de caractères que vous souhaitez utiliser */
      font-size: 24px;
      background-color: #ffc451; /* Couleur de fond */
	  border-radius : 50px;
      padding: 20px; /* Espacement interne */
	  margin-left : 25%;
    }

img {
	margin: 0 auto;
    width: 400px;
    height: 400px;
    background: #fff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    transition: 0.3s;
}

section {
  padding: 60px 0;
  overflow: hidden;
  transition: all ease-in-out 0.3s;
}

.section-title {
  padding-bottom: 40px;
  transition: all ease-in-out 0.3s;
}

.section-title h2 {
  font-size: 14px;
  font-weight: 500;
  padding: 0;
  line-height: 1px;
  margin: 0 0 5px 75px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #aaaaaa;
  font-family: "Poppins", sans-serif;
  transition: all ease-in-out 0.3s;
}

.section-title h2::after {
  content: "";
  width: 120px;
  height: 1px;
  display: inline-block;
  background: #ffde9e;
  margin: 4px 10px;
  transition: all ease-in-out 0.3s;
}

.section-title p {
  margin-left: 5%;
  font-size: 36px;
  font-weight: 700;
  text-transform: uppercase;
  font-family: "Poppins", sans-serif;
  color: #151515;
  transition: all ease-in-out 0.3s;
}


</style>

<!-- Contenu du fichier affichage_accueil.php !! -->
<br />
<?php
//echo $parametre_url;
echo"<div class='titre'>";
echo"<h1>Bienvenue dans les jeux sérieux sur l'espace</h1>";
echo"</div>";
echo"</br>";
echo"<div class='image'>";
echo"<img src=". base_url()."uploads/astronaute.png>";
echo"</div>";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<div class='section-title actualites-title'>";
echo "<h2>Actualités</h2>";
echo "<p>Actualités du site</p>";
echo "</div>";



if (! empty($intitule) && is_array($intitule))
{
	echo "<table class='table table-bordered table-striped overflow-auto mx-auto flex-column align-items-center' style='max-width: 80rem; border: 2px solid #ffc451;'>";
		echo "<thead>";
			echo "<tr>";
				echo "<th>titre</th>";
				echo "<th>description</th>";
				echo "<th>auteur</th>";
				echo "<th>date</th>";
			echo "</tr>";
		echo "</thead>";

	foreach ($intitule as $actus)
	{
	echo "<tbody>";
		echo "<tr>";
			echo "<td>";
			echo $actus["ACT_intituleActualite"];
			echo"</td>";
			echo "<td>";
			echo $actus["ACT_descrActualite"];
			echo"</td>";
			echo "<td>";
			echo $actus["CPT_loginCompte"];
			echo"</td>";
			echo "<td>";
			echo $actus["ACT_dateActualite"];
			echo"</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}


else {
    echo("<h3>Aucune actualité pour le moment</h3>");
   }
?>