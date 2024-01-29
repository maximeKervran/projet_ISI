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
        $resultat = $this->db->query("SELECT * FROM T_COMPTE_CPT;");
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
        LEFT JOIN T_INDICE_IND ON T_ETAPE_ETA.ETA_idEtape = T_INDICE_IND.ETA_idEtape AND IND_niveauIndice ='" .$indice ."'
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

    public function type_compte($u){
        //fonction pour vérifier si les infos récupérées sont bien reliées à un compte déja crée 
        $sql="SELECT CPT_typeCompte
        FROM T_COMPTE_CPT
        WHERE CPT_loginCompte='".$u."'
        AND CPT_activiteCompte = 'A';" ;
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



    public function modif_mdp($nouveaumdp)
{
    $session = session();
    $login = $session->get('user');

    // Fonction pour mettre à jour les infos du compte ouvert
    $sql = "UPDATE T_COMPTE_CPT
            SET CPT_mdpCompte = ?
            WHERE CPT_loginCompte = ?;";
    $resultat = $this->db->query($sql, [$nouveaumdp, $login]);
    
    return $resultat;
}




    public function get_all_scenario()
    {
       //fonction qui récupère le titre, la ressource, l'auteur, l'indice et le code d'un scénario
        $resultat = $this->db->query("SELECT SCE_idScenario, SCE_intituleScenario,SCE_etatScenario, SCE_imageScenario,CPT_loginCompte, IND_niveauIndice,SCE_codeScenario  FROM T_SCENARIO_SCE 
		JOIN T_COMPTE_CPT USING (cpt_idCompte)
		LEFT JOIN T_ETAPE_ETA USING (SCE_idScenario)
		LEFT JOIN T_INDICE_IND USING (ETA_idEtape)
        GROUP BY SCE_intituleScenario;");
        return $resultat->getResultArray();
    }


    public function visualiser_scenario($idScenario)
    {
        //fonction qui récupère les infos d'un scénario pour le visualiser
        $resultat = $this->db->query("SELECT * FROM T_ETAPE_ETA 
        JOIN T_SCENARIO_SCE USING (SCE_idScenario) 
        JOIN T_COMPTE_CPT USING (cpt_idCompte)
        WHERE SCE_idScenario = '".$idScenario."';");
        return $resultat->getResultArray();
    }


    public function suppression_scenario($idScenario)
    {
        //fonction qui supprime un scénario pour le visualiser avec d'abord les étapes puis le scénario

        $resultat = $this->db->query("DELETE FROM T_ETAPE_ETA WHERE SCE_idScenario ='".$idScenario."';
        DELETE FROM T_SCENARIO_SCE WHERE SCE_idScenario = '".$idScenario."';");
    }

    public function ajouter_scenario($intitule,$descr,$code,$image)
    {
        $session = session();
        $login = $session->get('user');
        //fonction qui crée un scénario

        $sql = "INSERT INTO T_SCENARIO_SCE VALUES
         (NULL, ?, ?, 'P', ?, ?, ?);";
             $resultat = $this->db->query($sql, [$intitule, $descr, $code, $login, $image]);

    }

    public function activer_desactiver($idScenario)
    {
        //fonction qui active/désactive un scénario
        $resultat = $this->db->query("UPDATE T_SCENARIO_SCE SET SCE_etatScenario = 'A' 
        WHERE SCE_idScenario = '".$idScenario."';");
    }

    /*public function prochaine_etape($idscenario,$etape){
        //fonction qui récupère le code de l'étape suivante à partir des infos du scenario et de l'étape précèdante
        $resultat = $this->db->query("SELECT ETA_codeEtape FROM T_ETAPE_ETA WHERE SCE_idScenario ='".$idScenario."'
        AND ETA_ordreEtape = '"$etape"';");

    }*/

    public function get_etape($code, $indice){
        //fonction qui récupère les infos de l'étape
        $resultat = $this->db->query("SELECT ETA_ordreEtape,ETA_intituleEtape,ETA_descrEtape,ETA_reponseEtape,ETA_questionEtape,SCE_idScenario,RES_idRessource,IND_lienIndice FROM T_ETAPE_ETA 
        JOIN T_SCENARIO_SCE USING (sce_idscenario)
        JOIN T_RESSOURCE_RES USING (RES_idRessource)
        LEFT JOIN T_INDICE_IND ON T_ETAPE_ETA.ETA_idEtape = T_INDICE_IND.ETA_idEtape AND IND_niveauIndice = '" .$indice . "'
        WHERE SCE_codeScenario = '".$code."';");
    }


    public function exist_participant($recuperation){
    //fonction qui vérifie si le participant existe déja dans la base de données
    $resultat = $this->db->query("SELECT COUNT(*) AS num_participant
    FROM T_PARTICIPANT_PAR WHERE PAR_adresseParticipant = '" .$recuperation."'
      AND PAR_prenomScenario = '" .$recuperation."' ;");
      return $resultat->getRow();
    }

    public function set_participant($recuperation){
    //fonction d'insertion du participant dans la table participation
    $sql = "INSERT INTO T_PARTICIPANT_PAR
    VALUES (NULL, ?, ?);";
    $resultat = $this->db->query($sql, [$recuperation, $recuperation]);

    
    }


    public function get_participant($recuperation){
    //fonction de récupération de l'id participant
    $resultat = $this->db->query("SELECT PAR_idParticipant FROM T_PARTICIPANT_PAR
    WHERE PAR_adresseParticipant = '". $recuperation . "' ;");
    return $resultat->getRow();
    
    }

    public function set_reussite($idscenario,$idparticipant,$niveau){
    //fonction d'insertion dans la table réussite
    $sql = "INSERT INTO T_REUSSITE_REU
    VALUES (?, ?, CURDATE(), CURDATE(), ?);";
    $resultat = $this->db->query($sql, [$idscenario, $idparticipant, $niveau]);
    }
}

