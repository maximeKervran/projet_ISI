<?php

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Etape extends BaseController
{
    public function __construct()
    {
      //...  
    }

    public function etape_jouer($code = '0',$indice = '0')
    {
    $model = model(Db_model::class);

    if ($code == '0' || $indice < '1' || $indice > '3')
        {
            return redirect()->to('/');
        }
        else{
            $data['etape'] = $model->get_premiere_etape($code,$indice);
            //$data['indice'] = $model->get_premiere_etape($code,$indice);    
   

            return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('affichage_etapes')
            . view('templates/bas');
        }

    }
}
?>