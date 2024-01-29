<?php
//$uploaddir = '/home/2023DIFAL3/e22107124/public_html/gabarit/documents/';
$uploaddir = __DIR__. '/documents/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
echo $uploadfile;
echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Le fichier est valide, et a été téléchargé
    avec succès. Voici plus d'informations :\n";
} else {
    echo "Le fichier n’a pas été téléchargé. Il y a eu un problème !\n";
}
echo 'Voici quelques informations sur le téléversement :';
print_r($_FILES);


echo ("Page Web OK");
// Connexion à la base MariaDB
$mysqli = new mysqli('localhost','e22107124sql','yhmV3I8V','e22107124_db1');
if ($mysqli->connect_errno) {
//...
}


$requete = "UPDATE T_SCENARIO_SCE SET SCE_imageScenario='".$_FILES['userfile']['name']."' WHERE
SCE_idScenario=1;";

echo($requete);
$resultat=$mysqli->query($requete);
/*ajout dans scenario bdd*/
if (!$resultat)
{
// La requête a echoué ...
}
else
{
// La requête a réussi...

}

/*$requete2 = "SELECT SCE_imageScenario FROM `T_SCENARIO_SCE` WHERE SCE_idScenario = 1;"; 
echo($requete2);
$resultat=$mysqli->query($requete2);
/*ajout dans scenario bdd*/
if (!$resultat)
{
// La requête a echoué ...
}
else
{
// La requête a réussi...
}

$requete = "SELECT SCE_imageScenario FROM T_SCENARIO_SCE WHERE
SCE_idScenario=1;";
echo($requete);

$resultat=$mysqli->query($requete);
/*ajout dans scenario bdd*/
if (!$resultat)
{
// La requête a echoué ...
}
else
{
// La requête a réussi...

}

$result = $resultat->fetch_assoc();
echo($result['SCE_imageScenario']);

echo("<img src = documents/".$result['SCE_imageScenario'].">");

$mysqli->close();
?>
