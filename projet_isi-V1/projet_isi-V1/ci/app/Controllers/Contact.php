<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Contact extends BaseController
{
	public function afficher()
	{
		//$data['parametre_url'] = ($donnee);

		return view('templates/haut_admin')
		. view('affichage_accueil')
		. view('templates/bas_admin');
	}
}
?>