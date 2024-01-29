<?php

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Scenario extends BaseController
{
    public function __construct()
    {
      $this->model = model(Db_model::class);
    }
    public function jouer()
    {

    $data['scenarii'] = $this->model->get_active_scenario();    

    return view('templates/haut', $data)
        . view('templates/menu_visiteur')
        . view('affichage_scenario')
        . view('templates/bas');
    }


    public function afficher_scenarii()
    {
      $data['titre'] = "espace organisateur";
      $data['session_user'] = session() ->get('user');
       $data['scenario'] = $this->model->get_all_scenario();

      return view('templates/haut_admin', $data)
            . view('templates/menu_organisateur')
            . view('afficher_liste_scenario', $data)
            . view('templates/bas_admin');
    }



    public function visualiser($idScenario = null)
    {
      if ($idScenario === null) {
        return redirect()->to(' /scenario/afficher_liste_scenario');
    }

      $data['scenario'] = $this->model->visualiser_scenario($idScenario);
      $data['titre'] = 'Visualisation de scénario';
      return view('templates/haut_admin', $data)
            . view('templates/menu_organisateur')
            . view('afficher_detail_scenario', $data)
            . view('templates/bas_admin');
    }


    public function ajouter()
{
    $session = session();

    if ($session->has('user')) {
        // Affichage de la vue
        return view('templates/haut_admin',)
            . view('templates/menu_organisateur')
            . view('ajouter_scenario',)
            . view('templates/bas_admin');

        // Si le formulaire est soumis
        if ($this->request->getMethod() == "post") {
            // Validation du formulaire
            if (!$this->validate([
                'intitule' => 'required|max_length[200]',
                'descr' => 'max_length[500]',
                'code' => 'required|max_length[8]',
                'image' => 'required'
            ], [
                // Messages d’erreurs
                'intitule' => [
                    'required' => 'Veuillez entrer un intitule !',
                    'max_length' => 'L intitule  saisi est trop long !',
                ],
                'descr' => [
                    'max_length' => 'La description saisi est trop longue !',
                ],
                'code' => [
                    'required' => 'Veuillez entrer un code !',
                    'max_length' => 'La code saisi est trop long !',
                ],
                'image' => [
                    'required' => 'Veuillez mettre une image !',
                ],
            ])) {
                // Retour à la page d'ajout avec les erreurs de validation
                echo "echec";
                return view('templates/haut_admin',)
            . view('templates/menu_organisateur')
            . view('ajouter_scenario',)
            . view('templates/bas_admin');
            }

            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            $intitule = $recuperation['intitule'];
            $descr = $recuperation['descr'];
            $code = $recuperation['code'];
            $image = $recuperation['image'];

            // Ajouter les données à la base de données
            $this->model->ajouter_scenario($intitule, $descr, $code, $image);

            $data['titre'] = $recuperation['intitule'];
            $data['le_message'] = "scénario ajouté ";

            // Redirection vers la page de succès
            return view('templates/haut_admin', $data)
                . view('templates/menu_organisateur')
                . view('succes_scenario')
                . view('templates/bas_admin');
        } else {
            // Affichage du formulaire
            return view('templates/haut_admin',)
            . view('templates/menu_organisateur')
            . view('ajouter_scenario',)
            . view('templates/bas_admin');
        }
    } else {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
}



    public function suppression_scenario($idScenario)
    {
        $session = session();

    if ($session->has('user')) {
        // Affichage de la vue
        return view('templates/haut_admin',)
            . view('templates/menu_organisateur')
            . view('confirmer_scenario',)
            . view('templates/bas_admin');

        // Si le formulaire est soumis
        if ($this->request->getMethod() == "post") {

            // Ajouter les données à la base de données
            if ($idScenario === null) {
                // Redirect to the scenario list page if no scenario ID is provided
                redirect()->to('/scenario/afficher_liste_scenario');
            }
            $this->model->suppression_scenario($idScenario);

            // Redirection vers la page de succès
            return view('templates/haut_admin', $data)
                . view('templates/menu_organisateur')
                . view('afficher_liste_scenario')
                . view('templates/bas_admin');
        } else {
            // Affichage du formulaire
            return view('templates/haut_admin',)
            . view('templates/menu_organisateur')
            . view('confirmer_suppression',)
            . view('templates/bas_admin');
        }
    } else {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
    }





    /*public function activer_desactiver($idScenario)
    {
        if ($codeScenario === null || $action === null) {
            // Redirect to the scenario list page if incomplete parameters
            redirect()->to('/scenario/afficher_liste_scenario');
        }

        // Call the model function to update the scenario status
        $this->model->activer_desactiver($idScenario);

    }*/
}