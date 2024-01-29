

<div class="container">
<div class ="container d-flex flex-column align-items-center" style="padding:5%; margin:5%; border-radius:10%; border: solid #EEE7DA; background-color: rgba(136, 171, 142,50%);">
<?php

if(isset($le_message))
{ 
  echo('<div class="alert alert-danger">
  <strong>Dommage...</strong> - '.$le_message.'</div>');
}




  if(isset($etape)){
   
    echo ('<B><h1>'.$etape->ETA_intituleEtape.'</h1></B></br>');
    echo('<p>'.$etape->ETA_descrEtape.'</p>');
    echo('<img src="'.base_url()."uploads/".$etape->RES_idRessource.'" class="img-responsive" alt="" style="height:300px;"></br>');
    
    
    

    if($etape->IND_lienIndice != NULL){
      echo('<div id="qind" style="display:flex; flex-direction : row; flex-wrap: wrap; align-items: center; ">');
      echo('<B><span> '.$etape->ETA_questionEtape.'    </span></B></br>');
          echo('
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="background-color: rgba(255,255,255,0) ; border : none;"><img src="'.base_url().'/uploads/indice.png" style ="width: 30px; object-fit : contain;"/></button>


        </div>


          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">INDICE</h4>
                </div>
                <div class="modal-body">
                  <p>'.$etape->IND_descrIndice." Plus d'infos <a href='".$etape->IND_lienIndice."'>ICI</a>.".'</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
          
          ');
      
    }
    else{
      echo(/*"<U>Pas d'indice pour cette question !</U>"*/"");
        echo('<B><span> '.$etape->ETA_questionEtape.'</span></B></br>');
    }
    

      echo form_open('scenario/franchir_etape/'.$code_etape.'/'.$niveau);
      
      echo('<div style="display:flex; flex-direction:column; align-items : center;">');
      echo('<div class="mb-3">
      <input type="text" name="reponse">
      <p class="text-danger">'.validation_show_error('reponse').'</p>
      </div>');
      
      echo('</br>
      <button type="submit" class="btn btn-primary" name="action" value="submit">Répondre</button>
      </br>');
      
      echo('</div>');
      
      
      echo('</form>');

  }
  else{
    if(isset($message_erreur)) echo("<h1>".$message_erreur."</h1></br><h2>Vous allez être rediriger vers la page des scenarios</h2>");
    else echo("<h1>Ce scenario n'a pas d'étapes pour le moment !</h1></br><h2>Vous allez être rediriger vers la page des scenarios</h2>");
    header("Refresh: 3;URL=".base_url()."index.php/scenario/lister");
    
  }
?>
</div>
</div>