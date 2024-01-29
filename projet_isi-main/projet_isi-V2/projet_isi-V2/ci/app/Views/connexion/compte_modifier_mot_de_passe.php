<?= session()->getFlashdata('error') ?>
<div class='card border-warning mx-auto text-center mt-5 d-flex flex-column align-items-center' style='max-width: 50rem; border: 2px solid #ffc451;'>
    </br>

    <form class='form-inline' action="<?php echo base_url();?>index.php/compte/compte_modifier_mot_de_passe" method="post">
    <?= csrf_field() ?>
    </br>
    <h1> Changer votre mot de passe</h1>
    </br>
    <div class="mb-3">
      <label for="ancien_mot_de_passe">Ancien mot de passe : </label>
      <input type="password" name="ancien_mot_de_passe" value="<?= set_value('ancien_mot_de_passe'); ?>">
      <p class="text-danger"><?= validation_show_error('ancien_mot_de_passe') ?></p>
    </div>
    <div class="mb-3">
      <label for="nouveau_mot_de_passe">Nouveau mot de passe : </label>
      <input type="password" name="nouveau_mot_de_passe" value="<?= set_value('nouveau_mot_de_passe'); ?>">
      <p class="text-danger"><?= validation_show_error('nouveau_mot_de_passe') ?></p>
    </div>
    <div class="mb-3">
      <label for="confirmation_mot_de_passe">Confirmation du mot de passe : </label>
      <input type="password" name="confirmation_mot_de_passe">
      <p class="text-danger"><?= validation_show_error('confirmation_mot_de_passe') ?></p>
    </div>
      
    </br>
    <button type="submit" class="btn btn-primary" name="action" value="submit">Mettre à jour le mot de passe</button>
    </br>
    </br>

    <button type="submit" class="btn btn-primary" name="action" value="cancel">Annuler</button>
    </br>
    </br>
  </form>

</div>

</br>

<?php if (isset($validation)) : ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>