<style>
/*--------------------------------------------------------------
# Sections General
--------------------------------------------------------------*/
section {
  padding: 60px 0;
  overflow: hidden;
}

.section-title {
  padding-bottom: 40px;
}

.section-title h2 {
  font-size: 14px;
  font-weight: 500;
  padding: 0;
  line-height: 1px;
  margin: 0 0 5px 0;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #aaaaaa;
  font-family: "Poppins", sans-serif;
}

.section-title h2::after {
  content: "";
  width: 120px;
  height: 1px;
  display: inline-block;
  background: #ffde9e;
  margin: 4px 10px;
}

.section-title p {
  margin: 0;
  margin: 0;
  font-size: 36px;
  font-weight: 700;
  text-transform: uppercase;
  font-family: "Poppins", sans-serif;
  color: #151515;
}

/*--------------------------------------------------------------
# About
--------------------------------------------------------------*/
.about .content h3 {
  font-weight: 700;
  font-size: 28px;
  font-family: "Poppins", sans-serif;
}

.about .content ul {
  list-style: none;
  padding: 0;
}

.about .content ul li {
  padding: 0 0 8px 26px;
  position: relative;
}

.about .content ul i {
  position: absolute;
  font-size: 20px;
  left: 0;
  top: -3px;
  color: #ffc451;
}

.about .content p:last-child {
  margin-bottom: 0;
}

/*--------------------------------------------------------------
# Clients
--------------------------------------------------------------*/
.clients {
  padding-top: 20px;
}

.clients .swiper-slide img {
  opacity: 0.5;
  transition: 0.3s;
  filter: grayscale(100);
}

.clients .swiper-slide img:hover {
  filter: none;
  opacity: 1;
}

.clients .swiper-pagination {
  margin-top: 20px;
  position: relative;
}

.clients .swiper-pagination .swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  background-color: #fff;
  opacity: 1;
  background-color: #ddd;
}

.clients .swiper-pagination .swiper-pagination-bullet-active {
  background-color: #ffc451;
}

/*--------------------------------------------------------------
# Features
--------------------------------------------------------------*/
.features {
  padding-top: 20px;
}

.features .icon-box {
  padding-left: 15px;
}

.features .icon-box h4 {
  font-size: 20px;
  font-weight: 700;
  margin: 5px 0 10px 60px;
}

.features .icon-box i {
  font-size: 48px;
  float: left;
  color: #ffc451;
}

.features .icon-box p {
  font-size: 15px;
  color: #848484;
  margin-left: 60px;
}

.features .image {
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  min-height: 400px;
}

/*--------------------------------------------------------------
# Services
--------------------------------------------------------------*/
.galerie {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.galerie .col-lg-4 {
  width: calc(33.33% - 20px); /* Ajuste la largeur*/
  margin-bottom: 20px; /* Ajoute un espace entre les éléments */
  margin-left: 10px;
}

a {
  color: #9a9a9a;
  text-decoration: none;
}

a:hover {
  color: #000;
  text-decoration: none;
}

.indice {
  display: flex;
  height : 8%;
  justify-content: space-around;
}

.indice span {
  padding: 10px; /* Ajustez la valeur d'espacement selon vos préférences */
  border: 1px solid #ccc; /* Ajoutez une bordure pour séparer les indices */
  border-radius: 10px; /* Ajoutez des bords arrondis */
  transition: background-color 0.3s; /* Ajoutez une transition pour une animation fluide */
}

.indice span:hover {
  background-color: #ffc451; /* Changez la couleur en jaune lorsque la souris est dessus */
}

.services .icon-box {
  text-align: center;
  border: 1px solid #ebebeb;
  padding: 80px 20px;
  transition: all ease-in-out 0.3s;
  background: #fff;
}

.services .icon-box .icon {
  margin: 0 auto;
  width: 400px;
  height: 300px;
  background: #fff;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  transition: 0.3s;
}

.services .icon-box .icon i {
  color: #151515;
  font-size: 28px;
  transition: ease-in-out 0.3s;
}

.services .icon-box h4 {
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 24px;
}

.services .icon-box h4 a {
  color: #151515;
  transition: ease-in-out 0.3s;
}

.services .icon-box h4 a:hover {
  color: #000;
}

.services .icon-box p {
  line-height: 24px;
  font-size: 14px;
  margin-bottom: 0;
}

.services .icon-box:hover {
  border-color: #ffc451;
  box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
  transform: translateY(-10px);
}

</style>

<?php
if (! empty($scenarii) && is_array($scenarii))
{
  echo"<section id='services' class='services'>";
      echo"<div class='container' data-aos='fade-up'>";
  echo"<div class='section-title'>";
  echo"<h2>Scenario</h2>";
  echo"<p>Galerie des Scenarii</p>";
echo"</div>";
echo "</div>";
echo"</section>";
echo"<div class='galerie'>";
    foreach ($scenarii as $sce)
    {
      echo"<section id='services' class='services'>";
      echo"<div class='container' data-aos='fade-up'>";
        

      echo"<div class='col-lg-4 col-md-6 d-flex align-items-stretch mt-4' data-aos='zoom-in' data-aos-delay='50'>";
        echo"<div class='icon-box'>";
        echo"<div class='icon'>";
        echo"<img src=". base_url()."uploads/".$sce["SCE_imageScenario"]." width='310' height='250'>";
        echo "</div>";
        echo"<h3>";
        echo $sce["SCE_intituleScenario"];
        echo "</h3>";
        echo"</br>";
        echo"<h4>";
        echo"auteur :  ";
        echo $sce["CPT_loginCompte"];
        echo"</h4>";
        echo"</br>";
        echo"</br>";
        echo"<h5>";
        echo"Difficulté :";
        echo"</h5>";
        echo"</br>";
        echo"<div class='indice'>";
        echo "<span>";
        echo "<a href='" . base_url() . "index.php/etape/etape_jouer/" . $sce["SCE_codeScenario"] . "/1' class='facile' style='color: green;'>Facile</a>";
        echo"</span>";
        echo "<span>";
        echo "<a href='" . base_url() . "index.php/etape/etape_jouer/" . $sce["SCE_codeScenario"] . "/2' class='moyen' style='color: blue;'>Moyen</a>";
        echo"</span>";
        echo "<span>";
        echo "<a href='" . base_url() . "index.php/etape/etape_jouer/" . $sce["SCE_codeScenario"] . "/3' class='difficile' style='color: red;'>Difficile</a>";
        echo"</span>";
        echo "</div>";
      echo"</div>";
    echo"</div>";
  echo"</div>";

echo"</section>";




    }
    echo "</div>";
}
else {
	echo"<section id='services' class='services>";
	echo"<div class='container' data-aos='fade-up'>";
	echo"<div class='section-title'>";
	echo"<h2>Scenario</h2>";
	echo"<p>Galerie des Scenarii</p>";
	echo"</div>";
	echo"</div>";
	echo"</section>";
    echo ("Pas de scénarii activés !");
}     

 
?>
