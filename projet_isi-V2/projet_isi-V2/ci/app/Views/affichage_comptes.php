
<?php 
if (isset($nombre)){
    echo(" -- ");
    echo $nombre->nbcompte;
    }
else {
    echo ("Pas de comptes !");

}
?>



<h2><?php echo $titre;?></h2>

<?php
if (! empty($logins) && is_array($logins))
{
    foreach ($logins as $pseudos)
    {
    echo "<br />";
    echo " -- ";
    echo $pseudos["CPT_loginCompte"];
    echo " -- ";
    echo "<br />";
    }
}
else {
    echo("<h3>Aucun compte pour le moment</h3>");
}
?>
