<?php

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Etape extends BaseController
{
    public function __construct()
    {
        $this->model = model(Db_model::class);
    }

    public function etape_jouer($code = '0',$indice = '0')
    {

    if ($code == '0' || $indice < '1' || $indice > '3')
        {
            return redirect()->to('/');
        }
        else{
            $data['etape'] = $this->model->get_premiere_etape($code,$indice);
            //$data['indice'] = $model->get_premiere_etape($code,$indice);    
   
            // L’utilisateur a validé le formulaire
            if($this->request->getMethod() == "post"){
                if(!$this->validate(
                    ['reponse' => 'required'],
                    /* Configuration des messages d’erreurs*/
                    ['reponse' => ['required' => "Vous devez entrer une réponse pour réussir l'etape !",]]
                )){
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/menu_visiteur', $data)
                    . view('affichage_prem_etape')
                    . view('templates/bas');
                }
                // La validation du formulaire a réussi !
                // Verification de la reponse
                $recuperation = $this->validator->getValidated();
                $bonne_reponse = $etape->ETA_reponseEtape;
                if(strtolower($recuperation['reponse']) == strtolower($bonne_reponse) ){
                    /* Bonne reponse */
                    $scenario=$this->model->get_scenario($code);
                    $idscenario = $scenario->SCE_idScenario;
                    $code_prochaine_etape = $this->model->prochaine_etape($idscenario,$etape->ETA_ordreEtape + 1);
                    return redirect()->to('scenario/franchir_etape/'.$code_prochaine_etape->ETA_codeEtape.'/'.$indice);
                
                }else{
                    /* Mauvaise reponse */
                    $data['le_message'] = 'Mauvaise réponse &#128533;';
                }


                
            }
            return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('affichage_etapes')
            . view('templates/bas');
       
        }

    }



public function franchir_etape($code = '', $indice = 0)
    {
        if ($code == '0' || $indice < '1' || $indice > '3')
        {
            $data['message_erreur'] = 'L\'information recherchée n\'existe pas !';
            return view('templates/menu_visiteur',$data)
               . view('affichage_prem_etape')
               . view('templates/bas');
        }
        else {
            $etape = $this->model->get_etape($code, $indice);
            $data['etape'] = $etape;
            $data['code_etape']=$code;
            $data['niveau'] = $indice;
         
            // L’utilisateur a validé le formulaire
            if($this->request->getMethod() == "post"){
                if(!$this->validate(
                    ['reponse' => 'required'],
                    /* Configuration des messages d’erreurs*/
                    ['reponse' => ['required' => "Vous devez entrer une réponse pour réussir l'etape !",]]
                )){
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/menu_visiteur', $data)
                        . view('affichage_etape')
                        . view('templates/bas');
                }
                // La validation du formulaire a réussi !
                // Verification de la reponse
                $recuperation = $this->validator->getValidated();
                $bonne_reponse = $etape->ETA_reponseEtape;
                if(strtolower($recuperation['reponse']) == strtolower($bonne_reponse) ){
                    /* Bonne reponse */
                    
                    $code_prochaine_etape = $this->model->prochaine_etape($etape->SCE_idScenario,$etape->ETA_ordreEtape + 1);
                    if(isset($code_prochaine_etape) && !empty($code_prochaine_etape)){
                        return redirect()->to('scenario/franchir_etape/'.$code_prochaine_etape->ETA_codeEtape.'/'.$indice);

                    }else{

                        // Il n'y a plus d'etape, redirecion vers la page de reussite
                        $session = session();
                        $session->set('user','participant');
                        $session->set('niveau',$indice);
                        $session->set('scenario',$etape->SCE_idScenario);
                        return redirect()->to('scenario/finaliser_scenario');
                    }


                }else{
                    /* Mauvaise reponse */
                    $data['le_message'] = 'Mauvaise réponse &#128533;';
                }

                
            }
                return view('templates/menu_visiteur', $data)
                    . view('affichage_etape')
                    . view('templates/bas');

        }
    }



    public function finaliser_scenario(){
        $session = session();
        if($session->has('user') && $session->get('user') == 'participant'){
            if ($this->request->getMethod() == "post") {
                if (!$this->validate(
                    ['nom' => 'required','mail' => 'required', 'nom' => 'required'],
                    /* Configuration des messages d’erreurs*/
                    [
                        'nom' => [
                            'required' => 'Veuillez entrer votre nom !',
                        ],

                        'mail' => [
                            'required' => 'Veuillez entrer une adresse mail!',
                        ],
                    ]
                )
            ) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/menu_visiteur')
                    .view('finalisation_scenario')
                    .view('templates/bas');

            }
            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();

            //requete  de verification si le participant existe deja
            if($this->model->exist_participant($recuperation) == 1 ){
                //le participant doit changer d'adresse mail
                $data['le_message'] = "Veuillez choisir une autre adresse email !";
                return view('templates/menu_visiteur',$data)
                    .view('finalisation_scenario')
                    .view('templates/bas');
            }else{
                //requete d'insertion du participant
                $this->model->set_participant($recuperation);

                //requete de recup id participant + recup id et niveau scenario via la session
                $idParticipant = $this->model->get_participant($recuperation)->PAR_idParticipant;
                $idScenario = $session->get('scenario');
                $niveau = $session->get('niveau');
                //requete d'insertion dans reussite
                $this->model->set_reussite($idscenario,$idparticipant,$niveau);
                //session destroy
                $session->destroy();
                //view reussite
                return view('finalisation_scenario_succes');
            }

            

            }
            // L’utilisateur veut afficher le formulaire pour enregistrer sa reussite
            return view('templates/menu_visiteur')
                    .view('finalisation_scenario')
                    .view('templates/bas');
        }
        else {
            //echo('Pirate !');
            return redirect()->to('/');

        }

    }
}
?>