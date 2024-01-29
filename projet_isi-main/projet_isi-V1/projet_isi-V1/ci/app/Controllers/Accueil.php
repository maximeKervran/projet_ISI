<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Accueil extends BaseController
{
	public function afficher()
	{
		$model = model(Db_model::class);
		$data['intitule'] = $model->get_all_actu();
		//$data['parametre_url'] = ($donnee);

		return view('templates/haut', $data)
		. view('templates/menu_visiteur')
		. view('affichage_accueil')
		. view('templates/bas');
	}
}
?>