<h1><?php echo $titre;?></h1><br />
<?php

if (isset($news)){
    echo $news->ACT_idActualite;
    echo(" -- ");
    echo $news->ACT_intituleActualite;
    }
else {
    echo ("Pas d'actualité !");
}
?>