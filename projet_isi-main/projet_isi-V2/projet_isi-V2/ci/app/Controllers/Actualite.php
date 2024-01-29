<?php

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Actualite extends BaseController
{
    public function __construct()
    {
        //...
    }


    public function afficher($numero = 0)
    //0 car actu auto-incrémentée donc 0 est inexistant
    {
        $model = model(Db_model::class);

        if ($numero == 0)
        {
            return redirect()->to('/');
        }
        else{
            $data['titre'] = 'Actualité :';
            $data['news'] = $model->get_actualite($numero);
            
            return view('templates/haut', $data)
                . view('affichage_actualite')
                . view('templates/bas');
        }
    }
}