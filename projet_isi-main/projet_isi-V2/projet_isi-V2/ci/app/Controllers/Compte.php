<?php

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Compte extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = model(Db_model::class);  
    }

    public function lister()
    {

        $data['nombre'] = $this->model->get_nb_compte();

        $data['titre']="Liste de tous les comptes";
        $data['logins'] = $this->model->get_all_compte();    

        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('affichage_comptes')
            . view('templates/bas');
    }



    public function creer()
    {

        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod() == "post") {
            if (! $this->validate([
                'pseudo' => 'required|max_length[50]|min_length[2]',
                'mdp' => 'required|max_length[64]|min_length[8]',
                'mdp2' => 'required|matches[mdp]',
                'statut' => 'required'
                ],
                [ // Configuration des messages d’erreurs
                'pseudo' => [
                    'required' => 'Veuillez entrer un pseudo pour le compte !',
                    'min_length' => 'Le pseudo saisi est trop court !',
                ],
                'mdp' => [
                    'required' => 'Veuillez entrer un mot de passe !',
                    'min_length' => 'Le mot de passe saisi est trop court !',
                ],
                'mdp2' => [
                    'required' => 'Veuillez confirmer le mot de passe !',
                    'matches' => 'Les mots de passe ne correspondent pas !',
                ],
                'statut' => [
                    'required' => 'Le statut du compte doit être précisé !',
                ],
                ])) {
                    // La validation du formulaire a échoué, retour au formulaire avec les erreurs
                    return view('templates/haut', ['titre' => 'Créer un compte'])
                        . view('templates/menu_administrateur')
                        . view('compte/compte_creer', ['validation' => $this->validator])
                        . view('templates/bas');
                }

            
            

            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();

            // Ajouter les données à la base de données
            $this->model->set_compte($recuperation);

            $data['le_compte'] = $recuperation['pseudo'];
            $data['le_message'] = "Nouveau nombre de comptes : ";

            // Appel de la fonction créée dans le précédent tutoriel :
            $data['le_total'] = $this->model->get_nb_comptes();

            return view('templates/haut_admin', $data)
                . view('templates/menu_administrateur')
                . view('compte/compte_succes')
                . view('templates/bas_admin');
        }

        // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut_admin', ['titre' => 'Créer un compte'])
            . view('templates/menu_administrateur')
            . view('compte/compte_creer')
            . view('templates/bas_admin');
    }



    public function connecter()
    {
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="post"){
            if (! $this->validate([
            'pseudo' => 'required',
            'mdp' => 'required'
            ]))
            { // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('templates/menu_visiteur')
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }


            // La validation du formulaire a réussi, traitement du formulaire
            $username=$this->request->getVar('pseudo');
            $mdp=$this->request->getVar('mdp');


            $sel = "3v942ufa789un27qab24r0dt4c09es";

            $password = hash('sha256', $mdp . $sel);



            $compte = $this->model->connect_compte($username,$password);
            if ($compte === true){
                // Connexion réussie, traitement du type de compte
                $session=session();
                $_SESSION['user'] = $username;

                $type = $this->model->type_compte($username,$password);

                if(($type->CPT_typeCompte == "O")){
                    return view('templates/haut_admin')
                    . view('templates/menu_organisateur')
                    . view('connexion/compte_accueil')
                    . view('templates/bas_admin');
                }else{
                    if(($type->CPT_typeCompte == "A")){
                        return view('templates/haut_admin')
                        . view('templates/menu_administrateur')
                        . view('connexion/compte_accueil')
                        . view('templates/bas_admin');
                    }
                }  
            }
            else
            { return view('templates/haut', ['titre' => 'Se connecter'])
                . view('templates/menu_visiteur')
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }
        }
        // L’utilisateur veut afficher le formulaire pour se conncecter
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }



    public function afficher_profil()
    {
        $session=session();
        if ($session->has('user'))
        {
            $infoscompte = $this->model->infos_compte($session->get('user'));
            $typeCompte = $this->model->type_compte($session->get('user'));

            if ($infoscompte)
            {
                $data['infosCompte'] = $infoscompte;
                $data['le_message'] = "Affichage des données du profil ici !!!";
                $data['typeCompte'] = ($typeCompte) ? $typeCompte->CPT_typeCompte : '';               
                
                if ($data['typeCompte'] == 'O') {
                    $data['menu'] = 'organisateur';
                } else {
                    $data['menu'] = 'administrateur';
                }
                
                return view("templates/haut_admin", $data)
                . view("templates/menu_{$data['menu']}")
                . view('connexion/compte_profil')
                . view("templates/bas_admin");
            }else{
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('templates/menu_visiteur')
                . view('connexion/compte_connecter')
                . view('templates/bas');
            }
        }else{
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }


    public function modifier_mot_de_passe()
    {
        $session = session();
    
        if ($session->has('user'))
        {
            $infoscompte = $this->model->infos_compte($session->get('user'));
            $data['typeCompte'] = ($infoscompte) ? $infoscompte->CPT_typeCompte : '';  
            if ($data['typeCompte'] == 'O') {
                $data['menu'] = 'organisateur';
            } else {
                $data['menu'] = 'administrateur';
            }             

            // Valider le formulaire
            if ($this->request->getMethod() == "post") {
                if (!$this->validate([
                'ancien_mot_de_passe' => 'required|min_length[8]',
                'nouveau_mot_de_passe' => 'required|min_length[8]',
                'confirmation_mot_de_passe' => 'required|matches[nouveau_mot_de_passe]'
                ],
                [ // Configuration des messages d’erreurs
                    'ancien_mot_de_passe' => [
                        'required' => 'Veuillez entrer votre mot de passe !',
                        'min_length' => 'Le mot de passe saisi est trop court !',
                    ],
                    'nouveau_mot_de_passe' => [
                        'required' => 'Veuillez entrer un nouveau mot de passe !',
                        'min_length' => 'Le mot de passe saisi est trop court !',
                    ],
                    'confirmation_mot_de_passe' => [
                        'required' => 'Veuillez confirmer le mot de passe !',
                        'matches' => 'Les mots de passe ne correspondent pas !',
                    ],
                    ])) {
                    // Retourner à la page de modification avec les erreurs de validation
                    return view('templates/haut_admin', ['titre' => 'Modifier le mot de passe'])
                    . view("templates/menu_{$data['menu']}")
                    . view('connexion/compte_modifier_mot_de_passe', ['validation' => $this->validator])
                    . view('templates/bas_admin');
                }


                // Vérifier si l'ancien mot de passe correspond
                $ancien_mdp_saisi = $this->request->getPost('ancien_mot_de_passe');
                $ancien_mdp_db = $infoscompte->CPT_mdpCompte;

                $sel = "3v942ufa789un27qab24r0dt4c09es";

                $ancien_mdp_saisi_hashe = hash('sha256', $ancien_mdp_saisi . $sel);

                if ($ancien_mdp_saisi_hashe !== $ancien_mdp_db) {
                    // Ancien mot de passe incorrect, retourner à la page de modification avec erreur
                    $this->validator->setError('ancien_mot_de_passe', 'Le mot de passe actuel est incorrect.');
                    return view('templates/haut_admin', ['titre' => 'Modifier le mot de passe'])
                        . view("templates/menu_{$data['menu']}")
                        . view('connexion/compte_modifier_mot_de_passe', ['validation' => $this->validator])
                        . view('templates/bas_admin');
                }


                // La validation du formulaire a réussi, traitement du formulaire
                $receptionmdp = $this->request->getPost('nouveau_mot_de_passe');

                $nouveaumdp = hash('sha256', $receptionmdp . $sel);

                // Mettre à jour le mot de passe
                $this->model->modif_mdp($nouveaumdp);

                $data['nouveau_mot_de_passe'] = $receptionmdp;
                $data['le_message'] = "Nouveau mot de passe : ";

                // Rediriger vers la page du profil
                $data['le_message']="Affichage des données du profil ici !!!";

                return view('templates/haut_admin',$data)
                . view("templates/menu_{$data['menu']}")
                . view('connexion/modifier_mdp')
                . view('templates/bas_admin');     
            }else{
                return view('templates/haut_admin', ['titre' => 'Modifier le mot de passe'])
                    . view("templates/menu_{$data['menu']}")
                    . view('connexion/compte_modifier_mot_de_passe')
                    . view('templates/bas_admin');
                }
        }else{
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }

    


    public function afficher_comptes()
    {
        $session=session();
        if ($session->has('user'))
        {
            $data['nombre'] = $this->model->get_nb_compte();

        $data['titre']="Liste de tous les comptes";
        $data['logins'] = $this->model->get_all_compte();    

        return view('templates/haut_admin', $data)
            . view('templates/menu_administrateur')
            . view('connexion/compte_tableau_comptes')
            . view('templates/bas_admin');
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
        }
    }

    public function deconnecter()
    {
        $session=session();
        $session->destroy();
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('templates/menu_visiteur')
        . view('connexion/compte_connecter')
        . view('templates/bas');
    }
}







