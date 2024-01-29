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



    public function visualiser()
    {
      $data['scenario'] = $this->model->get_scenario_detail($scenario_code);


      if (empty($data['scenario'])){
        throw new PageNotFoundException('Impossible de trouver le scenario demandé !');
      }

      $data['titre'] = 'Visualisation de scénario';
      return view('templates/haut_admin', $data)
            . view('templates/menu_organisateur')
            . view('visualiser_scenario', $data)
            . view('templates/bas_admin');
    }

    /*public function activer_desactiver($scenario_code, $nouvel_etat)
    {
      try{

      }
    }*/
    
}