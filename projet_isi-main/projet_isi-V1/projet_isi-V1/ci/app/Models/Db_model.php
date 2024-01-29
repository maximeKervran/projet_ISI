<?php

namespace App\Models;
use CodeIgniter\Model;

class Db_model extends Model
{
    protected $db;

    public function __construct(){
        $this->db = db_connect(); //charger la base de données
        // ou
        // $this->db = \Config\Database::connect();
    }



    public function get_nb_compte(){
        $requete ="SELECT COUNT(*) AS nbcompte FROM T_COMPTE_CPT;";
        //fonction qui compte le nombre de compte de la table compte
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
        //Affichage de la ligne de résultat
    }




    public function get_nb_comptes()
    {
        // Fonction créée et testée dans le précédent tutoriel
        $resultat=$this->db->query("SELECT COUNT(*) as nb FROM T_COMPTE_CPT;");
        return $resultat->getRow();
    }




    public function set_compte($saisie)
    {
        // Récupération (+ traitement si nécessaire) des données du formulaire
        $login = $saisie['pseudo'];
        $mot_de_passe = $saisie['mdp'];
        $statut = $saisie['statut'];

        // Utilisation d'une requête préparée pour l'insertion
        $sql = "INSERT INTO T_COMPTE_CPT VALUES(NULL, ?, 'A', ?, ?);";
        return $this->db->query($sql, [$mot_de_passe, $login,$statut]);
    }




    public function get_all_compte(){
        $resultat = $this->db->query("SELECT CPT_loginCompte FROM T_COMPTE_CPT;");
        //fonction qui récupère tous les logins de compte de la table compte
        return $resultat->getResultArray();
        //affichage de tous les résultats avec une boucle   
    }

    /* Fonction membre à ajouter sous le constructeur et get_all_compte() : */




    public function get_actualite($numero){
        $requete="SELECT * FROM T_ACTUALITE_ACT WHERE ACT_idActualite=".$numero.";";
        //fonction qui récupère toutes les infos d'une actu dont l'id est $numero
        $resultat = $this->db->query($requete);
        //ligne qui effectue la requête et la met dans resultat
        return $resultat->getRow();
        //Affichage de la ligne de résultat
    }





    public function get_all_actu()
    {
        //fonction qui récupère le titre, la description, la date et l'auteur de toutes les actus
        $resultat = $this->db->query("SELECT ACT_intituleActualite,ACT_descrActualite,ACT_dateActualite,CPT_loginCompte FROM T_ACTUALITE_ACT JOIN T_COMPTE_CPT USING(CPT_idCompte) WHERE ACT_etatActualite = 'P';");
        return $resultat->getResultArray();
    }





    public function get_active_scenario()
    {
       //fonction qui récupère le titre, la ressource, l'auteur, l'indice et le code d'un scénario si le scénario est activé
        $resultat = $this->db->query("SELECT SCE_intituleScenario, SCE_imageScenario,CPT_loginCompte, IND_niveauIndice,SCE_codeScenario  FROM T_SCENARIO_SCE 
		JOIN T_COMPTE_CPT USING (cpt_idCompte)
		LEFT JOIN T_ETAPE_ETA USING (SCE_idScenario)
		LEFT JOIN T_INDICE_IND USING (ETA_idEtape)
		WHERE SCE_etatScenario LIKE 'P'
        GROUP BY SCE_intituleScenario;");
        return $resultat->getResultArray();
    }





    public function get_premiere_etape($code,$indice){
        //fonction qui récupère la position, le titre, la description, la reponse, la question, l'indice et l'id du scénario et de la ressource de la première étape du scénario
        $resultat = $this->db->query("SELECT ETA_ordreEtape,ETA_intituleEtape,ETA_descrEtape,ETA_reponseEtape,ETA_questionEtape,SCE_idScenario,RES_idRessource,IND_lienIndice FROM T_ETAPE_ETA 
        JOIN T_SCENARIO_SCE USING (sce_idscenario)
        JOIN T_RESSOURCE_RES USING (RES_idRessource)
        LEFT JOIN T_INDICE_IND ON T_ETAPE_ETA.ETA_idEtape = T_INDICE_IND.ETA_idEtape AND IND_niveauIndice =$indice
        WHERE SCE_codeScenario = '".$code."'  AND ETA_ordreEtape =1;");
        return $resultat->getRow();
    }



    public function connect_compte($u,$p)
    {
        //fonction pour vérifier si les infos récupérées sont bien reliées à un compte déja crée 
        $sql="SELECT CPT_loginCompte,CPT_mdpCompte
        FROM T_COMPTE_CPT
        WHERE CPT_loginCompte='".$u."'
        AND CPT_mdpCompte='".$p."' AND CPT_activiteCompte = 'A';" ;
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function type_compte($u,$p){
        //fonction pour vérifier si les infos récupérées sont bien reliées à un compte déja crée 
        $sql="SELECT CPT_typeCompte
        FROM T_COMPTE_CPT
        WHERE CPT_loginCompte='".$u."'
        AND CPT_mdpCompte='".$p."' AND CPT_activiteCompte = 'A';" ;
        $resultat=$this->db->query($sql);
        return $resultat->getRow();
    }



    public function infos_compte($u){
        //fonction pour afficher les infos du compte ouvert
        $sql="SELECT *
        FROM T_COMPTE_CPT
        WHERE CPT_loginCompte='".$u."'
        AND CPT_activiteCompte = 'A';" ;
        $resultat=$this->db->query($sql);
        return $resultat->getRow();
    }



    public function modif_mdp($login, $nouveaumdp)
    {
        //fonction pour afficher les infos du compte ouvert
        $sql="UPDATE T_COMPTE_CPT
        SET CPT_mdpCompte = '".$nouveaumdp."'
        WHERE CPT_loginCompte='".$login."';" ;
        $resultat=$this->db->query($sql);
        return $resultat;
        
    }


    public function get_all_scenario()
    {
       //fonction qui récupère le titre, la ressource, l'auteur, l'indice et le code d'un scénario si le scénario est activé
        $resultat = $this->db->query("SELECT SCE_intituleScenario,SCE_etatScenario, SCE_imageScenario,CPT_loginCompte, IND_niveauIndice,SCE_codeScenario  FROM T_SCENARIO_SCE 
		JOIN T_COMPTE_CPT USING (cpt_idCompte)
		LEFT JOIN T_ETAPE_ETA USING (SCE_idScenario)
		LEFT JOIN T_INDICE_IND USING (ETA_idEtape)
        GROUP BY SCE_intituleScenario;");
        return $resultat->getResultArray();
    }
}
